/**
 * jquery.hoverPanel.js v1.0.0
 * http://www.pulsarmedia.ca
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Micro Themes
 * http://www.pulsarmedia.ca
 */
;( function( $, window, undefined ) {

	'use strict';

	// global
	var Modernizr = window.Modernizr;
			
	//cache DOM objects
	var object = null;

	$.PMToolTip = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMToolTip.defaults = {
		// default panel type
		floatType : 'float',
	};

	$.PMToolTip.prototype = {
		
		_init : function( options ) {
			
			var parent = this;
			
			var windowWidth = $(window).width();
						
			// options
			this.options = $.extend( true, {}, $.PMToolTip.defaults, options );
			
			this.$el.each(function( key, value ) {
								
				var $obj = $(this);
				
				$obj.hover(function(e) {
																
					var $this = $(this);
					var title = $this.attr('title');
					
					if(title != '' && windowWidth > 480){
						//console.log(title);
						parent._addToolTip(title, $this);
					};
					
					
				}, function(e){
					
					var $this = $(this);
					var title = $this.attr('title');
					
					if(title != '' && windowWidth > 480){
						//console.log(title);
						//remove tooltip
						$("#pm_marker_tooltip").remove();
					};
					
				});
				
			});
						
		},
		
		_addToolTip : function(toolTipData, el) {
			
			var parent = this;
			
			var $el = $(el);
										
			$("body").append("<div id='pm_marker_tooltip'>"+ toolTipData +"</div>");								 
			$("#pm_marker_tooltip")
				.css("top",($el.pageY - xOffset) + "px")
				.css("left",($el.pageX + yOffset) + "px")
				.fadeIn("fast");
				
			var yOffset = $("#pm_marker_tooltip").height() + 30;
			var xOffset = -$("#pm_marker_tooltip").width() - 20;
			
			if(parent.options.floatType == 'float'){
				
				$($el).mousemove(function(e){
								
					var mouseX = e.pageX;
					var mouseY = e.pageY;
					//console.log(yOffset);
					$('#pm_marker_tooltip').css("top",(mouseY - yOffset) + "px").css("left",(mouseX + xOffset) + "px");	
									
				});	
				
			}
			
			if(parent.options.floatType == 'static'){
				var tipWidth = $("#pm_marker_tooltip").width();
				$('#pm_marker_tooltip').css("top", $el.position().top + ($el.height() + 20) ).css("left",$el.position().left - tipWidth);	
			}

		},
		
		destroy : function() {

			if( this.itemsCount > 1 ) {
				this.$navPrev.parent().remove();
				
				if(this.options.controlNav == true){
					this.$navDots.parent().remove();
				} else if(this.options.controlNav == 'thumbnails'){
					this.$navThumbs.parent().remove();
				} else {
					//default
				}
				
			}
			this.$list.css( 'width', 'auto' );
			if( this.support ) {
				this.$list.css( 'transition', 'none' );
			}
			this.$items.css( 'width', 'auto' );

		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.PMToolTip = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMToolTip' );
				if ( !instance ) {
					logError( "cannot call methods on PMToolTip prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMToolTip instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMToolTip' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'PMToolTip', new $.PMToolTip( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );