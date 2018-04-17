<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mega_Store
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="wrapper site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mega-store' ); ?></a>

	<header id="masthead" class="site-header nav-down">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="contact-info">
							<?php mega_store_get_contact_block(); ?>
						</div>
						<div class="scroll-left"><span class="scroll-item"><?php echo esc_html(get_theme_mod('mega_store_top_message')); ?></span></div>
					</div>
					<div class="col-sm-5">
						<div class="social-info"><?php mega_store_get_social_block(); ?></div>
					</div>
				</div>
			</div>
		</div>
        <div class="header-middle">
        	<div class="container">
	            <div class="row">
	                <div class="col-md-3 col-sm-3 site-logo">
	                    <div class="site-branding">
							<?php
								if ( function_exists( 'the_custom_logo' ) && function_exists( 'has_custom_logo' ) && has_custom_logo()) :
									
									if ( is_front_page() ) : ?>
										<h1 class="site-title"><?php the_custom_logo();?></h1>
									<?php else : ?>
										<p class="site-title"><?php the_custom_logo();?></p>
									<?php
									endif;
								else :
									if ( is_front_page() ) : ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
									endif;
									$description = get_bloginfo( 'description', 'display' );
									if ( $description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo $description; ?></p>
									<?php
									endif; 
								endif;
							?>	
						</div><!-- .site-branding -->
	                </div>
	                <div class="col-md-6 col-sm-9 search-colum">
	                    <div class="search-from-con">
	                        <?php 
								if(mega_store_is_wc()){
									get_template_part('searchform-product');
								}else{
									get_search_form();
								}
							 ?>
	                        <div class="clearfix"></div>
	                    </div>
	                </div>
	                <div class="col-md-3 col-sm-12 header-icons-colum">
	                	<div class="header-icons-colum-inner">
	                        <div class="ms-header-icons ms-header-cart">
	                        	<?php if(mega_store_is_wc()){ mega_store_woocommerce_header_cart(); } ?>
	                        </div>
	                        <div class="ms-header-icons ms-header-wishl"></div>
	                    </div>

	                </div>
	            </div>
        	</div>
        </div>
        <div class="header-bottom">
        	<div class="container">
	            <div class="row">
            	<?php
            		$ms_menu_classes = 'col-md-12 col-sm-12 col-xs-12';
            		$show_catalog = get_theme_mod('mega_store_catalog_options', 'show');
            		if(mega_store_is_wc() && $show_catalog !== 'hide'):
            			$ms_menu_classes = 'col-md-10 col-sm-8 col-xs-12';
            		?>
	                <div class="col-md-2 col-sm-4 hidden-xs ctalog-con">
	                    <div class="department-btn">
	                    	<span class="btn"><i class="fa fa-bars"></i> <?php esc_html_e('All Categories', 'mega-store'); ?> </a></span>
	                    </div>
	                    <div class="departments">
	                        <ul class="departments-list">
		                    	<?php 
		                    		wp_list_categories(array(
		                    			'taxonomy'            => 'product_cat',
								        'title_li'            => '',
		                    		)); 
		                    	?>
	                        </ul>
	                    </div>
	                </div>
	            	<?php endif; ?>
	                <div class="<?php echo esc_attr($ms_menu_classes); ?> menu-bar">
	                    <nav id="site-navigation" class="main-navigation navbar navbar-default ms-menu">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#TF-Navbar">
									<span class="menu-label"><?php esc_html_e('Menu', 'mega-store'); ?></span> <i class="fa fa-bars"></i>                     
								</button>				
							</div>			
							<?php 
								$args = array(
												'theme_location'    => 'primary',
												'depth'             =>  0,
												'container'         => 'div',
												'container_class'   => 'collapse navbar-collapse',
												'container_id'      => 'TF-Navbar',
												'menu_class'        => 'nav navbar-nav',
												'menu_id'           => 'primary-menu',
												'fallback_cb'       => 'mega_store_fallback_page_menu',
												'walker'            => new mega_store_nav_walker()
									  );
								wp_nav_menu($args);
							?>
						</nav><!-- #site-navigation -->
	                </div>
	            </div>
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
