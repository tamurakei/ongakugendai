<div class="row">
	<div class="col">
		<h2><?php esc_html_e('Recommended actions', 'mega-store'); ?></h2>
		<p><?php esc_html_e('we have created list of steps to take so you get amazing expriance with theme.', 'mega-store'); ?></p>
		<a class="button" href="<?php echo esc_url(admin_url( 'themes.php?page=mega-store-welcome&tab=recommended_actions' )); ?>"><?php esc_html_e('Go to Recommended actions', 'mega-store'); ?></a>
	</div>
	<div class="col">
		<h2><?php esc_html_e('Read Theme Documentation', 'mega-store'); ?></h2>
		<p><?php esc_html_e('Missing Something..? Please check our full documentation for detaild information about Mega Store', 'mega-store'); ?></p>
		<a class="button" href="<?php echo esc_url($this->docs_link); ?>" target="_blank"><?php esc_html_e('Go to Documentation', 'mega-store'); ?></a>
	</div>
	<div class="col">
		<h2><?php esc_html_e('Customize Mega Store', 'mega-store'); ?></h2>
		<p><?php esc_html_e('Use customizer to setup Mega Store', 'mega-store'); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( admin_url('customize.php') ); ?>" target="_blank"><?php esc_html_e('Go to Customizer', 'mega-store'); ?></a>
	</div>
</div>
