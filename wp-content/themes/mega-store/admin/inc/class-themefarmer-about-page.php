<?php
/**
 * @author ThemeFarmer
 */

if (!class_exists('ThemeFarmer_About_Page')) {
	class ThemeFarmer_About_Page {

		protected static $instance;
		private $options;
		private $version = '1.0.0';
		private $theme;
		private $demo_link;
		private $docs_link;
		private $rate_link;
		private $theme_page;
		private $pro_link;
		private $tabs;
		private $action_count;
		private $recommended_actions;

		public static function get_instance() {

			if (is_null(self::$instance)) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function __construct() {
			$this->theme            = wp_get_theme();
			
			$this->demo_link  = 'http://demo.themefarmer.com/mega-store/';
			$this->docs_link  = 'http://docs.themefarmer.com/documentation-mega-store/';
			$this->rate_link  = 'http://wordpress.org/support/view/theme-reviews/mega-store';
			$this->theme_page = 'https://www.themefarmer.com/free-themes/mega-store-e-commerce-wordpress-theme/';
			$this->pro_link   = '';

			$actions                   = $this->get_recommended_actions();
			$this->action_count        = $actions['count'];
			$this->recommended_actions = $actions['actions'];

			add_action('admin_menu', array($this, 'add_theme_info_menu'));
			add_action('admin_enqueue_scripts', array($this, 'enqueue'));
			add_action('wp_ajax_mega_store_update_rec_acts', array($this, 'update_recommended_actions_watch'));
			add_action('load-themes.php', array($this, 'activation_admin_notice'));
		}

		public function enqueue($hook) {
			if ('appearance_page_mega-store-welcome' != $hook) {
				return;
			}

			wp_enqueue_style('mega-store-theme-info-style', MEGA_STORE_ADMIN_URI . '/assets/css/welcome-page-styles.css');
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

		public function add_theme_info_menu() {
			$theme = $this->theme;
			$count = $this->action_count;
			$count = ($count > 0) ? '<span class="awaiting-mod action-count"><span>' . $count . '</span></span>' : '';
			$title = sprintf(esc_html__('About %1$s %2$s', 'mega-store'), esc_html($theme->get('Name')), $count);
			add_theme_page(sprintf(esc_html__('Welcome to %1$s %2$s', 'mega-store'), esc_html($theme->get('Name')), esc_html($theme->get('Version'))), $title, 'edit_theme_options', 'mega-store-welcome', array($this, 'print_welcome_page'));
		}

		public function activation_admin_notice() {
			global $pagenow;
			if (is_admin() && ('themes.php' == $pagenow) && isset($_GET['activated'])) {
				add_action('admin_notices', array($this, 'welcome_admin_notice'), 99);
			}
		}

		public function welcome_admin_notice() {
			?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf(esc_html__('Welcome! Thank you for choosing Mega Store ! To fully take advantage of our theme please make sure you visit our %1$s welcome page %2$s.', 'mega-store'), '<a href="' . esc_url(admin_url('themes.php?page=mega-store-welcome')) . '">', '</a>'); ?></p>
				<p><a href="<?php echo esc_url(admin_url('themes.php?page=mega-store-welcome')); ?>" class="button" style="text-decoration: none;"><?php esc_html_e('Get started with Mega Store', 'mega-store');?></a></p>
			</div>
			<?php
		}

		public function print_welcome_page() {
			$theme = $this->theme;
			?>
			<div class="wrap theme-info-wrap mega-store-wrap">
				<div class="row">
					<div class="theme-info-single">
						<div class="themefarmer-logo"><a href="<?php echo esc_url('https://www.themefarmer.com/'); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri().'/images/tf-logo.png'); ?>" class="ing-responsive img-tf-logo"></a></div>
						<div class="theme-info-inner">
							<h1 class="theme-heading"> <?php esc_html_e('Welcome to', 'mega-store');?> <span class="theme-name"> <?php echo esc_html($theme->get('Name')) ?> </span> <span class="theme-version"> <?php echo esc_html($theme->get('Version')) ?> </span> </h1>
							<div class="theme-description"><?php echo esc_html($theme->get('Description')); ?></div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="theme-welcome-container" style="min-height:300px;">
					<div class="theme-welcome-inner">
						<?php
							$tabs = $this->get_tabs_array();
							$tabs_head     = '';
							$tab_file_path = '';
							$active_tab    = 'getting_started';

							if (isset($_GET['tab']) && $_GET['tab']) {
								$active_tab = sanitize_text_field($_GET['tab']);
							}

							foreach ($tabs as $key => $tab) {
								$active_class = '';
								$count        = '';
								if ($active_tab == $tab['link']) {
									$active_class  = 'nav-tab-active';
									$tab_file_path = $tab['file_path'];
								}

								if ($tab['link'] == 'recommended_actions') {
									$count = $this->action_count;
									$count = ($count > 0) ? '<span class="badge-action-count">' . $count . '</span>' : '';
								}

								$tabs_head .= sprintf('<a href="%s" class="nav-tab %s" role="tab" data-toggle="tab">%s</a>', esc_url(admin_url('themes.php?page=mega-store-welcome&tab=' . $tab['link'])), $active_class, $tab['name'] . $count);
							}
						?>

						 <h2 class="nav-tab-wrapper wp-clearfix">
							<?php echo $tabs_head; ?>
						 </h2>
						 <div class="tab-content <?php echo esc_attr($active_tab); ?>">
						 	<?php
								if (!empty($tab_file_path) && file_exists($tab_file_path)) {
									require_once $tab_file_path;
								}
							?>
						 	<div style="clear: both;"></div>
						 </div>
					</div>
				</div>
			</div>
			<?php
		}

		public function get_tabs_array() {
			$tabs_array = array();
			
			
			$tabs_array[]	= array(
					'link'      => 'getting_started',
					'name'      => esc_html__('Getting Started', 'mega-store'),
					'file_path' => MEGA_STORE_ADMIN_DIR . '/tab-pages/getting-started.php',
				);
			$tabs_array[]	= 	array(
					'link'      => 'recommended_actions',
					'name'      => esc_html__('Recommended Actions', 'mega-store'),
					'file_path' => MEGA_STORE_ADMIN_DIR . '/tab-pages/recommended-actions.php',
				);
			if(count($this->get_useful_plugins()) > 0){
				$tabs_array[]	= 	array(
						'link'      => 'useful_plugins',
						'name'      => esc_html__('Useful Plugins', 'mega-store'),
						'file_path' => MEGA_STORE_ADMIN_DIR . '/tab-pages/useful-plugins.php',
				);
			}
			$tabs_array[]	= 	array(
					'link'      => 'theme_info',
					'name'      => esc_html__('Theme Information', 'mega-store'),
					'file_path' => MEGA_STORE_ADMIN_DIR . '/tab-pages/theme-info.php',
				);
			$tabs_array[]	= 	array(
					'link'      => 'free_vs_pro',
					'name'      => esc_html__('Free vs Pro', 'mega-store'),
					'file_path' => MEGA_STORE_ADMIN_DIR . '/tab-pages/free-vs-pro.php',
				);
			return $tabs_array;
			
		}

		public function get_recommended_plugins() {
			$plugins = array(
				array(
					'name'     => esc_html__('Mega Store Companion', 'mega-store'),
					'slug'     => 'mega-store-companion',
					'desc'     => esc_html__('It is highly recommended that you install the companion plugin to have access to the advance Frontpage sections and other theme features', 'mega-store'),
				),
			);
			return $plugins;
		}

		public function get_useful_plugins() {
			$plugins = array(
				array(
					'name'     => esc_html__('WooCommerce', 'mega-store'),
					'slug'     => 'woocommerce',
					'desc'     => esc_html__('use WooCommerce for E-Commerce Shop. Mega Store support WooCommerce.', 'mega-store'),
				),
			);
			return $plugins;
		}

		public function get_recommended_actions() {

			$act_count           = 0;
			$actions_todo = get_option( 'mega_store_recommended_actions', array());
			$recommended_actions = array(
				array(
					'id'      => 'page_setup',
					'title'   => esc_html__('Front page and blog page setup', 'mega-store'),
					'desc'    => __('<ol><li>Go to WP Menu -> Pages -> All Pages -> create/edit "Home" page by Add New/Edit. Select Template <b>Home Page</b> from Template Dropdown below <b>Publish/Update Button</b> -> <b>Publish/Update Button</b>.</li> <li> create/edit a page to show blog posts. name it <b>Blog </b> or anything you like. no need to add content for blog page -> <b>Publish/Update Button</b> </li> <li> Go to WP Menu -> Setting -> Reading -> Set <b>Front page display</b> to <b>A Static Page</b> -> Select previously created pages <b>Home</b> for <b>Front Page</b> and <b>Blog</b> for <b>Post page</b>.</li> ', 'mega-store'),
					'link'    => '', //sprintf('<a href="%s" class="action-link %s" target="_blank"> %s </a>', esc_url('#'), 'button', esc_html__('Watch Video how to do it')),
					'is_done' => mega_store_is_front_page_setup_done(),
				),
			);

			foreach ($recommended_actions as $key => $action) {
				if (!$action['is_done'] && (!isset($actions_todo[$action['id']]) || !$actions_todo[$action['id']])) {
					$act_count++;
				}
			}

			$plugins = $this->get_recommended_plugins();

			if ($plugins) {
				foreach ($plugins as $key => $plugin) {
					$action = array();
					if (!isset($plugin['slug'])) {
						continue;
					}

					$action['id']   = 'install_' . $plugin['slug'];
					$action['desc'] = '';
					if (isset($plugin['desc'])) {
						$action['desc'] = $plugin['desc'];
					}

					$action['name'] = '';
					if (isset($plugin['name'])) {
						$action['title'] = $plugin['name'];
					}

					$link_and_is_done  = $this->get_plugin_buttion($plugin['slug'], $plugin['name']);
					$action['link']    = $link_and_is_done['button'];
					$action['is_done'] = $link_and_is_done['done'];
					if (!$action['is_done'] && (!isset($actions_todo[$action['id']]) || !$actions_todo[$action['id']])) {
						$act_count++;
					}
					$recommended_actions[] = $action;
					$actions_todo[]        = array('id' => $action['id'], 'watch' => true);
				}
			}

			return array('count' => $act_count, 'actions' => $recommended_actions);
		}

		public function get_plugin_buttion($slug, $name) {
			$is_done      = false;
			$button_html  = '';
			$is_installed = $this->is_plugin_installed($slug);
			$plugin_path  = $this->get_plugin_basename_from_slug($slug);
			$is_activeted = $this->is_plugin_active($plugin_path);
			if (!$is_installed) {
				$plugin_install_url = add_query_arg(
					array(
						'action' => 'install-plugin',
						'plugin' => $slug,
					),
					self_admin_url('update.php')
				);
				$plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_' . esc_attr($slug));
				$button_html        = sprintf('<a class="mega-store-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
					esc_attr($slug),
					esc_url_raw($plugin_install_url),
					sprintf(esc_html__('Install %s Now', 'mega-store'), esc_html($name)),
					esc_html($name),
					esc_html__('Install & Activate', 'mega-store')
				);
			} elseif ($is_installed && !$is_activeted) {

				$plugin_activate_link = add_query_arg(
					array(
						'action'        => 'activate',
						'plugin'        => rawurlencode($plugin_path),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce('activate-plugin_' . $plugin_path),
					), network_admin_url('plugins.php')
				);

				$button_html = sprintf('<a class="mega-store-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
					esc_attr($slug),
					esc_url_raw($plugin_activate_link),
					sprintf(esc_html__('Activate %s Now', 'mega-store'), esc_html($name)),
					esc_html($name),
					esc_html__('Activate', 'mega-store')
				);
			} elseif ($is_activeted) {
				$button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'mega-store'));
				$is_done     = true;
			}

			return array('done' => $is_done, 'button' => $button_html);
		}

		public function is_plugin_active($path) {

			if (!function_exists('is_plugin_active')) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if (is_plugin_active($path)) {
				return true;
			}
		}

		public function get_plugin_basename_from_slug($slug) {
			$keys = array_keys($this->get_installed_plugins());
			foreach ($keys as $key) {
				if (preg_match('|^' . $slug . '/|', $key)) {
					return $key;
				}
			}
			return $slug;
		}

		public function is_plugin_installed($slug) {
			$installed_plugins = $this->get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
			$file_path         = $this->get_plugin_basename_from_slug($slug);
			return (!empty($installed_plugins[$file_path]));
		}

		public function get_installed_plugins() {

			if (!function_exists('get_plugins')) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			return get_plugins();
		}

		public function update_recommended_actions_watch() {
			if (isset($_POST['action_id'])) {
				$action_id    = sanitize_text_field($_POST['action_id']);
				$actions_todo = get_option('mega_store_recommended_actions', array());

				if ((!isset($actions_todo[$action_id]) || !$actions_todo[$action_id])) {
					$actions_todo[$action_id] = true;
				} else {
					$actions_todo[$action_id] = false;
				}
				update_option('mega_store_recommended_actions', $actions_todo);
			}
			echo json_encode(get_option('mega_store_recommended_actions'));
			wp_die();
		}

	}
}

function ThemeFarmer_About_Page() {
	return ThemeFarmer_About_Page::get_instance();
}
$page = ThemeFarmer_About_Page();