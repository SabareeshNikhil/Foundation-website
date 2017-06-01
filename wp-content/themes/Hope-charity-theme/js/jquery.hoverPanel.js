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

	$.PMHoverPanel = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMHoverPanel.defaults = {
		// default panel type
		slideType : 'infoPanel',
		// default animation speed
		animationSpeed : 750,
		//easing method
		easing : 'easeOutCubic',
		//scale
		scale : true,
		//scale value
		scaleValue : 2
	};

	$.PMHoverPanel.prototype = {
		
		_init : function( options ) {
			
			var parent = this;
			
			// options
			this.options = $.extend( true, {}, $.PMHoverPanel.defaults, options );
			
			this.$el.each(function(index, obj) { //Adding return allows for chainability - this isnt always neccesary if chaining is not required
		
				var $obj = $(obj);
				
				if(parent.options.slideType == 'infoPanel' || parent.options.slideType == 'postPanel'){
					
					//add touch support for mobile browsers
					$obj.find('.pm-hover-item-title-panel').bind('touchstart click', function(e){
						e.stopPropagation();
						e.preventDefault();
						parent._clickEvent($obj);
						
					});
					
				}
				
				if(parent.options.slideType == 'galleryPanel'){
					//add touch support for mobile browsers
					$obj.find('.pm-hover-item-img').bind('touchstart click', function(e){
						e.stopPropagation();
						e.preventDefault();
						parent._clickEvent($obj);
					});
				}
											
				$obj.hover(function() {
	
					switch(parent.options.slideType){
	
						case 'infoPanel' :
							parent._showPanelInfo($(this));
						break;
						
						case 'infoPanelExcerpt' :
							parent._showPanelInfoExcerpt($(this));
						break;
						
						case 'eventPanel' :
							parent._showEventInfo($(this));
						break;						
	
						case 'postPanel' :
							parent._showPostInfo($(this));
						break; 
						
						case 'galleryPanel' :
							parent._showGalleryInterface($(this));
						break; 
						
						case 'imagePanel' :
							parent._showImagePanelOverlay($(this));
						break;
	
					}
	
				} , function(){
	
					switch(parent.options.slideType){
	
						case 'infoPanel' :
							parent._hidePanelInfo($(this));
						break;
						
						case 'infoPanelExcerpt' :
							parent._hidePanelInfoExcerpt($(this));
						break;
						
						case 'eventPanel' :
							parent._hideEventInfo($(this));
						break;
	
						case 'postPanel' :
							parent._hidePostInfo($(this));
						break; 
						
						case 'galleryPanel' :
							parent._hideGalleryInterface($(this));
						break; 
						
						case 'imagePanel' :
							parent._hideImagePanelOverlay($(this));
						break;
	
					}
	
				});
	
			});
						
		},
		
		_clickEvent : function(el) {
			
			var parent = this;
			var $obj = $(el);
						
			//Show panel only
			switch(parent.options.slideType){
	
				case 'infoPanel' :
					parent._showPanelInfo($obj);
				break;

				case 'postPanel' :
					parent._showPostInfo($obj);
				break; 
				
				case 'galleryPanel' :
					parent._showGalleryInterface($obj);
				break; 
				
				case 'imagePanel' :
					parent._showImagePanelOverlay($obj);
				break;

			}
			
			
		},
		
		//Regular Panels
		_showPanelInfo : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var panelTitleHeight = $panelTitle.height();
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			
			$panelTitle.stop().animate({
				'bottom' : -panelTitleHeight - 25
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 0
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			

		},

		_hidePanelInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('.pm-hover-item-img');
			
			var $panelImg = $this.find('img');

			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}

		},
				
		//Post Panels
		_showPostInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $postDetails = $this.find('.pm-news-post-item-details');
			var $postImg = $this.find('img');
			
			$postDetails.stop().animate({
				'bottom' : 0,
				'opacity' : '.85'
			}, parent.options.animationSpeed, parent.options.easing);
			
			$postImg.stop().animate({
				'opacity':'0.85',
			});
			
			if(parent.options.scale === true){
				$postImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			
			
			

		},

		_hidePostInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $postDetails = $this.find('.pm-news-post-item-details');
			var $postImg = $this.find('img');
			
			$postDetails.stop().animate({
				'bottom' : '-300px',
				'opacity' : '1'
			}, parent.options.animationSpeed, parent.options.easing);
			
			$postImg.stop().animate({
				'opacity':'1',
			});
			
			if(parent.options.scale === true){
				$postImg.css({
					'transform' : 'scale(1, 1)',
				});
			}
			

		},
		
		//Gallery Panels
		_showGalleryInterface : function(el) {
			
			var parent = this;
			
			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			var $galleryInterface = $this.find('.pm-hover-item-gallery-interface');
			var maxHeight = $galleryInterface.height();
			//console.log(maxHeight);
			
			$panelDetails.stop().animate({
				'top' : panelHeight - maxHeight
			}, parent.options.animationSpeed, parent.options.easing);
			
			if( !$panelImg.hasClass('noscale') ){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			
			
		},
		
		_hideGalleryInterface : function(el) {
			
			var parent = this;
			
			var $this = el;
			
			//var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelHeight);
			
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			var $galleryInterface = $this.find('.pm-hover-item-gallery-interface');
			var maxHeight = $galleryInterface.height();
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}
			
		},
		
		_showImagePanelOverlay : function(el){
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			var $icon = $this.find('.pm-hover-item-icon');
			var iconStyles = {
				left : (panelWidth / 2) - ($icon.width() / 2),
				top: 0 + (panelHeight / 2) - ($icon.width() / 2)
			};
				
			$icon.css(iconStyles);
			
			$icon.fadeIn('slow');
						
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-hover-item-details');
			$panelDetails.stop().animate({
				'top' : 0
			}, parent.options.animationSpeed, parent.options.easing);
			
			var $panelImg = $this.find('img');
			$panelImg.stop().animate({
				'opacity' : .7
			}, parent.options.animationSpeed, parent.options.easing);
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			
		},
		
		_hideImagePanelOverlay : function(el){
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $icon = $this.find('.pm-hover-item-icon');
			$icon.fadeOut('slow');
			
			var $panelDetails = $this.find('.pm-hover-item-details');
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);

			var $panelImg = $this.find('img');

			$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}
			
		},
		
		
		_showEventInfo : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var panelTitleHeight = $panelTitle.height();
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			//var $eventInfo = $this.find('.pm-hover-item-event-info');
			
			$panelTitle.stop().animate({
				'bottom' : -panelTitleHeight - 25
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0 //slides down
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelImg.stop().animate({
				'opacity' : 0.6
			}, parent.options.animationSpeed, parent.options.easing);
			
			/*$eventInfo.stop().animate({
				'top' : 0 //slides down
			}, parent.options.animationSpeed, parent.options.easing * 4);*/

			/*$panelImg.stop().animate({
				'opacity' : 0
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			

		},

		_hideEventInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			//var $eventInfo = $this.find('.pm-hover-item-event-info');

			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);
			
			/*$eventInfo.stop().animate({
				'top' : -panelHeight
			}, parent.options.animationSpeed, parent.options.easing * 4);*/

			/*$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}

		},
		
		//Post with excerpts
		_showPanelInfoExcerpt : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var panelTitleHeight = $panelTitle.height();
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			
			$panelTitle.stop().animate({
				'bottom' : -panelTitleHeight - 25
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 0
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			

		},

		_hidePanelInfoExcerpt : function(el) {

			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('.pm-hover-item-img');
			
			var $panelImg = $this.find('img');

			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}

		},
		
		
		_checkWidth : function() {
			
			var parent = this;
						
			setTimeout(function() {
				
			}, 10);
			
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

	$.fn.PMHoverPanel = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMHoverPanel' );
				if ( !instance ) {
					logError( "cannot call methods on PMHoverPanel prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMHoverPanel instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMHoverPanel' );
				if ( instance ) {
					console.log('init');
					//instance._init();
					instance = $.data( this, 'PMHoverPanel', new $.PMHoverPanel( options, this ) );
				}
				else {
					instance = $.data( this, 'PMHoverPanel', new $.PMHoverPanel( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );