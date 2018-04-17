<article  id="post-<?php the_ID(); ?>"  <?php post_class("col-md-6 blogs-colum content-index"); ?>>
	<div class="blogs-colum-over clearfix">
		<div class="img-thumbnail">
		<?php if(has_post_thumbnail()): ?>
		<?php the_post_thumbnail('mega-store-thumb', array( 'class' => 'img-responsive blog-photo' )); ?>
		<?php else: ?>
			<img src="<?php echo esc_url(get_template_directory_uri().'/images/blog-paceholder.png'); ?>" class="img-responsive blog-photo">
		<?php endif; ?>
		</div>
		<div class="blog-image-date">
			<time class="mgs-date entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' )); ?>">
				<div class="bds-date-block bds-day"><?php the_time( 'd',  get_the_ID()); ?></div>
				<div class="bds-date-block bds-month"><?php the_time( 'M',  get_the_ID()); ?></div>
			</time>
		</div>
		<div class="blog-colum-meta">
			<?php the_title( '<h2 class="entry-title blog-colum-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-summary blog-colum-desc"><?php the_excerpt(); ?></div>
			<div class="clearfix"></div>
			<div class="blog-colum-btn">
				<a class="btn btn-blog-colum" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE', 'mega-store'); ?></a>
			</div>
		</div>
	</div>	
</article>