<?php 
/*
* Plugin Name: Three
* Plugin URI: www.three.com
* Description: the three file from course of wordpress
* Version: 1.0
* Author: Carlos Vargas
* Author URI: www.carlosvargas.com
* License: GPL2
*/

/*
	Urls:
	http://www.codex.wordpress.org/Class_Reference/WP_Query
	http://www.codex.wordpress.org/The_Loop
	http://www.codex.wordpress.org/Template_Tags
	http://www.codex.wordpress.org/Function_Reference/get_the_terms
	http://www.codex.wordpress.org/Function_Reference/wp_reset_query
*/

add_filter('the_content','three_add_related_posts');

function three_add_related_posts($content){

	if(!is_singular('post')){
		return $content;
	}

	$categories = get_the_terms(get_the_ID(),'category');

	$categoriesIds = array();

	foreach($categories as $category){
		$categoriesIds[] = $category->term_id;
	}


	$loop = new WP_Query(array(
		'category_in' => $categoriesIds,
		'posts_per_page' => 4,
		'post__not_in' => array(get_the_ID()),
		'orderby' => 'rand'
	));

	if($loop->have_posts()){

		$content .= "Related Post: <br><ul>";
		while($loop->have_posts()){
			$loop->the_post();
			$content.="<li><a href='".get_permalink()."'>".get_the_title()."</a></li>";
		}

		$content.="</ul>";
	}

	wp_reset_query();

	return $content;
}
?>