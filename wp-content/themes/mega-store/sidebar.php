<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mega_Store
 */
if(mega_store_blog_layout() !== 'col-md-12'){
	?>

	<aside id="secondary" class="col-md-3 col-sm-12 col-xs-12 mgs-sidebar" role="complementary">
	<?php
	if (is_active_sidebar( 'sidebar' ) ) {
		 dynamic_sidebar( 'sidebar' ); 
	}else{

		$args = array(
			'name'          => esc_html__( 'Sidebar', 'mega-store' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Sidebar Widget Area', 'mega-store' ),
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-heading"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		);
		the_widget('WP_Widget_Calendar', 'title='.esc_html__('Calendar', 'mega-store'), $args);
		the_widget('WP_Widget_Search', 'title='.esc_html__('Search', 'mega-store'), $args);
		the_widget('WP_Widget_Tag_Cloud', null, $args);
		the_widget('WP_Widget_Archives', null, $args);
		the_widget('WP_Widget_Recent_Posts', null, $args);
		the_widget('WP_Widget_Categories', null, $args);

	}
	?>
	</aside><!-- #secondary -->
<?php 
}