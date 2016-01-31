<?php
/*
 * Plugin Name: Benz Wishlist 
 * Plugin URI: http://www.plugs.robbenz.com
 * Description: My Wishlist plugin 
 * Version: 1.0
 * Author: RobBenz
 * Author URI: http://www.plugs.robbenz.com 
 * License: GPL2
 */


//register widget
add_action( 'widgets_init', 'benz_widget_init' );

//load external files
add_action( 'wp', 'benz_init' );

//add to wishlist Ajax if logged in. Learn more: http://www.garyc40.com/2010/03/5-tips-for-using-ajax-in-wordpress
add_action( 'wp_ajax_benz_add_wishlist', 'benz_add_wishlist_process' );

//if not logged in use this:  add_action( 'wp_ajax_nopriv_myajax-submit', 'myajax_submit' );

//add admin settings
add_action('admin_init', 'benz_admin_init');
add_action('admin_menu', 'benz_plugin_menu' );

//dashboard widget
add_action('wp_dashboard_setup','benz_create_dashboard_widget');

/**
 * load external files
 */
function benz_init() {
    //register plugin js file. Jquery is a requirement for this script so we specify it
    wp_register_script( 'benzwishlist-js', plugins_url( '/benzwishlist.js', __FILE__ ), array('jquery') );
    
    //load scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('benzwishlist-js');
    
    global $post;
    wp_localize_script( 'benzwishlist-js', 'MyAjax', array(
        'postId' => $post->ID,
        'action' => 'benz_add_wishlist'
    ) );
}


/**
 * initiate widget
 */
function benz_widget_init() {
    register_widget(benz_Widget);
}

/**
 * widget class
 */
class benz_Widget extends WP_Widget {
    function benz_Widget() {
        $widget_options = array(
            'classname' => 'benz_class', //for CSS
            'description' => 'Add items to wishlist'
        );
        
        //id for DOM element
        $this->WP_Widget('benz_id', 'Wishlist', $widget_options);
    }
    
    /**
     * show widget form in Appearenace - Widgets
     */
    function form($instance) {
        $defaults = array( 'title' => 'Wishlist');
        $instance = wp_parse_args( (array) $instance, $defaults);
        $title = esc_attr($instance['title']);
        echo '<p>Title <input class="widefat" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></p>';
    }
    
    /**
     * save widget form
     */
    function update($new_instance, $old_instance) {
        // process widget options to save
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title']);
        return $instance;
    }
    
    /**
     * show widget
     */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        //show online if single post
        if(is_single()) {
            echo $before_widget;
            echo $before_title . $title . $after_title;
            
            //check user logged in
            if(!is_user_logged_in()) {
                echo 'Please sign in to use this widget';
            }
            else {
                global $post;
                if(benz_has_wishlisted($post->ID)) {
                   echo 'You want this!'; 
                }
                else {
                    echo '<span id="benz_add_wishlist_div"><a id="benz_add_wishlist" href="">Add to wishlist</a></span>';
                }                
            }
            
            echo $after_widget;
        }
    }
}

/** 
 * process add to wishlist ajax
 */
function benz_add_wishlist_process() {

    $post_id = (int)$_POST['postId'];
    
    $user = wp_get_current_user();
    
    //save user metadata if not saved already
    if(!benz_has_wishlisted($post_id)) {
        add_user_meta($user->ID, 'wanted_posts', $post_id); 
    }    
    
    // generate the response
    $response = json_encode( array( 'success' => true ) );

    // response output
    header( "Content-Type: application/json" );
    echo $response;
    exit();
}

/**
 * check that the current user has wishlisted a post
 */
function benz_has_wishlisted($post_id) {
    
    $user = wp_get_current_user();    
    $values = get_user_meta($user->ID, 'wanted_posts');
    
    foreach($values as $value) {
        if($value == $post_id) {
            return true;
        }
    }
    
    return false;
}

/**
 * Add plugin admin settings
 */
function benz_admin_init() {
    register_setting('benz-group', 'benz_dashboard_title');
    register_setting('benz-group', 'benz_number_of_items');
}

/**
 * add menu to admin
 */
function benz_plugin_menu() {
    add_options_page( 'benz Wishlist Options', 'benz Wishlist', 'manage_options', 'benz', 'benz_plugin_options' );
}

/**
 * show admin settings page
 */
function benz_plugin_options() {
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2>benz Wishlist</h2>
        <form action="options.php" method="post">
            <?php settings_fields('benz-group'); ?>
            <?php @do_settings_fields('benz-group'); ?> 
            <table class="form-table"> 
                <tr valign="top"> 
                    <th scope="row"><label for="benz_dashboard_title">Dashboard widget title</label></th> 
                    <td>
                        <input type="text" name="benz_dashboard_title" id="dashboard_title" value="<?php echo get_option('benz_dashboard_title'); ?>" />
                        <br/><small>help text for this field</small>
                    </td>                
                </tr> 
                <tr valign="top"> 
                    <th scope="row"><label for="benz_number_of_items">Number of items to show</label></th> 
                    <td>
                        <input type="text" name="benz_number_of_items" id="dashboard_title" value="<?php echo get_option('benz_number_of_items'); ?>" />
                        <br/><small>help text for this field</small>
                    </td>                
                </tr> 
            </table> <?php @submit_button(); ?> 
        </form>
    </div>
    <?php
}

/**
 * create dashboard widget
 */
function benz_create_dashboard_widget() {
    //create dashboard widget
    $title = get_option('benz_dashboard_title') ? get_option('benz_dashboard_title') : 'Wishlist';
    wp_add_dashboard_widget('css_id',  $title, 'benz_show_dashboard_widget');
}

/**
 * show dashboard widget with the items the user wants
 */
function benz_show_dashboard_widget() {
    //get wanted items
    $user = wp_get_current_user();    
    $values = get_user_meta($user->ID, 'wanted_posts');
    
    $limit = (int)get_option('benz_number_of_items') ? (int)get_option('benz_number_of_items') : 10;
    
    echo '<ul>';
    foreach($values as $i => $value) {
        
        //check limit
        if($i == $limit) {
            break;
        }
        
        //retrieve from db
        $currentPost = get_post($value);
        
        //show post name
        echo '<li>'.$currentPost->post_title.'</li>';
    }
    echo '</ul>';
}

?>