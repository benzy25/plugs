<?php
/*
All the functions are in the PHP pages in the functions/ folder.
*/

require_once locate_template('/functions/cleanup.php');
require_once locate_template('/functions/setup.php');
require_once locate_template('/functions/enqueues.php');
require_once locate_template('/functions/navbar.php');
require_once locate_template('/functions/widgets.php');
require_once locate_template('/functions/search.php');
require_once locate_template('/functions/feedback.php');

add_action('after_setup_theme', 'true_load_theme_textdomain');

wp_enqueue_style( 'superfish', get_template_directory_uri() . '/css/superfish.css', false, GENERATE_VERSION, 'all' );
wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), GENERATE_VERSION, true );

function true_load_theme_textdomain(){
    load_theme_textdomain( 'bst', get_template_directory() . '/languages' );
}

function register_my_menus() {
  register_nav_menus(
    array(
      'home'               => __( 'Home' ),
      'sign-in-menu'       => __( 'Sign In Menu' ),
      'medical-equipment'  => __( 'Medical Equipment' ),
      'parts-search'       => __( 'Parts Search' ),
      'repairs'            => __( 'Repairs' ),
      'manufacturers'      => __( 'Manufacturers' ),
      'myaccount'          => __( 'My Account' ),
      'about-us'           => __( 'About Us' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';
if(file_exists($preview)) {
     require $preview;
 }

// Change number or products per row, and number of products per page
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
if (is_woocommerce() && is_archive()) {
        wp_enqueue_script( 'frontend-custom', get_template_directory_uri() . '/js/frontend-custom.js', array("jquery"));
            add_thickbox();
}


//remove "Add to Cart" button on product listing page in WooCommerce
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

function remove_add_to_cart_buttons() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}


//Re-Order product page layouts
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );// Button
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 11 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',   10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );// Button

// PREFIX ORDERNUMMER ADD MM- BENZ
add_filter( 'woocommerce_order_number', 'prefix_woocommerce_order_number', 1, 2 );

function prefix_woocommerce_order_number( $oldnumber, $order ) {
    return 'EC-' . $order->id;
}

// Confirm password field on the register form under My Accounts BENZ
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
	?>
<div id="left-col-confirm-pass">
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
</div>
	<?php
}

// Display Price For Variable Product With Same Variations Prices
add_filter('woocommerce_available_variation', function ($value, $object = null, $variation = null) {
if ($value['price_html'] == '') {
$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
}
return $value;
}, 10, 3);


//remove '(Free)' or '(FREE!)' label text on cart page for Shipping and Handling if cost equal to $0
function benz_custom_shipping_free_label( $label ) {
    $label =  str_replace( "(Free)", " ", $label );
    $label =  str_replace( "(FREE!)", " ", $label );

    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label' , 'benz_custom_shipping_free_label' );

// get rid of users "POSTS" cloumn, -- never use it
add_action('manage_users_columns','remove_user_posts_column');
function remove_user_posts_column($column_headers) {
    unset($column_headers['posts']);
    return $column_headers;
}


//  -- New Class to add Sortable Registered date in users wp dash -- HOT

class RRHE {

//  -- roll the ball
    public function __construct() {
        add_action( 'init', array( &$this, 'init' ) );
    }

//  -- All init functions
    public function init() {
		add_filter( 'manage_users_columns', array( $this,'users_columns') );
		add_action( 'manage_users_custom_column',  array( $this ,'users_custom_column'), 10, 3);
		add_filter( 'manage_users_sortable_columns', array( $this ,'users_sortable_columns') );
		add_filter( 'request', array( $this ,'users_orderby_column') );
		add_action( 'plugins_loaded', array( $this ,'load_this_textdomain') );
		// add_filter( 'plugin_row_meta', array( $this ,'donate_link'), 10, 2 );

	}

//  -- Registers column for display
    public static function users_columns($columns) {
		$columns['registerdate'] = _x('Registered', 'user', 'recently-registered');
		return $columns;
	}

//  -- Handles the registered date column output.
    public static function users_custom_column( $value, $column_name, $user_id ) {

		global $mode;
		$mode = empty( $_REQUEST['mode'] ) ? 'list' : $_REQUEST['mode'];

        if ( 'registerdate' != $column_name ) {
           return $value;
        } else {
	        $user = get_userdata( $user_id );

          if ( is_multisite() && ( 'list' == $mode ) ) {
            $formated_date = __( 'm/d/Y' );
          } else {
            $formated_date = __( 'm/d/Y | g:i:s a' );
          }

          $registered   = strtotime(get_date_from_gmt($user->user_registered));
	        $registerdate = '<span>'. date_i18n( $formated_date, $registered ) .'</span>' ;

			return $registerdate;
		}
	}

//  --  Makes the column sortable
    public static function users_sortable_columns($columns) {
          $custom = array(
		  // meta column id => sortby value used in query
          'registerdate'    => 'registered',
          );
      return wp_parse_args($custom, $columns);
	}

//  --  Calculate the order if we sort by date.
    public static function users_orderby_column( $vars ) {
        if ( isset( $vars['orderby'] ) && 'registerdate' == $vars['orderby'] ) {
                $vars = array_merge( $vars, array(
                        'meta_key' => 'registerdate',
                        'orderby' => 'meta_value'
                ) );
        }
        return $vars;
	}

//  --  Internationalization - We're just going to use the language packs for this.

	public function load_this_textdomain() {
	    load_plugin_textdomain( 'recently-registered' );
	}
}
new RRHE();




// -- woocommerce support to theme
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div class="container">';
}

function my_theme_wrapper_end() {
  echo '</div>';
}


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
