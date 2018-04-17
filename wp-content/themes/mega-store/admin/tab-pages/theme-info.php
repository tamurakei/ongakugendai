<div class="row">
	<div class="theme-left">
		<div class="theme-info-inner">
			<img src="<?php echo esc_url(get_template_directory_uri().'/screenshot.png'); ?>" class="img-responsive theme-screenshot">
		</div>
	</div>
	<div class="theme-right">
		<div class="theme-info-inner">
			<h1 class="theme-heading"> <?php esc_html_e('Welcome to', 'mega-store');?> <span class="theme-name"> <?php echo esc_html($theme->get('Name')) ?> </span> <span class="theme-version"> <?php echo esc_html($theme->get('Version')) ?> </span> </h1>
			<div class="theme-description"><?php echo esc_html($theme->get('Description')); ?></div>
			<br>
			<hr>
			<div class="info-links">
					<strong><?php esc_html_e('Theme Links', 'mega-store');?></strong>
					<br>
					<br>
					<?php if(!empty($this->demo_link)): ?>
					<a class="button button-default" href="<?php echo esc_url($this->demo_link); ?>" target="_blank"><?php esc_html_e('Theme Demo', 'mega-store');?></a>
					<?php endif; ?>
					<?php if(!empty($this->docs_link)): ?>
					<a class="button button-default" href="<?php echo esc_url($this->docs_link); ?>" target="_blank"><?php esc_html_e('Theme Documentation', 'mega-store');?></a>
					<?php endif; ?>
					<?php if(!empty($this->theme_page)): ?>
					<a class="button button-default" href="<?php echo esc_url($this->theme_page); ?>" target="_blank"><?php esc_html_e('Theme Page', 'mega-store');?></a>
					<?php endif; ?>
					<?php if(!empty($this->rate_link)): ?>
					<a class="button button-default" href="<?php echo esc_url($this->rate_link); ?>" target="_blank"><?php esc_html_e('Rate this theme', 'mega-store');?></a>
					<?php endif; ?>
					<hr>
					<?php if (!empty($this->pro_link)):?>
					<a class="button button-orange" href="<?php echo esc_url($this->pro_link); ?>" target="_blank"><?php esc_html_e('View Pro Version', 'mega-store');?></a>
					<?php endif; ?>
					<a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Customize', 'mega-store');?></a>
			</div>
			<hr>
		</div>
	</div>
</div>
<div style="clear: both;"></div>