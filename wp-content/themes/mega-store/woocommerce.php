<?php
/**
 * The template for displaying woocommerce pages
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mega_Store
 */

get_header(); ?>
<div class="container-full space woocommerce-content-area">
	<div class="container">
		<div class="row">
			<main id="main" class="col-md-12 col-sm-12 col-xs-12 site-main">
				<div id="blog-content" class="row mgs-page">
					<?php if ( have_posts() ) : ?>
	                    <?php woocommerce_content(); ?>
	                <?php endif; ?>
				</div>
				<div class="clearfix"></div>
			</main><!-- #main -->
		</div>
	</div>
</div>
<?php
get_footer();