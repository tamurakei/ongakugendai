<?php 
	$plugins = $this->get_useful_plugins();
?>
<div class="usefull-plugins">
	<div class="row">
	<?php  if($plugins): foreach ($plugins as $key => $plugin): ?>
		<div class="col">
			<?php if(isset($plugin['name'])): ?>
			<h2><?php echo esc_html($plugin['name']); ?></h2>
			<?php endif; ?>
			<?php if(isset($plugin['desc'])): ?>
			<div class="descricption"><?php echo esc_html($plugin['desc']); ?></div>
			<?php endif; ?>
			<?php 
				$button = $this->get_plugin_buttion($plugin['slug'], $plugin['name']); 
				echo $button['button'];
			?>
		</div>
	<?php endforeach; endif; ?>
	</div>
</div>