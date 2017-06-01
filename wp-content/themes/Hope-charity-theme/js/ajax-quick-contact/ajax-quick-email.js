(function($) {

	
	$('#pm_full_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_email_address').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_message').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('.quick_contact_submit').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('.pm-ln-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_send_quick_contact_nonce').val();
		
		var reg_full_name = $('#pm_full_name').val();
		var reg_email_address =  $('#pm_email_address').val();
		var reg_message =  $('#pm_message').val();
		var reg_recipient_email =  $('#pm_email_address_contact').val();
		
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = wordpressOptionsObject.pm_ln_ajax_url;
	
		// Data to send
		var data = {
		  action: 'send_quick_contact_form',
		  nonce: reg_nonce,
		  full_name: reg_full_name,
		  email_address: reg_email_address,
		  message: reg_message,
		  recipient: reg_recipient_email
		};
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === 'full_name_error') {
			  
				$('.pm-ln-form-response').html(wordpressOptionsObject.optContactFormNameError);
				$('#pm_full_name').addClass('invalid_field');
			  
			} else if( response === 'email_error' ){
				
			    $('.pm-ln-form-response').html(wordpressOptionsObject.optContactFormEmailError);
				$('#pm_email_address').addClass('invalid_field');

			} else if( response === 'message_error' ){
				
			  	$('.pm-ln-form-response').html(wordpressOptionsObject.optContactFormInquiryError);
				$('#pm_message').addClass('invalid_field');

			}  else if( response === 'success' ){
				
				$('.pm-ln-form-response').html(wordpressOptionsObject.optFormSuccessMessage);
				$('.quick_contact_submit').css({
					'opacity' : 0,
					'visibility' : 'hidden',
					'display' : 'none'
				});

			  
			} else if( response === 'failed' ){
				
				$('.pm-ln-form-response').html(wordpressOptionsObject.optFormErrorMessage);
				$('.quick_contact_submit').css({
					'opacity' : 0,
					'visibility' : 'hidden',
					'display' : 'none'
				});
				
			} else {
				
			  $('.result-message').html( response );
			  $('.result-message').show();
			  
			}
		  }
		});
		
		
	});
	
})(jQuery);