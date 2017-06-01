<?php

add_shortcode( "premium-paypal-item", "add_pm_paypal_manager_plugin" );

function add_pm_paypal_manager_plugin( $atts ) {
	
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
	
	//Grab PayPal Manager settings
	$paypal_email = get_option('pm_paypal_payment_email', true);
	$payment_currency = get_option('pm_paypal_payment_currency', true);
	//$pm_payment_currency_symbol = get_option('pm_payment_currency_symbol', true);
	$pm_paypal_product_return_url = get_option('pm_paypal_product_return_url', true);
	$pm_paypal_donation_return_url = get_option('pm_paypal_donation_return_url', true);
	$pm_paypal_product_identifier = get_option('pm_paypal_product_identifier', true);
	$pm_paypal_product_item_width = get_option('pm_paypal_product_item_width', true);
	$pm_paypal_product_item_responsive = get_option('pm_paypal_product_item_responsive', true);
	
	$currencySymbol = '';
	
	if( $payment_currency == 'AUD' ) {	
		$currencySymbol = 'A $';		
	} else if( $payment_currency == 'CAD' ) {		
		$currencySymbol = 'C $';			
	} else if($payment_currency == 'EUR') {		
		$currencySymbol = '&euro;';		
	} else if($payment_currency == 'GBP') {		
		$currencySymbol = '&pound;';		
	} else if($payment_currency == 'JPY') {		
		$currencySymbol = '&yen;';		
	} else if( $payment_currency == 'USD' ) {		
		$currencySymbol = '$';		
	} else if( $payment_currency == 'NZD' ) {		
		$currencySymbol = '$';		
	} else if( $payment_currency == 'CHF' ) {		
		$currencySymbol = 'CHF';		
	} else if( $payment_currency == 'HKD' ) {		
		$currencySymbol = '$';		
	} else if( $payment_currency == 'SGD' ) {		
		$currencySymbol = '$';		
	} else if( $payment_currency == 'SEK' ) {		
		$currencySymbol = 'kr';		
	} else if( $payment_currency == 'DKK' ) {		
		$currencySymbol = 'kr';		
	} else if( $payment_currency == 'PLN' ) {		
		$currencySymbol = 'zł';		
	} else if( $payment_currency == 'NOK' ) {		
		$currencySymbol = 'kr';			
	} else if( $payment_currency == 'HUF' ) {		
		$currencySymbol = 'Ft';		
	} else if( $payment_currency == 'CZK' ) {		
		$currencySymbol = 'Kč';			
	} else if( $payment_currency == 'ILS' ) {		
		$currencySymbol = '₪';			
	} else if( $payment_currency == 'MXN' ) {		
		$currencySymbol = '$';		
	} else if( $payment_currency == 'BRL' ) {		
		$currencySymbol = 'R$';		
	} else if( $payment_currency == 'MYR' ) {		
		$currencySymbol = 'RM';		
	} else if( $payment_currency == 'PHP' ) {		
		$currencySymbol = '₱';		
	} else if( $payment_currency == 'TWD' ) {		
		$currencySymbol = 'NT$';		
	} else if( $payment_currency == 'THB' ) {		
		$currencySymbol = '฿';		
	} else if( $payment_currency == 'TRY' ) {		
		$currencySymbol = '';		
	} else if( $payment_currency == 'RUB' ) {		
		$currencySymbol = '₽';		
	} else {
		//do nothing	
	}
	
	//Grab meta options
	
	//Payment type
	$pm_paypal_payment_type = get_post_meta( $id, 'pm_paypal_payment_type', true );
	
	//Donation Options
	$pm_paypal_donation_amount = get_post_meta( $id, 'pm_paypal_donation_amount', true );
	//$pm_paypal_donation_reference = get_post_meta( $id, 'pm_paypal_donation_reference', true );
	$pm_paypal_donation_placeholder = get_post_meta( $id, 'pm_paypal_donation_placeholder', true );
	
	//Payment Options
	$pm_paypal_payment_option1 = get_post_meta( $id, 'pm_paypal_payment_option1', true );
	$pm_paypal_payment_option2 = get_post_meta( $id, 'pm_paypal_payment_option2', true );
	$pm_paypal_payment_option3 = get_post_meta( $id, 'pm_paypal_payment_option3', true );
	$pm_paypal_payment_option4 = get_post_meta( $id, 'pm_paypal_payment_option4', true );
	$pm_paypal_payment_option5 = get_post_meta( $id, 'pm_paypal_payment_option5', true );
	$pm_paypal_payment_option6 = get_post_meta( $id, 'pm_paypal_payment_option6', true );
	
	$pm_paypal_payment_option1_price = get_post_meta( $id, 'pm_paypal_payment_option1_price', true );
	$pm_paypal_payment_option2_price = get_post_meta( $id, 'pm_paypal_payment_option2_price', true );
	$pm_paypal_payment_option3_price = get_post_meta( $id, 'pm_paypal_payment_option3_price', true );
	$pm_paypal_payment_option4_price = get_post_meta( $id, 'pm_paypal_payment_option4_price', true );
	$pm_paypal_payment_option5_price = get_post_meta( $id, 'pm_paypal_payment_option5_price', true );
	$pm_paypal_payment_option6_price = get_post_meta( $id, 'pm_paypal_payment_option6_price', true );
	
	$pm_paypal_monthly_payment_option = get_post_meta( $id, 'pm_paypal_monthly_payment_option', true );//NEW IN 1.3
	$pm_paypal_monthly_payment_text = get_post_meta( $id, 'pm_paypal_monthly_payment_text', true );//NEW IN 1.3
	$pm_paypal_monthly_payment_price = get_post_meta( $id, 'pm_paypal_monthly_payment_price', true );//NEW IN 1.3
	$pm_paypal_display_recurring_options = get_post_meta( $id, 'pm_paypal_display_recurring_options', true );//NEW IN 1.4
	$pm_paypal_default_recurring_option = get_post_meta( $id, 'pm_paypal_default_recurring_option', true );//NEW IN 1.4
	
	//Sales tax
	$pm_paypal_sales_tax_amount = get_option('pm_paypal_sales_tax_amount', true);//NEW IN 1.3
	
	//Image Options
	$pm_paypal_purchase_btn_img = get_option('pm_paypal_purchase_btn_img', true);
	$pm_paypal_donation_btn_img = get_option('pm_paypal_donation_btn_img', true);
	$pm_paypal_subscription_btn_img = get_option('pm_paypal_subscription_btn_img', true);
	
	//Product Options
	$pm_paypal_product_display_availablity = get_post_meta( $id, 'pm_paypal_product_display_availablity', true ); //NEW IN 1.3
	$pm_paypal_product_availablity = get_post_meta( $id, 'pm_paypal_product_availablity', true );
	$pm_paypal_product_code = get_post_meta( $id, 'pm_paypal_product_code', true );
	
	//Sandbox Options
	$pm_paypal_sandbox_mode = get_option('pm_paypal_sandbox_mode', true);
	$pm_paypal_merchant_sandbox_email = get_option('pm_paypal_merchant_sandbox_email', true);
	
	$paymentText = array();
	array_push(
				$paymentText, 
				$pm_paypal_payment_option1,
				$pm_paypal_payment_option2,
				$pm_paypal_payment_option3,
				$pm_paypal_payment_option4,
				$pm_paypal_payment_option5,
				$pm_paypal_payment_option6
	);
	
	$payments = array();
	array_push(
				$payments, 
				$pm_paypal_payment_option1_price,
				$pm_paypal_payment_option2_price,
				$pm_paypal_payment_option3_price,
				$pm_paypal_payment_option4_price,
				$pm_paypal_payment_option5_price,
				$pm_paypal_payment_option6_price
	);
	
	$totalPaymentOptions = 0;
		
	//pass plugin data and/or additional settings to JS
	//wp_enqueue_script( 'js_handler', plugins_url() ); //pass in second parameter to prevent error
	//wp_localize_script( 'js_handler', 'plugin_settings', $settings, true );
	//wp_localize_script( 'js_handler', 'plugin_data', json_decode($panels, true) ); 
	
	//Pass plugin URL to JS for Ajax purposes
	//$bloginfo = site_url();
	//wp_localize_script( 'js_handler', 'plugin_url', $bloginfo, true ); 
	
	
	//Add front-end code here
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$GetTitle = addslashes($queried_post->post_title);
	$title = htmlspecialchars($GetTitle);
	$content = $queried_post->post_content;
	$image = get_the_post_thumbnail($id);
		
	?>
    
    <?php 
	
		//PRODUCT
		if($pm_paypal_payment_type == 'Product') {
		
			$html = '<div class="pm_paypal_item_container" style="width:'. ($pm_paypal_product_item_responsive == 'Yes' ? '100%' : $pm_paypal_product_item_width .'px').';">';
			
			$html .= '<div class="pm_paypal_item_img">'.$image.'</div>';
						
			$html .= '<div class="pm_paypal_item_content">';
			
				$html .= '<p class="pm-paypal-item-title"><strong>'.stripslashes($title).'</strong></p>';
				
				$html .= '<p class="pm-paypal-item-content">'.$content.'</p>';
				
				if($pm_paypal_product_display_availablity === 'yes') :
					$html .= '<p><b> '.__( 'Availability:', 'pmLocalization' ).' </b> '.$pm_paypal_product_availablity.' </p>';
				endif;
			
				if($pm_paypal_product_code != '') {
					$html .= '<p><b>'. __( $pm_paypal_product_identifier, 'pmLocalization' ).' </b> '.$pm_paypal_product_code.' </p>';
				}
				
				if($pm_paypal_product_availablity == 'In Stock' || $pm_paypal_product_availablity == 'Pre-Order'){
					
					foreach($payments as $payment){
								
						if($payment != ''){
							$totalPaymentOptions++;
						}
						
					}//end of foreach
					
					if($totalPaymentOptions > 1){ //display select list
					
						$html .= '<select name="pm_paypal_item_price_list_'.$id.'" id="pm_paypal_item_price_list_'.$id.'">';
						
						$counter = 0;
						
						foreach($payments as $payment){
								
							//check to make sure payment is not blank (this will eliminate empty values in the select list)
							if($payment != ''){
								
								if($paymentText[$counter] != ''){
									//append text to price
									$html .= '<option value="'.$payment.'" title="'.$paymentText[$counter].'">'. $paymentText[$counter] .' - '. $currencySymbol . $payment.'</option>';
								} else {
									//show price only
									$html .= '<option value="'.$payment.'">'. $currencySymbol . $payment.'</option>';	
								}
																		
							}
							
							$counter++;
							
						}//end of foreach
						
						$html .= '</select>';
						
					
					} else {//display single price only
					
						if($pm_paypal_payment_option1 != ''){
							$html .= '<p class="pm-paypal-item-price">'. $pm_paypal_payment_option1 .' - '. $currencySymbol . $pm_paypal_payment_option1_price. '</p>';
						} else {
							$html .= '<p class="pm-paypal-item-price">'. $currencySymbol . $pm_paypal_payment_option1_price. '</p>';
						}
					
					}//end of $totalPaymentOptions
					
				}//end of stock check
				
			
				
			
				//ONLY PROCESS PAYPAL FORM IF ITEM IS IN STOCK OR PRE-ORDER
				if($pm_paypal_product_availablity == 'In Stock' || $pm_paypal_product_availablity == 'Pre-Order'){
					
					//RENDER PAYPAL FORM
					if($pm_paypal_sandbox_mode == 'Yes') {
						$html .= '<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_form_'.$id.'">';
					} else {
						$html .= '<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_form_'.$id.'">';
					}//end of if
					
					$html .= '<input type="hidden" name="cmd" value="_xclick">';
					
					if($pm_paypal_sandbox_mode == 'Yes') {
						$html .= '<input type="hidden" name="business" value="'.$pm_paypal_merchant_sandbox_email.'">';
					} else {
						$html .= '<input type="hidden" name="business" value="'.$paypal_email.'">';
					}//end of if
					
					$html .= '<input type="hidden" name="currency_code" value="'.$payment_currency.'">';
					$html .= '<input type="hidden" name="item_name" value="">';
					$html .= '<input type="hidden" name="amount" value="">';
					$html .= '<input type="hidden" name="return" value="'.$pm_paypal_product_return_url.'" />';
					$html .= '<input type="hidden" name="email" value="" />';
					$html .= '<input type="hidden" name="tax" value="" />';
					
					$html .= '</form>';
					
					if($pm_paypal_purchase_btn_img !== ''){
						
						$html .= '<input type="image" id="pm_paypal_buy_btn_'.$id.'" src="'.$pm_paypal_purchase_btn_img.'" style="background:none !important;" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">';
						
					} else {
						
						$html .= '<input type="image" id="pm_paypal_buy_btn_'.$id.'" src="'.plugin_dir_url(__FILE__).'front-end/img/paypal_buynow.gif" style="background:none !important;" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">';
						
					}	
					
					
				}//end of if
				
			
				$html .= '</div>';
				
				//Use JS to determine which product is being submitted for purchase
				if($pm_paypal_product_availablity == 'In Stock' || $pm_paypal_product_availablity == 'Pre-Order'){
					
					$html .= '<script type="text/javascript">';
					
						$html .= '(function($) {';
						
							$html .= ' $(document).ready(function(e) {';
							
								//Get parameters
								$html .= 'var paymentType = "'.$pm_paypal_payment_type.'";';
								$html .= 'var totalPaymentOptions = '.$totalPaymentOptions.';';
								$html .= 'var id = '.$id.';';
								
								//Click handler
								$html .= "$('#pm_paypal_buy_btn_' + id).click(function(e){";
								
									$html .= 'e.preventDefault();';
								
									$html .= 'if(totalPaymentOptions > 1){'; //check price drop down list
										$html .= "var price = $('#pm_paypal_item_price_list_' + id).val().toString();";
										$html .= "var titleAddon = $('#pm_paypal_item_price_list_' + id).find(\"option:selected\").attr('title');";
										$html .= "$('input[name=item_name]').val(' ".$title." ' + (titleAddon != undefined ? ' - ' + titleAddon : '') );";
									$html .= '} else {'; //process single payment
										$html .= "var price = $pm_paypal_payment_option1_price;";
										$html .= "$('input[name=item_name]').val('$title');";
									$html .= '}';
									
									$taxAmount = $pm_paypal_sales_tax_amount !== '' ? $pm_paypal_sales_tax_amount : '0';
									
									$html .= "var tax = Math.round(price * $taxAmount);";
									$html .= "$('input[name=tax]').val(tax);";
									$html .= "$('input[name=amount]').val(price);";
									$html .= "$('#pm_paypal_manager_form_' + id).submit();";
							
								$html .= '});';
								
							$html .= '});';
							
						$html .= '})(jQuery);';
						
					$html .= '</script>';
					
				}//end of js check
				
				
				//Recurring Payment Plan
				if( $pm_paypal_monthly_payment_option === 'yes' ){
					
					//Display recurring price option
					$html .= '<p class="pm-paypal-item-price">'.$pm_paypal_monthly_payment_text.'' . $currencySymbol . $pm_paypal_monthly_payment_price.'</p>';
										
					if($pm_paypal_sandbox_mode == 'Yes') {
						$html .= '<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_subscription_'.$id.'">';
					} else {
						$html .= '<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_subscription_'.$id.'">';
					}//end of if
					
						$html .= '<input type="hidden" name="cmd" value="_xclick-subscriptions">';
						
						if($pm_paypal_sandbox_mode == 'Yes') {
							$html .= '<input type="hidden" name="business" value="'.$pm_paypal_merchant_sandbox_email.'">';
						} else {
							$html .= '<input type="hidden" name="business" value="'.$paypal_email.'">';
						}//end of if
												
						$html .= '<input type="hidden" name="currency_code" value="'.$payment_currency.'">';
						$html .= '<input type="hidden" name="no_shipping" value="1">';
						
						if($pm_paypal_subscription_btn_img !== ''){
							$html .= '<input type="image" id="pm_paypal_subscription_btn_'.$id.'" src="'.$pm_paypal_subscription_btn_img.'" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">';
						} else {
							$html .= '<input type="image" id="pm_paypal_subscription_btn_'.$id.'" src="http://www.paypal.com/en_US/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">';
						}
						
						
						$html .= '<input type="hidden" name="a3" value="'.$pm_paypal_monthly_payment_price.'">';
						$html .= '<input type="hidden" name="p3" value="1">';
						
						
						$html .= '<input type="hidden" name="t3" value="'.$pm_paypal_default_recurring_option.'">';
						
						
						$html .= '<input type="hidden" name="src" value="1">';
						$html .= '<input type="hidden" name="sra" value="1">';
						
					$html .= '</form>';
					
					//Use JS to determine which subscription item is being submitted for purchase
					$html .= '<script type="text/javascript">';
					
						$html .= '(function($) {';
						
							$html .= ' $(document).ready(function(e) {';
							
								//Get parameters
								$html .= 'var id = '.$id.';'; //get the id of the item
								
								//Click handler
								$html .= "$('#pm_paypal_subscription_btn_' + id).click(function(e){";
								
									$html .= 'e.preventDefault();';
									
									$html .= "$('#pm_paypal_manager_subscription_' + id).submit();";
							
								$html .= '});';
								
							$html .= '});';
							
						$html .= '})(jQuery);';
						
					$html .= '</script>';
					
				}
				
				
			
			$html .= '</div>';
						
			return $html;
			
		}
		
	?>
    
    
    
    
    <?php
	
		//DONATION
		if($pm_paypal_payment_type == 'Donation') {
			
			$html = '<div class="pm_paypal_item_container" style="width:'. ($pm_paypal_product_item_responsive == 'Yes' ? '100%' : $pm_paypal_product_item_width .'px').';">';
					
				$html .= '<div class="pm_paypal_item_img">'.$image.'</div>';
				
				$html .= '<p>'.$content.'</p>';
				
				//check first to see if we have more than one payment option
				foreach($payments as $payment){
					
					if($payment != ''){
						$totalPaymentOptions++;
					}
					
				}//end of foreach
				
				if( $pm_paypal_donation_amount == 'No' ){
				
					if($totalPaymentOptions > 1){
						
						$html .= '<select name="pm_paypal_item_price_list_'.$id.'" id="pm_paypal_item_price_list_'.$id.'">';
						
						$counter = 0;
						
						foreach($payments as $payment){
								
							//check to make sure payment is not blank (this will eliminate empty values in the select list)
							if($payment != ''){
								
								if($paymentText[$counter] != ''){
									//append text to price
									$html .= '<option value="'.$payment.'" title="'.$paymentText[$counter].'">'. $paymentText[$counter] .' - '. $currencySymbol . $payment.'</option>';
								} else {
									//show price only
									$html .= '<option value="'.$payment.'">'.$currencySymbol . $payment.'</option>';	
								}
																		
							}
							
							$counter++;
							
						}//end of foreach
						
						$html .= '</select>';
						
					} else {//display single price
						
												
						if($pm_paypal_monthly_payment_option === 'yes'){
														
							if($pm_paypal_monthly_payment_price !== ''){
								$html .= '<p>'.$pm_paypal_monthly_payment_text.' '.$currencySymbol . $pm_paypal_monthly_payment_price.'</p>';
							}
							
						} else {
							
							//Select payment option 1
							$html .= '<p>'.$currencySymbol . $pm_paypal_payment_option1_price.'</p>';
							
						}
						
						
						
					}
						
				}//end of other amount check
				
				
				
				//Paypal form
				if($pm_paypal_sandbox_mode == 'Yes') {
					$html .= '<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_form_'.$id.'">';
				} else {
					$html .= '<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="pm_paypal_manager_form_'.$id.'">';
				}
				
						if( $pm_paypal_monthly_payment_option === 'yes' ){
							$html .= '<input type="hidden" name="cmd" value="_xclick-subscriptions">';
						} else {
							$html .= '<input type="hidden" name="cmd" value="_xclick">';	
						}
						
				
						if($pm_paypal_sandbox_mode == 'Yes') {
							$html .= '<input type="hidden" name="business" value="'.$pm_paypal_merchant_sandbox_email.'" />';
						} else {
							$html .= '<input type="hidden" name="business" value="'.$paypal_email.'" />';
						}
						
						
						if( $pm_paypal_monthly_payment_option === 'yes' ){
							
							//Recurring payment fields
							if($pm_paypal_monthly_payment_price !== ''){
								$html .= '<input type="hidden" name="a3" value="'.$pm_paypal_monthly_payment_price.'">';
							} else {
								$html .= '<input type="hidden" name="a3" value="">';	
							}
							
							$html .= '<input type="hidden" name="currency_code" value="'.$payment_currency.'">';
							$html .= '<input type="hidden" name="no_shipping" value="1">';
							
							$html .= '<input type="hidden" name="p3" value="1">';
							$html .= '<input type="hidden" name="t3" value="">';
							$html .= '<input type="hidden" name="src" value="1">';
							$html .= '<input type="hidden" name="sra" value="1">';
							
							
						} else {
							
							//Stand alone payment fields
							$html .= '<input type="hidden" name="currency_code" value="'.$payment_currency.'" />';
							$html .= '<input type="hidden" name="item_name" value="" />';
							$html .= '<input type="hidden" name="amount" value="" />';
							$html .= '<input type="hidden" name="return" value="'.$pm_paypal_donation_return_url.'" />';
							$html .= '<input type="hidden" name="email" value="" />';
								
						}
				
							
				
				$html .= '</form>';
				
				if($pm_paypal_donation_amount == 'Yes') {
					
					$html .= '<div class="pm_paypal_donate_amount">';
						$html .= '<input type="text" name="pm_paypal_donation_amount_'.$id.'" id="pm_paypal_donation_amount_'.$id.'" placeholder="'.$pm_paypal_donation_placeholder.'"/>';		
					$html .= '</div>';
					
				}
				
				if( $pm_paypal_monthly_payment_option === 'yes' && $pm_paypal_display_recurring_options === 'yes' ){
						
					//display recurring payment option list
					$html .= '<div class="pm_paypal_donate_amount">';
						$html .= '<select class="select" name="pm_paypal_recurring_option_'.$id.'" id="pm_paypal_recurring_option_'.$id.'">';
						  $html .= '<option value="W">'.__('Weekly', 'pmLocalization').'</option>';
						  $html .= '<option value="M">'.__('Monthly', 'pmLocalization').'</option>';
						  $html .= '<option value="Y">'.__('Yearly', 'pmLocalization').'</option>';
						$html .= '</select>';
					$html .= '</div>';
					
				}
				
				if($pm_paypal_donation_btn_img !== ''){
					
					$html .= '<input type="image" id="pm_paypal_buy_btn_'.$id.'" style="background:none !important; padding:0; border-radius:none !important;" alt="Make donations with PayPal - it\'s fast, free and secure!" name="submit" src="'.$pm_paypal_donation_btn_img.'">';
					
				} else {
					
					$html .= '<input type="image" id="pm_paypal_buy_btn_'.$id.'" style="background:none !important; padding:0; border-radius:none !important;" alt="Make donations with PayPal - it\'s fast, free and secure!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif">';
					
				}
				
				
				$html .= '<script type="text/javascript">';
				
					$html .= '(function($) {';
					
						$html .= ' $(document).ready(function(e) {';
						
							$html .= 'var paymentType = "'.$pm_paypal_payment_type.'";';
							$html .= 'var totalPaymentOptions = '.$totalPaymentOptions.';';
							$html .= 'var donationAmount = "'.$pm_paypal_donation_amount.'";';
							$html .= 'var monthlyPaymentOption = "'.$pm_paypal_monthly_payment_option.'";';
							$html .= 'var monthlyPaymentPrice = "'.$pm_paypal_monthly_payment_price.'";';
							$html .= 'var id = '.$id.';';
							
							$html .= "$('#pm_paypal_buy_btn_' + id).click(function(e){";
													
								$html .= 'e.preventDefault();';
								
								$html .= "if(totalPaymentOptions > 1){"; //If there are more than 1 payment inserted then we generate a select list
									
									$html .= " if(donationAmount == 'No'){ "; //WORKING
									
										//Get donation amount from select list
										$html .= "var price = $('#pm_paypal_item_price_list_' + id).val().toString();";
										$html .= "var titleAddon = $('#pm_paypal_item_price_list_' + id).find(\"option:selected\").attr('title');";
										
										if($pm_paypal_monthly_payment_option === 'yes'){
											
											if($pm_paypal_display_recurring_options === 'yes') {
											
												//Get the recurring option from the select list
												$html .= "var recurringOption = $('#pm_paypal_recurring_option_' + id).val().toString();";
												$html .= "$('input[name=t3]').val(recurringOption);";
												
											} else {
												
												//Get the default recurring option
												$html .= "var recurringOption = '".$pm_paypal_default_recurring_option."';";
												$html .= "$('input[name=t3]').val(recurringOption);";
												
											}
											
											$html .= "$('input[name=a3]').val(price);";
											
										} else {
											$html .= "$('input[name=item_name]').val('".$title." - $' + price );";
										}
									
									$html .= "}";
									
									
									
								$html .= "} else if(donationAmount == 'Yes') {"; //Show "other amount" textfield so users can insert their own amount
								
								
									$html .= "if(monthlyPaymentOption === 'no'){";
									
										//One time donation
										$html .= "var price = $('#pm_paypal_donation_amount_' + id).val().toString();";
										$html .= "$('input[name=item_name]').val('".$title." - $' + price);";
									
									$html .= "} else if(monthlyPaymentOption === 'yes'){";
									
										//Recurring donation
										$html .= "var price = $('#pm_paypal_donation_amount_' + id).val().toString();";
										$html .= "$('input[name=a3]').val(price);";
										
										if($pm_paypal_display_recurring_options === 'yes') {
											
											//Get the recurring option from the select list
											$html .= "var recurringOption = $('#pm_paypal_recurring_option_' + id).val().toString();";
											$html .= "$('input[name=t3]').val(recurringOption);";
											
										} else {
											
											//Get the default recurring option
											$html .= "var recurringOption = '".$pm_paypal_default_recurring_option."';";
											$html .= "$('input[name=t3]').val(recurringOption);";
											
										}
									
									$html .= "} else {";
									
									$html .= "}";										
									
									
									
								$html .= "} else if(donationAmount == 'No') {"; //Mulitple payments not detected and other amount not detected - check for recurring or one-time fixed payment
								
									$html .= "if(monthlyPaymentOption === 'yes'){";
									
										//Recurring fixed payment
										$html .= "var price = '".$pm_paypal_monthly_payment_price."';";
										$html .= "$('input[name=a3]').val(price);";
										
										if($pm_paypal_display_recurring_options === 'yes') {
											
											//Get the recurring option from the select list
											$html .= "var recurringOption = $('#pm_paypal_recurring_option_' + id).val().toString();";
											$html .= "$('input[name=t3]').val(recurringOption);";
											
										} else {
											
											//Get the default recurring option
											$html .= "var recurringOption = '".$pm_paypal_default_recurring_option."';";
											$html .= "$('input[name=t3]').val(recurringOption);";
											
										}
									
									$html .= "} else {";	
									
										$html .= "var price = '$pm_paypal_payment_option1_price';";
										$html .= "$('input[name=item_name]').val('".$title."');";
									
									$html .= '}';								
									
									
								$html .= '} else {';
								
									$html .= "var price = '$pm_paypal_payment_option1_price';";
									$html .= "$('input[name=item_name]').val('".$title."');";
									
								$html .= '}';
															
								$html .= "$('input[name=amount]').val(price);";
								$html .= "$('#pm_paypal_manager_form_' + id).submit();";
														
							$html .= '});';
						
						$html .= '});';
					
					$html .= '})(jQuery);';
					
				$html .= '</script>';
				
			
			$html .= '</div><!-- /pm_paypal_item_container -->';
			
			return $html;
			
		}//end of donation check if
	
}//end of function

?>