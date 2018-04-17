<?php if (function_exists('mega_store_companion')): ?>
<div class="home-section space section-services">
    <div class="container">
        <div class="section-heading">
            <?php $title = get_theme_mod('mega_store_home_services_heading'); if(!empty($title)): ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <p class="section-description"><?php echo esc_html(get_theme_mod('mega_store_home_services_desc')); ?></p>
        </div>
        <div class="row services-details">
        	<?php $services = json_decode(get_theme_mod('mega_store_home_services'), true); ?>
        	<?php if($services): foreach ($services as $key => $service): ?>
            <div class="col-md-3 col-sm-6 col-xs-6 service-item">
                <div class="service-item-inner">
                    <div class="service-photo service-item-bga" style="background-image:url(<?php echo esc_url($service['image']); ?>)"></div>
                    <div class="service-inner-info">
                        <div class="service-icon">
                            <i class="fa <?php echo esc_attr($service['icon']); ?>"></i>
                        </div>
                        <div class="service-info">
                            <h3 class="service-title"><?php echo esc_html($service['heading']); ?></h3>
                            <p class="service-desc"><?php echo esc_html($service['description']); ?></p>
                        </div>
                        <?php $page_link = (absint($service['page_id']) > 0)?get_permalink(absint($service['page_id'])):$service['button_url']; ?>
                        <?php if(!empty($page_link)): ?>
                        <a class="btn service-read-more" href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($service['button_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>