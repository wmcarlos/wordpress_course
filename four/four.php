<?php 
/*
*	Plugin Name: Four
*	Plugin URI: www.four.com
*	Description: This the four tutorial from wordpress course
*	Version: 1.0
*	Author: Carlos Vargas
*	Author URU: www.carlosvargas.com
*	License: GPL2
*/

add_action("init","four_register_shortcodes");

function four_register_shortcodes(){
	add_shortcode("rate","four_rate");
}

/*function four_rate($args, $content){
	return "this is a shortcode";
}*/

/*function four_rate($args, $content){
	return strtoupper($content);
}*/

function four_rate($args, $content){
	$result = wp_remote_get("http://finance.yahoo.com/d/quotes.csv?s=".$args["from"].$args["to"]."=X&f=l1");
	return $result["body"]." ".esc_attr($content);
}

?>