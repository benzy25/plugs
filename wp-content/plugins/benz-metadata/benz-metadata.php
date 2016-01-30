<?php
/*
 * Plugin Name: Benz Metadata 
 * Plugin URI: http://www.plugs.robbenz.com
 * Description: My fourth plugin
 * Version: 1.0
 * Author: RobBenz
 * Author URI: http://www.plugs.robbenz.com 
 * License: GPL2
 */


//show metabox in editing page
add_action('add_meta_boxes', 'benz_add_metabox');

add_action('save_post', 'benz_save_metabox');


function benz_add_metabox() {
 add_meta_box('benz_youtube', 'YouTube Video Link', 'benz_youtube_handler', 'post');
    
}


//metabox handler 
function benz_youtube_handler () {
    $value = get_post_custom($post->ID);
    $youtube_link = esc_attr($value['benz_youtube'][0]);
    echo '<label for="benz_youtube">YouTube Video Link</label><input type="text" id="benz_youtube" name="benz_youtube" value="' . $youtube_link. '" />' ;
}

//save metadata
function benz_save_metabox($post_id) {
    //dont save metadata if its being autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    //check if user can edit post
    if( !current_user_can( 'edit_post' ) ) {
        return;
    }
    
    if( isset($_POST['benz_youtube'] )) {
        update_post_meta($post_id, 'benz_youtube', esc_url($_POST['benz_youtube'] ));
    }
    
    
    
}



?>
