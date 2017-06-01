<?php

/*
Plugin Name: Premium Paypal Manager
Plugin URI: http://www.microthemes.ca/premium-wordpress-plugins/premium-paypal-manager/
Description: Sell products, subscriptions or accept donations with Premium Paypal Manager
Version: 1.4.3
Author: Micro Themes
Author URI: http://www.microthemes.ca
License: 
*/

//Define global constants
if ( ! defined( 'PM_PAYPAL_PLUGIN_URL' ) ) {
	define( 'PM_PAYPAL_PLUGIN_URL', plugin_dir_url(__FILE__) );	
}
if ( ! defined( 'PM_PAYPAL_PATH' ) ) {
	define( 'PM_PAYPAL_PATH', plugin_dir_path(__FILE__) );
}
if ( ! defined( 'PM_PAYPAL_ADMIN_URL' ) ) {
  define( 'PM_PAYPAL_ADMIN_URL', PM_PAYPAL_PLUGIN_URL . 'admin');
}
if ( ! defined( 'PM_PAYPAL_FRONT_URL' ) ) {
  define( 'PM_PAYPAL_FRONT_URL', PM_PAYPAL_PLUGIN_URL . 'front-end' );
}
if ( ! defined( 'PM_PAYPAL_DEBUG' ) ) {
  //true by default
  define( 'PM_PAYPAL_DEBUG', false );
}

// Implicitly prevent the plugin's installation from collision
if ( !class_exists( 'PremiumPaypalManager' ) ) {
	
	class PremiumPaypalManager {
		
		//Constructor
		public function __construct() {
			
			//ACTIONS
			
			//Language support
			add_action( 'init', array( $this, 'load_languages' ) ); //LOAD LANGUAGE FILES FOR LOCALIZATION SUPPORT
			
			add_action( 'init', array( $this, 'add_post_type' ) ); //REGISTER THE POST TYPE
			add_action( 'admin_init', array( $this, 'add_post_metaboxes' ) ); //ADD POST TYPE META OPTIONS
			add_action( 'init', array( $this, 'add_default_paypal_options' ) ); //ADD DEFAULT PAYPAL OPTIONS
			add_action('admin_menu', array( $this, 'pm_premium_paypal_manager_settings' ) );// ADD SETTINGS PAGE
			
			//Display PP id shortcodes
			add_filter('manage_premiumpaypalmanager_posts_columns', array( $this, 'posts_premiumpaypalmanager_columns_id' ), 5);
			add_action('manage_premiumpaypalmanager_posts_custom_column', array( $this, 'posts_premiumpaypalmanager_custom_id_columns' ), 10, 2);
			
			//Save data action
			add_action( 'save_post', array( $this, 'save_post_meta' ), 10, 2 );
						
			//add_action( 'add_meta_boxes', array( $this, 'add_pm_admin' ) ); //REMOVE DEFAULT WP PUBLISH BOX
			
			//Enqueue scripts for admin
			add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );//ADD STYLES & SCRIPTS FOR ADMIN
			add_action( 'edit_form_after_title', array( $this, 'publish_panel' ) );//DISPLAY PUBLISH MESSAGE
			
			//add_filter( 'screen_layout_columns', array( $this, 'set_columns' ) ); //SET ADMIN COLUMNS
		    //add_filter( 'get_user_option_screen_layout_floorplan', array( $this, 'force_user_column' ) ); //FORCE LAYOUT TO 1 COLUMN
			
			
			//Enqueue scripts for front-end
			add_action( 'wp_enqueue_scripts', array( $this, 'load_front_scripts' ) );
			
			//this is wordpress ajax that can work in front-end and admin areas
			//add_action('wp_ajax_nopriv_your_ajax', array( $this, 'shortcode_ajax_function' ) );//_your_ajax is the action required for jQuery Ajax setting
			//add_action('wp_ajax_your_ajax', array( $this, 'shortcode_ajax_function' ));//_your_ajax is the action required for jQuery Ajax setting
			
			//FILTERS
			
			//add widget text shortcode support
			add_filter( 'widget_text', 'do_shortcode' );
			add_filter( 'the_content', 'do_shortcode' );
			
			//add_filter( 'post_updated_messages', array( $this, 'plugin_messages' ) ); ***
			
			//SHORTOCODE
			add_filter( 'the_content', array( $this, 'shortcode_content' ) );
			
		}//end of constructor
		
		//Load language file(s) (.mo)
		public function load_languages() { 
			load_plugin_textdomain( 'pmLocalization', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
		} 
		
		//Display PP id shortcodes
		public function posts_premiumpaypalmanager_columns_id($defaults){
			$defaults['wps_post_id'] = __('Shortcode', 'pmLocalization');
			return $defaults;
		}
		public function posts_premiumpaypalmanager_custom_id_columns($column_name, $id){
			if($column_name === 'wps_post_id'){
				echo ' [premium-paypal-item id="'.$id.'"/]';
			}
		}
		
		//Screen Alerts
		public function plugin_messages( $messages ) {
			
		  global $post, $post_ID;
		  $messages['premium-paypal-manager'][6] = __( 'Item created', 'pmLocalization' ) . sprintf( ' <a href="%s">' . __( 'View Item', 'pmLocalization' ) . '</a>', esc_url( get_permalink($post_ID) ) );    
		  return $messages;
		  
		}//end of plugin_messages
		
		//Add sub menus
		public function pm_premium_paypal_manager_settings() {
	
			//create custom top-level menu
			//add_menu_page( 'Framework Documentation', 'Theme Documentation', 'manage_options', __FILE__, 'pm_documentation_main_page',	plugins_url( '/images/wp-icon.png', __FILE__ ) );
			
			//create sub-menu items
			add_submenu_page( 'edit.php?post_type=premiumpaypalmanager', __('Paypal Settings'),  __('Paypal Settings'), 'manage_options', 'paypal_settings',  array( $this, 'pm_paypal_settings_page' ) );
			
			//create an options page under Settings tab
			//add_options_page('My API Plugin', 'My API Plugin', 'manage_options', 'pm_myplugin', 'pm_myplugin_option_page');	
		}
		
		//Paypal Settings page
		public function pm_paypal_settings_page() {
						
			//Save data first
			if (isset($_POST['pm_paypal_settings_update'])) {
				
				update_option('pm_paypal_payment_email', (string)$_POST["pm_paypal_email"]);
				update_option('pm_paypal_payment_currency', (string)$_POST["pm_payment_currency"]);
				update_option('pm_payment_currency_symbol', (string)$_POST["pm_payment_currency_symbol"]);	
				update_option('pm_paypal_sales_tax_amount', (string)$_POST["pm_paypal_sales_tax_amount"]);								
				update_option('pm_paypal_product_return_url', (string)$_POST["pm_paypal_product_return_url"]);
				update_option('pm_paypal_donation_return_url', (string)$_POST["pm_paypal_donation_return_url"]);
				update_option('pm_paypal_product_identifier', (string)$_POST["pm_paypal_product_identifier"]);
				update_option('pm_paypal_product_item_width', $_POST["pm_paypal_product_item_width"]);
				update_option('pm_paypal_product_item_responsive', (string)$_POST["pm_paypal_product_item_responsive"]);
				
				//image options
				update_option('pm_paypal_purchase_btn_img', (string)$_POST["pm_paypal_purchase_btn_img"]);
				update_option('pm_paypal_donation_btn_img', (string)$_POST["pm_paypal_donation_btn_img"]);				
				update_option('pm_paypal_subscription_btn_img', (string)$_POST["pm_paypal_subscription_btn_img"]);
				
				//sandbox options
				update_option('pm_paypal_sandbox_mode', (string)$_POST["pm_paypal_sandbox_mode"]);
				update_option('pm_paypal_merchant_sandbox_email', (string)$_POST["pm_paypal_merchant_sandbox_email"]);
				
				echo '<div id="message" class="updated fade"><h4>Your settings have been saved.</h4></div>';
				
			}//end of save data
			
			$paypal_email = get_option('pm_paypal_payment_email');
			$payment_currency = get_option('pm_paypal_payment_currency');
			$pm_payment_currency_symbol = get_option('pm_payment_currency_symbol'); 
			$pm_paypal_sales_tax_amount = get_option('pm_paypal_sales_tax_amount'); 
			$pm_paypal_product_return_url = get_option('pm_paypal_product_return_url');
			$pm_paypal_donation_return_url = get_option('pm_paypal_donation_return_url');
			$pm_paypal_product_identifier = get_option('pm_paypal_product_identifier');
			$pm_paypal_product_item_width = get_option('pm_paypal_product_item_width');
			$pm_paypal_product_item_responsive = get_option('pm_paypal_product_item_responsive');
			
			//image options
			$pm_paypal_purchase_btn_img = get_option('pm_paypal_purchase_btn_img');
			$pm_paypal_donation_btn_img = get_option('pm_paypal_donation_btn_img');
			$pm_paypal_subscription_btn_img = get_option('pm_paypal_subscription_btn_img');
			
			//sandbox options
			$pm_paypal_sandbox_mode = get_option('pm_paypal_sandbox_mode');
			$pm_paypal_merchant_sandbox_email = get_option('pm_paypal_merchant_sandbox_email');
			
			?>
			
			<div class="wrap">
				<?php screen_icon(); ?>
				<h2><?php _e('Premium Paypal Manager', 'pmLocalization') ?> <?php _e('Settings', 'pmLocalization') ?></h2>
                
                <h4><?php _e('Configure the settings for Premium Paypal Manager below:', 'pmLocalization') ?></h4>
                
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                
                	<input type="hidden" name="pm_paypal_settings_update" id="pm_paypal_settings_update" value="true" />
                    
                    <label for="pm_paypal_email" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('This is the Paypal Email address where the payments will be sent to.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('PayPal email address:', 'pmLocalization') ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_email" name="pm_paypal_email" value="<?php echo $paypal_email; ?>">
                    
                    <label for="pm_payment_currency" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('This is the currency for your visitors to make Payments or Donations in.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('PayPal Currency:', 'pmLocalization') ?> </label>
                    
                    <select id="pm_payment_currency" name="pm_payment_currency" class="pm-paypal-textfield ">                    
                      <option value="<?php _e('AUD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'AUD' ); ?>><?php _e('Australian Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('CAD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'CAD' ); ?>><?php _e('Canadian Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('EUR', 'pmLocalization') ?>" <?php selected( $payment_currency, 'EUR' ); ?>><?php _e('Euro Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('GBP', 'pmLocalization') ?>" <?php selected( $payment_currency, 'GBP' ); ?>><?php _e('British Pound', 'pmLocalization') ?></option>
                      <option value="<?php _e('JPY', 'pmLocalization') ?>" <?php selected( $payment_currency, 'JPY' ); ?>><?php _e('Japanese Yen', 'pmLocalization') ?></option>
                      <option value="<?php _e('USD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'USD' ); ?>><?php _e('US Dollar', 'pmLocalization') ?></option>
              		  <option value="<?php _e('NZD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'NZD' ); ?>><?php _e('New Zealand Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('CHF', 'pmLocalization') ?>" <?php selected( $payment_currency, 'CHF' ); ?>><?php _e('Swiss Franc', 'pmLocalization') ?></option>
                      <option value="<?php _e('HKD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'HKD' ); ?>><?php _e('Hong Kong Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('SGD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'SGD' ); ?>><?php _e('Singapore Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('SEK', 'pmLocalization') ?>" <?php selected( $payment_currency, 'SEK' ); ?>><?php _e('Swedish Krona', 'pmLocalization') ?></option>
                      <option value="<?php _e('DKK', 'pmLocalization') ?>" <?php selected( $payment_currency, 'DKK' ); ?>><?php _e('Danish Krone', 'pmLocalization') ?></option>                      
                      <option value="<?php _e('PLN', 'pmLocalization') ?>" <?php selected( $payment_currency, 'PLN' ); ?>><?php _e('Polish Zloty', 'pmLocalization') ?></option>
                      <option value="<?php _e('NOK', 'pmLocalization') ?>" <?php selected( $payment_currency, 'NOK' ); ?>><?php _e('Norwegian Krone', 'pmLocalization') ?></option>
                      <option value="<?php _e('HUF', 'pmLocalization') ?>" <?php selected( $payment_currency, 'HUF' ); ?>><?php _e('Hungarian Forint', 'pmLocalization') ?></option>
                      <option value="<?php _e('CZK', 'pmLocalization') ?>" <?php selected( $payment_currency, 'CZK' ); ?>><?php _e('Czech Koruna', 'pmLocalization') ?></option>
                      <option value="<?php _e('ILS', 'pmLocalization') ?>" <?php selected( $payment_currency, 'ILS' ); ?>><?php _e('Israeli New Shekel', 'pmLocalization') ?></option>
                      <option value="<?php _e('MXN', 'pmLocalization') ?>" <?php selected( $payment_currency, 'MXN' ); ?>><?php _e('Mexican Peso', 'pmLocalization') ?></option>
                      <option value="<?php _e('BRL', 'pmLocalization') ?>" <?php selected( $payment_currency, 'BRL' ); ?>><?php _e('Brazilian Real', 'pmLocalization') ?></option>
                      <option value="<?php _e('MYR', 'pmLocalization') ?>" <?php selected( $payment_currency, 'MYR' ); ?>><?php _e('Malaysian Ringgit ', 'pmLocalization') ?></option>
                      <option value="<?php _e('PHP', 'pmLocalization') ?>" <?php selected( $payment_currency, 'PHP' ); ?>><?php _e('Philippine Peso', 'pmLocalization') ?></option>
                      <option value="<?php _e('TWD', 'pmLocalization') ?>" <?php selected( $payment_currency, 'TWD' ); ?>><?php _e('New Taiwan Dollar', 'pmLocalization') ?></option>
                      <option value="<?php _e('THB', 'pmLocalization') ?>" <?php selected( $payment_currency, 'THB' ); ?>><?php _e('Thai Baht', 'pmLocalization') ?></option>
                      <!--<option value="<?php //_e('TRY', 'pmLocalization') ?>" <?php //selected( $payment_currency, 'TRY' ); ?>><?php //_e('Turkish Lira', 'pmLocalization') ?></option>-->
                      <option value="<?php _e('RUB', 'pmLocalization') ?>" <?php selected( $payment_currency, 'RUB' ); ?>><?php _e('Russian Ruble', 'pmLocalization') ?></option>
                    </select>
                    
                    <!--<label for="pm_payment_currency_symbol" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php //_e('Select the currency symbol that corresponds to the set currency.', 'pmLocalization') ?>"><img src="<?php //echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php //_e('Currency symbol:', 'pmLocalization') ?> </label>
                    
                    <select id="pm_payment_currency_symbol" name="pm_payment_currency_symbol" class="pm-paypal-textfield ">
                    
                      <option value="AUD" <?php //selected( $pm_payment_currency_symbol, 'AUD' ); ?>><?php //_e('Australia - A $', 'pmLocalization') ?></option>
                      <option value="CAD" <?php //selected( $pm_payment_currency_symbol, 'CAD' ); ?>><?php //_e('Canada - C $', 'pmLocalization') ?></option>
                      <option value="EUR" <?php //selected( $pm_payment_currency_symbol, 'EUR' ); ?>><?php //_e('Euro - &euro;', 'pmLocalization') ?></option>
                      <option value="GBP" <?php //selected( $pm_payment_currency_symbol, 'GBP' ); ?>><?php //_e('Pound Sterling - &pound;', 'pmLocalization') ?></option>
                      <option value="JPY" <?php //selected( $pm_payment_currency_symbol, 'JPY' ); ?>><?php //_e('Japanese Yen - &yen;', 'pmLocalization') ?></option>
                      <option value="USD" <?php //selected( $pm_payment_currency_symbol, 'USD' ); ?>><?php //_e('USA - $', 'pmLocalization') ?></option>
                      <option value="NZD" <?php //selected( $pm_payment_currency_symbol, 'NZD' ); ?>><?php //_e('New Zealand - $', 'pmLocalization') ?></option>
                      <option value="CHF" <?php //selected( $pm_payment_currency_symbol, 'NZD' ); ?>><?php //_e('Swiss Franc - CHF', 'pmLocalization') ?></option>              		  
                      
                    </select>-->
                                        
                    <label for="pm_paypal_sales_tax_amount" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter your sales tax amount. Ex. 0.13 for 13% sales tax.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Sales tax amount:', 'pmLocalization'); ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_sales_tax_amount" name="pm_paypal_sales_tax_amount" value="<?php echo $pm_paypal_sales_tax_amount; ?>">
                                        
                    <label for="pm_paypal_product_return_url" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter a return URL for product purchases (could be a Thank You page). PayPal will redirect visitors to this page after completing a payment.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('PayPal product return URL:', 'pmLocalization'); ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_product_return_url" name="pm_paypal_product_return_url" value="<?php echo $pm_paypal_product_return_url; ?>">
                    
                    <label for="pm_paypal_donation_return_url" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter a return URL for donations (could be a Thank You page). PayPal will redirect visitors to this page after completing a donation.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('PayPal donation return URL:', 'pmLocalization'); ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_donation_return_url" name="pm_paypal_donation_return_url" value="<?php echo $pm_paypal_donation_return_url; ?>">
                    
                    <label for="pm_paypal_product_identifier" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter a product identifier. (Ex. Product Code or SKU #). <b>This applies to products only.</b>', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Product identifier:', 'pmLocalization'); ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_product_identifier" name="pm_paypal_product_identifier" value="<?php echo $pm_paypal_product_identifier; ?>">
                    
                    <label for="pm_paypal_product_item_width" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter a width for the PayPal item container. <b>This applies to both products and donations and only if responsive is set to NO.</b>', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('PayPal item width:', 'pmLocalization'); ?> </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_product_item_width" name="pm_paypal_product_item_width" value="<?php echo $pm_paypal_product_item_width; ?>">
                    
                    <label for="pm_paypal_product_item_responsive" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Set this to YES if you are running this plug-in in a responsive theme. Setting this to YES will set the item container to a width of 100%. <b>This applies to both products and donations.</b>', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Make item container responsive?', 'pmLocalization'); ?>: </label>
                    
                    <select id="pm_paypal_product_item_responsive" name="pm_paypal_product_item_responsive" class="pm-paypal-textfield">
                      <option value="<?php _e('No', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_item_responsive, 'No' ); ?>><?php _e('No', 'pmLocalization') ?></option>
              		  <option value="<?php _e('Yes', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_item_responsive, 'Yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
                    </select>
                    
                    <!-- SANDBOX OPTIONS -->
                    <div style="clear:both; margin:10px 0; float:left;">
                    	<p><strong><?php _e('PayPal Sandbox Options:', 'pmLocalization') ?></strong></p>
                        <p><?php _e('Configure these settings for testing item purchases and/or donations through your Sandbox PayPal account.', 'pmLocalization') ?></p>
                    </div>
                    
                    <label for="pm_paypal_sandbox_mode" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Set this to YES if you want to send payments to your PayPal Merchant Sandbox account.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div>Enable Sandbox mode? </label>
                    <select id="pm_paypal_sandbox_mode" name="pm_paypal_sandbox_mode" class="pm-paypal-textfield ">
                      <option value="<?php _e('No', 'pmLocalization') ?>" <?php selected( $pm_paypal_sandbox_mode, 'No' ); ?>><?php _e('No', 'pmLocalization') ?></option>
              		  <option value="<?php _e('Yes', 'pmLocalization') ?>" <?php selected( $pm_paypal_sandbox_mode, 'Yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
                    </select>
                    
                    <label for="pm_paypal_merchant_sandbox_email" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('Enter the email address that corresponds to your PayPal Merchant sandbox account. All transactions will be sent to this dummy account.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div>PayPal Buyer Merchant email: </label>
                    <input type="text" class="pm-paypal-textfield" id="pm_paypal_merchant_sandbox_email" name="pm_paypal_merchant_sandbox_email" value="<?php echo $pm_paypal_merchant_sandbox_email; ?>">
                    <!-- /SANDBOX OPTIONS -->
                    
                    
                    
                    <!-- IMAGE OPTIONS -->
                    <div style="clear:both; margin:10px 0; float:left;">
                    	<p><strong><?php _e('Image Options:', 'pmLocalization') ?></strong></p>
                        <p><?php _e('Upload your own custom PayPal purchase buttons.', 'pmLocalization') ?></p>
                        
                        <!-- PRODUCTS -->
                        <div style="clear:both; margin:10px 0; float:left;">
                            <label for="pm_paypal_purchase_btn_img" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('This image applies to products.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Purchase Button image', 'pmLocalization'); ?> </label>
                            
                            <input type="text" style="width:100%;" value="<?php echo $pm_paypal_purchase_btn_img; ?>" name="pm_paypal_purchase_btn_img" id="img-uploader-field" class="pm-purchase-image-upload-field" />
                            <input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <div class="pm-paypal-purchase-btn-img-preview"></div>
                            
                            <?php if($pm_paypal_purchase_btn_img) : ?>
                                <input id="remove_paypal_purchase_btn_img_button" type="button" class="button button-primary button-large delete" value="<?php _e('Remove Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <?php endif; ?> 
                        </div>
                        
                        
                        <!-- DONATIONS -->
                        <div style="clear:both; margin:10px 0; float:left;">
                            <label for="pm_paypal_donation_btn_img" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('This image applies to donations.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Donation Button image', 'pmLocalization'); ?> </label>
                            
                            <input type="text" style="width:100%;" value="<?php echo $pm_paypal_donation_btn_img; ?>" name="pm_paypal_donation_btn_img" id="img-uploader-field-donation" class="pm-donation-image-upload-field" />
                            <input id="upload_image_button_donation" type="button" value="<?php _e('Media Library Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <div class="pm-paypal-donation-btn-img-preview"></div>
                            
                            <?php if($pm_paypal_donation_btn_img) : ?>
                                <input id="remove_paypal_donation_btn_img_button" type="button" class="button button-primary button-large delete" value="<?php _e('Remove Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <?php endif; ?> 
                        </div>
                        
                        
                        <!-- SUBSCRIPTIONS -->
                        <div style="clear:both; margin:10px 0; float:left;">
                            <label for="pm_paypal_subscription_btn_img" class="pm-paypal-label"><div class="pm-paypal-help-icon" title="<?php _e('This image applies to subscriptions.', 'pmLocalization') ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e('Subscription Button image', 'pmLocalization'); ?> </label>
                            
                            <input type="text" style="width:100%;" value="<?php echo $pm_paypal_subscription_btn_img; ?>" name="pm_paypal_subscription_btn_img" id="img-uploader-field-subscription" class="pm-subscription-image-upload-field" />
                            <input id="upload_image_button_subscription" type="button" value="<?php _e('Media Library Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <div class="pm-paypal-subscription-btn-img-preview"></div>
                            
                            <?php if($pm_paypal_subscription_btn_img) : ?>
                                <input id="remove_paypal_subscription_btn_img_button" type="button" class="button button-primary button-large delete" value="<?php _e('Remove Image', 'pmLocalization'); ?>" class="button-secondary" />
                            <?php endif; ?> 
                        </div>
                        
                    </div>
                    <!-- /IMAGE OPTIONS -->
                    
                    
                    <div class="pm-payel-submit">
                        <input type="submit" name="pm_settings_update" class="button button-primary button-large" value="<?php _e('Update Settings', 'pmLocalization'); ?> &raquo;" />
                    </div>
                    
                    
                
                </form>
				
				
			</div>
			
			<?php
			
		}
		
		//Default PayPal options
		public function add_default_paypal_options(){
		
			add_option('pm_paypal_payment_email', 'youname@youremail.com');
			add_option('pm_paypal_payment_currency', 'USD');
			add_option('pm_paypal_product_item_width', 300);
			add_option('pm_paypal_product_item_responsive', 'No');
			
		}

		//Load admin scripts
		public function load_admin_scripts( $hook ) {
			
			$screen = get_current_screen();
      		$dot = ( PM_PAYPAL_DEBUG ) ? '.' : '.min.';
						
			//print_r($screen);
						
			if ( is_admin() && $screen->post_type === "premiumpaypalmanager" ) { 
						
				//jQuery ui scripts
				wp_enqueue_script( 'jquery' );
				//wp_enqueue_script( 'jquery-ui-core' );
				//wp_enqueue_script( 'jquery-ui-mouse' );
				//wp_enqueue_script( 'jquery-ui-slider' );
				//wp_enqueue_script( 'jquery-ui-draggable' );
				//wp_enqueue_script( 'jquery-ui-dialog' );
				//wp_enqueue_script( 'jquery-ui-sortable' );
			
				//load styles and scripts
				wp_enqueue_style( 'premium-paypal-styles', PM_PAYPAL_ADMIN_URL . '/css/premium-paypal-manager' . $dot . 'css' );
				
				//load the WP 3.5 Media uploader scripts and environment
				wp_enqueue_script('thickbox');  
        		wp_enqueue_style('thickbox');
				wp_enqueue_media( 'media-upload' );				
				
				//Load admin js file(s)
				wp_enqueue_script( 'premium-paypal-wordpress-admin', PM_PAYPAL_ADMIN_URL . '/js/wp-admin' . $dot . 'js' );
				wp_enqueue_script( 'premium-paypal-image-uploader', PM_PAYPAL_ADMIN_URL . '/js/pm-image-uploader' . $dot . 'js' );
				wp_enqueue_script( 'premium-paypal-tooltip', PM_PAYPAL_ADMIN_URL . '/js/jquery.tooltip.class' . $dot . 'js' );
				wp_enqueue_script( 'premium-paypal-adming-settings', PM_PAYPAL_ADMIN_URL . '/js/premium-paypal-manager' . $dot . 'js' );
				
				//wp_enqueue_style( 'color-picker-styles', PM_PAYPAL_ADMIN_URL . '/js/colorpicker/css/colorpicker' . $dot . 'css' );
				//wp_enqueue_script( 'color-picker', PM_PAYPAL_ADMIN_URL . '/js/colorpicker/js/colorpicker' . $dot . 'js' );
				
				//wp_enqueue_style( 'spectrum-styles', PM_PAYPAL_ADMIN_URL . '/js/spectrum/spectrum' . $dot . 'css' );
				//wp_enqueue_script( 'spectrum-picker', PM_PAYPAL_ADMIN_URL . '/js/spectrum/spectrum' . $dot . 'js' );
			
			}//end of if
			
		}//end of load_scripts
			
		//Load front-end scripts
		public function load_front_scripts() {
			
			$dot = ( PM_PAYPAL_DEBUG ) ? '.' : '.min.';
			
			//load styles and scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_style( 'premium-paypal-manager-styles', PM_PAYPAL_FRONT_URL . '/css/premium-paypal-manager-front' . $dot . 'css' );
			wp_enqueue_script( 'premium-paypal-manager-js', PM_PAYPAL_FRONT_URL . '/js/premium-paypal-manager-front' . $dot . 'js' );
			
		}//end of load_front_scripts
		
		//Shortcode
		public function shortcode_content( $content ) {
		  global $post;
		  if ( $post->post_type === 'premiumpaypalmanager' )
			return sprintf( '[premium-paypal-item id="%s"/]', $post->ID );
		  return $content;
		}
		
		//DISPLAY PUBLISH MESSAGE
		public function publish_panel() {
		  global $post;
		  $screen = get_current_screen();
		  if ( $screen->post_type !== 'premiumpaypalmanager' ) 
			return;
		  
		  /*if (!get_post_meta( $post->ID, 'premium-paypal-settings', true ))
			return;*/
	
		  printf( '<div class="pm-paypal-publish"><p>' . __( 'You can use the following shortcode for displaying the newly created PayPal item', 'pmLocalization' ) . ':<p>' );
		  printf( '<div>[premium-paypal-item id="%s"/]</div>', $post->ID );
		  printf( '<p>' . __( 'Copy and paste it where you wish the item will display', 'pmLocalization' ) . ', ');
		  printf( __( 'e.g. Post, Page editor, Text widget or even directly in your PHP code by using ', 'pmLocalization' ) );
		  printf( '<a href="http://codex.wordpress.org/Function_Reference/do_shortcode" target="_blank">do_shortcode</a> ' . __( 'function', 'pmLocalization' ) . '.</p></div>');  
		}
		
		//Remove default WP Publish box
		public function add_pm_admin() {
			remove_meta_box( 'submitdiv', 'premium-paypal-manager', 'side' );
		}
		
		//Set post admin screen to full column width
		public function set_columns( $columns ) {
		  $columns['premium-paypal-manager'] = 1;
		  return $columns;
		}
	
		public function force_user_column( $columns ) {
		  return 1;
		}
				
		//REGISTER THE POST TYPE
		public function add_post_type() {
					
			$labels = array(
				'name' => 'Premium Paypal Manager',
				'singular_name' => 'Premium Paypal Manager',
				'add_new' => __( 'Add New Paypal Item', 'pmLocalization' ),
				'add_new_item' => __( 'Add New Paypal Item', 'pmLocalization' ),
				'edit_item' => __( 'Edit Paypal Item', 'pmLocalization' ),
				'new_item' => __( 'New Paypal Item', 'pmLocalization' ),
				'all_items' => __( 'All Paypal Items', 'pmLocalization' ),
				'view_item' => __( 'View Paypal Item', 'pmLocalization' ),
				'search_items' => __( 'Search Paypal Items', 'pmLocalization' ),
				'not_found' =>  __( 'No Paypal Items found', 'pmLocalization' ),
				'not_found_in_trash' => __( 'No Paypal Item found in Trash', 'pmLocalization' ), 
				'parent_item_colon' => '',
				'menu_name' => 'Premium Paypal Manager'
			  );
		
			  $args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'show_in_menu' => true, 
				//'show_in_admin_bar' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'pm-premium-paypal' ),
				'capability_type' => 'post',
				'has_archive' => true, 
				'hierarchical' => false,
				'menu_position' => 5,
				'taxonomies' => array('pmpaypaltags','pmpaypalcategory'),
				'supports' => array( 'title', 'editor', 'thumbnail'),
				'menu_icon' => PM_PAYPAL_ADMIN_URL . '/img/icon.png'
			  ); 
		
			  register_post_type( 'premiumpaypalmanager', $args );
			  
			  //Add category support
			  register_taxonomy('pmpaypalcategory', 'premiumpaypalmanager', array(
				// Hierarchical taxonomy (like categories)
				'hierarchical' => true,
				'show_admin_column' => true,
				// This array of options controls the labels displayed in the WordPress Admin UI
				'labels' => array(
					'name' => _x( 'Item Category', 'taxonomy general name' ),
					'singular_name' => _x( 'Item Categories', 'taxonomy singular name' ),
					'search_items' =>  __( 'Search Item Categories' ),
					'all_items' => __( 'Popular Item Categories' ),
					'parent_item' => __( 'Parent Item Categories' ),
					'parent_item_colon' => __( 'Parent Item Category:' ),
					'edit_item' => __( 'Edit Item Category' ),
					'update_item' => __( 'Update Item Category' ),
					'add_new_item' => __( 'Add New Item Category' ),
					'new_item_name' => __( 'New Item Category Name' ),
					'menu_name' => __( 'Item Category' ),
				),
				// Control the slugs used for this taxonomy
				'rewrite' => array(
					'slug' => 'paypal_item_category', // This controls the base slug that will display before each term
					'with_front' => false, // Don't display the category base before "/locations/"
					'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
				),
			));
			
			//Add tag support
			register_taxonomy('pmpaypaltags', 'premiumpaypalmanager', array(
				// Hierarchical taxonomy (like categories)
				'hierarchical' => false,
				'show_admin_column' => true,
				// This array of options controls the labels displayed in the WordPress Admin UI
				'labels' => array(
					'name' => _x( 'Item Tag', 'taxonomy general name' ),
					'singular_name' => _x( 'Item Tags', 'taxonomy singular name' ),
					'search_items' =>  __( 'Search Item Tags' ),
					'all_items' => __( 'Popular Item Tags' ),
					'parent_item' => __( 'Parent Item Tags' ),
					'parent_item_colon' => __( 'Parent Item Tag:' ),
					'edit_item' => __( 'Edit Item Tag' ),
					'update_item' => __( 'Update Item Tag' ),
					'add_new_item' => __( 'Add New Item Tag' ),
					'new_item_name' => __( 'New Item Tag Name' ),
					'menu_name' => __( 'Item Tags' ),
				),
				// Control the slugs used for this taxonomy
				'rewrite' => array(
					'slug' => 'paypal_item_tags', // This controls the base slug that will display before each term
					'with_front' => false, // Don't display the category base before "/locations/"
					'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
				),
			));
			  
		  
		}//end of post type declaration
		
		//METABOXES for CPT
		public function add_post_metaboxes() {
			
			//Payment Type
			add_meta_box( 'pm_paypal_payment_type_meta', 'Payment Type', array( $this, 'pm_paypal_payment_type_function' ) , 'premiumpaypalmanager', 'normal', 'high' );
			
			//Payment Options
			add_meta_box( 'pm_paypal_payment_option_meta', 'Payment Options', array( $this, 'pm_paypal_payment_options_function' ) , 'premiumpaypalmanager', 'normal', 'high' );
			
			//Donation Options
			add_meta_box( 'pm_paypal_donation_option_meta', 'Donation Options', array( $this, 'pm_paypal_donation_options_function' ) , 'premiumpaypalmanager', 'normal', 'high' );
			
			//Product Options
			add_meta_box( 'pm_paypal_product_option_meta', 'Product Options', array( $this, 'pm_paypal_product_options_function' ) , 'premiumpaypalmanager', 'normal', 'high' );
			
			
		}
		
		//PAYMENT TYPE
		public function pm_paypal_payment_type_function($post) {
		
			//We need this to save our data
			wp_nonce_field( basename( __FILE__ ), 'pm_paypal_manager_nonce' );
			
			//retrieve the metadata value if it exists
			$pm_paypal_payment_type = get_post_meta( $post->ID, 'pm_paypal_payment_type', true );
			
			?>
            
            <select id="pm_paypal_payment_type" name="pm_paypal_payment_type" class="pm-paypal-textfield ">  
              <option value="<?php _e('Product', 'pmLocalization') ?>" <?php selected( $pm_paypal_payment_type, 'Product' ); ?>><?php _e('Product', 'pmLocalization') ?></option>
              <option value="<?php _e('Donation', 'pmLocalization') ?>" <?php selected( $pm_paypal_payment_type, 'Donation' ); ?>><?php _e('Donation', 'pmLocalization') ?></option>
            </select>
            
            <?php
			
			
		}
		
		//PAYMENT OPTION META BOX
		public function pm_paypal_payment_options_function($post) {
			
			//We need this to save our data
			wp_nonce_field( basename( __FILE__ ), 'pm_paypal_manager_nonce' );
			
			//retrieve the metadata value if it exists
			$pm_paypal_payment_option1 = get_post_meta( $post->ID, 'pm_paypal_payment_option1', true );
			$pm_paypal_payment_option2 = get_post_meta( $post->ID, 'pm_paypal_payment_option2', true );
			$pm_paypal_payment_option3 = get_post_meta( $post->ID, 'pm_paypal_payment_option3', true );
			$pm_paypal_payment_option4 = get_post_meta( $post->ID, 'pm_paypal_payment_option4', true );
			$pm_paypal_payment_option5 = get_post_meta( $post->ID, 'pm_paypal_payment_option5', true );
			$pm_paypal_payment_option6 = get_post_meta( $post->ID, 'pm_paypal_payment_option6', true );
			
			$pm_paypal_payment_option1_price = get_post_meta( $post->ID, 'pm_paypal_payment_option1_price', true );
			$pm_paypal_payment_option2_price = get_post_meta( $post->ID, 'pm_paypal_payment_option2_price', true );
			$pm_paypal_payment_option3_price = get_post_meta( $post->ID, 'pm_paypal_payment_option3_price', true );
			$pm_paypal_payment_option4_price = get_post_meta( $post->ID, 'pm_paypal_payment_option4_price', true );
			$pm_paypal_payment_option5_price = get_post_meta( $post->ID, 'pm_paypal_payment_option5_price', true );
			$pm_paypal_payment_option6_price = get_post_meta( $post->ID, 'pm_paypal_payment_option6_price', true );
			
			$pm_paypal_monthly_payment_option = get_post_meta( $post->ID, 'pm_paypal_monthly_payment_option', true );
			$pm_paypal_monthly_payment_text = get_post_meta( $post->ID, 'pm_paypal_monthly_payment_text', true );
			$pm_paypal_monthly_payment_price = get_post_meta( $post->ID, 'pm_paypal_monthly_payment_price', true );
			
			$pm_paypal_display_recurring_options = get_post_meta( $post->ID, 'pm_paypal_display_recurring_options', true );
			$pm_paypal_default_recurring_option = get_post_meta( $post->ID, 'pm_paypal_default_recurring_option', true );
			
			?>
            
            <label for="pm_paypal_payment_option1" class="pm-paypal-meta-label"><?php _e('Payment Option 1', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option1" type="text" size="75" name="pm_paypal_payment_option1" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option1; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option1_price" type="text" size="75" name="pm_paypal_payment_option1_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option1_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_payment_option2" class="pm-paypal-meta-label"><?php _e('Payment Option 2', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option2" type="text" size="75" name="pm_paypal_payment_option2" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option2; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option2_price" type="text" size="75" name="pm_paypal_payment_option2_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option2_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_payment_option3" class="pm-paypal-meta-label"><?php _e('Payment Option 3', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option3" type="text" size="75" name="pm_paypal_payment_option3" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option3; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option3_price" type="text" size="75" name="pm_paypal_payment_option3_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option3_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_payment_option4" class="pm-paypal-meta-label"><?php _e('Payment Option 4', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option4" type="text" size="75" name="pm_paypal_payment_option4" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option4; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option4_price" type="text" size="75" name="pm_paypal_payment_option4_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option4_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_payment_option5" class="pm-paypal-meta-label"><?php _e('Payment Option 5', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option5" type="text" size="75" name="pm_paypal_payment_option5" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option5; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option5_price" type="text" size="75" name="pm_paypal_payment_option5_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option5_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_payment_option6" class="pm-paypal-meta-label"><?php _e('Payment Option 6', 'pmLocalization') ?></label>
            <input id="pm_paypal_payment_option6" type="text" size="75" name="pm_paypal_payment_option6" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_payment_option6; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_payment_option6_price" type="text" size="75" name="pm_paypal_payment_option6_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_payment_option6_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />
            
            <label for="pm_paypal_monthly_payment_option" class="pm-paypal-meta-label">
            <div class="pm-paypal-help-icon" title="<?php _e( 'Add a recurring payment option if required. This can be useful for subscriptions or recurring donations.', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e( 'Recurring payment?', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_monthly_payment_option" name="pm_paypal_monthly_payment_option" class="pm-paypal-textfield ">   
                <option value="no" <?php selected( $pm_paypal_monthly_payment_option, 'no' ); ?>><?php _e('No', 'pmLocalization') ?></option>
                <option value="yes" <?php selected( $pm_paypal_monthly_payment_option, 'yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
            </select>
            
            <label for="pm_paypal_display_recurring_options" class="pm-paypal-meta-label">
            <div class="pm-paypal-help-icon" title="<?php _e( 'Setting this to <b>YES</b> will display a recurring option list allowing the customer to choose between weekly, monthly or yearly recurring payments. <b>NOTE:</b> This option only works with Donations.', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e( 'Display Recurring options list?', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_display_recurring_options" name="pm_paypal_display_recurring_options" class="pm-paypal-textfield ">   
                <option value="no" <?php selected( $pm_paypal_display_recurring_options, 'no' ); ?>><?php _e('No', 'pmLocalization') ?></option>
                <option value="yes" <?php selected( $pm_paypal_display_recurring_options, 'yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
            </select>
            
            <label for="pm_paypal_default_recurring_option" class="pm-paypal-meta-label">
            <div class="pm-paypal-help-icon" title="<?php _e( 'Set the default recurring payment method. This option will be used if the <b>Display Recurring options list?</b> option is set to <b>NO</b>. ', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e( 'Default Recurring Option', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_default_recurring_option" name="pm_paypal_default_recurring_option" class="pm-paypal-textfield ">   
                <option value="W" <?php selected( $pm_paypal_default_recurring_option, 'W' ); ?>><?php _e('Weekly', 'pmLocalization') ?></option>
                <option value="M" <?php selected( $pm_paypal_default_recurring_option, 'M' ); ?>><?php _e('Monthly', 'pmLocalization') ?></option>
                <option value="Y" <?php selected( $pm_paypal_default_recurring_option, 'Y' ); ?>><?php _e('Yearly', 'pmLocalization') ?></option>
            </select>
            
            <label for="pm_paypal_monthly_payment_price" class="pm-paypal-meta-label"><?php _e('Recurring Payment Price', 'pmLocalization') ?>
            	<div class="pm-paypal-help-icon" title="<?php _e( 'Use this field to enter a fixed recurring price.', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div>
            </label>
            <input id="pm_paypal_monthly_payment_text" type="text" size="75" name="pm_paypal_monthly_payment_text" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_monthly_payment_text; ?>" placeholder="<?php _e('enter description if required', 'pmLocalization') ?>" />
            <input id="pm_paypal_monthly_payment_price" type="text" size="75" name="pm_paypal_monthly_payment_price" class="pm-paypal-meta-textfield-price" value="<?php echo $pm_paypal_monthly_payment_price; ?>" placeholder="<?php _e('price', 'pmLocalization') ?>" />

            
            <?php
			
		}
		
		//DONATION OPTION META BOX
		public function pm_paypal_donation_options_function($post) {
			
			//We need this to save our data
			wp_nonce_field( basename( __FILE__ ), 'pm_paypal_manager_nonce' );
			
			//retrieve the metadata value if it exists
			$pm_paypal_donation_amount = get_post_meta( $post->ID, 'pm_paypal_donation_amount', true );
			//$pm_paypal_donation_reference = get_post_meta( $post->ID, 'pm_paypal_donation_reference', true );
			$pm_paypal_donation_placeholder = get_post_meta( $post->ID, 'pm_paypal_donation_placeholder', true );
			
			?>
            
            <label for="pm_paypal_donation_amount" class="pm-paypal-meta-label">
            <div class="pm-paypal-help-icon" title="<?php _e( 'Set this to <b>YES</b> if you want to show other amount text box to your visitors so they can enter a custom donation amount.', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e( 'Show Other Amount:', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_donation_amount" name="pm_paypal_donation_amount" class="pm-paypal-textfield ">   
                <option value="<?php _e('No', 'pmLocalization') ?>" <?php selected( $pm_paypal_donation_amount, 'No' ); ?>><?php _e('No', 'pmLocalization') ?></option>
                <option value="<?php _e('Yes', 'pmLocalization') ?>" <?php selected( $pm_paypal_donation_amount, 'Yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
            </select>
            
            <!--<label for="pm_paypal_donation_reference" class="pm-paypal-meta-label"><div class="pm-paypal-help-icon" title="<?php //_e( 'Set this to <b>YES</b> if you want your visitors to be able to enter a reference text like email or web address.', 'pmLocalization' ); ?>"><img src="<?php //echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php //_e( 'Show Reference Text Box:', 'pmLocalization' ); ?>
            </label>            
            <select id="pm_paypal_donation_reference" name="pm_paypal_donation_reference" class="pm-paypal-textfield ">    
              <?php //_e('<option value="No"') ?><?php //selected( $pm_paypal_donation_reference, 'No' ); ?><?php //_e('>No</option>') ?>          
              <?php //_e('<option value="Yes"') ?><?php //selected( $pm_paypal_donation_reference, 'Yes' ); ?><?php //_e('>Yes</option>') ?>
            </select>-->
            
			<label for="pm_paypal_donation_placeholder" class="pm-paypal-meta-label"><div class="pm-paypal-help-icon" title="<?php _e( 'Enter a placeholder for the amount textfield. (ex. Enter a donation amount)', 'pmLocalization' ); ?>"><img src="<?php echo PM_PAYPAL_PLUGIN_URL ?>admin/img/help-icon.png" /></div><?php _e( 'Amount placeholder: ', 'pmLocalization' ); ?>
            </label>
            <input id="pm_paypal_donation_placeholder" type="text" size="75" name="pm_paypal_donation_placeholder" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_donation_placeholder; ?>" />
            
            <?php
			
		}
		
		//PRODUCT OPTIONS META BOX
		public function pm_paypal_product_options_function($post) {
			
			//We need this to save our data
			wp_nonce_field( basename( __FILE__ ), 'pm_paypal_manager_nonce' );
			
			//retrieve the metadata value if it exists
			$pm_paypal_product_display_availablity = get_post_meta( $post->ID, 'pm_paypal_product_display_availablity', true );
			$pm_paypal_product_availablity = get_post_meta( $post->ID, 'pm_paypal_product_availablity', true );
			$pm_paypal_product_code = get_post_meta( $post->ID, 'pm_paypal_product_code', true );
			
			?>
            
            <label for="pm_paypal_product_display_availablity" class="pm-paypal-meta-label">
            <?php _e( 'Display Availability?', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_product_display_availablity" name="pm_paypal_product_display_availablity" class="pm-paypal-textfield ">   
            	<option value="yes" <?php selected( $pm_paypal_product_display_availablity, 'yes' ); ?>><?php _e('Yes', 'pmLocalization') ?></option>
                <option value="no" <?php selected( $pm_paypal_product_display_availablity, 'no' ); ?>><?php _e('No', 'pmLocalization') ?></option>
            </select>
            
            <label for="pm_paypal_product_availablity" class="pm-paypal-meta-label">
            <?php _e( 'Availability status:', 'pmLocalization' ); ?>
            </label>
            <select id="pm_paypal_product_availablity" name="pm_paypal_product_availablity" class="pm-paypal-textfield ">   
            	<option value="<?php _e('In Stock', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_availablity, 'In Stock' ); ?>><?php _e('In Stock', 'pmLocalization') ?></option>
                <option value="<?php _e('Out of Stock', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_availablity, 'Out of Stock' ); ?>><?php _e('Out of Stock', 'pmLocalization') ?></option>
                <option value="<?php _e('Not Available', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_availablity, 'Not Available' ); ?>><?php _e('Not Available', 'pmLocalization') ?></option>
                <option value="<?php _e('Pre-Order', 'pmLocalization') ?>" <?php selected( $pm_paypal_product_availablity, 'Pre-Order' ); ?>><?php _e('Pre-Order', 'pmLocalization') ?></option>
            </select>
            
			<label for="pm_paypal_product_code" class="pm-paypal-meta-label"><?php _e( 'Product Code or SKU #:', 'pmLocalization' ); ?></label>
            <input id="pm_paypal_product_code" type="text" size="75" name="pm_paypal_product_code" class="pm-paypal-meta-textfield" value="<?php echo $pm_paypal_product_code; ?>" />
            
            <?php
			
		}
				
		//SAVE DATA
		public function save_post_meta( $post_id ) {
			
			//Verify the nonce before proceeding.
			if ( !isset( $_POST['pm_paypal_manager_nonce'] ) || !wp_verify_nonce( $_POST['pm_paypal_manager_nonce'], basename( __FILE__ ) ) ) {
				return $post_id;
			}
					
			
			//Save Meta options
			
			//Payment type
			if(isset($_POST['pm_paypal_payment_type'])){
				update_post_meta( $post_id, 'pm_paypal_payment_type', $_POST['pm_paypal_payment_type'] );
			}
			
			//Donation options
			if(isset($_POST['pm_paypal_donation_amount'])){
				update_post_meta( $post_id, 'pm_paypal_donation_amount', $_POST['pm_paypal_donation_amount'] );
			}
			/*if(isset($_POST['pm_paypal_donation_reference'])){
				update_post_meta( $post_id, 'pm_paypal_donation_reference', $_POST['pm_paypal_donation_reference'] );
			}*/
			if(isset($_POST['pm_paypal_donation_placeholder'])){
				update_post_meta( $post_id, 'pm_paypal_donation_placeholder', $_POST['pm_paypal_donation_placeholder'] );
			}
						
			//Payment options
			if(isset($_POST['pm_paypal_payment_option1'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option1', $_POST['pm_paypal_payment_option1'] );
			}
			if(isset($_POST['pm_paypal_payment_option1_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option1_price', $_POST['pm_paypal_payment_option1_price'] );
			}
			if(isset($_POST['pm_paypal_payment_option2'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option2', $_POST['pm_paypal_payment_option2'] );
			}
			if(isset($_POST['pm_paypal_payment_option2_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option2_price', $_POST['pm_paypal_payment_option2_price'] );
			}
			if(isset($_POST['pm_paypal_payment_option3'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option3', $_POST['pm_paypal_payment_option3'] );
			}
			if(isset($_POST['pm_paypal_payment_option3_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option3_price', $_POST['pm_paypal_payment_option3_price'] );
			}
			if(isset($_POST['pm_paypal_payment_option4'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option4', $_POST['pm_paypal_payment_option4'] );
			}
			if(isset($_POST['pm_paypal_payment_option4_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option4_price', $_POST['pm_paypal_payment_option4_price'] );
			}
			if(isset($_POST['pm_paypal_payment_option5'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option5', $_POST['pm_paypal_payment_option5'] );
			}
			if(isset($_POST['pm_paypal_payment_option5_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option5_price', $_POST['pm_paypal_payment_option5_price'] );
			}
			if(isset($_POST['pm_paypal_payment_option6'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option6', $_POST['pm_paypal_payment_option6'] );
			}
			if(isset($_POST['pm_paypal_payment_option6_price'])){
				update_post_meta( $post_id, 'pm_paypal_payment_option6_price', $_POST['pm_paypal_payment_option6_price'] );
			}		
			if(isset($_POST['pm_paypal_monthly_payment_option'])){
				update_post_meta( $post_id, 'pm_paypal_monthly_payment_option', $_POST['pm_paypal_monthly_payment_option'] );
			}
			if(isset($_POST['pm_paypal_display_recurring_options'])){
				update_post_meta( $post_id, 'pm_paypal_display_recurring_options', $_POST['pm_paypal_display_recurring_options'] );
			}
			if(isset($_POST['pm_paypal_default_recurring_option'])){
				update_post_meta( $post_id, 'pm_paypal_default_recurring_option', $_POST['pm_paypal_default_recurring_option'] );
			}
			
			
			
			if(isset($_POST['pm_paypal_monthly_payment_text'])){
				update_post_meta( $post_id, 'pm_paypal_monthly_payment_text', $_POST['pm_paypal_monthly_payment_text'] );
			}
			if(isset($_POST['pm_paypal_monthly_payment_price'])){
				update_post_meta( $post_id, 'pm_paypal_monthly_payment_price', $_POST['pm_paypal_monthly_payment_price'] );
			}
			
			//Product options
			if(isset($_POST['pm_paypal_product_display_availablity'])){
				update_post_meta( $post_id, 'pm_paypal_product_display_availablity', $_POST['pm_paypal_product_display_availablity'] );
			}
			if(isset($_POST['pm_paypal_product_availablity'])){
				update_post_meta( $post_id, 'pm_paypal_product_availablity', $_POST['pm_paypal_product_availablity'] );
			}
			if(isset($_POST['pm_paypal_product_code'])){
				update_post_meta( $post_id, 'pm_paypal_product_code', $_POST['pm_paypal_product_code'] );
			}
			
								
		}//end of Save Data
		
	}//end of class
	
}//end of class collision if

// Instantiate the class
$premiumPaypalManager = new PremiumPaypalManager; 

//Add shortcode include here
include("shortcode.php"); // Load shortcode

?>