// JavaScript Document

(function($) {
	
	$(document).ready(function(e) {
		        
		//Purchase btn image preview
		if( $('.pm-purchase-image-upload-field').length > 0 ){
	
			var value = $('.pm-purchase-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-paypal-purchase-btn-img-preview').html('<img src="'+ value +'" />');
				
			}
	
		}//end if
		
		//Remove Purchase btn image preview
		if( $('#remove_paypal_purchase_btn_img_button').length > 0 ){
			
			$('#remove_paypal_purchase_btn_img_button').click(function(e) {
				
				$('.pm-purchase-image-upload-field').val('');
				$('.pm-paypal-purchase-btn-img-preview').empty();
				
			});
			
		}//end if
		
		
		
		//Donation btn image preview
		if( $('.pm-donation-image-upload-field').length > 0 ){
	
			var value = $('.pm-donation-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-paypal-donation-btn-img-preview').html('<img src="'+ value +'" />');
				
			}
	
		}//end if
		
		//Remove Donation btn image preview
		if( $('#remove_paypal_donation_btn_img_button').length > 0 ){
			
			$('#remove_paypal_donation_btn_img_button').click(function(e) {
				
				$('.pm-donation-image-upload-field').val('');
				$('.pm-paypal-donation-btn-img-preview').empty();
				
			});
			
		}//end if
		
		
		//Subscription btn image preview
		if( $('.pm-subscription-image-upload-field').length > 0 ){
	
			var value = $('.pm-subscription-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-paypal-subscription-btn-img-preview').html('<img src="'+ value +'" />');
				
			}
	
		}//end if
		
		//Remove Subscription btn image preview
		if( $('#remove_paypal_subscription_btn_img_button').length > 0 ){
			
			$('#remove_paypal_subscription_btn_img_button').click(function(e) {
				
				$('.pm-subscription-image-upload-field').val('');
				$('.pm-paypal-subscription-btn-img-preview').empty();
				
			});
			
		}//end if
		
		
    });
	
})(jQuery);