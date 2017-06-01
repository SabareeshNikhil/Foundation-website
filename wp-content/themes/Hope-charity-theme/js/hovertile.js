/**
	Hover tile plugin
	Developed by Micro Themes founder Leo Nanfara 
	Author website: www@pulsarmedia.ca
	Author email: leo@pulsarmedia.ca
	Plugin Version: 1.0
**/



//wrapper function to prevent conflicts with other js libraries - the $ in the brackets allows us to target this plugin with just $

(function($) {

	//jQuery Hover tile plugin
	jQuery.fn.hoverTile = function(options) {

		var settings = $.extend({}, {
			slideType:'fade',
			slideVerticalOffset:0,
			resizeOffset:100
		}, options);
		
		var $window = $(window);
		var $windowsize = 0;
		var el = this;
		
		function checkWidth() {
			$windowsize = $window.width();
			init(el);
			//console.log('init called');
			/*if ($windowsize > 1200) {
				//console.log('window is greater than 1200');
				init();
			} else if($windowsize > 980) {	
				//console.log('window is greater than 980');
				
			} else if($windowsize > 767) {	
				//console.log('window is greater than 767');
				
			} else if($windowsize > 480) {	
				//console.log('window is greater than 480');
				
			}*/
		}
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);

		//Load init first time
		init(el);
			
		function init(element) {
		
			$(element).each(function(index, obj) { //Adding return allows for chainability - this isnt always neccesary if chaining is not required
		
				var $obj = $(obj);
			
				//dynamically position span tag
				var $span = $(this).find("span");
				var $spanWidth = $(this).find(".hover_image").width();
				console.log('$spanWidth = ' + $spanWidth);
				var $spanHeight = $(this).find(".hover_image").height();
				
				var spanStyles = {
					width : $spanWidth,
					height: $spanHeight
				};
				
				$span.css(spanStyles);
				
				//dynamically position icon
				var $icon = $(this).find(".icon_hover");
				
				var iconStyles = {
					left : ($spanWidth / 2) - ($icon.width() / 2),
					bottom: 0 - $icon.height()
				};
				
				$icon.css(iconStyles);
				
				//fade or slide setup
				if(settings.slideType == 'fade'){
								
					//reposition the span tag
					$span.css('opacity', 0);
					
				}
				
				if(settings.slideType == 'slide'){
								
					//reposition the span tag
					var y_height = $obj.height()
					$span.css('bottom', -y_height);
					
				}
				
				$obj.hover(function() {
	
					switch(settings.slideType){
	
						case 'fade' :
							showTile($(this));
						break;
	
						case 'slide' :
							slideTileUp($(this))
						break; 
	
					}
	
				} , function(){
	
					switch(settings.slideType){
	
						case 'fade' :
							hideTile($(this));
						break;
	
						case 'slide' :
							slideTileDown($(this))
						break; 
	
					}
	
				});
	
			});
		
		}// end of init
		
		

		

		function slideTileUp(el){

			$(el).find("span").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: "0px",
				easing:'swing'

			});
			
			var $iconHeight = $(el).find(".icon_hover").height();
			var y_height = (el.height() / 2) - ($iconHeight / 2);
			
			$(el).find(".icon_hover").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: y_height,
				easing:'swing'

			}, 800);

		}

		function slideTileDown(el){

			var y_height = el.height();

			$(el).find("span").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: -y_height + settings.slideVerticalOffset,
				easing:'swing'

			});
			
			var $iconHeight = $(el).find(".icon_hover").height();
			var y_height = el.height() + $iconHeight;
			
			$(el).find(".icon_hover").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: -y_height,
				easing:'swing'

			}, 800);

		}

		

		function showTile(el){

			$(el).find("span").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				opacity: "1",
				easing:'ease-in'

			}, 550);
			
			var $iconHeight = $(el).find(".icon_hover").height();
			var y_height = (el.height() / 2) - ($iconHeight / 2);
			
			$(el).find(".icon_hover").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: y_height,
				easing:'ease-in'

			}, 550);

		}

		function hideTile(el) {

			$(el).find("span").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				opacity: "0",
				easing:'ease'

			}, 550);
			
			var $iconHeight = $(el).find(".icon_hover").height();
			var y_height = el.height() + $iconHeight;
			
			$(el).find(".icon_hover").stop().animate({

				//width: x_width, //Animate the width of ths <span> based on the x_width variable
				bottom: -y_height,
				easing:'ease-in'

			}, 550);

		}

	}//hoverTile plugin end

})(jQuery);//end of wrapper function





