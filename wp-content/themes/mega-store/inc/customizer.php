<?php
/**
 * Mega Store Theme Customizer
 *
 * @package Mega_Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mega_store_customize_register($wp_customize) {

	/*Panels Start*/
	$wp_customize->add_panel('mega_store_homepage', array(
		'priority' => 2,
		'title'    => __('Homepage Options', 'mega-store'),
	));

	$wp_customize->add_panel('mega_store_settings', array(
		'title'    => __('Mega Store Settings', 'mega-store'),
		'priority' => 3,
	));

	
	/*Panel End*/

	$wp_customize->add_section('mega_store_header_options', array(
		'title'    => __('Header Settings', 'mega-store'),
		'priority' => 20,
	));

	$wp_customize->add_setting('mega_store_catalog_options', array(
		'default'           => __('Latest Posts', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_catalog_options', array(
		'type'    => 'select',
		'label'   => __('Header Catalog Dispaly', 'mega-store'),
		'section' => 'mega_store_header_options',
		'choices' => array(
			'hide'   => esc_html__('Hide', 'mega-store'),
			'show'   => esc_html__('Hover Show', 'mega-store'),
			'always' => esc_html__('Always Show', 'mega-store'),
		),
	));

	$wp_customize->add_setting('mega_store_menu_button_text', array(
		'default'           => __('Join Us', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_menu_button_text', array(
		'type'    => 'text',
		'label'   => __('Menu Button Text', 'mega-store'),
		'section' => 'mega_store_header_options',
	));

	$wp_customize->add_setting('mega_store_menu_button_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('mega_store_menu_button_link', array(
		'type'    => 'text',
		'label'   => __('Menu Button Link', 'mega-store'),
		'section' => 'mega_store_header_options',
	));

	$wp_customize->add_section('mega_store_header_topbar_section', array(
		'title'    => __('Header Topbar', 'mega-store'),
		'priority' => 20,
	));

	$wp_customize->add_setting('mega_store_top_message', array(
		'default'           => esc_html__('Edit this in customizer ', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_top_message', array(
		'type'    => 'textarea',
		'label'   => __('Message', 'mega-store'),
		'section' => 'mega_store_header_topbar_section',
	));

/* Contact */
	$wp_customize->add_section('mega_store_contacts_section', array(
		'title'      => __('Contact Options', 'mega-store'),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_setting('mega_store_top_email', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'mega_store_sanitize_email',
	));

	$wp_customize->add_control('mega_store_top_email', array(
		'type'     => 'email',
		'priority' => 200,
		'section'  => 'mega_store_contacts_section',
		'label'    => __('Email', 'mega-store'),
	));

	$wp_customize->add_setting('mega_store_top_phone', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_top_phone', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'mega_store_contacts_section',
		'label'    => __('Phone', 'mega-store'),
	));
/* Contact */

/*Hero Image*/

	$wp_customize->add_section('mega_store_home_hero_section', array(
		'title'    => __('Hero Image', 'mega-store'),
		'panel'    => 'mega_store_homepage',
		'priority' => 10,
	));

	$wp_customize->add_setting('mega_store_home_hero_image', array(
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'mega_store_home_hero_image', array(
		'label'       => __('Heading', 'mega-store'),
		'priority'    => 0,
		'section'     => 'mega_store_home_hero_section',
		'flex_width'  => true,
		'flex_height' => true,
		'width'       => 1920,
		'height'      => 1080,
	)));

	$wp_customize->add_setting('mega_store_home_hero_heading', array(
		'default'           => __('Edit this in Customizer', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_hero_heading', array(
		'type'    => 'text',
		'label'   => __('Heading', 'mega-store'),
		'section' => 'mega_store_home_hero_section',
	));

	$wp_customize->add_setting('mega_store_home_hero_subheading', array(
		'default'           => __('Edit this in Customizer', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_hero_subheading', array(
		'type'    => 'text',
		'label'   => __('Sub Heading', 'mega-store'),
		'section' => 'mega_store_home_hero_section',
	));

	$wp_customize->add_setting('mega_store_home_hero_desc', array(
		'default'           => __('Edit Description in Customizer', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_hero_desc', array(
		'type'    => 'text',
		'label'   => __('Description', 'mega-store'),
		'section' => 'mega_store_home_hero_section',
	));

	$wp_customize->add_setting('mega_store_home_hero_btn_text', array(
		'default'           => __('Edit in Customizer', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_hero_btn_text', array(
		'type'    => 'text',
		'label'   => __('Button Text', 'mega-store'),
		'section' => 'mega_store_home_hero_section',
	));

	$wp_customize->add_setting('mega_store_home_hero_btn_link', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	));

	$wp_customize->add_control('mega_store_home_hero_btn_link', array(
		'type'    => 'text',
		'label'   => __('Button Link', 'mega-store'),
		'section' => 'mega_store_home_hero_section',
	));

/*Hero Image*/

/** Recent Posts **/

	$wp_customize->add_section('mega_store_home_blog_section', array(
		'title'    => __('Blog', 'mega-store'),
		'panel'    => 'mega_store_homepage',
		'priority' => 50,
	));

	$wp_customize->add_setting('mega_store_home_blog_heading', array(
		'default'           => __('Latest Posts', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_blog_heading', array(
		'type'    => 'text',
		'label'   => __('Heading', 'mega-store'),
		'section' => 'mega_store_home_blog_section',
	));

	$wp_customize->add_setting('mega_store_home_blog_desc', array(
		'default'           => __('Description Latest Posts', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_blog_desc', array(
		'type'    => 'text',
		'label'   => __('Description', 'mega-store'),
		'section' => 'mega_store_home_blog_section',
	));

	$wp_customize->add_setting('mega_store_home_blog_count', array(
		'default'           => 2,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('mega_store_home_blog_count', array(
		'type'    => 'number',
		'section' => 'mega_store_home_blog_section',
		'label'   => __('Product Count', 'mega-store'),
	));

	$wp_customize->add_setting('mega_store_home_blog_background', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mega_store_home_blog_background', array(
		'label'   => __('Background Image', 'mega-store'),
		'section' => 'mega_store_home_blog_section',
	)));

/** Recent Posts **/

/** Recent Products **/

	$wp_customize->add_section('mega_store_home_products_latest_section', array(
		'title'    => __('Latest Products', 'mega-store'),
		'panel'    => 'mega_store_homepage',
		'priority' => 30,
	));

	if(!mega_store_is_wc()){
		$wp_customize->add_setting('mega_store_woocommerce_needed', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mega_store_sanitize_html',
		));

		$wp_customize->add_control(new Mega_Store_Info_Text($wp_customize, 'mega_store_woocommerce_needed', array(
			'label'       => __('Install WooCommerce', 'mega-store'),
			'description' => __('This section show products from WooCommerce. Please install and Activate WooCommerce plugin to use this section.', 'mega-store'),
			'priority'    => 1,
			'section'     => 'mega_store_home_products_latest_section',
		)));
	}

	$wp_customize->add_setting('mega_store_home_products_latest_heading', array(
		'default'           => __('Latest Products', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_products_latest_heading', array(
		'type'    => 'text',
		'section' => 'mega_store_home_products_latest_section',
		'label'   => __('Heading', 'mega-store'),
	));

	$wp_customize->add_setting('mega_store_home_products_latest_desc', array(
		'default'           => __('Description Latest Product', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('mega_store_home_products_latest_desc', array(
		'type'    => 'textarea',
		'section' => 'mega_store_home_products_latest_section',
		'label'   => __('Description', 'mega-store'),
	));

	$wp_customize->add_setting('mega_store_home_products_latest_count', array(
		'default'           => 15,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('mega_store_home_products_latest_count', array(
		'type'    => 'number',
		'section' => 'mega_store_home_products_latest_section',
		'label'   => __('Product Count', 'mega-store'),
	));

/** Recent Products **/

/* typography start*/

if(class_exists('ThemeFarmer_Field_Font_Selector')){
	
	$wp_customize->add_panel('mega_store_typography', array(
		'title'    => __('Typography Options', 'mega-store'),
		'priority' => 4,
	));

	$wp_customize->add_section('mega_store_body_typography', array(
		'title'    => __('Body Typography', 'mega-store'),
		'panel'    => 'mega_store_typography',
		'priority' => 10,
	));

	$wp_customize->add_setting('mega_store_body_font_family', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Font_Selector($wp_customize, 'mega_store_body_font_family', array(
		'label'     => esc_html__('Body Font', 'mega-store'),
		'section'   => 'mega_store_body_typography',
		'priority'  => 30,
	)));
}

if (class_exists('ThemeFarmer_Field_Range')) {
	$wp_customize->add_setting('mega_store_body_font_size', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
		'default'			=> 10,
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Range($wp_customize, 'mega_store_body_font_size', array(
		'section'   => 'mega_store_body_typography',
		'label'     => esc_html__('Font Size', 'mega-store'),
		'responsive'=> false,
	)));
}

if(class_exists('ThemeFarmer_Field_Tabs')){
	
	$wp_customize->add_setting('mega_store_body_typography_tabs', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Tabs($wp_customize, 'mega_store_body_typography_tabs', array(
		'section'   => 'mega_store_body_typography',
		'tabs'		=> array(
			'body_font_family' => array(
				'icon'	=> 'fa-font',
				'name'	=> esc_html__('Body Font', 'mega-store'),
				'controls'=> array('mega_store_body_font_family'),
			),
			'body_font_size' => array(
				'icon'	=> 'fa-text-height',
				'name'	=> esc_html__('Body Font Size', 'mega-store'),
				'controls'=> array('mega_store_body_font_size'),
			),
		)
	)));
}
/* typography end */

/* page layout*/
if(class_exists('ThemeFarmer_Field_Image_Select')){	
	$wp_customize->add_panel('mega_store_page_layouts_panel', array(
		'title'    => __('Page Layouts', 'mega-store'),
		'priority' => 5,
	));

	$wp_customize->add_section('mega_store_blog_page_layouts_section', array(
		'title'    => __('Blog Laout', 'mega-store'),
		'panel'    => 'mega_store_page_layouts_panel',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'mega_store_blog_single_page_layout', array(
	  	'sanitize_callback' => 'sanitize_text_field',
		'default' => 'right',
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'mega_store_blog_single_page_layout', array(
		'label' => __( 'Single Page Layout', 'mega-store'),
		'section' => 'mega_store_blog_page_layouts_section',
		'choices' => array(
	    	'left' => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
	    	'full' => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
	    	'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
	  	),
	)));

	$wp_customize->add_setting( 'mega_store_blog_single_post_layout', array(
	  	'sanitize_callback' => 'sanitize_text_field',
		'default' => 'right',
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'mega_store_blog_single_post_layout', array(
		'label' => __( 'Single Post Layout', 'mega-store' ),
		'section' => 'mega_store_blog_page_layouts_section',
		'choices' => array(
	    	'left' => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
	    	'full' => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
	    	'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
	  	),
	)));

	$wp_customize->add_setting( 'mega_store_blog_post_index_layout', array(
	  	'sanitize_callback' => 'sanitize_text_field',
		'default' => 'right',
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'mega_store_blog_post_index_layout', array(
		'label' => __( 'All Posts Page Layout', 'mega-store'),
		'section' => 'mega_store_blog_page_layouts_section',
		'choices' => array(
	    	'left' => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
	    	'full' => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
	    	'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
	  	),
	)));
}

/* page layout end */	
// theme setup info
	if(!mega_store_is_front_page_setup_done()){
		$wp_customize->add_section('mega_store_setup_info', array(
			'title'      => __('Theme Setup Info', 'mega-store'),
			'priority'   => 1,
			'capability' => 'edit_theme_options',
		));

		$wp_customize->add_setting('mega_store_homepage_setup', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mega_store_sanitize_html',

		));

		$wp_customize->add_control(new Mega_Store_Info_Text($wp_customize, 'mega_store_homepage_setup', array(
			'label'       => __('Home Page Setup', 'mega-store'),
			'description' => __('1. Create or Edit page with name Home -> Select Template "Home Page" -> Publish. <br><br>
	    							2. Go To Appearance -> Customize -> Static Front Page -> Front page displays set it to "A static page" -> for Front page select Home. <a class="mega_store_go_to_section" href="#accordion-section-static_front_page"> Switch To "A Static Page"</a>', 'mega-store'),
			'priority'    => 1,
			'section'     => 'mega_store_setup_info',
		)));

		$wp_customize->add_setting('mega_store_theme_info_page', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mega_store_sanitize_html',

		));

		$wp_customize->add_control(new Mega_Store_Info_Text($wp_customize, 'mega_store_theme_info_page', array(
			'label'       => __('Mega Store Info Page', 'mega-store'),
			'description' => sprintf('<a class="button button-default" href="%1$s">%2$s</a>', esc_url(admin_url('themes.php?page=mega-store-welcome')), esc_html__('See Theme Info Page', 'mega-store')),
			'priority'    => 1,
			'section'     => 'mega_store_setup_info',
		)));
	}




	$wp_customize->get_section( 'title_tagline' )->priority = 2;


	$wp_customize->get_setting('blogname')->transport                                = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport                         = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport                        = 'postMessage';
	$wp_customize->get_setting('mega_store_home_blog_heading')->transport            = 'postMessage';
	$wp_customize->get_setting('mega_store_home_blog_desc')->transport               = 'postMessage';
	$wp_customize->get_setting('mega_store_home_products_latest_heading')->transport = 'postMessage';
	$wp_customize->get_setting('mega_store_home_products_latest_desc')->transport    = 'postMessage';
	$wp_customize->get_setting('mega_store_home_hero_image')->transport              = 'postMessage';
	$wp_customize->get_setting('mega_store_home_hero_heading')->transport            = 'postMessage';
	$wp_customize->get_setting('mega_store_home_hero_subheading')->transport         = 'postMessage';
	$wp_customize->get_setting('mega_store_home_hero_desc')->transport               = 'postMessage';
	$wp_customize->get_setting('mega_store_home_hero_btn_text')->transport           = 'postMessage';
	$wp_customize->get_setting('mega_store_top_email')->transport                    = 'postMessage';
	$wp_customize->get_setting('mega_store_top_phone')->transport                    = 'postMessage';
	$wp_customize->get_setting('mega_store_top_message')->transport                  = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'mega_store_customize_partial_blogname',
		));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'mega_store_customize_partial_blogdescription',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_home_blog_heading', array(
			'selector'        => '.section-blog .section-title',
			'render_callback' => 'mega_store_home_blog_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_home_blog_desc', array(
			'selector'        => '.section-blog .section-description',
			'render_callback' => 'mega_store_home_blog_desc_partial',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_home_products_latest_desc', array(
			'selector'        => '.section-products-latest .section-description',
			'render_callback' => 'mega_store_home_products_latest_desc_partial',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_home_products_latest_heading', array(
			'selector'        => '.section-products-latest .section-title',
			'render_callback' => 'mega_store_home_products_latest_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_home_hero_image', array(
			'selector'        => '.hero-details .hero-image',
			'render_callback' => 'mega_store_home_hero_image_partial',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_home_hero_heading', array(
			'selector'        => '.hero-captions .hero-title',
			'render_callback' => 'mega_store_home_hero_heading_partial',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_home_hero_subheading', array(
			'selector'        => '.hero-captions .hero-subtitle',
			'render_callback' => 'mega_store_home_hero_subheading_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_home_hero_desc', array(
			'selector'        => '.hero-captions .hero-description',
			'render_callback' => 'mega_store_home_hero_desc_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_home_hero_btn_text', array(
			'selector'        => '.hero-buttons .big-button',
			'render_callback' => 'mega_store_home_hero_btn_text_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_top_phone', array(
			'selector'        => '.contact-mobile .contact-link',
			'render_callback' => 'mega_store_top_phone_partial',
		));

		$wp_customize->selective_refresh->add_partial('mega_store_top_email', array(
			'selector'        => '.contact-email  .contact-link',
			'render_callback' => 'mega_store_top_email_partial',
		));
		$wp_customize->selective_refresh->add_partial('mega_store_top_message', array(
			'selector'        => '.header-top .scroll-left',
			'render_callback' => 'mega_store_top_message_partial',
		));

	}
}
add_action('customize_register', 'mega_store_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mega_store_customize_partial_blogname() {
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function mega_store_customize_partial_blogdescription() {
	bloginfo('description');
}

function mega_store_home_blog_heading_partial() {
	return esc_html(get_theme_mod('mega_store_home_blog_heading'));
}

function mega_store_home_blog_desc_partial() {
	return esc_html(get_theme_mod('mega_store_home_blog_desc'));
}

function mega_store_home_products_latest_desc_partial() {
	return esc_html(get_theme_mod('mega_store_home_products_latest_desc'));
}

function mega_store_home_products_latest_heading_partial() {
	return esc_html(get_theme_mod('mega_store_home_products_latest_heading'));
}

function mega_store_home_hero_image_partial() {
	$image_id = get_theme_mod('mega_store_home_hero_image');
	if ($image_id) {
		return sprintf('<img class="img-responsive" src="%s">', esc_url(wp_get_attachment_url(absint($image_id))));
	}

}

function mega_store_home_hero_heading_partial() {
	return esc_html(get_theme_mod('mega_store_home_hero_heading'));
}

function mega_store_home_hero_subheading_partial() {
	return esc_html(get_theme_mod('mega_store_home_hero_subheading'));
}

function mega_store_home_hero_desc_partial() {
	return esc_html(get_theme_mod('mega_store_home_hero_desc'));
}

function mega_store_home_hero_btn_text_partial() {
	return esc_html(get_theme_mod('mega_store_home_hero_btn_text'));
}

function mega_store_top_phone_partial() {
	$top_phone = get_theme_mod('mega_store_top_phone');
	return sprintf('<a href="callto:%s">%s</a>', esc_attr($top_phone), esc_html($top_phone));
}

function mega_store_top_email_partial() {
	$top_email = get_theme_mod('mega_store_top_email');
	return sprintf('<a href="mailto:%s">%s</a>', esc_attr($top_email), esc_html($top_email));
}

function mega_store_top_message_partial() {
	return '<span class="scroll-item">' . esc_html(get_theme_mod('mega_store_top_message')) . '</span>';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mega_store_customize_preview_js() {
	wp_enqueue_script('mega-store-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'mega_store_customize_preview_js');

if (class_exists('WP_Customize_Control')):
	class Mega_Store_Info_Text extends WP_Customize_Control {

		public function render_content() {
			?>
			    <span class="customize-control-title">
					<?php echo esc_html($this->label); ?>
				</span>

				<?php if ($this->description) {?>
					<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
					</span>
			<?php 	}
		}

	}

	class Mega_Store_Upsale_Customize_Control extends WP_Customize_Section {
		public $type = 'themefarmer-upsell';
		public function render() {
			$classes = 'accordion-section control-section-' . $this->type;
			$id      = 'themefarmer-upsell-buttons-section';
			?>
			    <li id="accordion-section-<?php echo esc_attr($this->id); ?>"class="<?php echo esc_attr($classes); ?>">
			        <div class="themefarmer-upsale">
			          	<a href="<?php echo esc_url('https://www.themefarmer.com/product/megastore-pro/'); ?>" target="_blank" class="themefarmer-upsale-bt" id="themefarmer-pro-button"><?php esc_html_e('VIEW PRO VERSION ', 'mega-store');?></a>
			        </div>
			    </li>
			<?php
		}
	}

endif;