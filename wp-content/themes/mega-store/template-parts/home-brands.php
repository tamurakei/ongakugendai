<?php if (function_exists('mega_store_companion')): ?>
<div class="home-section space section-brands">
    <div class="container">
        <div class="section-heading">
            <?php $title = get_theme_mod('mega_store_home_brands_heading'); if(!empty($title)): ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <p class="section-description"><?php echo esc_html(get_theme_mod('mega_store_home_brands_desc')); ?></p>
        </div>
        <div class="brands-details">
            <div class="brand-carousel owl-carousel">
            	<?php $brands = json_decode(get_theme_mod('mega_store_home_brands'), true); ?>
            	<?php if($brands): foreach ($brands as $key => $brand): ?>
                <div class="brand-item">
                    <div class="brand-item-inner">
                        <?php if(!empty($brand['brand_link'])): ?>
                            <a href="<?php echo esc_url($brand['brand_link']); ?>">
                            <img  class="img-responsive" src="<?php echo esc_url($brand['image']); ?>">
                            </a>
                        <?php else: ?>
                            <img  class="img-responsive" src="<?php echo esc_url($brand['image']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>