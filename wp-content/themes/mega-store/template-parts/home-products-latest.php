<?php if(mega_store_is_wc()): ?>
<!-- Product  Start -->
<div class="home-section  mgs-recent-products mgs-products products-latest space section-products-latest
section-latest">
	<div class="container">
		<div class="section-heading">
			<?php $title = get_theme_mod('mega_store_home_products_latest_heading'); if(!empty($title)): ?>
	 	    <h2 class="section-title"><?php echo esc_html($title); ?></h2>
	 	    <?php endif; ?>
	 	    <p class="section-description"><?php echo esc_html(get_theme_mod('mega_store_home_products_latest_desc')); ?></p>
		</div>
		<div class="mgs-home-products mgs-recents woocommerce">
			<div class="mgs-product-carasol products owl-carousel">
			<?php
				$product_count = absint(get_theme_mod('mega_store_home_products_latest_count', 15));
				$query_args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $product_count, 'orderby' =>'date','order' => 'DESC' );
				$products = new WP_Query( $query_args );
				$catorgies = array();
				while($products->have_posts()){
					$products->the_post();
					wc_get_template_part( 'content-product-home' );
				}
				wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
</div>
<!-- Product End -->
<?php endif; ?>