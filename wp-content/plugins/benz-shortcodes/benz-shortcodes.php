<?php
/*
 * Plugin Name: Benz Shortcodes 
 * Plugin URI: http://www.plugs.robbenz.com
 * Description: My third plugin
 * Version: 1.0
 * Author: RobBenz
 * Author URI: http://www.plugs.robbenz.com 
 * License: GPL2
 */

add_action('init', 'benz_register_shortcodes');

function benz_register_shortcodes() {
    //register shortcode    [rate from="USD" to="EUR"]USD/EUR[/currency]     1.1 USD/EUR
    add_shortcode( 'rate', 'benz_rate' );
}

function benz_rate($args, $content) {
    $result = wp_remote_get('http://finance.yahoo.com/d/quotes.csv?s='.$args['from'].$args['to'].'=X&f=l1');
    return $result['body'].' '.esc_attr($content);    
}

?>
