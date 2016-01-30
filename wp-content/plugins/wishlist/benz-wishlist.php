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

add_action('admin_menu', 'benz_plugin_menu' ); 
add_action('admin_init', 'benz_admin_init' ); 

function benz_plugin_menu(){
    add_options_page( 'Benz Wishlist Options', 'Benz Wishlist', 'manage_options', 'benz', 'benz_plugin_options' );
}
function benz_admin_init() {
    register_setting('benz-group', 'benz_dashboard_title');
    register_setting('benz-group', 'benz_number_of_items');
}
function benz_plugin_options() {
    ?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Benz Wishlist</h2>
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
    <?php
}
?>
