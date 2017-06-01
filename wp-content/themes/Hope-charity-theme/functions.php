<?php

add_filter( 'ot_show_pages', '__return_true' );
add_filter( 'ot_theme_mode', '__return_true' );

/* Add filters, actions, and theme-supported features after theme is loaded */

add_action( 'after_setup_theme', 'pm_hope_theme_setup' );

function pm_hope_theme_setup() {
	
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
		
	/***** LOAD REDUX FRAMEWORK ******/
		
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/hope/hope-config.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/hope/hope-config.php' );
	}
	
	/***** REQUIRED INCLUDES ***************************************************************************************************/
	
	include_once(trailingslashit( get_template_directory() ) . 'includes/cpt-organizers.php'); //Custom post type
	include_once(trailingslashit( get_template_directory() ) . 'includes/cpt-events.php'); //Custom post type
	include_once(trailingslashit( get_template_directory() ) . 'includes/cpt-gallery.php'); //Custom post type
	include_once(trailingslashit( get_template_directory() ) . 'includes/shortcodes/shortcodes.php'); //Shortcodes
	include_once(trailingslashit( get_template_directory() ) . "includes/theme-metaboxes.php"); //Option Tree Meta boxes
		
	//Widgets
	include_once(trailingslashit( get_template_directory() ) . "includes/widget-twitter.php"); //twitter
	include_once(trailingslashit( get_template_directory() ) . "includes/fb_likebox.php"); //facebook
	include_once(trailingslashit( get_template_directory() ) . "includes/video-widget.php"); //video
	include_once(trailingslashit( get_template_directory() ) . "includes/flickr.php"); //flickr
	include_once(trailingslashit( get_template_directory() ) . "includes/widget-mailchimp.php"); //mailchimp
	include_once(trailingslashit( get_template_directory() ) . "includes/widget-quickcontact.php"); //quick contact form
	include_once(trailingslashit( get_template_directory() ) . "includes/widget-recentposts.php"); //recent posts
	include_once(trailingslashit( get_template_directory() ) . "includes/widget-events.php"); //recent posts
	
	//Theme update notifications library
	require_once(get_template_directory() . "/includes/theme-update-checker.php");
	
	//TGM plugin
	require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
	
	//Customizer class
	include_once(trailingslashit( get_template_directory() ) . "includes/classes/PM_LN_Customizer.class.php");
	
	//Custom functions
	include_once(trailingslashit( get_template_directory() ) . "includes/wp-functions.php");
	
	/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
	if ( pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {

		if(!class_exists('WPBakeryShortCode')) return;
	
		$de_block_dir = get_template_directory().'/includes/vc_blocks/';
		
		require_once( $de_block_dir . 'alert.php' );	
		require_once( $de_block_dir . 'divider.php' );
		require_once( $de_block_dir . 'event_post.php' );
		require_once( $de_block_dir . 'event_posts.php' );
		require_once( $de_block_dir . 'feature_box.php' );
		//require_once( $de_block_dir . 'featured_panel.php' );
		require_once( $de_block_dir . 'google_map.php' );
		require_once( $de_block_dir . 'image_panel.php' );
		require_once( $de_block_dir . 'panel_header.php' );
		require_once( $de_block_dir . 'post_items.php' );
		require_once( $de_block_dir . 'progress_bar.php' );
		require_once( $de_block_dir . 'single_post.php' );
		require_once( $de_block_dir . 'sponsors_carousel.php' );
		require_once( $de_block_dir . 'staff_posts.php' );
		require_once( $de_block_dir . 'staff_profile.php' );
		require_once( $de_block_dir . 'standard_button.php' );
		require_once( $de_block_dir . 'vimeo_video.php' );
		require_once( $de_block_dir . 'youtube_video.php' );
		require_once( $de_block_dir . 'gallery_posts.php' );
		
		//Nested elements go last
		require_once( $de_block_dir . 'social_group.php' );
		require_once( $de_block_dir . 'accordion_group.php' );
		require_once( $de_block_dir . 'tab_group.php' );			
	
	}
		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Main Menu');
	register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT *******************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	
	/***** THEME CUSTOMIZER - NEW in WP 3.4+ ***********************************************************************/
	
	//Output CSS to head section
	add_action ('wp_head', 'pm_ln_customizer_css', 130);
	//add_action( 'wp_enqueue_scripts', 'pm_ln_customizer_styles_cache', 130 );
	//add_action( 'customize_save_after', 'pm_ln_reset_style_cache_on_customizer_save' );
		
	/***** CUSTOM FILTERS AND HOOKS *********************************************************************************/
	
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'pm_hope_register_custom_sidebars' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
	
	//Enqueues scripts and styles for front-end.
	add_action( 'wp_enqueue_scripts', 'pm_hope_scripts_styles' );
	
	add_filter('excerpt_more', 'pm_hope_new_excerpt_more');
	
	// Radio Images for theme options layouts
	add_filter( 'ot_radio_images', 'pm_hope_filter_radio_images', 10, 2 );
	
	//add do_shortcode
	add_filter( 'the_content', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'pm_hope_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'pm_hope_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','pm_hope_custom_nextpage_links');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'pm_hope_remove_category_list_rel' );
	add_filter( 'the_category', 'pm_hope_remove_category_list_rel' );	
	
	//Ajax loader function
	add_action('wp_ajax_pulsar_load_more', 'pulsar_load_more');
	add_action('wp_ajax_nopriv_pulsar_load_more', 'pulsar_load_more');
	
	//Ajax Quick Contact form
	add_action('wp_ajax_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	add_action('wp_ajax_nopriv_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	
	//Custom page title output
	add_filter( 'wp_title', 'pm_ln_custom_page_titles', 10, 2 );
		
	/**** WOOCOMMERCE ***/
	
	//Disable default Woocommerce styles
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add HOPE theme wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_theme_wrapper_end', 10);
	
	//Display number of items per page
	$products_per_page = get_theme_mod('products_per_page', 8);
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );
	
	//Add Search filter for posts and woocommerce products
	add_filter('pre_get_posts','pm_ln_search_filter');
	
	//Dashboard customization
	add_action ('wp_dashboard_setup', 'pm_ln_remove_dashboard_widget'); //remove default widgets to reduce clutter
	add_action( 'wp_dashboard_setup', 'pm_ln_add_dashboard_widgets' ); //add custom widget for Micro Themes
	add_filter( 'admin_footer_text', 'pm_ln_remove_footer_admin' );//footer info
	add_action( 'login_enqueue_scripts', 'pm_ln_login_logo' );//login logo
	add_filter( 'login_headerurl', 'pm_ln_login_logo_url' );//login logo url
	add_filter( 'login_headertitle', 'pm_ln_login_logo_url_title' );//login logo title
	
	//TGM plugin activation
	add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
	
	//Theme updates
	add_action('init', 'pm_ln_check_for_theme_updates');
	
	//Custom settings page for purchase verification
	add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
	
	//Create theme update options
	add_option('pm_ln_theme_marketplace','');
	add_option('pm_ln_micro_themes_user_email','');
	add_option('pm_ln_micro_themes_purchase_code_themeforest','');
	add_option('pm_ln_micro_themes_purchase_code_mojo','');
	add_option('pm_ln_micro_themes_purchased_product', 2);//Theme specific
				
}//end of after_theme_setup

//Localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
add_action('after_setup_theme', 'pm_hope_localization_setup');


if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Woocommerce', // The plugin name.
				'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/woocommerce.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Premium PayPal Manager', // The plugin name.
				'slug'               => 'premium-paypal-manager', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/premium-paypal-manager.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			
			array(
				'name'               => 'Contact Form 7', // The plugin name.
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/contact-form-7.4.6.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
		
			
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'localization',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
			
		);
	
		tgmpa( $plugins, $config );
	}

}

if( !function_exists('pm_ln_login_logo_url') ) {
	
	function pm_ln_login_logo_url() {
		return esc_url( 'https://www.microthemes.ca' );
	}
	
}

if( !function_exists('pm_ln_login_logo_url_title') ) {
	
	function pm_ln_login_logo_url_title() {
		return esc_html__('Micro Themes :: Developers of micro niche themes and plug-ins for WordPress', 'localization');
	}
	
}

if( !function_exists('pm_ln_login_logo') ) {
	
	function pm_ln_login_logo() { ?>
		<style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/micro-themes-login.png );
                padding-bottom: 0px;
                width:321px !important;
                background-size:100%;
            }
        </style>
    <?php }
	
}

if( !function_exists('pm_ln_remove_footer_admin') ) {
	
	function pm_ln_remove_footer_admin () {
		echo '<span id="footer-thankyou">'. esc_html__('Developed by', 'localization') .' <a href="http://www.microthemes.ca/" target="_blank">'. esc_html__('Micro Themes', 'localization') .'</a> :: '. esc_html__('Developers of micro niche themes and plug-ins for WordPress', 'localization') .' - '. esc_html__('Need help with this theme? Visit our', 'localization') .' <a href="https://www.microthemes.ca/forums-disclaimer" target="_blank">'. esc_html__('support forums', 'localization') .'</a> '. esc_html__('or view our', 'localization') .' <a href="https://www.microthemes.ca/installation-videos/" target="_blank">'. esc_html__('theme installation videos', 'localization') .'</a></span>';
	}
	
}

if( !function_exists('pm_ln_remove_dashboard_widget') ) {
	
	function pm_ln_remove_dashboard_widget () {
		remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );		
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	}
	
}


if( !function_exists('pm_ln_add_dashboard_widgets') ) {
	
	function pm_ln_add_dashboard_widgets() {
		wp_add_dashboard_widget(
			'pm_ln_dashboard_widget', // Widget slug.
			esc_html__('Micro Themes - Latest News', 'localization'), // Title.
			'pm_ln_dashboard_widget_function' // Display function.
		);
	}
	
}

if( !function_exists('pm_ln_dashboard_widget_function') ) {
	
	function pm_ln_dashboard_widget_function() {
	
		$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
		
		if( is_array($news_file) ) {
							
		  $header = $news_file['headers']; // array of http header lines
		  $body = $news_file['body']; // use the content
		  
		  $args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'p' => array(),
				'h2' => array(),
			);
		  
		  echo wp_kses($body, $args) ;
		  
		}
		
	}
	
}



if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'Hope-charity-theme',
			'https://www.microthemes.ca/theme-updates/hope-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}


if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'localization'), esc_attr__('Theme Updates', 'localization'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));	
			update_option('pm_ln_micro_themes_purchased_product', 2);//Corresponds to products array in verify account script		
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');		
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'https://www.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
				
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'localization'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'localization'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'localization'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'localization'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'localization'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'localization'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'localization'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'localization'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'localization'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'localization'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'localization'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" value="" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'localization'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'localization') : esc_attr('Unverified', 'localization'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'localization'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'localization'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'localization'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}


if( !function_exists('pm_ln_custom_page_titles') ) {
	
	function pm_ln_custom_page_titles( $title, $sep ) {

		//Check if custom titles are enabled from your option framework
		$title = '<title>';
		
			  if (function_exists('is_tag') && is_tag()) {
				 $title .= single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; 
			  } elseif ( is_front_page()) {
				 $title .= wp_title(''); echo ' Home - '; }
			  elseif (is_archive()) {
				 $title .= wp_title(''); echo ' Archive - '; }
			  elseif (is_search()) {
				 $title .= ''. __('Search for', 'localization') .' &quot;'.esc_html($s).'&quot; - '; }
			  elseif (!(is_404()) && (is_single()) || (is_page())) {
				 $title .= wp_title(''); echo ' - '; }
			  elseif (is_404()) {
				 $title .= ''. __('404 Error', 'localization') .' - '; }
			  if (is_home()) {
				 $title .= bloginfo('name'); echo ' - '; bloginfo('description'); }
			  else {
				 $title .= bloginfo('name'); }
			  if ($paged>1) {
				 $title .= ' - page '. $paged; }
		   
		$title .= '</title>';
	
		return $title;
	}
	
}



if( !function_exists('pm_ln_search_filter') ) {
	
	//Filter Search results
	function pm_ln_search_filter($query) {
		
		if( isset($_GET['post_type']) ){
			
			if($_GET['post_type'] == 'product'){
				
				if ($query->is_search) {
					$query->set('post_type', array('product'));
				}
				
			}
			
		} else {
			
			if ($query->is_search) {
				$query->set('post_type',array('post', 'page', 'post_events', 'post_galleries', 'post_organizers'));
			}
			
		}
		
		return $query;
	}
	
}



/*** WOOCOMMERCE FUNCTIONS *****/

if( !function_exists('pm_ln_remove_wc_breadcrumbs') ) {
	
	function pm_ln_remove_wc_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
	
}




if( !function_exists('pm_ln_theme_wrapper_start') ) {
	
	function pm_ln_theme_wrapper_start() {
		if(is_product()){
			 echo '<div class="container pm_paddingVertical60"><div class="row">';  
		} else {
			 echo '<div class="container pm_paddingVertical60"><div class="row"><div class="span12">';  
		}
	 
	}
	
}



if( !function_exists('pm_ln_theme_wrapper_end') ) {
	
	function pm_ln_theme_wrapper_end() {
		if(is_product()){
			 echo '</div></div>';  
		} else {
			 echo '</div></div></div>';
		}
	  
	}
	
}




if( !function_exists('pm_hope_remove_category_list_rel') ) {
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error)
	function pm_hope_remove_category_list_rel( $output ) {
		// Remove rel attribute from the category list
		return str_replace( ' rel="category tag"', '', $output );
	}
	
}




if( !function_exists('pm_hope_filter_radio_images') ) {
	
	//Radio Images
	function pm_hope_filter_radio_images( $array, $field_id ) {
	  
	  /* apply filter to appropriate field IDs */
	  if ( $field_id == 'defaultTemplateLayout' || $field_id == 'singleblogTemplateLayout') {
		$array = array(
		  array(
			'value'   => 'full-width',
			'label'   => esc_attr__( 'Full Width', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/full-width.png'
		  ),
		  array(
			'value'   => 'left-sidebar',
			'label'   => esc_attr__( 'Left Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
		  ),
		  array(
			'value'   => 'right-sidebar',
			'label'   => esc_attr__( 'Right Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
		  ),
		  
		);
	  }
	  
	  if ( $field_id == 'blogTemplateLayout' || $field_id == 'homepageLayout') {
		$array = array(
		  array(
			'value'   => 'full-width',
			'label'   => esc_attr__( 'Full Width', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/full-width.png'
		  ),
		  array(
			'value'   => 'left-sidebar',
			'label'   => esc_attr__( 'Left Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
		  ),
		  array(
			'value'   => 'dual-left-sidebar',
			'label'   => esc_attr__( 'Dual Left Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/left-dual-sidebar.png'
		  ),
		  array(
			'value'   => 'right-sidebar',
			'label'   => esc_attr__( 'Right Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
		  ),
		  array(
			'value'   => 'dual-right-sidebar',
			'label'   => esc_attr__( 'Dual Right Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/right-dual-sidebar.png'
		  ),
		  array(
			'value'   => 'dual-sidebar',
			'label'   => esc_attr__( 'Dual Sidebars', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/dual-sidebar.png'
		  ),
		  
		);
	  }
	  
	  if ( $field_id == 'postLayout' || $field_id == 'pageLayout') {
		$array = array(
		  array(
			'value'   => 'full-width',
			'label'   => esc_attr__( 'Full Width', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/full-width.png'
		  ),
		  array(
			'value'   => 'left-sidebar',
			'label'   => esc_attr__( 'Left Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
		  ),
		  array(
			'value'   => 'right-sidebar',
			'label'   => esc_attr__( 'Right Sidebar', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
		  ),	  
		);
	  }
	  
	  if ( $field_id == 'footerLayout') {
		$array = array(
		  array(
			'value'   => 'footer-three-wide-left',
			'label'   => esc_attr__( 'Footer 3 Wide Left Columns', 'localization' ),
			'src'     => OT_URL . '/assets/images/layout/footer-3-wide-left.png'
		  ),
		  array(
			'value'   => 'footer-three-wide-right',
			'label'   => esc_attr__( 'Footer 3 Wide Right Columns', 'localization' ),
			'src'     => OT_URL . '/assets/images/layout/footer-3-wide-right.png'
		  ),
		  array(
			'value'   => 'footer-three-columns',
			'label'   => esc_attr__( 'Footer 3 Columns', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/footer-3-column.png'
		  ),
		  array(
			'value'   => 'footer-four-columns',
			'label'   => esc_attr__( 'Footer 4 Columns', 'option-tree' ),
			'src'     => OT_URL . '/assets/images/layout/footer-4-column.png'
		  )
		);
	  }
	  
	  return $array;
	  
	}
	
}



if( !function_exists('pm_hope_posts_columns_id') ) {
	
	//Show Post ID's
	function pm_hope_posts_columns_id($defaults){
		$defaults['wps_post_id'] = esc_attr__('ID', 'localization');
		return $defaults;
	}
	
}


if( !function_exists('pm_hope_posts_custom_id_columns') ) {
	
	function pm_hope_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
		}
	}
	
}



if( !function_exists('pm_hope_new_excerpt_more') ) {
	
	//Excerpt filters
	function pm_hope_new_excerpt_more($more) {
		global $post;
		return '... <a href="'. get_permalink($post->ID) . '" class="readmore">' . 'Read More &raquo;' . '</a>';
	}
	
}


if( !function_exists('pm_hope_custom_nextpage_links') ) {
	
	//Custom paginated posts
	function pm_hope_custom_nextpage_links($defaults) {
		$args = array(
			'before' => '<div class="pm_paginated-posts"><p>'. esc_attr__('Continue Reading: ', 'localization') .'</p><ul class="pagination_multi clearfix">',
			'after' => '</ul></div>',
			'link_before'      => '<li>',
			'link_after'       => '</li>',
		);
		$r = wp_parse_args($args, $defaults);
		return $r;
	}
	
}


if( !function_exists('pm_ln_load_admin_scripts') ) {
	
	//Enqueue scripts and styles for admin area
	function pm_ln_load_admin_scripts() {
		
		wp_enqueue_media();
		
		//Date picker for Events post type
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
		
		//Load Media uploader script for custom meta options
		wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array('jquery'), '1.0', true );
		
		//Custom CSS for meta boxes
		wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
		
		//JS for admin
		wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
		
		wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
		wp_enqueue_style('customizer-styles');
		
		//Get locale and export for JS
		$getLocale = get_locale();
		$splitLocale = explode("_", $getLocale);
		$currentLocale = $splitLocale[0];
		
		$wordpressOptionsArray = array( 
			'urlRoot' => home_url(),
			'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
			'currentLocale' => $currentLocale,
			//'fixedHeight' => $enableFixedHeight,
		);
		
		wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wp-admin/wordpress.js');
		wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
		
	}
	
}



if( !function_exists('pm_hope_scripts_styles') ) {
	
	//Enqueue scripts and styles
	function pm_hope_scripts_styles() {
			
		global $wp_styles;
		global $post;
	
		// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		
			wp_enqueue_script( 'comment-reply' );
	
			//Adds JavaScript for handling the navigation menu hide-and-show behavior.
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'modrnizer', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', array("jquery"), '1.0', false );
			wp_enqueue_script( 'froogaloop', get_template_directory_uri() . '/js/froogaloop2.min.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'hovertile', get_template_directory_uri() . '/js/hovertile.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing-1.3.js', array("jquery"), '1.0', true );
			
			if( is_single() ){
				//Flexslider
				wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider.js', array("jquery"), '1.0', true );
				
			}
			
			if(is_home() || is_front_page()){
				//Load pulse slider
				wp_enqueue_script( 'pulseslider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider.js', array('jquery'), '1.0', true );
				wp_enqueue_style( 'pulseslider-css', get_template_directory_uri() . '/js/pulse/pm-slider.css', array( 'pulsar-style' ), '20121010' );
			}
					
			//load owl carousel
			if( pm_ln_has_shortcode('sponsorsCarousel') || is_archive() || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {
				wp_enqueue_style( 'pulsar-owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'pulsar-owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array("jquery"), '1.0', true );
			}
			
			$enableRetina = get_theme_mod('enableRetina','off');
			if($enableRetina === 'on'){
				wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array("jquery"), '1.0', true );
			}
			
			//Ajax email		
			if(is_active_widget( '', '', 'pm_quickcontact_widget')) {
				wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-quick-email.js', array("jquery"), '1.0', true );	
			}
			
			//PrettyPhoto - use for galleries if needed
			if('post_galleries' == get_post_type() || is_page_template('template-gallery.php') || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ){
				wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array("jquery"), '1.0', true );
				wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array("jquery"), '1.0', true );
				wp_enqueue_style( 'pulsar-prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
			}
			
			//Micro Themes plug-ins
			wp_enqueue_script( 'pulsar-hoverPanel', get_template_directory_uri() . '/js/jquery.hoverPanel.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'pulsar-tooltip', get_template_directory_uri() . '/js/jquery.tooltip.js', array("jquery"), '1.0', true );
			
			//Load countdown on event page only - specific for HOPE Theme
			if('post_events' == get_post_type()){
				wp_enqueue_script( 'pulsar-countdown', get_template_directory_uri() . '/js/countdown/js/jquery.ccountdown.js', array("jquery"), '1.0', true );
				wp_enqueue_script( 'pulsar-knob', get_template_directory_uri() . '/js/countdown/js/jquery.knob.js', array("jquery"), '1.0', true );
				wp_enqueue_script( 'pulsar-countdowninit', get_template_directory_uri() . '/js/countdown/js/init.js', array("jquery"), '1.0', true );
			}
			
			if( pm_ln_has_shortcode('googleMap') || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {
				
				$googleAPIKey = get_theme_mod('googleAPIKey');
				
				//Google maps shortcode support
				wp_register_script('googlemaps', ('//maps.google.com/maps/api/js?key='.$googleAPIKey.''), false, null, true);
				wp_enqueue_script('googlemaps');
				
			}
			
					
			if(is_page_template('template-organizers.php') || is_page_template('template-events.php') || is_page_template('template-gallery.php')){
				
				//load isotope
				wp_enqueue_style( 'pulsar-isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'pulsar-isotope', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array("jquery"), '1.0', true );
				
				//Load Ajax loader - Still need to create this
				wp_enqueue_script( 'jcustom', true );
				$array = array( 
					'ajaxurl' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce('pulsar_ajax'),
					'loading' => esc_attr__('Loading...', 'localization')
				);
				wp_localize_script( 'jcustom', 'pulsarajax', $array );
				
			}
			
			//Main scripts
			wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array("jquery"), '1.0', true );
			wp_enqueue_script( 'pulsar-init', get_template_directory_uri() . '/js/init.js', array("jquery"), '1.0', true );
			
			//Load theme color selector (for sampling purposes)
			$colorSampler = get_theme_mod('colorSampler', 'off');
			if( $colorSampler == 'on' ){
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-mouse' );
				wp_enqueue_script( 'jquery-ui-slider' );
				wp_enqueue_script( 'jquery-ui-draggable' );
				wp_enqueue_script( 'jquery-ui-widget ' );
				wp_enqueue_script( 'pulsar-color', get_template_directory_uri() . '/js/iris/color.min.js', array(), '1.0', true );
				wp_enqueue_script( 'pulsar-iris', get_template_directory_uri() . '/js/iris/iris.min.js', array(), '1.0', true );
				wp_enqueue_style( 'pulsar-iris-css', get_template_directory_uri() . '/js/iris/iris.min.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_script( 'pulsar-theme-color-selector', get_template_directory_uri() . '/js/theme-sampler/theme-color-selector.js', array(), '1.0', true );
				wp_enqueue_style( 'pulsar-theme-color-selector-css', get_template_directory_uri() . '/js/theme-sampler/theme-color-selector.css', array( 'pulsar-style' ), '20121010' );
			}
			
			//Load twitter feed
			if(is_active_widget( '', '', 'latest-tweets')) {
				wp_enqueue_script( 'twitterFetcher', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array("jquery"), '1.0', true );
			}
					
			//Loads our main stylesheet.
			wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
			
			wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap/bootstrap.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css', array( 'pulsar-style' ), '20121010' );
		
			//Loads other stylesheets.
			wp_enqueue_style( 'superfish', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
			
				
			//enable responsiveness
			$enableResponsiveness = get_theme_mod('enableResponsiveness', 'on'); 
			if($enableResponsiveness === 'on'){
				wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap/bootstrap-responsive.css', array( 'pulsar-style' ), '20121010' );
				wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );
			} else {
				wp_enqueue_style( 'pulsar-nonresponsive', get_template_directory_uri() . '/css/non-responsive.css', array( 'pulsar-style' ), '20121010' );
			}			
			
			if(is_home() || is_front_page()){
				//Flexslider
				wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/css/flexslider/flexslider.css', array( 'pulsar-style' ), '20121010' );
				
			}
			
			
			if(is_single()){
				//Flexslider
				wp_enqueue_style( 'pulsar-flexslider-post', get_template_directory_uri() . '/css/flexslider/flexslider-post.css', array( 'pulsar-style' ), '20121010' );
			}
			
			//Use for sponsor carousel
			wp_enqueue_style( 'flexisel-css', get_template_directory_uri() . '/css/flexisel/flexisel.css', array( 'pulsar-style' ), '20121010' );
			
			
			//Load ie9 specific css - use this to fix ie 9 issues
			wp_enqueue_style( 'ie-nine-css', get_stylesheet_directory_uri() . '/css/ie9.css', array( 'pulsar-style' ), '20121010' );
			$wp_styles->add_data( 'ie-nine-css', 'conditional', 'IE 9' );
			
			//JS LOCALIZATION
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			
			//PrettyPhoto settings
			global $hope_options;
			
			$ppAnimationSpeed = $hope_options['ppAnimationSpeed'];
			$ppAutoPlay = $hope_options['ppAutoPlay'];
			//$ppShowTitle = $hope_options['ppShowTitle'];
			$ppColorTheme = $hope_options['ppColorTheme'];
			$ppSlideShowSpeed = $hope_options['ppSlideShowSpeed'];
			
			//Post zoom effect
			$enablePostZoom = get_theme_mod('enablePostZoom', 'on');
			$enablePostHover = get_theme_mod('enablePostHover', 'on');
			$enableEventPostZoom = get_theme_mod('enableEventPostZoom', 'on');
			$enableEventPostHover = get_theme_mod('enableEventPostHover', 'on');
			
			//Micro slider settings
			$enableSlideShow = get_theme_mod('enableSlideShow', 'true');
			$slideLoop = get_theme_mod('slideLoop', 'true');
			$enableControlNav = get_theme_mod('enableControlNav', 'true');
			$pauseOnHover = get_theme_mod('pauseOnHover', 'true');
			$showArrows = get_theme_mod('showArrows', 'true');
			$animtionType = get_theme_mod('animtionType', 'fade');
			$slideShowSpeed = get_theme_mod('slideShowSpeed', 8000);
			$slideSpeed = get_theme_mod('slideSpeed', 500);
			$sliderHeight = get_theme_mod('sliderHeight', 800);
			//$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');
			
			//Get locale and export for JS
			$getLocale = get_locale();
			$splitLocale = explode("_", $getLocale);
			$currentLocale = $splitLocale[0];			
			
			$wordpressOptionsArray = array( 
				'urlRoot' => home_url(),
				'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
				'templatePath' => get_template_directory_uri(),
				'optContactFormNameError' => esc_attr__('Please enter your name.', 'localization'),
				'optContactFormEmailError' => esc_attr__('Please enter a valid email address.', 'localization'),
				'optContactFormInquiryError' => esc_attr__('Please enter a message.', 'localization'),
				'optFormSuccessMessage' => esc_attr__('Thank you, your inquiry has been received.', 'localization'),
				'optFormErrorMessage' => esc_attr__('A system error occurred, please try again.', 'localization'),
				'fieldValidation' => esc_html__('Validating form...', 'localization'),
				'enablePostZoom' => $enablePostZoom,
				'enableEventPostZoom' => $enableEventPostZoom,
				'enableEventPostHover' => $enableEventPostHover,
				'enablePostHover' => $enablePostHover,
				'ppAnimationSpeed' => $ppAnimationSpeed,
				'ppAutoPlay' => $ppAutoPlay,
				//'ppShowTitle' => $ppShowTitle,
				'ppColorTheme' => $ppColorTheme,
				'ppSlideShowSpeed' => $ppSlideShowSpeed,
				'currentLocale' => $currentLocale,
				'enableSlideShow' => $enableSlideShow,
				'slideLoop' => $slideLoop,
				'enableControlNav' => $enableControlNav,
				'animtionType' => $animtionType,
				'pauseOnHover' => $pauseOnHover,
				'showArrows' => $showArrows,
				'slideShowSpeed' => $slideShowSpeed,
				'slideSpeed' => $slideSpeed,
				'sliderHeight' => $sliderHeight,
			);
			
			wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
			wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
			
	}
	
}



if( !function_exists('pm_hope_register_custom_sidebars') ) {
	
	function pm_hope_register_custom_sidebars() {
		
		if (function_exists('register_sidebar')) {
			
			//DEFAULT TEMPLATE
			/*register_sidebar(array(
									'name' => 'Default Template',
									'before_widget' => '<div id="%1$s" class="%2$s pm_widget">',
									'after_widget' => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));*/
			
			//HOMEPAGE
			register_sidebar(array(
									
									'name' => esc_attr__('Homepage Single Column', 'localization'),
									'id' => 'home_single_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									'name' => esc_attr__('Homepage Left Column', 'localization'),
									'id' => 'home_left_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_attr__('Homepage Right Column', 'localization'),
									'id' => 'home_right_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
	
			//NEWS POSTS PAGE
			register_sidebar(array(
									
									'name' => esc_attr__('Blog Page Single Column', 'localization'),
									'id' => 'blog_page_single_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_attr__('Blog Page Left Column', 'localization'),
									'id' => 'blog_page_left_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_attr__('Blog Page Right Column', 'localization'),
									'id' => 'blog_page_right_column_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
	
	
			//NEWS SINGLE POST PAGE
			register_sidebar(array(
									'name' => esc_attr__('Single Blog Post', 'localization'),
									'id' => 'single_post_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget pm_widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
					
			//FOOTER
			register_sidebar(array(
									
									'name' => esc_attr__('Footer Column 1', 'localization'),
									'id' => 'footer_column1_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									'name' => esc_attr__('Footer Column 2', 'localization'),
									'id' => 'footer_column2_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									'name' => esc_attr__('Footer Column 3', 'localization'),
									'id' => 'footer_column3_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									'name' => esc_attr__('Footer Column 4', 'localization'),
									'id' => 'footer_column4_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_attr__('Woocommerce', 'localization'),
									'id' => 'woocomm_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			register_sidebar(array(
									
									'name' => esc_attr__('Page Sidebar', 'localization'),
									'id' => 'default_widget',
									'description'   => '',
									'class'         => '',
									'before_widget' => '<div id="%1$s" class="widget %2$s">',
									'after_widget'  => '</div>',
									'before_title' => '<h6>',
									'after_title' => '</h6>',
			));
			
			
			
		}//end of if function_exists
		
	}//end of pm_hope_register_custom_sidebars
	
}


if( !function_exists('pm_hope_localization_setup') ) {
	
	//Localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
	function pm_hope_localization_setup() {
		// Retrieve the directory for the localization files
		$lang_dir = get_template_directory() . '/languages';
		// Set the theme's text domain using the unique identifier from above
		load_theme_textdomain('localization', $lang_dir);
	} // end custom_theme_setup
	
}





if( !function_exists('pm_hope_kriesi_pagination') ) {
	
	//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
	function pm_hope_kriesi_pagination($pages = '', $range = 2){
		
		 $showitems = ($range * 2)+1;
	
		 global $paged;
		 if(empty($paged)) $paged = 1;
	
		 if($pages == '')
		 {
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages)
			 {
				 $pages = 1;
			 }
		 }
	
		 if(1 != $pages){
			 
			 echo "<ul class='pagination clearfix'>";
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
			 if($paged > 1 && $showitems < $pages) echo "<a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
	
			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
					 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
				 }
			 }
	
			 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
			 
		 }
		 
		 $args = array(
			'before'           => '<li>' . esc_attr__('Pages:', 'localization'),
			'after'            => '</li>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => esc_attr__('Next page', 'localization'),
			'previouspagelink' => esc_attr__('Previous page', 'localization'),
			'pagelink'         => '%',
			'echo'             => 1
		);
		
		echo "</ul>\n";
	}
	
}


if( !function_exists('pm_ln_customizer_css') ) {
	
	/*** Theme Customizer CSS ****/
	function pm_ln_customizer_css(){
	?>
			<style type="text/css">
			<?php
			
				//apply body styles
				$pageBackgroundColor = get_option('pageBackgroundColor', '#FFFFFF');
							
				echo '
					body {
						background-color:'.$pageBackgroundColor.' !important;
					}
				';
							
				//apply primary colors
				$primaryColor =  get_option('primaryColor', '#00B7C2');	
				$primaryColors =  pm_ln_hex2rgb($primaryColor); //Array of colors R,G,B
					
				$secondaryColor =  get_option('secondaryColor', '#ACDB05');
				$secondaryColors =  pm_ln_hex2rgb($secondaryColor); //Array of colors R,G,B
					
				$borderColor = pm_hope_hex2rgb($primaryColor);
				$searchFieldColor = get_option('searchFieldColor', '#494949');	
				$searchFieldTextColor= get_option('searchFieldTextColor', '#ffffff');	
				
				$textBackgroundColor = get_option('textBackgroundColor', '#000000');
				$textBackgroundColors = pm_ln_hex2rgb($textBackgroundColor); //Array of colors R,G,B
				$textBackgroundOpacity = get_theme_mod('textBackgroundOpacity', 80);
				$textBackgroundOpacityFinal = $textBackgroundOpacity / 100; //divide this to convert value decimal
				
				//Micro Slider styles
				echo '
				
					.footer .widget_recent_entries ul li, .footer .widget_archive ul li, .footer .widget_categories ul li {
						color:'.$secondaryColor.';		
					}
				
					.pm-single-blog-post-categories .icon i, .pm-single-blog-post-tags .icon i {
						color: '.$secondaryColor.';	
					}
				
					.pm-isotope-filter-system-expand {
						background-color: '.$primaryColor.';	
					}
								
					.pm-gallery-item-btns li a {
						background-color:'.$primaryColor.';
					}
					
					.pm-gallery-item-btns li a:hover {
						background-color:'.$secondaryColor.';
					}
				
					.pm-gallery-item-title {
						background-color:'.$primaryColor.';	
					}
					
					.pm-gallery-item-hover-btn {
						border-color: transparent '.$secondaryColor.' '.$secondaryColor.' transparent;	
					}
					
					.pm-gallery-item-hover-btn:hover {
						border-color: transparent '.$primaryColor.' '.$primaryColor.' transparent;	
					}
				
					.pm-rounded-btn a {
						border: 3px solid '.$secondaryColor.';
						color: white;
					}
				
					.pm-rounded-btn a.current {
						background-color: '.$primaryColor.';
						border: 3px solid '.$primaryColor.';
						color: white;
					}
					
					@media only screen and (max-width: 767px) {
						
						.pm-rounded-btn a.current {
							background-color: '.$secondaryColor.' !important;
						}
						
							
					}
					
					.pm-rounded-btn a:hover {
						background-color: '.$primaryColor.';
						border: 3px solid '.$primaryColor.';
						color: white;
					}
				
					.pm_single_post_tags i, .pm_single_post_comment_count i {
						color:'.$secondaryColor.';		
					}
					
					.pm_single_post_tags a:hover {
						color:'.$primaryColor.' !important;	
					}
				
					.pm-slide-btn {
						background-color:'.$secondaryColor.';	
					}
					.pm-slide-btn:hover {
						background-color:'.$primaryColor.';	
					}
					.pm-caption h1, .pm-caption-decription {
						background-color: rgba('.$textBackgroundColors[0].', '.$textBackgroundColors[1].', '.$textBackgroundColors[2].', '.$textBackgroundOpacityFinal.');	
					}
					
					.pm-slider nav span.pm-prev, .pm-slider nav span.pm-next {
						background-color: rgba('.$secondaryColors[0].', '.$secondaryColors[1].', '.$secondaryColors[2].', 0.7);	
					}
					
					.pm-slider nav span.pm-prev:hover, .pm-slider nav span.pm-next:hover {
						background-color: rgba('.$primaryColors[0].', '.$primaryColors[1].', '.$primaryColors[2].', 0.9);	
					}
					
					.pm-dots span {
						background-color:'.$secondaryColor.';	
					}
					
					.pm-dots span:hover {
						background-color:'.$primaryColor.';	
					}
					
					.pm-dots span.pm-currentDot {
						background-color:'.$primaryColor.';		
					}
					
				';
				
				echo '
				
					.pm-organizers-nav-links a {
						background-color:'.$primaryColor.' !important	
					}
					
					.pm-organizers-nav-links a:hover {
						background-color:'.$secondaryColor.' !important		
					}
				
					.btn.pm-owl-next:hover, .btn.pm-owl-play:hover, .btn.pm-owl-prev:hover {
						color: '.$secondaryColor.' !important
					}
				
					.pm_slider_btn a:hover, .button-large i:hover, .button-large-theme i:hover {
						background-color:'.$primaryColor.' !important;	
					}
				
					.flex-control-thumbs li:hover {
						border: 1px solid '.$secondaryColor.' !important	
					}
				
					.button-small i:hover, .button-small-theme:hover i {
						background-color:'.$primaryColor.' !important;
					}
				
					.quick_contact_submit:hover {
						background-color:'.$primaryColor.' !important;
					}
					
					.pagination li:hover {
						background-color:'.$primaryColor.' !important;
					}
					
					.pagination li:hover a {
						color:black !important;
					}
				
					.quick_contact_field:focus, .quick_contact_textarea:focus {
						background-color:'.$secondaryColor.' !important;
						color:black !important;
					}
				
					.pm-product-social-icons li a:hover {
						background-color:'.$secondaryColor.' !important;	
					}
				
					.pm_searchbar_container {
						background-color:'.$searchFieldColor.' !important	
					}
					
					.pm_searchfield {
						color:'.$searchFieldTextColor.' !important;		
					}
				
					.searchBtn:hover {
						background-color:'.$primaryColor.' !important;	
					}
				
					.remove {
						background-color:'.$secondaryColor.' !important	
					}
					
					.remove:hover {
						background-color:'.$primaryColor.' !important
					}
					
					#reply-title {
						color:'.$primaryColor.' !important !important			
					}
					.comment-reply-link, .wpcf7-submit, .coupon .button, .pm-cart-total-container .button, #place_order, .woocommerce input[type="submit"], .checkout-button {
						background-color:'.$secondaryColor.' !important	
					}
					.comment-reply-link:hover, #submit:hover, .wpcf7-submit:hover, .coupon .button:hover, .pm-cart-total-container .button:hover, #place_order:hover, .checkout-button:hover, .woocommerce input[type="submit"]:hover {
						background-color:'.$primaryColor.' !important
					}
					
					.pm-column-border {
						border-bottom:1px solid '.$primaryColor.' !important			
					}
					.pm_image_panel_header h4 {
						background-color:'.$primaryColor.' !important		
					}
					
					.pm-added-to-cart-icon {
						background-color:'.$primaryColor.' !important
					}
					.pm-sidebar h6 {
						border-bottom:1px solid '.$primaryColor.' !important	
					}
					.pm-event-info-ul-date {
						border-right: 1px solid '.$primaryColor.' !important;
					}
					.pm_paginated-posts p {
						color:'.$primaryColor.' !important	
					}
					.comments-title {
						color:'.$primaryColor.' !important	
					}	
					.pm_span_header h4 {
						background-color:'.$primaryColor.' !important;	
					}
					#back-top a:hover {
						color:'.$primaryColor.' !important
					}
					.sf-menu li:hover {
						border-bottom:1px solid '.$primaryColor.' !important
					}
					.sf-menu li.current-menu-item {
						border-bottom:1px solid '.$primaryColor.' !important
					}
					.pm-events-widget-date i {
						color:'.$primaryColor.';
					}
					.pm-sidebar .tweet_list li a {
						color:'.$primaryColor.' !important	
					}
					.recentcomments a {
						color:'.$primaryColor.' !important
					}
					.pm_events_container a {
						color:'.$primaryColor.' !important
					}
					.pm_events_container {
						border:1px solid '.$primaryColor.' !important
					}
					.pm_events_container .pm_events_img {
						border-left: 1px solid '.$primaryColor.' !important
						border-right: 1px solid '.$primaryColor.' !important
					}
					.pm_event_single_post_countdown i {
						color:'.$primaryColor.' !important	
					}
					.pm_organizer_single_details li {
						color:'.$primaryColor.' !important
					}
					ol.commentlist li div.reply {
						background-color:'.$primaryColor.' !important
					}
					#commentform input[type="submit"], .wpcf7-submit {
						background-color:'.$secondaryColor.' !important	
					}
					
					#commentform input[type="submit"]:hover, .wpcf7-submit:hover {
						background-color:'.$primaryColor.' !important	
					}
					
					#pm-accordionIcon {
						color:'.$primaryColor.' !important
					}
					.accordion-heading .accordion-toggle:hover {
						color:'.$primaryColor.' !important
					}
					#wp-calendar tbody td:hover { 
						background:'.$primaryColor.' !important
					}
					.widget_footer h6 {
						border-bottom: 1px solid '.$primaryColor.' !important;	
					}
					.flickr_badge_wrapper div a:hover {
						border:1px solid '.$primaryColor.' !important	
					}
					#pm-footer-nav li a:hover { 
						color:'.$primaryColor.' !important;
					}
					#pm-footer-nav li a { 
						border-right:1px solid '.$primaryColor.' !important
					}
					input[type="submit"], input[type="reset"], input[type="button"] {
						background-color:'.$primaryColor.' !important		
					}
					
					input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover {
						background-color:'.$secondaryColor.' !important		
					}
					
					.single_add_to_cart_button {
						background-color:'.$primaryColor.' !important	
					}
					.widget_shopping_cart_content .buttons .wc-forward {
						background-color:'.$primaryColor.' !important	
					}
					.single_add_to_cart_button, .pm-custom-button.remove {
						background-color:'.$primaryColor.' !important
					}
					.pm-shipping-calculator-btn {
						background-color:'.$primaryColor.' !important	
					}
					#pm-load-more {
						background-color: '.$primaryColor.' !important
					}
					.owl-item .pm-brand-item a:hover {
						background-color:'.$primaryColor.' !important
					}
					.btn.pm-owl-prev {
						color:'.$primaryColor.' !important;	
					}
					.btn.pm-owl-next {
						color:'.$primaryColor.' !important;	
					}
					.btn.pm-owl-play {
						color:'.$primaryColor.' !important;		
					}
				';
				
				
				
				echo '
					#pm_search_btn i {
						color:'.$secondaryColor.' !important;
					}
					
					.owl-item .pm-brand-item a {
						background-color:'.$secondaryColor.' !important;		
					}
					.pm_search_field_container #searchsubmit {
						background-color:'.$secondaryColor.' !important;		
					}
					
					.pm_search_field_container #searchsubmit:hover {
						background-color:'.$primaryColor.' !important;		
					}
					.pm-widget-star-rating li , .comment-form-rating .stars span a {
						color:'.$secondaryColor.' !important;		
					}
					.woocommerce-pagination .page-numbers li span.current {
						background-color:'.$secondaryColor.' !important;		
					}
					.pm-product-img-hover-container .onsale {
						background-color:'.$secondaryColor.' !important;		
					}
					.footer .tagcloud a:hover {
						background-color:'.$secondaryColor.' !important;	
					}
					blockquote {
						border-left: 5px solid '.$secondaryColor.' !important;
					}
					.pm-event-info-ul-date li strong {
						color:'.$secondaryColor.' !important;	
					}
					
					.pm-event-info-ul-date li p {
						color:'.$secondaryColor.' !important;
					}
					.header_donate_btn a {
						background-color:'.$secondaryColor.' !important;
					}
					.header_social_icons a:hover, .footer_social_icons a:hover {
						background-color:'.$secondaryColor.' !important;
					}
					.pm_slider_btn_large {
						background-color:'.$secondaryColor.' !important;
					}
					.pm_slider_btn a {
						background-color:'.$secondaryColor.' !important;
					}
					#back-top a {
						color:'.$secondaryColor.';
					}
					.pm-hover-item-details a {
						color:'.$secondaryColor.' !important;
					}
					.pm-hover-item-title-panel b {
						color:'.$secondaryColor.' !important;
					}
					.footer .recentcomments {
						color:'.$secondaryColor.' !important;
					}
					.tweet_list li a {
						color:'.$secondaryColor.' !important;
					}
					.newsletter_submit {
						background-color:'.$secondaryColor.' !important;	
					}
					.button-medium.searchBtn, .button-medium-theme.searchBtn {
						background-color:'.$secondaryColor.' !important;	
					}
					.pm-event-widget-btn {
						background-color:'.$secondaryColor.' !important;	
					}
					.pm-event-post-btn {
						background-color:'.$secondaryColor.' !important;		
					}
					.pm_events_container .pm_events_date p {
						color:'.$secondaryColor.' !important;	
					}
					
					.pagination li.current {
						background-color:'.$secondaryColor.' !important;
					}
					.pm-sidebar .tagcloud a:hover {
						background-color:'.$secondaryColor.' !important
					}
					
					
					.searchBtn {
						background-color:'.$secondaryColor.' !important;
					}
					
				';
				
				//Tooltip color
				$tooltipColor = get_option('tooltipColor', '#ACDB05');
				echo '
					#pm_marker_tooltip {
						background-color:'.$tooltipColor.' !important;
					}
				';
				
				//Column border image
				$columnBorderImage = get_theme_mod('columnBorderImage');
				if($columnBorderImage !== ''){
					echo '
						.pm_containerBorderBottom {
							background-image:url('.$columnBorderImage.');
						}
					';
				}
				
				//search icon color
				$searchIconColor = get_option('searchIconColor', '#BBBBBB');
				echo '
					.pm_search_icon .icon-search {
						color:'.$searchIconColor.' !important
					}
				';
				
				//navigation colors
				$navHoverColor = get_option('navHoverColor', '#00A4AD');
				$navBgColor = get_option('navBgColor', '#070707');
				
				$navHoverColors = pm_hope_hex2rgb($navHoverColor);
				echo '
					.sf-menu li:hover {
						background-color:rgba('.$navHoverColors[0].','.$navHoverColors[1].','.$navHoverColors[2].', .2)!important;
					}
					
					.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active ul li a:hover { 
						background-color:rgba('.$navHoverColors[0].','.$navHoverColors[1].','.$navHoverColors[2].', .8) !important;		
					}
					
					.sf-menu ul li:hover {
						background-color:rgba('.$navHoverColors[0].','.$navHoverColors[1].','.$navHoverColors[2].', .2)!important;
					}
					.sf-menu li.current-menu-item {
						background-color:rgba('.$navHoverColors[0].','.$navHoverColors[1].','.$navHoverColors[2].', .2)!important;
					}
				';
				
				$navBGColors = pm_hope_hex2rgb($navBgColor);
				echo '
					.pm_main_nav_container, .pm-quick-nav-container {
						background-color:rgba('.$navBGColors[0].','.$navBGColors[1].','.$navBGColors[2].', .8)!important;
					}
					.sf-menu ul {
						background-color:rgba('.$navBGColors[0].','.$navBGColors[1].','.$navBGColors[2].', .8)!important;	
					}
					.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active {
						background-color:rgba('.$navBGColors[0].','.$navBGColors[1].','.$navBGColors[2].', .8)!important;		
					}
				';
				
				//Header Options
				$pageTitleColor = get_option('pageTitleColor', '#2E2E2E');
				$pageTitleColors = pm_hope_hex2rgb($pageTitleColor);
				echo '
				.pm_page_title {
					background-color:rgba('.$pageTitleColors[0].','.$pageTitleColors[1].','.$pageTitleColors[2].', .6)!important;
				}
				';
				
				$pageQuoteColor = get_option('pageQuoteColor', '#2E2E2E');
				$pageQuoteColors = pm_hope_hex2rgb($pageQuoteColor);
				echo '
					.pm_header_quote {
						background-color:rgba('.$pageQuoteColors[0].','.$pageQuoteColors[1].','.$pageQuoteColors[2].', .6)!important;
					}
				';
				
				$breadcrumbBg = get_option('breadcrumbBg', '#2E2E2E');
				$breadcrumbColors = pm_hope_hex2rgb($breadcrumbBg);
				echo '
					.breadcrumbs, .woocommerce-breadcrumb {
						background-color:rgba('.$breadcrumbColors[0].','.$breadcrumbColors[1].','.$breadcrumbColors[2].', .6)!important;
					}
					
				';
				
				//feature slider
				$featureSliderCaptionBG = get_option('featureSliderCaptionBG', '#141312');
				$featureSliderDescriptionBG = get_option('featureSliderDescriptionBG', '#FBF9F3');
				
				$featureSliderCaptionBGColors = pm_hope_hex2rgb($featureSliderCaptionBG);
				echo '
					.flex-caption h1 {
						background-color:rgba('.$featureSliderCaptionBGColors[0].','.$featureSliderCaptionBGColors[1].','.$featureSliderCaptionBGColors[2].', .8)!important;
					}
				';
				
				$featureSliderDescriptionBGColors = pm_hope_hex2rgb($featureSliderDescriptionBG);
				echo '
					.flex-caption-decription {
						background-color:rgba('.$featureSliderDescriptionBGColors[0].','.$featureSliderDescriptionBGColors[1].','.$featureSliderDescriptionBGColors[2].', .8)!important;
					}'
				;
								
				$fatFooterBorderColor = get_option('fatFooterBorderColor', '#3C3C3C');
				$footerPadding = get_theme_mod('footerPadding', 20);
				echo '
					footer {
						border-top:8px solid '.$fatFooterBorderColor.';
						border-bottom:8px solid '.$fatFooterBorderColor.';
						padding:'.$footerPadding.'px 0;
					}'
				;
				
				$footerNavPadding = get_theme_mod('footerNavPadding', 20);
				echo '
					.footer_info {
						padding:'.$footerNavPadding.'px 0;
					}'
				;
				
				$footerInfoPadding = get_theme_mod('footerInfoPadding', 20);
				echo '
					.pm_footer_info {
						padding:'.$footerInfoPadding.'px 0;
					}'
				;
				
				$subHeaderBorderColor = get_option('subHeaderBorderColor', '#e8e8e8');
				echo '
					.pm_subheader_container {
						border-bottom:8px solid '.$subHeaderBorderColor.';
					}'
				;
				
				$filterMenuColor = get_option('filterMenuColor', '#8A8A8A');
				$filterMenuColors = pm_hope_hex2rgb($filterMenuColor);
				echo '
					.pm-dropmenu, .pm-dropmenu-active {
						background-color:rgba('.$filterMenuColors[0].', '.$filterMenuColors[1].', '.$filterMenuColors[2].', 0.9);
					}'
				;
				
				$filterMenuHoverColor = get_option('filterMenuHoverColor', '#7d7d7d');
				echo '
					.pm-dropmenu-active ul li a:hover {
						background-color:'.$filterMenuHoverColor.';
					}
					'
				;
				
				$socialIconsColor = get_option('socialIconsColor', '#00b7c2');
				$socialIconsColors = pm_hope_hex2rgb($socialIconsColor);
				
				echo '
					.header_social_icons a, .footer_social_icons a {
						background-color:rgba('.$socialIconsColors[0].', '.$socialIconsColors[1].', '.$socialIconsColors[2].', 0.9);
					}
					'
				;
				
				$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#1C1C1C');
				$footerBackgroundColor = get_option('footerBackgroundColor', '#007f84');
				$footerBackgroundImage = get_theme_mod('footerBackgroundImage');
				
				echo '
					footer {
						background-color:'.$fatFooterBackgroundColor.';
					}
					.pm_footer_info {
						background-color:'.$footerBackgroundColor.';
						'. ($footerBackgroundImage !== '' ? 'background-image:url('. $footerBackgroundImage .')' : '') .'
					}	
					'
				;
				
				$featuredColumnBorders = get_option('featuredColumnBorders', '#3d3d3d');
				
				echo '
					.vc-featured-borders {
						border-bottom: 6px solid '.$featuredColumnBorders.';
						border-top: 6px solid '.$featuredColumnBorders.';
					}
					'
				;
					
			 ?>
		</style>
		
		<?php
	}
	
}



if( !function_exists('pm_ln_customizer_styles_cache') ) {
	
	/* Cache customizer */
	function pm_ln_customizer_styles_cache() {
	
		global $wp_customize;

		// Check we're not on the Customizer.
		// If we're on the customizer then DO NOT cache the results.
		if ( ! isset( $wp_customize ) ) {
	
			// Get the theme_mod from the database
			$data = get_theme_mod( 'my_customizer_styles', false );
	
			// If the theme_mod does not exist, then create it.
			if ( $data == false ) {
				// We'll be adding our actual CSS using a filter
				$data = apply_filters( 'my_styles_filter', null );
				// Set the theme_mod.
				set_theme_mod( 'my_customizer_styles', $data );
			}
	
		// If we're not on the customizer, get all the styles using our filter
		} else {
	
			$data = apply_filters( 'my_styles_filter', null );
	
		}
	
		// Add the CSS inline.
		// Please note that you must first enqueue the actual 'my-styles' stylesheet.
		// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
		wp_add_inline_style( 'pm-ln-customizer-css', $data );
	
	}
	
}



if( !function_exists('pm_ln_reset_style_cache_on_customizer_save') ) {
	
	/* Reset the cache when saving the customizer */
	function pm_ln_reset_style_cache_on_customizer_save() {
		remove_theme_mod( 'my_customizer_styles' );
	}
	
}

