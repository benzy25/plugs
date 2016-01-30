<?php
/*
 * Plugin Name: Benz List Builder 
 * Plugin URI: http://www.robbenz.com
 * Description: List Builder plugin built with Code College Usemy online course
 * Version: 1.0
 * Author: RobBenz
 * Author URI: http://www.robbenz.com 
 * License: GPL2
 */

/* !0. TABLE OF CONTENTS */

/*
	
	1. HOOKS
		1.1 - registers all our custom shortcodes
        1.2 - register custom admin column headers
	
	2. SHORTCODES
		2.1 - slb_register_shortcodes()
		2.2 - slb_form_shortcode()
		
	3. FILTERS
        3.1 - creating custom column header data
		
	4. EXTERNAL SCRIPTS
		
	5. ACTIONS
		
	6. HELPERS
		
	7. CUSTOM POST TYPES
	
	8. ADMIN PAGES
	
	9. SETTINGS

*/


/* !1. HOOKS */

// 1.1
// hint: registers all our custom shortcodes on init
add_action('init', 'benz_register_shortcodes');

//1.2
//hint: register custom admin column headers
add_filter('manage_edit-benz_subscriber_columns', 'benz_subscriber_column_headers');

add_filter('manage_edit-slb_subscriber_columns','slb_subscriber_column_headers');

/* !2. SHORTCODES */
// 2.1
// hint: registers all our custom shortcodes
function benz_register_shortcodes() {
    add_shortcode('benz_form', 'benz_form_shortcode');
}

// 2.2
// hint: returns a html string for a email capture form
function benz_form_shortcode( $args, $content="") {
    // Setup output var - form html
    $output = '
        <div class="benz">
        <form id="benz_form" name="benz_form" method="post" class="benz-form">
       
        <p class="benz-input-wrap">
        <label>Your Name</label></br />
        <input type="text" name="benz_fname" placeholder="First Name" />
        <input type="text" name="benz_lname" placeholder="Last Name" />
        </p>
        
        <p class="benz-input-wrap">
        <label>Your Email</label></br />
        <input type="email" name="benz_email" placeholder="you@email.com" />
        </p>';
    	// including content in our form html if content is passed into the function
    if( strlen($content) ):

        $output .= '<div class="benz-content">' . wpautop($content) . '</div>';

        endif;
// completing our form html
    $output .='<p class="benz-input-wrap">
        <input type="submit" name="benz_submit" value="Sign Up!" />
        </p>
        
        </form> 
        </div> 
        '; 
    // return output result/html
    return $output;

}

/* !3. FILTERS */
//3.1
function benz_subscriber_column_headers( $columns ) {
    
    //creating custom column header data override settings
    $columns = array(
    'cb'    => '<input type="checkbox" />',
    'title' => __('Subscriber Name'),
    'email' => __('Email Address')
    );
}
return $columns;


/* !4. EXTERNAL SCRIPTS */




/* !5. ACTIONS */




/* !6. HELPERS */




/* !7. CUSTOM POST TYPES */




/* !8. ADMIN PAGES */




/* !9. SETTINGS */
