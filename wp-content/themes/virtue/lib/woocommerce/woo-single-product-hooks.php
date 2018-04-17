<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'init', 'virtue_woocommerce_single_product_hooks' );
function virtue_woocommerce_single_product_hooks() {
	// Remove woocommerce single variation
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
	// Remove woocommerce single variation button
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
	// Add virtue single variation
	add_action( 'woocommerce_single_variation', 'virtue_woocommerce_single_variation', 10 );
	if ( ! function_exists( 'virtue_woocommerce_single_variation' ) ) {
		/**
		* Output placeholders for the single variation.
		*/
		function virtue_woocommerce_single_variation() {
			echo '<div class="single_variation headerfont"></div>';
		}
	}
	add_action( 'woocommerce_single_variation', 'virtue_woocommerce_single_variation_add_to_cart_button', 20 );
	if ( ! function_exists( 'virtue_woocommerce_single_variation_add_to_cart_button' ) ) {
		/**
		* Output the add to cart button for variations.
		*/
		function virtue_woocommerce_single_variation_add_to_cart_button() {
			global $product; ?>
			<div class="variations_button">
				<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : 1 ) ); ?>
				<button type="submit" class="kad_add_to_cart headerfont kad-btn kad-btn-primary single_add_to_cart_button"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="" />
			</div>
			<?php
		}
	}

	// Display product tabs?
	add_action('wp_head','virtue_woo_tab_check');
	function virtue_woo_tab_check() {
		$virtue = virtue_get_options();
		if ( isset( $virtue[ 'product_tabs' ] ) && 0 == $virtue[ 'product_tabs' ] ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
		}
	}
	// Display related products?
	add_action('wp_head','virtue_woo_related_products');
	function virtue_woo_related_products() {
		$virtue = virtue_get_options();
		if ( isset( $virtue[ 'related_products' ] ) && 0 == $virtue[ 'related_products' ] ) {
		  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
	}
	// Redefine woocommerce_output_related_products()
	add_filter( 'woocommerce_related_products_args', 'virtue_woo_related_products_limit' );
	function virtue_woo_related_products_limit() {
		global $product, $woocommerce;
		$related = $product->get_related();
		$args = array(
			'post_type'           => 'product',
			'no_found_rows'       => 1,
			'posts_per_page'      => 4,
			'ignore_sticky_posts'   => 1,
			'post__in'              => $related,
			'post__not_in'          => array($product->get_id())
		);
		return $args;
	}
}
