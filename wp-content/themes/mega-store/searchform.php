<form role="search" method="get" class="search-form mega-store-search all-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label  class="search-label">
			<span class="screen-reader-text"><?php esc_html_e('Search for:','mega-store'); ?></span>
			<input type="search" class="blog-search input-search" placeholder="<?php esc_attr_e('Search ','mega-store'); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php esc_attr_e('Search for:','mega-store'); ?>">
		</label>
		<input type="submit" class="search-submit" value="<?php esc_attr_e('Search ','mega-store'); ?>">
	</div>
</form>