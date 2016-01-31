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
		1.3 - register custom admin column data
	
	2. SHORTCODES
		2.1 - benz_register_shortcodes()
		2.2 - benz_form_shortcode()
		
	3. FILTERS
		3.1 - benz_subscriber_column_headers()
		3.2 - benz_subscriber_column_data()
		3.2.2 - benz_register_custom_admin_titles()
		3.2.3 - benz_custom_admin_titles()
		3.3 - benz_list_column_headers()
		3.4 - benz_list_column_data()
		
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

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-benz_subscriber_columns','benz_subscriber_column_headers');

// 1.3
// hint: register custom admin column data
add_filter('manage_benz_subscriber_posts_custom_column','benz_subscriber_column_data',1,2);
add_action(
    'admin_head-edit.php',
    'benz_register_custom_admin_titles'
);


/* !2. SHORTCODES */

// 2.1
// hint: registers all our custom shortcodes
function benz_register_shortcodes() {
	
	add_shortcode('benz_form', 'benz_form_shortcode');
	
}

// 2.2
// hint: returns a html string for a email capture form
function benz_form_shortcode( $args, $content="") {
	
	// setup our output variable - the form html 
	$output = '
	
		<div class="benz">
		
			<form id="benz_form" name="benz_form" class="benz-form" method="post">
			
				<p class="benz-input-container">
				
					<label>Your Name</label><br />
					<input type="text" name="benz_fname" placeholder="First Name" />
					<input type="text" name="benz_lname" placeholder="Last Name" />
				
				</p>
				
				<p class="benz-input-container">
				
					<label>Your Email</label><br />
					<input type="email" name="benz_email" placeholder="ex. you@email.com" />
				
				</p>';
				
				// including content in our form html if content is passed into the function
				if( strlen($content) ):
				
					$output .= '<div class="benz-content">'. wpautop($content) .'</div>';
				
				endif;
				
				// completing our form html
				$output .= '<p class="benz-input-container">
				
					<input type="submit" name="benz_submit" value="Sign Me Up!" />
				
				</p>
			
			</form>
		
		</div>
	
	';
	
	// return our results/html
	return $output;
	
}




/* !3. FILTERS */

// 3.1
function benz_subscriber_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('Subscriber Name'),
		'email'=>__('Email Address'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 3.2
function benz_subscriber_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'title':
			// get the custom name data
			$fname = get_field('benz_fname', $post_id );
			$lname = get_field('benz_lname', $post_id );
			$output .= $fname .' '. $lname;
			break;
		case 'email':
			// get the custom email data
			$email = get_field('benz_email', $post_id );
			$output .= $email;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}

// 3.2.2
// hint: registers special custom admin title columns
function benz_register_custom_admin_titles() {
    add_filter(
        'the_title',
        'benz_custom_admin_titles',
        99,
        2
    );
}

// 3.2.3
// hint: handles custom admin title "title" column data for post types without titles
function benz_custom_admin_titles( $title, $post_id ) {
   
    global $post;
	
    $output = $title;
    
    if( isset($post->post_type) ):
    switch( $post->post_type ) {
        case 'benz_subscriber':
            $fname = get_field('benz_fname', $post_id );
            $lname = get_field('benz_lname', $post_id );
            $output = $fname .' '. $lname;
            break;
                }
        endif;
   
    return $output;
}

// 3.3
function benz_list_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('List Name'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 3.4
function benz_list_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'example':
			// get the custom name data
			//$fname = get_field('benz_fname', $post_id );
			//$lname = get_field('benz_lname', $post_id );
			//$output .= $fname .' '. $lname;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}




/* !4. EXTERNAL SCRIPTS */




/* !5. ACTIONS */




/* !6. HELPERS */




/* !7. CUSTOM POST TYPES */




/* !8. ADMIN PAGES */




/* !9. SETTINGS */

