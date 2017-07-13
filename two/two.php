<?php 
/*
* Plugin Name: Two
* Plugin URI: www.two.com
* Description: the two file from course of wordpress
* Version: 1.0
* Author: Carlos Vargas
* Author URI: www.carlosvargas.com
* License: GPL2
*/

/*
	Urls
	http://www.codex.wordpress.org/Plugin_API/Filter_Reference/
*/

add_filter('the_title','twotitle_title');
add_filter('the_content','twocontent_content');
add_filter('list_cats','towcats_cats');


//Modify the title
function twotitle_title($text){
	return "__00__".$text;
}

//Modify the content
function twocontent_content($text){
	return strtoupper($text);
}

//Modify the list categories
function towcats_cats($text){
	return strtolower($text);
}

?>