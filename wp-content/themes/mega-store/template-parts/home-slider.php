<?php if (function_exists('mega_store_companion')): ?>
<!-- Slider Start  -->
<?php 
	$slider_section_class = ''; 
	$show_catalog = get_theme_mod('mega_store_catalog_options', 'show');
	if($show_catalog === 'always'){
		$slider_section_class = 'container';
	}

?>
<div class="slider-section section-slider <?php echo esc_attr($slider_section_class); ?>">
	<div class="home-slider">
		<div class="home-carousel owl-carousel">
			<?php
				$slides = json_decode(get_theme_mod('mega_store_home_slider'), true);
				$i = 1;
				if($slides){
					foreach ($slides as $key => $slide) {

						?>
						<div class="owl-slide">
							<?php 
								if(isset($slide['image'])):
									$slide_img = $slide['image'];
							 	else:
							 		$slide_img = get_template_directory_uri().'/images/slide'.$i.'.jpg';
								endif; 
							?>
							<img src="<?php echo esc_url($slide_img); ?>" class="img-responsive img-slide"/>
							<div class="overlay"></div>
			               	<div class="carousel-caption">
			               		<?php if(isset($slide['heading'])): ?>
								<h2 class="mgs-slider-heading animation animated-item-1"> <?php echo esc_html($slide['heading']); ?> </h2>
								<?php endif; ?>
								<?php if(isset($slide['description'])): ?>
								<div class="mgs-slider-desc animation animated-item-2"><?php echo wp_strip_all_tags($slide['description']); ?></div>
								<?php endif; ?>								
								<?php if(!empty($slide['button1_url'])): ?>
								<a href="<?php echo esc_url($slide['button1_url']); ?>" class="btn animation animated-item-3 banner-link"> <?php echo esc_html($slide['button1_text']); ?> </a>
								<a href="<?php echo esc_url($slide['button2_url']); ?>" class="btn animation animated-item-3 banner-link"> <?php echo esc_html($slide['button2_text']); ?> </a>
								<?php endif; ?>
							</div>
						</div>
						<?php
						if($i == 2){ $i = 0; }
						$i++;
					}
				}
				?>
		</div>			
	</div>
</div>
<!-- Slider End -->
<?php endif; ?>