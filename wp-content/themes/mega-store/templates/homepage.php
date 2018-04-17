<?php 
/*
* Template Name: Home Page
*/

get_header();
	$home_sections  = json_decode(get_theme_mod('mega_store_home_layout', json_encode(array('slider', 'hero', 'features', 'products-latest', 'about', 'blog', 'services', 'testimonials', 'brands'))));
	foreach ($home_sections as $key => $section) {
	 	get_template_part('template-parts/home', $section);
	}
get_footer();
