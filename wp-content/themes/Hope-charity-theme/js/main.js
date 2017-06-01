(function($) {
	
	'use strict';
	
	var activeMap = '',
	latLong = '';
		
	$(document).ready(function(e) {
		
		//used for quick nav toggle
		var navHeight =  $('header').outerHeight(); //outerHeight gets height with padding
		var quickNavActive = false;
				
		// fade in #back-top
		$(window).scroll(function () {
			
			//toggle back to top btn
			if ($(this).scrollTop() > 50) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
			
			//quick nav toggle
			if ($(this).scrollTop() > navHeight + 50) {
				
				if(!quickNavActive){
					quickNavActive = true;
					quickNavToggle('show');
				}
				
			} else if($(this).scrollTop() < navHeight + 50){
				if(quickNavActive){
					quickNavActive = false;
					quickNavToggle('hide');
				}
			}
			
		});
		
		
			
		//product switcher
		if( $('#pm-product-switcher').length > 0 ){
			
			var switcherActive = false,
			$switcher = $('#pm-product-switcher');
			
			$('#pm-product-switcher-btn').click(function(e) {
				
				var $this = $(this);
				
				if(!switcherActive){
					
					switcherActive = true;
					$switcher.css({
						'bottom' : '0px'	
					});
					
					$this.addClass('pm-switcher-active');
					
				} else {
					switcherActive = false;
					$switcher.css({
						'bottom' : '-234px'	
					});	
					$this.removeClass('pm-switcher-active');
				}
				
			});
			
		}
		
		
	/* ==========================================================================
	   Homepage slider
	   ========================================================================== */
		if($('#pm-slider').length > 0){
												
			$('#pm-slider').PMSlider({
				speed : wordpressOptionsObject.slideSpeed, //get parameter fron wp
				easing : 'ease',
				loop : wordpressOptionsObject.slideLoop == 'true' ? true : false, //get parameter fron wp
				controlNav : wordpressOptionsObject.enableControlNav == 'true' ? true : false, //false = no bullets / true = bullets / 'thumbnails' activates thumbs //get parameter fron wp
				controlNavThumbs : true,
				animation : wordpressOptionsObject.animtionType, //get parameter fron wp
				fullScreen : false,
				slideshow : wordpressOptionsObject.enableSlideShow == 'true' ? true : false, //get parameter fron wp
				slideshowSpeed : wordpressOptionsObject.slideShowSpeed, //get parameter fron wp
				pauseOnHover : wordpressOptionsObject.pauseOnHover == 'true' ? true : false, //get parameter fron wp
				arrows : wordpressOptionsObject.showArrows == 'true' ? true : false, //get parameter fron wp
				fixedHeight : false,
				//fixedHeightValue : wordpressOptionsObject.sliderHeight,
				touch : true,
				progressBar : false
			});
			
		}
		
		
		/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').click(function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height();
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 80 
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
	   }
	   
	/* ==========================================================================
	   Isotope activation
	   ========================================================================== */
		if($('#pm-isotope-item-container').length > 0){
			//initialize isotope
			$('#pm-isotope-item-container').isotope({
			  // options
			  itemSelector : '.pm-isotope-item',
			  layoutMode : 'fitRows',
			});	
		}
	   
	/* ==========================================================================
	   Isotope filter activation
	   ========================================================================== */
		$('.pm-isotope-filter-system').children().each(function(i,e) {
						
			if(i > 0){
				
				delay(e, 1);
				$(e).css({
					'visibility' : 'visible'	
				});
				//add click functionality
				$(e).find('a').click(function(e) {
					
					e.preventDefault();
										
					$('.pm-isotope-filter-system').children().find('a').removeClass('current');
					$(this).addClass('current');
					
					var id = $(this).attr('id');
					$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
					
					
					if( $(window).width() < 760 ){
						//Capture parent li index for list reordering
						var listItem = $(this).closest('li');
						var listItemIndex = $(this).closest('li').index();
						console.log( "Index: " +  listItemIndex );
						
						//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
						
						$('.pm-isotope-filter-system').find("li").eq(0).after(listItem);
					}
										
				});
				
			}
						
			
		});
		
		var offset = 50;
		
		//must be declared at top level or immediately after a function call in "strict mode"
		function delay(element, opacity) {
			setTimeout(function(){
				$(element).animate({
					opacity: opacity, 
				}, 150);
			}, $(element).index() * offset)
		}
		
	/* ==========================================================================
	   Gallery item
	   ========================================================================== */
	   if( $('.pm-gallery-item-container').length > 0 ){
			methods.bindGalleryItemEvents();   
	   }
		
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
		//print page btn
		if( $('#pm-print-btn').length > 0 ){
			
			var printBtn = $('#pm-print-btn');
		
			printBtn.click(function() {
				window.print();
				return false;	
			});
			
		}
		
		//Append nav icons
		$('#pm_nav').children().each(function(index, element) {
            
			var aTag = $(element).find('a');
			
			if(aTag.attr('title') == 'cart-icon'){
				aTag.find('span').hide().addClass('pm-sf-menu-span-hidden');
				aTag.append('<i class="fa fa-shopping-cart"></i>');
			}
			
			
        });	
		
		//Woocommerce prouduct rollovers
		$('.pm-product-img-hover-container').on('mouseover mouseout click', function(e) {
			//console.log();
			
			var $this = $(this);
			
			if( e.type == 'mouseover' || e.type == 'onclick' ){
				$this.find('.pm-product-img-hover-icon').stop().animate({
					opacity : 1	
				}, 300);
				
				$this.find('img').stop().animate({
					opacity : .2	
				}, 300);
			}
			
			if( e.type == 'mouseout' ){
				$this.find('.pm-product-img-hover-icon').stop().animate({
					opacity : 0	
				}, 300);
				
				$this.find('img').stop().animate({
					opacity : 1	
				}, 300);
			}			
			
		});
		
		//Woocommerce add to cart icon
		$('.pm-add-to-cart-btn').on('click', function(e) {
			
			var $this = $(this);
			
			var productID = $this.data('product_id');
			
			var post = '.post-' + productID;
			$(post).find('.pm-added-to-cart-icon').addClass('in_cart');
			
		});
		
		
		//Woocommerce Star rating
		if( $('.comment-form-rating').length > 0 ){
			
			$('.comment-form-rating .stars span a').append('<i class="fa fa-star"></i>');
			
			$('.comment-form-rating .stars span a').on('click mousedown', function(e) {
				
				e.preventDefault();
				
				var $this = $(this);
				
				//remove previous active attribute to all a tags so we dont catch it
				$('.comment-form-rating .stars span a').removeClass('active');
				$('.comment-form-rating .stars span a i').removeClass('activated');
				
				var className = $this.attr('class');
				var currentStarIndex = className.substring(className.lastIndexOf("-") + 1);
				//console.log("currentStarIndex = " + currentStarIndex);
				
				for( var i = 0; i <= currentStarIndex; i++){
					
					var $currStar = '.star-' + i;
					$($currStar).find('i').addClass('activated');
					
				}
				
			});
			
		}
		
		//Woocommerce Star rating widget
		if( $('.widget_recent_reviews').length > 0 ){
			
			$('.widget_recent_reviews .product_list_widget li').each(function(index, element) {
                
				var $ratingDiv = $(element).find('.star-rating');
				var rating = $(element).find('.star-rating span strong').html();
				
				$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-'+index+'"></ul>');
				
				for (var i = 1; i <= 5; i++) {
										
					if( i > parseInt(rating) ){
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star inactive"></i></li>');
					} else {
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star"></i></li>');
					}
										
				}
				
            });
						
		}
		
		
		//Woocommerce product details page star rating
		if( $('.woocommerce-product-rating').length > 0 ){
			
			var $ratingDiv = $('.woocommerce-product-rating').find('.star-rating');
			
			var rating = $ratingDiv.find('span strong').html();
			
			$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-single"></ul>');
			
			for (var i = 1; i <= 5; i++) {
									
				if( i > parseInt(rating) ){
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star inactive"></i></li>');
				} else {
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star"></i></li>');
				}
									
			}
						
		}
		
		//Woocommerce Shop page fliter menu
		if($('.pm-dropdown.pm-shop-filter-menu').length > 0){
			$('.pm-dropdown.pm-shop-filter-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
		//staff fliter menu
		if($('.pm-dropdown.pm-staff-menu').length > 0){
			$('.pm-dropdown.pm-staff-menu').on('mouseover', methods.dropDownStaffMenu).on('mouseleave', methods.dropDownStaffMenu);
   			$('.pm-dropdown.pm-staff-menu a').on('click', methods.dropDownStaffClick);
		}
		
		//staff
		if($('#pm-isotope-organizers-container').length > 0){
			//initialize isotope
			$('#pm-isotope-organizers-container').isotope({
			  // options
			  itemSelector : '.pm-isotope-organizer-item',
			  layoutMode : 'fitRows'
			});	
		}
			
		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		//accordion menu
		//check if tab accordion exists first
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
			$('.pm-tab-content div:first-child').addClass('active');
		}
		
	/* ==========================================================================
	   Initialize PrettyPhoto
	   ========================================================================== */
		methods.loadPrettyPhoto();
		
	/* ==========================================================================
	   Conact page google map interaction
	   ========================================================================== */
	   if( $(".pm-google-map-container").length > 0 ){
		   
		   $( '.pm-google-map-container' ).each(function(index, element) {
				
				var $this = $(element),
				container = $this.find('.pm-googleMap'),
				id = container.attr('id'),
				mapType = container.data('mapType'),
				zoom = container.data('mapZoom'),
				latitude = container.data('latitude'),
				longitude = container.data('longitude'),
				message = container.data('message');
												
				methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
			
        	}); 
			
	   }
		
	/* ==========================================================================
	   Google map reset for tabs
	   ========================================================================== */
		if( $('.pm-nav-tabs').length > 0){
			
			$('.pm-nav-tabs').children().find('a').click(function(e) {
				
				var targetId = $(this).attr('href');
				
				var targetMap = $(targetId).find('.googleMap');
				
				if(targetMap.length > 0){
					
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
					
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(this).on('shown.bs.tab', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				//alert();
				
			});
			
		}
					
		//search fields				
		if( $('#searchsubmit').length > 0 ){
			
			var searchsubmit = $('#searchsubmit'), 
			searchForm = $('#searchform');
			
			searchsubmit.on('click', function(e) {
								
				e.preventDefault();
				searchForm.submit();
				
			});
			
		}
		
		if( $('#searchsubmit-widget').length > 0 ){
			
			var searchsubmitWidget = $('#searchsubmit-widget'), 
			searchFormWidget = $('#searchform-widget');
			
			searchsubmitWidget.on('click', function(e) {
								
				e.preventDefault();
				searchFormWidget.submit();
				
			});
			
		}
		
		
		
		//superfish activation
		$('#nav, #pm_nav').superfish({
			delay: 0,
			animation: {opacity:'show',height:'show'},
			speed: 300,
			autoArrows: true,
			dropShadows: true
		});
		
		//tinynav activation
		$("#pm_nav").tinyNav();
		$("#pm-footer-nav").tinyNav();
		
		//post interaction check
		if( $('.pm_post').length > 0 ){
			
			if( wordpressOptionsObject.enablePostHover === 'on' ) {
				
				$('.pm-hover-item').PMHoverPanel({
					slideType: 'infoPanel',
					animationSpeed: 600,
					easing : "easeOutCubic",
					scaleValue: wordpressOptionsObject.enablePostZoom === 'on' ? 1.2 : 1,
				});
				
			}
			
		}
		
		//single post interaction check
		if( $('.pm_post_single').length > 0 ){
			
			if( wordpressOptionsObject.enablePostHover === 'on' ) {
				
				$('.pm-hover-item').PMHoverPanel({
					slideType: 'infoPanel',
					animationSpeed: 600,
					easing : "easeOutCubic",
					scaleValue: wordpressOptionsObject.enablePostZoom === 'on' ? 1.2 : 1,
				});
				
			}
			
			
			
		}
		
		//activate sponsors carousel
		if( $("#pm_sponsors_carousel").length > 0 ) {
			
			var owl = $("#pm_sponsors_carousel");
			var isPlaying = true;
		   
		    owl.owlCarousel({
				
				items : 4, //10 items above 1000px browser width
				itemsDesktop : [5000,4],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				autoPlay: true,
				
		   });
			
			// Custom Navigation Events
			$(".pm-owl-next").click(function(){
				owl.trigger('owl.next');
			})
			$(".pm-owl-prev").click(function(){
				owl.trigger('owl.prev');
			})
			
				
			$("#pm-owl-play").click(function(){
				
				if(!isPlaying){
					isPlaying = true;
					$(this).removeClass('fa fa-play').addClass('fa fa-stop');
					owl.trigger('owl.play',3000); //owl.play event accept autoPlay speed as second parameter
				} else {
					isPlaying = false;
					$(this).removeClass('fa fa-stop').addClass('fa fa-play');
					owl.trigger('owl.stop');
				}
				
				
			});
			
		};
		
		//organizer interaction check
		if( $('.pm-organizer-activate').length > 0 ){
				$('.pm-hover-item.pm-organizer-activate').PMHoverPanel({
				slideType: 'infoPanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scale : false
			});
		}
		
		//event interaction check
		if( $('.pm-event-activate').length > 0 ){
			
			if( wordpressOptionsObject.enableEventPostHover === 'on' ) {
				
				$('.pm-hover-item.pm-event-activate').PMHoverPanel({
					slideType: 'eventPanel',
					animationSpeed: 600,
					easing : "easeOutCubic",
					scaleValue: wordpressOptionsObject.enableEventPostZoom === 'on' ? 1.2 : 1,
				});
				
			}
		}
		
		//tooltip check
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static').length > 0 ){
			$('.pm_tip_static').PMToolTip({
				floatType : 'static'
			});
		}
		
		//recent posts
		if( $('.pm-hover-item.pm_recent_posts').length > 0 ){
			$('.pm-hover-item.pm_recent_posts').PMHoverPanel({
				slideType: 'infoPanel',
				animationSpeed: 700,
				easing : 'easeOutCubic',
				scaleValue : 1.2
			});
		}
		
		//imagePanel shortcode check
		if( $('.pm-hover-item-image-panel').length > 0 ){
			$('.pm-hover-item-image-panel').PMHoverPanel({
				slideType: 'imagePanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scaleValue : 1.2
			});
		}
		
		//change galleries	
		if( $('#gallery_list').length > 0 ){ 
			$('#gallery_list').bind('change', function () { // bind change event to select
				var url = $(this).val(); // get selected value
				if (url != '') { // require a URL
					window.location = url; // redirect
				}
				return false;
			});
		}
		
		//activate gallery interaction
		if( $('.pm-hover-item.pm-gallery-activate').length > 0 ){ 
			$('.pm-hover-item.pm-gallery-activate').PMHoverPanel({
				slideType: 'galleryPanel',
				animationSpeed: 600,
				easing : "easeOutCubic",
				scaleValue : 1.2
			});
		}
		
		//activate countdown on event page
		if( $('.pm_event_counter').length > 0 ){ 
			var year = pmobject.pmYear;
			var month = pmobject.pmMonth;
			var day = pmobject.pmDay;
			$('.pm_event_counter').ccountdown(year,month,day, '18:00');
		}
		
		//remove empty p tags
		$( 'p:empty' ).remove();
			
	});
		
	$(window).load(function() {
		
		//Ajax Load more
		if($('#pm-load-more').length > 0){
			
			var morebutton = $('#pm-load-more'),
			section = morebutton.attr('rel'),
			container = 'pm-isotope-'+section+'-container',
			btntext = morebutton.find('span').text(),
			page = 1;
								
			morebutton.click(function(e){
				
				e.preventDefault();
				page++; 
				
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pulsar_load_more', nonce:pulsarajax.nonce, page:page, section:section}, function(data){
					
					var content = $(data.content);
					
					$(content).imagesLoaded(function(){
						$('#'+container).append(content).isotope('insert',content); //appended or insert (insert appends and filters the new items)
						//runflexslider();
						morebutton.find('span').text(btntext);
						//morebutton.find('i').removeClass('fa fa-cog fa-spin').addClass('fa fa-cloud-download').css({borderLeft:'1px solid black'});
						
						methods.resetHoverPanels();
						
						/*if(section == 'gallery'){
							//reset prettyPhoto
							methods.loadPrettyPhoto();
						}*/
						
					});
					
					if(page >= data.pages){
						morebutton.fadeOut();
					}
					
				},'json');
				
			});
			
		}
		
	});
	
	function quickNavToggle(status){
		
		var $quickNav = $('#pm-quick-nav');
		var $quickNavHeight = $('#pm-quick-nav').outerHeight();
		
		if(status === 'show'){
			$quickNav.animate({
				'top' : '0px'
			}, 500);
		}
		
		if(status === 'hide'){
			$quickNav.animate({
				'top' : '-'+ $quickNavHeight +'px'
			}, 500);
		}
		
	}
	
	/**** OPTIONS AND METHODS *****/
	
	var options = {
        dropDownSpeed : 100,
        slideUpSpeed : 200,
        slideDownTabSpeed: 50,
        changeTabSpeed: 200,
		activateSearch : false,
		activateMobileSearch : false,
		activateQuickNavSearch : false,
		tinyNavExpanded: false,
    }
	
	var methods = {
		
		dropDownMenu : function(e){  
		
            var body = $(this).find('> :last-child');
            var head = $(this).find('> :first-child');
            
            if (e.type == 'mouseover'){
                body.fadeIn(options.dropDownSpeed);
            } else {
                body.fadeOut(options.dropDownSpeed);
            }
            
        },
		
		dropDownClick : function(e) {
            e.preventDefault();
			
			var $this = $(e.target);
			//alert($this.attr('id'));
			
			//make href call here
			
        },
		
		dropDownStaffMenu : function(e){  
		
            var body = $(this).find('> :last-child');
            var head = $(this).find('> :first-child');
            
            if (e.type == 'mouseover'){
                body.fadeIn(options.dropDownSpeed);
            } else {
                body.fadeOut(options.dropDownSpeed);
            }
            
        },
		
		dropDownStaffClick : function(e) {
			
            e.preventDefault();
			
			
			
			$('.pm-dropmenu-active ul li a').removeClass('active');
			
			var $this = $(e.target);
			$this.addClass('active');
			
			var id = $this.attr('id');

			$('.pm-isotope-organizer-item').each(function(index, element) {
                
				var $e = $(element);
				
				if($e.hasClass(id)){
					console.log('found');
					$('#pm-isotope-organizers-container').isotope({ filter: '.'+$this.attr('id') });
				} else {
					console.log('not found');
				}
				
            });
						
        },
		

				
		detectIPadOrientation : function () {
			if ( orientation == 0 ) {
				//alert ('Portrait Mode, Home Button bottom');
			} else if ( orientation == 90 ) {
				//alert ('Landscape Mode, Home Button right');
			} else if ( orientation == -90 ) {
				//alert ('Landscape Mode, Home Button left');
			} else if ( orientation == 180 ) {
				//alert ('Portrait Mode, Home Button top');
			}
		},
		
		resetHoverPanels : function() {
			
						
			//organizer interaction check
			if( $('.pm-organizer-activate').length > 0 ){
					$('.pm-hover-item.pm-organizer-activate').PMHoverPanel({
					slideType: 'infoPanel',
					animationSpeed: 600,
					easing : "easeOutCubic",
					scale : false
				});
			}
			
		},
		
		initializeGoogleMap : function(id, latitude, longitude, mapZoom, mapType, message) {
				
			  var myLatlng = new google.maps.LatLng(latitude,longitude);
			  latLong = myLatlng;
			  var myOptions = {
				center: myLatlng, 
				zoom: 13,
				mapTypeId: google.maps.MapTypeId.mapType
			  };
			  
			  //alert(document.getElementById(id).getAttribute('id'));
			  
			  //clear the html div first
			  document.getElementById(id).innerHTML = "";
			  
			  var map = new google.maps.Map(document.getElementById(id), myOptions);
			  
			  
	 
			  var contentString = message;
			  var infowindow = new google.maps.InfoWindow({
				  content: contentString
			  });
			   
			  var marker = new google.maps.Marker({
				  position: myLatlng
			  });
			   
			  google.maps.event.addListener(marker, "click", function() {
				  infowindow.open(map,marker);
			  });
			   
			  marker.setMap(map);
			  
			  activeMap = map;
			
		},
		
		bindGalleryItemEvents : function() {
				
			$('.pm-gallery-item-hover-btn').on('click', function(e) {
				
				var $container = $(this).closest('.pm-gallery-item-container'),
				$title = $container.find('.pm-gallery-item-title'),
				$btn = $container.find('.pm-gallery-item-hover-btn'),
				$span = $container.find('span'),
				$caption = $container.find('.pm-gallery-item-caption'),
				$btns = $container.find('.pm-gallery-item-btns'),
				$closeBtn = $container.find('.pm-gallery-item-close');
					
				$title.stop().animate({
					"left" : "-380px"
				}, 450);
				
				$btn.stop().animate({
					"bottom" : "-80px"	
				}, 450);
				
				$span.stop().animate({
					"opacity" : "1"	
				}, 300);
				
				$caption.stop().animate({
					"opacity" : "1"	
				}, 800);
				
				$btns.stop().animate({
					"right" : "20px",
					"opacity" : "1"	
				}, 450);
				
				
				$closeBtn.on('click', function(e) {
					$title.stop().animate({
						"left" : "0px"
					}, 450);
					
					$btn.stop().animate({
						"bottom" : "0px"	
					}, 450);
					
					$span.stop().animate({
						"opacity" : "0"	
					}, 300);
					
					$caption.stop().animate({
						"opacity" : "0"	
					}, 500);
					
					$btns.stop().animate({
						"right" : "-200px",
						"opacity" : "0"	
					}, 450);			
				});
				
			});
			
		},
			
		loadPrettyPhoto : function() {
							
			if( $("a[data-rel^='prettyPhoto']").length > 0 ){
						
				$("a[data-rel^='prettyPhoto']").prettyPhoto({
					animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
					slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
					autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
					opacity: 0.80, /* Value between 0 and 1 */
					show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
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
			
		},
				
		windowResize : function() {
			
			//window resize code
			
			
		},

		
	};
	
})(jQuery);

