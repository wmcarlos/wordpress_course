<?php 
/*
*	Plugin Name: Five
*	Plugin URI: www.five.com
*	Description: This is the five tutorial from wordpress course
*	Version: 1.0
*	Author: Carlos Vargas
*	Author URI: www.carlosvargas.com
*	License: GPL2
*/

add_action('add_meta_boxes','five_add_metabox');

add_action('save_post','five_save_metabox');


function five_add_metabox(){
	add_meta_box('five_youtube','Link de Youtube','five_youtube_callback','post');
}

function five_youtube_callback(){
	$value = get_post_custom($post->ID);

	$youtube_link = esc_attr($value["five_youtube"][0]);

	echo '<label for="five_youtube">Link video de Youtube:</label> <input type="text" name="five_youtube" id="five_youtube" value="'.$youtube_link.'" />';	
}

function five_save_metabox($post_id){

	if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE){
		return;
	}

	if( !current_user_can('edit_post') ){
		return;
	}

	if(isset($_POST["five_youtube"])){
		update_post_meta($post_id,'five_youtube', esc_url($_POST["five_youtube"]));
	}
	
}

?>