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
require_once locate_template('/functions/woocommerce-setup.php');

add_action('after_setup_theme', 'true_load_theme_textdomain');

function true_load_theme_textdomain(){
    load_theme_textdomain( 'wbst', get_template_directory() . '/languages' );
}




add_action ( 'woocommerce_before_shop_loop_item' , 'whatever' );
function whatever() {
echo '<input type="checkbox" name="dont_care" value="show_product" id="show_specs"> Show Specs';
?>
<div id="show_spec_div_wrap" style="position: relative; background-color:#00426a; opacity: 0.6;">

</div>
<?php
}