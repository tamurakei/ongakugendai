<?php if (function_exists('mega_store_companion')): ?>
<div class="home-section space section-features">
    <div class="container">
        <div class="section-heading">
            <?php $title = get_theme_mod('mega_store_home_features_heading'); if(!empty($title)): ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <p class="section-description"><?php echo esc_html(get_theme_mod('mega_store_home_features_desc')); ?></p>
        </div>
        <div class="row features-details">
        	<?php $features = json_decode(get_theme_mod('mega_store_home_features'), true); ?>
        	<?php if($features): foreach ($features as $key => $feature): ?>
            <div class="col-md-3 col-sm-6 col-xs-6 feature-item">
                <div class="feature-item-inner">
                    <div class="feature-inner-info">
                        <div class="feature-icon">
                            <i class="fa <?php echo esc_attr($feature['icon']); ?>"></i>
                        </div>
                        <div class="feature-info">
                            <h3 class="feature-title"><?php echo esc_html($feature['heading']); ?></h3>
                            <p class="feature-desc"><?php echo esc_html($feature['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>