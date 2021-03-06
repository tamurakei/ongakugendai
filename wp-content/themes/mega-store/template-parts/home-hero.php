<div class="home-section section-hero">
    <div class="container-full">
        <div class="hero-details">
            <?php $image_id = get_theme_mod('mega_store_home_hero_image'); ?>
            <div class="hero-image" <?php echo (!empty($image_id))?'style="min-height:auto"':'' ?>>
                <?php if(!empty($image_id)):?>
                <img class="img-responsive" src="<?php echo esc_url(wp_get_attachment_url(absint($image_id))); ?>">
                <?php endif; ?>
            </div>
            <div class="hero-captions container">
                <h2 class="hero-title"><?php echo esc_html(get_theme_mod('mega_store_home_hero_heading')); ?></h2>
                <h3 class="hero-subtitle"><?php echo esc_html(get_theme_mod('mega_store_home_hero_subheading')); ?></h3>
                <p class="hero-description"><?php echo esc_html(get_theme_mod('mega_store_home_hero_desc')); ?></p>
                <div class="hero-buttons">
                    <?php $link = get_theme_mod('mega_store_home_hero_btn_link');  if($link): ?>
                    <a href="<?php echo esc_url($link); ?>" class="btn big-button"><?php echo esc_html(get_theme_mod('mega_store_home_hero_btn_text')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
