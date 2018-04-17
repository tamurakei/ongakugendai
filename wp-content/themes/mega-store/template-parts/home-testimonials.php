<?php if (function_exists('mega_store_companion')): ?>
<div class="home-section space section-testimonials">
    <div class="container">
        <div class="section-heading heading-white">
            <?php $title = get_theme_mod('mega_store_home_testimonials_heading'); if(!empty($title)): ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <p class="section-description"><?php echo esc_html(get_theme_mod('mega_store_home_testimonials_desc')); ?></p>
        </div>
        <div class="testimonials-details">
            <div class="testimonial-carousel owl-carousel">
            	<?php $testimonials = json_decode(get_theme_mod('mega_store_home_testimonials'), true); ?>
            	<?php if($testimonials): foreach ($testimonials as $key => $testimonial): ?>
                <div class="testimonial-item">
                    <div class="testimonial-item-inner">
                        <div class="testimonial-img">
                            <img  class="img-responsive" src="<?php echo esc_url($testimonial['image']); ?>">
                        </div>
                        <div class="testimonial-top">
                            <h2 class="testimonial-name"><?php echo esc_html($testimonial['heading']) ?></h2>
                        </div>
                        <div class="testimonial-bottom">
                            <p class="testimonial-description"><?php echo esc_html($testimonial['description']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>