<?php
/*
Plugin Name: Benz Cron Email
Plugin URI: http://www.plugs.robbenz.com
Description: Create a simple cron job. More options: http://codex.wordpress.org/Function_Reference/wp_schedule_event
Version: 1.0
Author: benz
Author URI: http://www.plugs.robbenz.com
License: GPL2
*/

add_action('init', benzcron_init_cronjob);
add_action('benzcron_sendmail_hook', benzcron_sendmail);

/**
 * initiating the cron job
 */
function benzcron_init_cronjob() {
    if(!wp_next_scheduled('benzcron_sendmail_hook')) {
        wp_schedule_event(time(), 'hourly', 'benzcron_sendmail_hook');
    }
}

/**
 * send email
 */
function benzcron_sendmail() {
    //send email code here
    //get blog admin  http://codex.wordpress.org/Function_Reference/get_bloginfo
    $benz_admin_email = get_bloginfo('admin_email');
    
    wp_mail($benz_admin_email, 'admin', 'Time for your medication!');
}
?>
