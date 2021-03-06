<article id="post-<?php the_ID(); ?>" <?php post_class("col-md-12 mgs-post mgs-post-post"); ?>>
	<?php if(has_post_thumbnail()):  ?>
	<div class="img-thumbnail">
		<?php the_post_thumbnail('full', array( 'class' => 'img-responsive' )); ?>
	</div>
	<?php endif; ?>
	<div class="mgs-post-content">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mega_store_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mega-store' ),
					'after'  => '</div>',
				) );
			?>
			<div class="clearfix"></div>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<div class="entry-footer">
			<?php mega_store_entry_footer(); ?>
		</div>
	</div>
</article>