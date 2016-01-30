<?php
/*
 * Plugin Name: Benz Title
 * Plugin URI: http://www.plugs.robbenz.com
 * Description: My first plugin
 * Version: 1.0
 * Author: RobBenz
 * Author URI: http://www.plugs.robbenz.com 
 * License: GPL2
 */

add_filter('the_title', 'benztitle_title');
add_filter('the_content', 'benztitle_content');

function benztitle_content($text) {
    return strtoupper($text);
}

function benztitle_title($text) {
    return '~|0|~' . $text;
}

?>
