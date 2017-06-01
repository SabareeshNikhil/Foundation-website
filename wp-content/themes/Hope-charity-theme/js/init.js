(function($) {
	
	'use strict';
	
	$(document).ready(function(){
		
		if( $("a[rel^='prettyPhoto']").length > 0 ){
			
			$("a[rel^='prettyPhoto']").prettyPhoto({
				animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
				slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
				autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
				opacity: 0.80, /* Value between 0 and 1 */
				//show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
				//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
				//default_width: 640,
				//default_height: 480,
				counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
				theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
				horizontal_padding: 20, /* The padding on each side of the picture */
				hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque', /* Set the flash wmode attribute */
				autoplay: true, /* Automatically start videos: True/False */
				modal: false, /* If set to true, only the close button will close the window */
				deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
				overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
				changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			});
			
			$("a[rel^='prettyPhoto1']").prettyPhoto({
				animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
				slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
				autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
				opacity: 0.80, /* Value between 0 and 1 */
				//show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
				//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
				//default_width: 640,
				//default_height: 480,
				counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
				theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
				horizontal_padding: 20, /* The padding on each side of the picture */
				hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque', /* Set the flash wmode attribute */
				autoplay: true, /* Automatically start videos: True/False */
				modal: false, /* If set to true, only the close button will close the window */
				deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
				overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
				changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			});
			
		}
			
	});
	
})(jQuery);

