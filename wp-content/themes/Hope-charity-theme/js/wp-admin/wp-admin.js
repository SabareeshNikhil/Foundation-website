// JavaScript Document

(function($) {
	
	$(window).load(function(e) {
		
		if( $('.redux-notice').length > 0 ){
			
			$('.redux-notice').css({
				'display' : 'none',
				'visibility' : 'hidden'	
			});
				
		}
		
		
	});
	
	$(document).ready(function(e) {		
	
		//Datepicker
		if( $( "#eventDate" ).length > 0 ){
			$( "#eventDate" ).datepicker();
		}
		
		//User profile avatar image uploader
		if(wp.media !== undefined){
			
			//var formfield = null;
			//var clicked = '';
			
			var avatar_image_uploader;
			
			//Page header image
			$('#user-avatar-image').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (avatar_image_uploader) {
					 avatar_image_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 avatar_image_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 avatar_image_uploader.on('select', function() {
				 
				attachment = avatar_image_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#user_avatar').val(url);
				//$('.pm-admin-upload-field-preview').html('<img src="'+ url +'" />');
	
			 });


			
			
			var background_image_uploader;
			
			//Page header image
			$('#user-background-image').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (background_image_uploader) {
					 background_image_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 background_image_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 background_image_uploader.on('select', function() {
				 
				attachment = background_image_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#user_background_image').val(url);
				//$('.pm-admin-upload-field-preview').html('<img src="'+ url +'" />');
	
			 });
			

			
		}
		
		        
		//Header image preview
		if( $('.pm-admin-upload-field').length > 0 ){	
			var value = $('.pm-admin-upload-field').val();			
			if (value !== '') {				
				$('.pm-admin-upload-field-preview').html('<img src="'+ value +'" />');				
			}	
		}
		
		//Featured Post image preview
		if( $('.pm-featured-image-upload-field').length > 0 ){
	
			var value = $('.pm-featured-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-featured-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Staff image preview
		if( $('.pm-admin-upload-field').length > 0 ){	
			var value = $('.pm-admin-upload-field').val();			
			if (value !== '') {				
				$('.pm-admin-upload-staff-preview').html('<img src="'+ value +'" />');				
			}	
		}
		
		//Gallery image preview
		if( $('#featured-img-uploader-field').length > 0 ){	
			var value = $('#featured-img-uploader-field').val();			
			if (value !== '') {				
				$('.pm-admin-gallery-image-preview').html('<img src="'+ value +'" />');				
			}	
		}

		
		//Remove Gallery image button
		if( $('#remove_gallery_image_button').length > 0 ){	
		
			$('#remove_gallery_image_button').click(function(e) {				
				$('#featured-img-uploader-field').val('');
				$('.pm-admin-gallery-image-preview').empty();				
			});	
			
		}
		
		
		//Remove Page header image button
		if( $('#remove_page_header_button').length > 0 ){	
		
			$('#remove_page_header_button').click(function(e) {				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();				
			});	
			
		}
		
		//Remove woocomm header image
		if( $('#remove_woocom_header_image_button').length > 0 ){
	
			$('#remove_woocom_header_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}		


		//Remove staff image button
		if( $('#remove_staff_image_button').length > 0 ){
	
			$('#remove_staff_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-staff-preview').empty();
				
			});
	
		}
		
		//Datepicker
		$( "#datepicker" ).datepicker();
		
		
		//Check if slider system is enabled or disabled
		if( $('#pm_enable_slider_system').length > 0 ){
						
			$('#pm_enable_slider_system').change(function(e) {
				var val = $(this).val();
				
				//console.log(val);
				
				if(val === 'yes'){
					$('.pm-featured-properties-settings-container').removeClass('hidden').addClass('visible');	
				} else {
					$('.pm-featured-properties-settings-container').removeClass('visible').addClass('hidden');		
				}
				
			});
			
		}
		
		
		//properties slide system
		if(wp.media !== undefined){
			
			//Global vars
			//var globalScope = 'test';
			
			var image_custom_uploader,
			target_text_field = '';
			
			//Target multiple image upload buttons
			if($('.slider_system_upload_image_button').length > 0) {				
				methods.bindClickEvent();									
			}
			
			//Featured projects properties system
			
			//Add New slide btn
			if( $('#pm-slider-system-add-new-slide-btn').length > 0 ){
			
				$('#pm-slider-system-add-new-slide-btn').click(function(e) {
					
					e.preventDefault();
					
					//Get counter value based on last input field in container
					if( $('#pm-featured-properties-images-container').find('.pm-slider-system-field-container:last-child').length > 0 ){
						var counterValue = $('.pm-slider-system-field-container:last-child').attr('id'),
						counterValueId = counterValue.substring(counterValue.lastIndexOf('_') + 1),
						counterValueIdFinal = ++counterValueId;
					} else {
						counterValueIdFinal = 0;
						$('#pm-featured-properties-images-container').html('');
					}
					
					//Append new slide field
					var wrapperStart = '<div class="pm-slider-system-field-container" id="pm_slider_system_field_container_'+counterValueIdFinal+'">';
					var field1 = '<input type="text" value="" name="pm_slider_system_post[]" id="pm_slider_system_post_'+counterValueIdFinal+'" class="pm-slider-system-upload-field" />';
					var field2 = '<input type="button" value="Media Library Image" class="button-secondary slider_system_upload_image_button" id="pm_slider_system_post_btn_'+counterValueIdFinal+'" />';
					var field3 = '&nbsp; <input type="button" value="Remove Slide" class="button button-primary button-large delete slider_system_remove_image_button" id="pm_slider_system_post_remove_btn_'+counterValueIdFinal+'" />';
					var wrapperEnd = '</div>';
					$('#pm-featured-properties-images-container').append(wrapperStart + field1 + field2 + field3 + wrapperEnd);
					
					methods.bindClickEvent();
					methods.bindRemoveImageClickEvent();
					
				});
				
			}
			
			if( $('.slider_system_remove_image_button').length > 0 ){			
				methods.bindRemoveImageClickEvent();				
			}			
						
		}//end if
				
				
		//Theme verification - marketplace selection
		if( $('#pm_ln_verify_marketplace_selection').length > 0 ){
	
			$('#pm_ln_verify_marketplace_selection').on('change', function(e) {		
			
				
				var val = $(this).val();
				
				if(val === 'themeforest'){
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').addClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');		
									
					
				} else if(val === 'mojo') {
					
					$('#pm_ln_micro_themes_purchase_code_mojo').addClass('active');	
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');			
							
				} else {
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');	
						
				}
				
			});
	
		}
		
    });
	
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
			
			bindClickEvent : function(e) {
							
				$('.slider_system_upload_image_button').click(function(e) {
					
					e.preventDefault();
					
					var btnId = $(this).attr('id'),
					targetTextFieldID = btnId.substring(btnId.lastIndexOf('_') + 1);
					
					
					//console.log(target_text_field.attr('id'));
	
					 //If the uploader object has already been created, reopen the media library window
					 if (image_custom_uploader) {
						 image_custom_uploader.open();
						 target_text_field = $('#pm_slider_system_post_'+targetTextFieldID)
						 return;
					 }
						
				});
				
				//Triggers the Media Library window
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
					
					//console.log(target_text_field.attr('id'));
					
					$(target_text_field).val(url);
					//$('.pm-admin-upload-field-preview').html('<img src="'+ url +'" />');
		
				 });
				
			},
			
			bindRemoveImageClickEvent : function(e) {
				
				$('.slider_system_remove_image_button').each(function(index, element) {
                    
					$(this).click(function(e) {
						
						e.preventDefault();
						
						var btnId = $(this).attr('id'),
						targetTextFieldID = btnId.substring(btnId.lastIndexOf('_') + 1);
						
						var targetTextFieldContainer = $('#pm_slider_system_field_container_'+targetTextFieldID).remove(),
						targetTextField = $('#pm_slider_system_post_'+targetTextFieldID).remove(),
						targetLibraryBtn = $('#pm_slider_system_post_btn_'+targetTextFieldID).remove();
						
						$(this).remove();
						
					});
					
                });
				
			},
			
		}
	
})(jQuery);