<?php 
/*
*	Plugin Name: Six
*	Plugin URI: www.six.com
*	Desription: is it the six tutorial the wordpress plugin development course
*	Version: 1.0
*	Author: Carlos Vargas
*	Author URI: www.carlosvargas.com
*	License: GPL2
*/
add_action('add_meta_boxes','six_add_metabox');

add_action('save_post','six_save_metabox');

add_action('widgets_init','six_widget_init');


function six_add_metabox(){
	add_meta_box('six_youtube','Link de Youtube','six_youtube_callback','post');
}

function six_youtube_callback(){
	$value = get_post_custom($post->ID);

	$youtube_link = esc_attr($value["six_youtube"][0]);

	echo '<label for="six_youtube">Link video de Youtube:</label> <input type="text" name="six_youtube" id="six_youtube" value="'.$youtube_link.'" />';	
}

function six_save_metabox($post_id){

	if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE){
		return;
	}

	if( !current_user_can('edit_post') ){
		return;
	}

	if(isset($_POST["six_youtube"])){
		update_post_meta($post_id,'six_youtube', esc_url($_POST["six_youtube"]));
	}
	
}

function six_widget_init(){
	register_widget(six_Widget);
}


class six_Widget extends WP_Widget{

	function six_Widget(){
		$widget_options = array(
			'classname' => 'six_class',
			'description' => 'Para ver video de youtube que biene desde el post metadata'
		);

		$this->WP_Widget("six_id","Video Youtube", $widget_options);
	}

	function form($instance){

		$defaults = array("title" => "Url del Video");

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance["title"]);

		echo "<p><input type='text' class='widefat' name='".$this->get_field_name("title")."' value='".$title."'/></p>";

		
	}

	function update($new_instance, $old_instance){

	}

	function widget($args, $instance){

	}
}


?>