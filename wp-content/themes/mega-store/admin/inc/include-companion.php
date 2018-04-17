<?php
/**
 * This file implements custom requirements for the Mega store Companion plugin.
 * It can be used as-is in themes (drop-in).
 *
 * @package Mega store
 */

$hide_install = get_option('mega_store_hide_customizer_companion_notice', false);
if (!function_exists('mega_store_companion') && !$hide_install) {
	if (class_exists('WP_Customize_Section') && !class_exists('Mega_Store_Companion_Installer_Section')) {
		/**
		 * Recommend the installation of Mega Store Companion using a custom section.
		 *
		 * @see WP_Customize_Section
		 */
		class Mega_Store_Companion_Installer_Section extends WP_Customize_Section {
			/**
			 * Customize section type.
			 *
			 * @access public
			 * @var string
			 */
			public $type = 'mega_store_companion_installer';

			public function __construct($manager, $id, $args = array()) {
				parent::__construct($manager, $id, $args);

				add_action('customize_controls_enqueue_scripts', 'Mega_Store_Companion_Installer_Section::enqueue');
			}

			/**
			 * enqueue styles and scripts
			 *
			 *
			 **/
			public static function enqueue() {
				wp_enqueue_script('plugin-install');
				wp_enqueue_script('updates');
				wp_enqueue_script('mega-store-companion-install', MEGA_STORE_ADMIN_URI . '/assets/js/mega-store-plugin-install.js', array('jquery'));
				wp_localize_script('mega-store-companion-install', 'mega_store_companion_install',
					array(
						'installing' => esc_html__('Installing', 'mega-store'),
						'activating' => esc_html__('Activating', 'mega-store'),
						'error'      => esc_html__('Error', 'mega-store'),
						'ajax_url'   => esc_url_raw(admin_url('admin-ajax.php')),
					)
				);
			}
			/**
			 * Render the section.
			 *
			 * @access protected
			 */
			protected function render() {
				// Determine if the plugin is not installed, or just inactive.
				$plugins   = get_plugins();
				$installed = false;
				foreach ($plugins as $plugin) {
					if ('Mega Store Companion' === $plugin['Name']) {
						$installed = true;
					}
				}
				$slug = 'mega-store-companion';
				// Get the plugin-installation URL.
				$classes            = 'cannot-expand accordion-section control-section-companion control-section control-section-themes control-section-' . $this->type;
				?>
				<li id="accordion-section-<?php echo esc_attr($this->id); ?>" class="<?php echo esc_attr($classes); ?>">
					<a class="notification-dismiss" id="companion-install-dismiss" href="#companion-install-dismiss"> <i class="fa fa-times"></i> <span><?php esc_html_e('Dismiss', 'mega-store'); ?></span></a>
					<?php if (!$installed): ?>
					<?php 
						$plugin_install_url = add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $slug,
							),
							self_admin_url('update.php')
						);
						$plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_mega-store-companion');
					 ?>
						<p><?php esc_html_e('Mega store Companion plugin is required to take advantage of this theme\'s features in the customizer.', 'mega-store');?></p>
						<a class="mega-store-plugin-install install-now button-secondary button" data-slug="mega-store-companion" href="<?php echo esc_url_raw($plugin_install_url); ?>" aria-label="<?php esc_attr_e('Install Mega Store Companion Now', 'mega-store');?>" data-name="<?php esc_attr_e('Mega Store Companion', 'mega-store'); ?>">
							<?php esc_html_e('Install & Activate', 'mega-store');?>
						</a>
					<?php else: ?>
						<?php 
							$plugin_link_suffix = $slug . '/' . $slug . '.php';
							$plugin_activate_link = add_query_arg(
								array(
									'action'        => 'activate',
									'plugin'        => rawurlencode( $plugin_link_suffix ),
									'plugin_status' => 'all',
									'paged'         => '1',
									'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_link_suffix ),
								), network_admin_url( 'plugins.php' )
							);
						?>
						<p><?php esc_html_e('You have installed Mega store Companion. Activate it to take advantage of this theme\'s features in the customizer.', 'mega-store');?></p>
						<a class="mega-store-plugin-activate activate-now button-primary button" data-slug="mega-store-companion" href="<?php echo esc_url_raw($plugin_activate_link); ?>" aria-label="<?php esc_attr_e('Activate Mega store Companion now', 'mega-store');?>" data-name="<?php esc_attr_e('Mega store Companion', 'mega-store'); ?>">
							<?php esc_html_e('Activate Now', 'mega-store');?>
						</a>
					<?php endif;?>
				</li>
				<?php
			}
		}
	}
	if (!function_exists('mega_store_companion_installer_register')) {
		/**
		 * Registers the section, setting & control for the Mega store Companion installer.
		 *
		 * @param object $wp_customize The main customizer object.
		 */
		function mega_store_companion_installer_register($wp_customize) {
			$wp_customize->add_section(new Mega_Store_Companion_Installer_Section($wp_customize, 'mega_store_companion_installer', array(
				'title'      => '',
				'capability' => 'install_plugins',
				'priority'   => 0,
			)));

		}
		add_action('customize_register', 'mega_store_companion_installer_register');
	}
}

function mega_store_hide_customizer_companion_notice(){
	update_option('mega_store_hide_customizer_companion_notice', true);
	echo true;
	wp_die();
}
add_action('wp_ajax_mega_store_hide_customizer_companion_notice', 'mega_store_hide_customizer_companion_notice');