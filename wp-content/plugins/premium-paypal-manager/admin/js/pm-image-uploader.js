(function($){

	$(document).ready(function(e) {
		
		//alert('pm-image-uploader loaded');
		
		if(wp.media !== undefined){
			
			var formfield = null;
		
			var clicked = '';
			
			var image_custom_uploader;
			
			
			/******** Purchase button image *********/
			
			$('#upload_image_button').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (image_custom_uploader) {
					 image_custom_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 image_custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 image_custom_uploader.on('select', function() {
				attachment = image_custom_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#img-uploader-field').val(url);
				$('.pm-paypal-purchase-btn-img-preview').html('<img src="'+ url +'" />');
	
			 });
			 
			 
			 
			 
			 
			 /******** Donation button image *********/
			 
			 $('#upload_image_button_donation').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (donation_image_custom_uploader) {
					 donation_image_custom_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 donation_image_custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 donation_image_custom_uploader.on('select', function() {
				attachment = donation_image_custom_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#img-uploader-field-donation').val(url);
				$('.pm-paypal-donation-btn-img-preview').html('<img src="'+ url +'" />');
	
			 });
			 
			 
			/******** Subscription button image *********/
			
			$('#upload_image_button_subscription').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (subscription_image_custom_uploader) {
					 subscription_image_custom_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 subscription_image_custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 subscription_image_custom_uploader.on('select', function() {
				attachment = subscription_image_custom_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#img-uploader-field-subscription').val(url);
				$('.pm-paypal-subscription-btn-img-preview').html('<img src="'+ url +'" />');
	
			 });
			
			
		}
		
		
		
		
	});

})(jQuery);