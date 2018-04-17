<table class="free-vs-pro-table">
	<thead>
		<tr>
			<th></th>
			<th><?php echo esc_html($theme->get('Name')); ?></th>
			<th><?php echo esc_html($theme->get('Name')).' '.esc_html__('Pro', 'mega-store'); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<h3><?php esc_html_e('WooCommerce Compatible', 'mega-store'); ?></h3>
				<p><?php esc_html_e('Best suitable theme for online store', 'mega-store'); ?></p>
			</td>
			<td><span class="dashicons-before dashicons-yes"></span></td>
			<td><span class="dashicons-before dashicons-yes"></span></td>
		</tr>
		<tr>
			<td>
				<h3><?php esc_html_e('Pricing Plans Section', 'mega-store'); ?></h3>
				<p><?php esc_html_e('Home page pricing plans section to show your plans', 'mega-store'); ?></p>
			</td>
			<td><span class="dashicons-before dashicons-no-alt"></span></td>
			<td><span class="dashicons-before dashicons-yes"></span></td>
		</tr>
	</tbody>
	<tfoot>
		<th></th>
		<th colspan="2">
			<?php if (!empty($this->pro_link)):?>
			<a class="button button-primary button-big" href="<?php echo esc_url($this->pro_link); ?>" target="_blank"><?php esc_html_e('Get Mega Store Pro Now', 'mega-store');?></a>
			<?php endif; ?>
		</th>
	</tfoot>
</table>