// JavaScript Document
(function($){
	
	var tooltip;
	
	$(document).ready(function(e) {
		
		//Instatiate uploader class
		tooltip = new ToolTip('.pm-paypal-help-icon');
    	tooltip.init();
		
	});
	
})(jQuery);