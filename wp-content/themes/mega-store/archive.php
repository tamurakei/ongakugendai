<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mega_Store
 */

get_header(); ?>

<div class="container-full space blog-post-index content-area">
	<div class="container">
		<div class="row">
			<main id="main" class="col-md-9 col-sm-12 col-xs-12 blog-left blog-posts-wrap site-main">
				<?php if ( have_posts() ) : ?>
					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					<div id="blog-content" class="row blog-gallery mgs-posts">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'index' );
						endwhile;
					?>
					</div>
					<div class="clearfix"></div>
					<div class="mgs-pagination">
						<?php the_posts_pagination(); ?>
					</div>
				<?php
					else :
						get_template_part( 'template-parts/content', 'none' );
				endif; ?>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();
