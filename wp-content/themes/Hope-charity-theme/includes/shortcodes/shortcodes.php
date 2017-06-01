<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that stray paragraph and line break tags aren't added.
function pm_ln_run_shortcode( $content ) {
    //global $shortcode_tags;
    // Backup current registered shortcodes and clear them all out
    //$orig_shortcode_tags = $shortcode_tags;
    //remove_all_shortcodes();
	
	
	add_shortcode("singlePost", "singlePost"); 	
	add_shortcode("eventPost", "eventPost");	
	add_shortcode("staffItems", "staffItems");//COMPLETE		
	add_shortcode("eventItems", "eventItems");//COMPLETE	
	add_shortcode("staffProfile", "staffProfile");	
	add_shortcode("postItems", "postItems");//COMPLETE	
	
	add_shortcode("tabGroup", "tabGroup");
	add_shortcode("tabItem", "tabItem");
	add_shortcode("accordionGroup", "accordionGroup");
	add_shortcode("accordionItem", "accordionItem");	
	add_shortcode("alert", "alert");	
	add_shortcode("sponsorsCarousel", "sponsorsCarousel");//COMPLETE	
	add_shortcode("callToAction", "callToAction");	
	add_shortcode("divider", "divider");	
	add_shortcode("googleMap", "googleMap");
	add_shortcode("progressBar", "progressBar");	
	add_shortcode("hopeButton", "hopeButton");
	add_shortcode("youtubeVideo", "youtubeVideo");
	add_shortcode("vimeoVideo", "vimeoVideo");			
	add_shortcode("featureBox", "featureBox");//COMPLETE			
	add_shortcode("imagePanel", "imagePanel");		
	add_shortcode("socialGroup", "socialGroup");	
	add_shortcode("socialIcon", "socialIcon");
	add_shortcode("panelHeader", "panelHeader");		
	add_shortcode("featuredPanel", "featuredPanel");	
	
	//Bootstrap 2
	add_shortcode("columnContainer", "columnContainer");
	//add_shortcode("container", "container");
	add_shortcode("column", "column");
	
    // Do the shortcode (only the one above is registered)
    //$content = do_shortcode( $content );
    // Put the original shortcodes back
    //$shortcode_tags = $orig_shortcode_tags;
    return $content;
}
add_filter( 'the_content', 'pm_ln_run_shortcode', 7 );

//SPONSORS CAROUSEL
function sponsorsCarousel($atts, $content = null) {

	extract(shortcode_atts(array(
		"icon" => 'fa fa-thumbs-o-up',
		"controls" => 'true'
		), 
	$atts));
		
	global $hope_options;
	
	$clients = '';
		
	if( isset($hope_options['opt-client-slides']) && !empty($hope_options['opt-client-slides']) ){
		$clients = $hope_options['opt-client-slides']; //This should return an empty array if no slides are present...not an undefined index notice
	}
	
	$targetWindow = $hope_options['opt-sponsor-target-window'];
	$carouselMessage = $hope_options['opt-sponsors-carousel-message'];
	
	$html = '';
	
	if ( is_array($clients) ) {
		
        $html .= '<div id="pm_sponsors_carousel" class="owl-carousel owl-theme"> ';        
            
                foreach( $clients as $c ) {
                
                    $html .= '<div class="pm-carousel-item">'; 
					
                    if($c['url'] != '') {
						
                        $html .= '<a href="'. esc_url($c['url']) .'" '. ($c['description'] !== '' ? 'class="pm_tip" title="'. esc_attr($c['description']) .'"' : '') .'" target="'. esc_attr($targetWindow) .'"><img src="'. esc_url($c['image']) .'" alt="'. esc_attr($c['title']) .'" /></a>';
                        
                    } else {
						
                        $html .= '<img src="'. esc_url($c['image']) .'" '. ($c['description'] !== '' ? 'class="pm_tip" title="'. esc_attr($c['description']) .'"' : '') .' alt="'. esc_attr($c['title']) .'" />';
						
                    }
                    
                     $html .= '</div>';
                
                }//end of foreach
        
         $html .= '</div>';
		 
		 if($controls === 'true') {
			 
			 $html .= '<div class="pm-brand-carousel-btns">';
				$html .= '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
				$html .= '<a class="btn pm-owl-play fa fa-stop" id="pm-owl-play"></a>';
				$html .= '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
			 $html .= '</div>';
			 
		 }	 
		 
		 
    }
	
	if($carouselMessage !== '') :
	
		$html .= '<div class="pm_sponsors_title">';
		
			$html .= esc_attr($carouselMessage) ;
			
		$html .= '</div>';
	
	endif;
	
	
		
	return $html;
	
}

//FEATURE BOX
function featureBox($atts, $content = null) {

	extract(shortcode_atts(array(
		"icon" => 'fa fa-thumbs-o-up',
		"icon_image" => '',
		"icon_color" => '#ffffff',
		"title_color" => '#ffffff',
		"title" => 'Title goes here',
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="feature-box">';
	
		if($icon_image !== ''){
			$html .= '<img alt="'.$title.'" src="'.$icon_image.'">';
		} else {
			$html .= '<i class="'.$icon.'" style="color:'.$icon_color.';"></i>';	
		}
		
		$html .= '<div class="content">';
			$html .= '<h5 style="color:'.$title_color.';">'.$title.'</h5>';
			$html .= do_shortcode($content);
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}


//STAFF ITEMS
function staffItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"order" => 'ASC',
		"organiser_title" => '',
		), 
	$atts));
	
	if( $organiser_title !== '' ){
		
		//Fetch organizers by title
		$arguments = array(
			'post_type' => 'post_organizers',
			'post_status' => 'publish',
			'order' => $order,
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
			'tax_query' => array(
					array(
						'taxonomy' => 'organizer_item_types',
						'field' => 'slug',
						'terms' => array( $organiser_title )
					)
			),
		);
		
	} else {
		
		//Fetch all organizers
		$arguments = array(
			'post_type' => 'post_organizers',
			'post_status' => 'publish',
			'order' => $order,
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
		);
		
	}
	
	$post_query = new WP_Query($arguments);
	pm_hope_set_query($post_query);
	
	$html = '';
	
	$html .= '<div class="row">';
	
	if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
	
		$organizerTitle = get_post_meta(get_the_ID(), 'pm_organizer_title_meta', true);
        $organizerTip = get_post_meta(get_the_ID(), 'pm_organizer_tooltip_meta', true); 
		
		$html .= '<div class="span4 pm-event-post-shortcode-overflow">';

			$html .= '<div class="pm_span_header pm_organizer">';
				$html .= '<h4>';
					$html .= '<span>'. get_the_title() .'</span>';
					if($organizerTip !== '') {
						$html .= '<a class="fa fa-user pm_tip" title="'. esc_attr($organizerTip) .'" href="'. get_the_permalink() .'"></a>';
					} else { 
						$html .= '<a class="fa fa-user" href="'. get_the_permalink() .'"></a>';
					}
					
				$html .= '</h4>';
			$html .= '</div>';
			
			$html .= '<div class="pm-hover-item pm-organizer-activate">';
				$html .= '<div class="pm-hover-item-title-panel">';
					$html .= '<a class="fa fa-location-arrow pm_float_right" href="#"></a>';
					$html .= '<p>'. esc_attr($organizerTitle) .'</p>';
				$html .= '</div>';
				$html .= '<div class="pm-hover-item-details">';
					$html .= '<div class="pm-hover-item-spacer">';
						$html .= '<p>';
						  $excerpt = get_the_excerpt();
						  $html .= pm_hope_string_limit_words($excerpt,50) .'...'; 						
						$html .= '</p>';
						$html .= '<p><a href="'. get_the_permalink() .'">'. esc_attr__('View full profile','localization') .' &raquo;</a></p>';						
					$html .= '</div>';
				$html .= '</div>';
				$html .= '<div class="pm-hover-item-img">';					
					$html .= get_the_post_thumbnail( get_the_ID() );					
				$html .= '</div>';
			$html .= '</div>';
			
		$html .= '</div>';
	
	endwhile; else:
		$html .= '<div class="span12">';
		 $html .= '<p>'. esc_attr__('No staff posts were found.', 'localization') .'</p>';
		$html .= '</div>';
	endif;
	
    $html .= '</div>';
	
	pm_hope_restore_query();
	
	return $html;
	
}




//EVENT ITEMS
function eventItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '2',
		"order" => 'ASC',
		"category" => '',
		), 
	$atts));
	
	
	if( $category !== '' ){
		
		//Fetch events by category
		$arguments = array(
			'post_type' => 'post_events',
			'post_status' => 'publish',
			'orderby' => 'meta_value',
			'meta_key' => 'eventDate',
			'order' => $order,
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
			'tax_query' => array(
					array(
						'taxonomy' => 'event_categories',
						'field' => 'slug',
						'terms' => array( $category )
					)
			),
		);
		
	} else {
		
		//Fetch all events
		$arguments = array(
			'post_type' => 'post_events',
			'post_status' => 'publish',
			'orderby' => 'meta_value',
			'meta_key' => 'eventDate',
			'order' => $order,
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
		);
		
	}


	$post_query = new WP_Query($arguments);

	pm_hope_set_query($post_query);
	
	$html = '';
	
	//$html .= '<div class="container pm_paddingVertical60 pm_event_post">';
		$html .= '<div class="row">';
	
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
			
				$eventDate = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
				$month = date("M", strtotime($eventDate));
				$day = date("d", strtotime($eventDate));
				$year = date("Y", strtotime($eventDate));
				$countdown = get_post_meta(get_the_ID(), 'pm_event_countdown_meta', true);
				$eventTip = get_post_meta(get_the_ID(), 'pm_event_tooltip_meta', true);
				$eventIconFile = get_post_meta(get_the_ID(), 'pm_event_icon_meta', true);
				$eventIcon = $eventIconFile === '' ? 'fa fa-calendar' : $eventIconFile;
				
				$html .= '<div class="span6 pm-event-post-shortcode-overflow">';
					$html .= '<div class="pm_span_header pm_event">';
						$html .= '<h4>';
							$html .= '<span>'. get_the_title() .'</span>';
							 if($eventTip !== '') {
								$html .= '<a class="'. esc_attr($eventIcon) .' pm_tip" title="'. esc_attr($eventTip) .'" href="'. get_the_permalink() .'"></a>';
							 } else { 
								$html .= '<a class="'. esc_attr($eventIcon) .'" href="'. get_the_permalink() .'"></a>';
							 } 							
						$html .= '</h4>';
					$html .= '</div>';					
					$html .= '<div class="pm-hover-item pm-event-activate">';
						$html .= '<div class="pm-hover-item-title-panel">';
							$html .= '<a class="fa fa-location-arrow pm_float_right" href="#"></a>';
							$html .= '<p><b>'. esc_attr__('Organizer', 'localization') .':</b> '. get_the_author() .'</p>';
						$html .= '</div>';
						$html .= '<div class="pm-hover-item-details">';
							$html .= '<div class="pm-hover-item-spacer">';
								$html .= '<ul class="pm-event-info-ul-date">';
									$html .= '<li><strong>'.  esc_attr($day) .'</strong></li>';
									$html .= '<li><p>'.  esc_attr($month) .'</p></li>';
									$html .= '<li class="visible-phone" style="margin-top:15px;"><a href="'. get_the_permalink() .'">'. esc_attr__('View Event','localization') .' &raquo;</a></li>';
								$html .= '</ul>';
								$html .= '<div class="pm-event-info-excerpt">';
									$html .= '<p>';
									$excerpt = get_the_excerpt();
									  $html .= pm_hope_string_limit_words($excerpt,50) .'...'; 
									
									$html .= '</p>';
									$html .= '<p><a href="'. get_the_permalink() .'">'. esc_attr__('View Event','localization') .' &raquo;</a></p>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
						$html .= '<div class="pm-hover-item-img">';					
							$html .= get_the_post_thumbnail( get_the_ID() );						
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';				
			
			endwhile; else:
				$html .= '<div class="span12">';
				 $html .= '<p>'.esc_attr__('No event posts were found.', 'localization').'</p>';
				$html .= '</div>';
			endif;
	
		$html .= '</div>';
	//$html .= '</div>';
				
	pm_hope_restore_query();
	
	return $html;
	
}

//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '2',
		"order" => 'ASC',
		), 
	$atts));
	
	//Fetch data
	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'order' => $order,
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $num_of_posts,
		//'tag' => get_query_var('tag')
	);

	$post_query = new WP_Query($arguments);

	$displaySocialMeta = get_theme_mod('displaySocialMeta', 'on');
	$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');
	$displayExcerptOnMeta = get_theme_mod('displayExcerptOnMeta', 'off');
	
	$html = '';
	
	//Display Items
		
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
			$postIconFile = get_post_meta(get_the_ID(), 'pm_post_icon_meta', true);
			$postDate =  mysql2date('l, F j, Y', get_the_date());
			
			$postTip = get_post_meta(get_the_ID(), 'pm_post_tooltip_meta', true);
			$postIconSaved = get_post_meta(get_the_ID(), 'pm_post_icon_meta', true);
			$postIcon = $postIconSaved != '' ? $postIconSaved : 'fa fa-link';
			
			$html .= '<div class="span4 pm-post-item-shortcode">';
			
				$html .= '<div class="pm_span_header pm_post_single">';
				$html .= '<h4>';
				
				$html .= '<span>'.get_the_title().'</span>';
				
				if( $postTip !== '' ){
					$html .= '<a class="'.$postIcon.' pm_tip" title="'.$postTip.'" href="'.get_the_permalink().'"></a>';
				} else {
					$html .= '<a class="'.$postIcon.'" href="'.get_the_permalink().'"></a>';
				}				
				
				$html .= '</h4>';
				$html .= '</div>';
				
				$html .= '<div class="pm-hover-item">';
				
					$html .= '<div class="pm-hover-item-title-panel">';
					$html .= '<a class="icon-location-arrow pm_float_right pm_panel_touch_btn"></a>';
					
					$html .= '<p><b>'. esc_attr__('Posted', 'localization') .'</b> '.$postDate.'<b> '. esc_attr__('by', 'localization') .'</b> '.get_the_author().'</p>';
					
					if( $displayExcerptOnMeta === 'on' ){
						$html .= '<p>'. pm_hope_string_limit_words(get_the_excerpt(), 12) .'...</p>';
					}					
					
					$html .= '</div>';
					
					$html .= '<div class="pm-hover-item-details">';
						$html .= '<div class="pm-hover-item-spacer">';
							$html .= '<p>'.pm_hope_string_limit_words(get_the_excerpt(), 30).'...</p>';
							$html .= '<a href="'.get_the_permalink().'">'. esc_attr__('Read More', 'localization') .' &raquo;</a>';
							
							if( $displayCommentsCount === 'on' ) {
							
								$html .= '<div class="pm_post_tags">';
								$html .= '<i class="fa fa-comment"></i> '.get_comments_number().' '. esc_attr__('comments', 'localization') .'';	
								$html .= '</div>';
							
							} else {
								
								$html .= '<div class="pm_post_tags" style="margin-bottom:0px;">';
								$html .= '</div>';	
								
							}		
							
							if( $displaySocialMeta === 'on' ) :
																					
								$html .= '<ul class="pm-post-social-icons">';
								
									$html .= '<li class="twitter">';
									$html .= '<a target="_blank" href="http://twitter.com/home?status='.urlencode(get_the_title()).'"><i class="fa fa-twitter"></i></a>';
									$html .= '</li>';
									
									$html .= '<li class="facebook">';
									$html .= '<a target="_blank" href="http://www.facebook.com/share.php?u='.urlencode(get_the_permalink()).'"><i class="fa fa-facebook"></i></a>';
									$html .= '</li>';
									
									$html .= '<li class="linkedin">';
									$html .= '<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_the_permalink()).'&amp;title='.urlencode(get_the_title()).'&amp;summary='.urlencode(get_the_excerpt()).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
									$html .= '</li>';
									
									$html .= '<li class="gplus">';
									$html .= '<a href="https://plus.google.com/share?url='.urlencode(get_the_permalink()).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
									$html .= '</li>';
								
								$html .= '</ul>';
							
							endif;							
						
						$html .= '</div>';
					$html .= '</div>';
					
					$html .= '<div class="pm-hover-item-img">';		
								
					if( has_post_thumbnail() ) :
						
						$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
						$image = wp_get_attachment_image( $post_thumbnail_id, 'full-width' );
						
						$html .= $image;
												
					endif;					
					
					$html .= '</div>';
					
				$html .= '</div>';
			
			$html .= '</div>';
		
			
					
		endwhile; else:
			$html .= '<div class="span12">';
			 $html .= '<p>'.esc_attr__('No posts were found.', 'localization').'</p>';
			$html .= '</div>';
		endif;
	
				
	wp_reset_postdata();
	
	return $html;
		
}


//STAFF PROFILE
function staffProfile( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"post_id" => '',
		"icon" => 'fa fa-user'
		), 
	$atts));
	
	//Method to retrieve a single post
	$queried_post = get_post($post_id);
	$postID = $queried_post->ID;
	$postLink = get_permalink($postID);
	$postTitle = $queried_post->post_title;
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_hope_string_limit_words($postExcerpt, 50);
	
	$organizerTitle = get_post_meta($postID, 'pm_organizer_title_meta', true);
	$organizerTip = get_post_meta($postID, 'pm_organizer_tooltip_meta', true);    
	
	$html = '';
	
	$html .= '<div class="pm_span_header pm_organizer">';
		$html .= '<h4>';
			$html .= '<span>'. $postTitle .'</span>';
			if($organizerTip !== '') {
				$html .= '<a class="'.$icon.' pm_tip" title="'.$organizerTip.'" href="'.$postLink.'"></a>';
			} else {
				$html .= '<a class="'.$icon.'" href="'.$postLink.'"></a>';
			}
			
		$html .= '</h4>';
	$html .= '</div>';
    
	$html .= '<div class="pm-hover-item pm-organizer-activate">';
		$html .= '<div class="pm-hover-item-title-panel">';
			$html .= '<a class="fa fa-location-arrow pm_float_right" href="#"></a>';
			$html .= '<p>'. $organizerTitle .'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-hover-item-details">';
			$html .= '<div class="pm-hover-item-spacer">';
				$html .= '<p>';
				 $html .= $shortExcerpt .'...';
				$html .= '</p>';
				$html .= '<p><a href="'.$postLink.'">'. esc_attr__('View full profile','localization').' &raquo;</a></p>';
				
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="pm-hover-item-img">';
		
			$html .= get_the_post_thumbnail( $postID );
			
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//EVENT POST
function eventPost($atts) {
			
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
	
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = get_permalink($postID);
	$postTitle = $queried_post->post_title;
	$postDate =  mysql2date('l, F j, Y', $queried_post->post_date);
	$postAuthorID = $queried_post->post_author;
	$postAuthor = get_the_author_meta('nickname', $postAuthorID);
	$postExcerpt = $queried_post->post_excerpt;
	
	$eventMonthValue = get_post_meta($postID, 'eventMonth', true);
	if($eventMonthValue !== '') { 
		$eventMonth = substr($eventMonthValue, 0, 3);
	}
	$eventDate = get_post_meta($postID, 'pm_event_date_meta', true);
	$month = date("M", strtotime($eventDate));
	$day = date("d", strtotime($eventDate));
	$year = date("Y", strtotime($eventDate));
	
	$countdown = get_post_meta($postID, 'pm_event_countdown_meta', true);
	$eventTip = get_post_meta($postID, 'pm_event_tooltip_meta', true);
	
	$eventIconFile = get_post_meta($postID, 'pm_event_icon_meta', true);
	$eventIcon = $eventIconFile == '' ? 'fa fa-calendar' : $eventIconFile;
	
	$html = '';
	
	$html .= '<div class="pm_span_header pm_event">';
		$html .= '<h4>';
			$html .= '<span>'.$postTitle.'</span>';
			if($eventTip !== '') {
				$html .= '<a class="'.$eventIcon .' pm_tip" title="'.$eventTip.'" href="'.$postLink.'"></a>';
			} else {
				$html .= '<a class="'.$eventIcon .'" href="'.$postLink.'"></a>';
			}
		$html .= '</h4>';
	$html .= '</div>';
	$html .= '<div class="pm-hover-item pm-event-activate">';
		$html .= '<div class="pm-hover-item-title-panel">';
			$html .= '<a class="fa fa-location-arrow pm_float_right" href="#"></a>';
			$html .= '<p><b>'. esc_attr__('Organizer', 'localization') .':</b> '.$postAuthor.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-hover-item-details">';
			$html .= '<div class="pm-hover-item-spacer">';
				$html .= '<ul class="pm-event-info-ul-date">';
					$html .= '<li><strong>'.$day.'</strong></li>';
					$html .= '<li><p>'.$month.'</p></li>';
					$html .= '<li class="visible-phone" style="margin-top:15px;"><a href="'.$postLink.'">'.esc_attr__('View Event','localization').' &raquo;</a></li>';
				$html .= '</ul>';
				$html .= '<div class="pm-event-info-excerpt" style="float:none !important; width:auto !important;">';
					$html .= '<p>' . pm_hope_string_limit_words($postExcerpt,30) .'...</p>';
					$html .= '<p><a href="'.$postLink.'">'.esc_attr__('View Event','localization').' &raquo;</a></p>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="pm-hover-item-img">';
			$html .= get_the_post_thumbnail( $postID );
		$html .= '</div>';
	$html .= '</div>';

	return $html;
	
}  


//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP"; 
         
    echo '<script type="text/javascript"> 
		(function($) {
			$(document).ready(function() {
			  function initializeGoogleMap() {
				  var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				  var myOptions = {
					center: myLatlng, 
					zoom: '.$zoom.',
					mapTypeId: google.maps.MapTypeId.'.$mapType.'
				  };
				  var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
				  var contentString = "'.$message.'";
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
			  }
			  initializeGoogleMap();
			});
		})(jQuery);</script>';
     
	if($responsive == 1){
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
} 

//FEATURED PANEL
function featuredPanel($atts, $content = null) { 
	extract(shortcode_atts(array(  
        "bgcolor" => '',
		"bgimage" => '',
		"border_color" => '#3C3C3C',
		"class" => ''
    ), $atts));
	
	if($bgimage != ''){
		return '<div class="pm_feature_container '. ($class !== '' ? $class : '') .'" style="background-image:url('.$bgimage.'); background-color:'.$bgcolor.'; border-bottom:8px solid '.$border_color.'; border-top:8px solid '.$border_color.';">'.do_shortcode($content).'</div>';  
	} else {
		return '<div class="pm_feature_container '. ($class !== '' ? $class : '') .'" style="background-color:'.$bgcolor.'; border-bottom:8px solid '.$border_color.'; border-top:8px solid '.$border_color.';">'.do_shortcode($content).'</div>'; 	
	}
    
}  

//SOCIAL GROUP
function socialGroup($atts, $content = null) { 
    return '<ul class="pm-personal-icons">'.do_shortcode($content).'</ul>';  
}  

//SOCIAL ICON
function socialIcon($atts, $content = null) {
	extract(shortcode_atts(array(  
        "icon" => 'fa fa-twitter',
		"link" => '',
		"target" => '_self',
		"size" => '5',
		"color" => '#333333'
    ), $atts));
    return '<li><a href="'.$link.'" target="'.$target.'" style="padding:'.$size.'px; background-color:'.$color.';"><i class="'.$icon.'"></i></a></li>';  
}  


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'danger'
    ), $atts)); 
	
	if($close == 'true'){
		return '<div class="alert alert-'.$type.' alert-block fade in"><a class="close" data-dismiss="alert" href="#">&times;</a>' . do_shortcode($content) . '</div>';
	} else {
		return '<div class="alert alert-'.$type.' alert-block fade in">' . do_shortcode($content) . '</div>';
	}

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "height" => '1',
		"width" => '',
		"bg_color" => 'orange',
		"margin" => 20
    ), $atts)); 
	
	return '<div class="pm-divider" style="height:'.$height.'px; '. ($width !== '' ? 'width:'.$width.'px;' : '') .' background-color:'.$bg_color.'; margin:'.$margin.'px 0px;"></div>';

}


//HOPE BUTTON
function hopeButton($atts, $content = null) {  

    extract(shortcode_atts(array(  
        "color" => 'grey',
		"textcolor" => '',
        "type" => 'small',
        "url" => '#',
		"target" => '_self',
		"icon" => 'fa fa-chevron-right'
    ), $atts));  
	
    return '<a class="button-'.$type.'" style="background-color:'.$color.';" href="'.$url.'" target="'.$target.'"><span style="color:'.$textcolor.' !important;">'.$content.'</span><i class="'.$icon.'" style="color:'.$textcolor.' !important;"></i></a>';  
}  

//PROGRESS BAR
function progressBar($atts) { 

	extract(shortcode_atts(array(  
        "percentage" => '50',
		"type" => 'success',
		"animation" => 'active'
    ), $atts));
	
    return '<div class="progress progress-striped progress-'.$type.' '.$animation.'">
			  <div class="bar" style="width: '.$percentage.'"></div>
			</div>
			';  
}



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'tip' => '',
		'icon' => 'fa fa-file',
		'hover_icon' => 'fa fa-link',
		'title' => '',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
	
    
    $html .= '<div class="pm_image_panel">';
    
    $html .= '<div class="pm_image_panel_header">';
		if($tip !== ''){
			$html .= '<h4><span>'.$title.'</span><a target="_self" class="'.$icon.' pm_tip" title="'.$tip.'" href="'.$link.'"></a></h4>';
		} else {
			$html .= '<h4><span>'.$title.'</span><a target="_self" class="'.$icon.'" href="'.$link.'"></a></h4>';
		}
		
	$html .= '</div>';
        
    $html .= '<div class="pm-hover-item-image-panel">';
	
	$html .= '<div class="pm-hover-item-icon"><a class="'.$hover_icon.'" href="'.$link.'"></a></div>';
	
	$html .= '<div class="pm-hover-item-details"></div>';
	
	$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
		
	$html .= '</div>';   
	
	$html .= do_shortcode($content);
    
    $html .= '</div>';
    
	return $html;
	
}



//SINGLE POST
function singlePost($atts) {
			
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
	
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = get_permalink($postID);
	$postTitle = $queried_post->post_title;
	$postDate =  mysql2date('l, F j, Y', $queried_post->post_date);
	$postAuthorID = $queried_post->post_author;
	$postAuthor = get_the_author_meta('nickname', $postAuthorID);
	//$postTags = get_the_tags($postID);
	$postCommentCount = $queried_post->comment_count;
	$postExcerpt = $queried_post->post_excerpt;
	$postContent = $queried_post->post_content;
	//$postImage = get_the_post_thumbnail($id);
	
	$postTip = get_post_meta($postID, 'pm_post_tooltip_meta', true);
	$postIconSaved = get_post_meta($postID, 'pm_post_icon_meta', true);
	$postIcon = $postIconSaved != '' ? $postIconSaved : 'fa fa-link';
	
	$displaySocialMeta = get_theme_mod('displaySocialMeta', 'on');
	$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');
	
	$displayExcerptOnMeta = get_theme_mod('displayExcerptOnMeta', 'off');
	$displayMetaInfo = get_theme_mod('displayMetaInfo', 'on');
	
	$html = '';
	
	?>
    
    <?php
	
	
	$html .= '<div class="pm-single-post-shortcode-container">';
	
		$html .= '<div class="pm_span_header pm_post_single">';
		$html .= '<h4>';
		
		$html .= '<span>'.$postTitle .'</span>';
		
		if( $postTip !== '' ){
			$html .= '<a class="'.$postIcon.' pm_tip" title="'.$postTip.'" href="'.$postLink.'"></a>';
		} else {
			$html .= '<a class="'.$postIcon.'" href="'.$postLink.'"></a>';
		}
		
		
		$html .= '</h4>';
		$html .= '</div>';
		
		$html .= '<div class="pm-hover-item">';
		
			$html .= '<div class="pm-hover-item-title-panel">';
			$html .= '<a class="icon-location-arrow pm_float_right pm_panel_touch_btn"></a>';
						
			if( $displayMetaInfo === 'on' ) {
				$html .= '<p><b>'. esc_attr__('Posted','localization') .'</b> '.$postDate.'<b> '. esc_attr__('by','localization') .'</b> '.$postAuthor.'</p>';
			}
			
			if( $displayExcerptOnMeta === 'on' ){
				$html .= '<p>'.pm_hope_string_limit_words($postExcerpt, 12).'...</p>';
			}
			
			$html .= '</div>';
			
			$html .= '<div class="pm-hover-item-details">';
				$html .= '<div class="pm-hover-item-spacer">';
					$html .= '<p>'.$postExcerpt.'</p>';
					$html .= '<a href="'.$postLink.'">'. esc_attr__('Read More','localization') .' &raquo;</a>';
				
					
					if($displayCommentsCount === 'on'){
						$html .= '<div class="pm_post_tags">';
						$html .= '<i class="fa fa-comment"></i> '.get_comments_number().' '. esc_attr__('comments', 'localization') .'';	
						$html .= '</div>';
					} else {
						$html .= '<div class="pm_post_tags" style="margin-bottom:0px;">';
						$html .= '</div>';	
					}
					
					if( $displaySocialMeta === 'on' ) :											
												
						$html .= '<ul class="pm-post-social-icons">';
						
							$html .= '<li class="twitter">';
							$html .= '<a target="_blank" href="http://twitter.com/home?status='.urlencode(get_the_title()).'"><i class="fa fa-twitter"></i></a>';
							$html .= '</li>';
							
							$html .= '<li class="facebook">';
							$html .= '<a target="_blank" href="http://www.facebook.com/share.php?u='.urlencode(get_the_permalink()).'"><i class="fa fa-facebook"></i></a>';
							$html .= '</li>';
							
							$html .= '<li class="linkedin">';
							$html .= '<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_the_permalink()).'&amp;title='.urlencode(get_the_title()).'&amp;summary='.urlencode(get_the_excerpt()).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
							$html .= '</li>';
							
							$html .= '<li class="gplus">';
							$html .= '<a href="https://plus.google.com/share?url='.urlencode(get_the_permalink()).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
							$html .= '</li>';
						
						$html .= '</ul>';
					
					endif;	
				
				$html .= '</div>';
			$html .= '</div>';
			
			$html .= '<div class="pm-hover-item-img">';
			
			$html .= get_the_post_thumbnail( $postID );	
						
			$html .= '</div>';
			
		$html .= '</div>';
		
	$html .= '</div>';	

	return $html;
	
    //return '<div class="pm_span_header"><h4><span>'.$content.'</span><a class="'.$icon.' pm_tip" title="'.$tip.'" href="'.$link.'" target="'.$target.'"></a></h4></div>';  
}  


//CALL TO ACTION
function callToAction($atts, $content = null) {
	return '<span class="pm-call-to-action">'.$content.'</span>'; 
}


// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';  
}

//HTML5 VIDEO
/*function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
		'width' => '400',
		'height' => '400',
		"responsive" => 0,
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
	
}*/


//TABS
function tabGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_ln_tab_id'] = (int) $id;
	$GLOBALS['pm_ln_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] ) ){
	
		foreach( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] as $tab ){	
			$tabs[] = '<li><a data-toggle="tab" href="#'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';		
			$panes[] = '<div class="tab-pane" id="'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(
		'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['pm_ln_tab_count'];
	$GLOBALS['tabs' . $GLOBALS['pm_ln_tab_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_ln_tab_count'] ), 'content' =>  do_shortcode($content) );
	$GLOBALS['pm_ln_tab_count']++;

}



//ACCORDION
function accordionGroup($atts, $content = null) { 

	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_ln_accordion_id'] = (int) $id;
	$GLOBALS['pm_ln_accordion_count'] = 0;
	
    return '<div class="accordion pm-accordion" id="accordion'.$GLOBALS['pm_ln_accordion_id'].'">'.do_shortcode($content).'</div>';
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"icon" => 'fa fa-file'
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="accordion-group">';                
			$html .= '<div class="accordion-heading">';
			$html .= '<div class="'.$icon.' pm-primary-color" id="pm-accordionIcon"></div><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$GLOBALS['pm_ln_accordion_id'].'" href="#'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'">'.$title.'</a></div>';
			$html .= '<div id="'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="accordion-body collapse">';
				$html .= '<div class="accordion-inner">';
					$html .= do_shortcode($content);
				$html .= '</div>';
			$html .= '</div>';
	$html .= '</div>';
	
	$GLOBALS['pm_ln_accordion_count']++;
	
    return $html;
	
}  

//PANEL HEADER
function panelHeader($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "icon" => '',
		"link" => '',
		"target" => '_self',
		"tip" => '',
		"bgcolor" => '',
		"marginbottom" => 10
    ), $atts));
	if($icon !== ''){
		return '<div class="pm_span_header" style="margin-bottom:'.$marginbottom.'px !important; overflow:hidden;"><h4 '. ($bgcolor !== '' ? 'style="background-color:'.$bgcolor.';"' : '') .'><span>'.$content.'</span><a '. ($link !== '' ? 'href="'.$link.'"' : '') .' class="'.$icon.' '. ($tip !== '' ? 'pm_tip' : '') .'" title="'.($tip !== '' ? $tip : '').'" target="'.$target.'"></a></h4></div>'; 
		
	} else {
		return '<div class="pm_span_header" style="margin-bottom:'.$marginbottom.'px !important; overflow:hidden;"><h4 style="'. ($bgcolor !== '' ? 'background-color:'.$bgcolor.';' : '') .' "><span>'.$content.'</span></h4></div>'; 	
	}
     
}  




/******** BOOTSTRAP 2 COLUMNS ***********/

//COLUMN CONTAINER
function columnContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
        "fullscreen" => 'off',
		"bgcolor" => '#FFFFFF',
		"bgimage" => '',
		"border" => 'no',
		"class" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		//wrap a cta_container
		if($bgimage != ''){
			return '<div class="cta_container '. ( $class !== '' ? $class : '' ) .'" style="background-image:url('.$bgimage.'); background-color:'.$bgcolor.';"><div class="container"><div class="row">'.do_shortcode($content).'</div></div></div>';  
		} else {
			return '<div class="cta_container '. ( $class !== '' ? $class : '' ) .'" style="background-color:'.$bgcolor.';"><div class="container"><div class="row">'.do_shortcode($content).'</div></div></div>';  	
		}
		
	} else {
		if($bgimage != ''){
			return '<div class="container '. ( $class !== '' ? $class : '' ) .' pm_paddingVertical60 '. ($border == 'yes' ? 'pm_containerBorderBottom' : '') .'" style="background-color:'.$bgcolor.'; background-image:url('.$bgimage.');"><div class="row">'.do_shortcode($content).'</div></div>'; 
		} else {
			return '<div class="container '. ( $class !== '' ? $class : '' ) .' pm_paddingVertical60 '. ($border == 'yes' ? 'pm_containerBorderBottom' : '') .'" style="background-color:'.$bgcolor.';"><div class="row">'.do_shortcode($content).'</div></div>'; 
		}
		 	
	}
    
}  

//COLUMNS
function column($atts, $content = null) { 

	extract(shortcode_atts(array(  
        "span" => 'span1',
		"alignment" => 'none',
    ), $atts)); 
    return '<div class="'.$span.'" style="text-align:'.$alignment.';">'.do_shortcode($content).'</div>';
	
}  


//CONTAINER
/*function container($atts, $content = null) {	
	return '<div class="container"><div class="row">'.do_shortcode($content).'</div></div>';
}*/


/******** BOOTSTRAP 3 COLUMNS END ***********/

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/
add_action('init', 'pm_ln_add_tiny_shortcodes');  
function pm_ln_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
		 
		 //Bootstrap 2
		 add_filter('mce_external_plugins', 'add_plugin_columnContainer');  
     	 add_filter('mce_buttons_3', 'register_columnContainer'); 
		 
		 /*add_filter('mce_external_plugins', 'add_plugin_container');  
     	 add_filter('mce_buttons_3', 'register_container'); */
		 
		 add_filter('mce_external_plugins', 'add_plugin_column');  
     	 add_filter('mce_buttons_3', 'register_column'); 
		 		 
		 //Featured Panel
		 add_filter('mce_external_plugins', 'add_plugin_featuredPanel');  
     	 add_filter('mce_buttons_3', 'register_featuredPanel');	
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "hopeButton" button
		 add_filter('mce_external_plugins', 'add_plugin_hopeButton');  
		 add_filter('mce_buttons_3', 'register_hopeButton');  
		 		 
		 //Add "Progress bar"
		 add_filter('mce_external_plugins', 'add_plugin_progressBar');  
		 add_filter('mce_buttons_3', 'register_progressBar');
		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Add "Single Post" button
		 add_filter('mce_external_plugins', 'add_plugin_singlepost');  
		 add_filter('mce_buttons_3', 'register_singlepost');
		 
		 //Add "Event Post" button
		 add_filter('mce_external_plugins', 'add_plugin_eventPost');  
		 add_filter('mce_buttons_3', 'register_eventPost');
		 		 		 
		 //Social Group
		 add_filter('mce_external_plugins', 'add_plugin_socialGroup');  
     	 add_filter('mce_buttons_3', 'register_socialGroup'); 
		 
		 //Social Icon
		 add_filter('mce_external_plugins', 'add_plugin_socialIcon');  
     	 add_filter('mce_buttons_3', 'register_socialIcon'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		/* add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); */
		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');
		 
		 //Panel Header
		 add_filter('mce_external_plugins', 'add_plugin_panelHeader');  
     	 add_filter('mce_buttons_3', 'register_panelHeader');
		 
		 //Testimonials
		 add_filter('mce_external_plugins', 'add_plugin_testimonials');  
     	 add_filter('mce_buttons_3', 'register_testimonials');	
		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	
		 
		 //Image panel
		 add_filter('mce_external_plugins', 'add_plugin_imagePanel');  
     	 add_filter('mce_buttons_3', 'register_imagePanel');
		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffProfile');  
     	 add_filter('mce_buttons_3', 'register_staffProfile'); 
		 
		 //Post items
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems'); 
		 
		 //Featured box
		 add_filter('mce_external_plugins', 'add_plugin_featureBox');  
     	 add_filter('mce_buttons_3', 'register_featureBox'); 
		 
		 //Sponsors Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sponsorsCarousel');  
     	 add_filter('mce_buttons_3', 'register_sponsorsCarousel'); 
		 
		 //Event items
		 add_filter('mce_external_plugins', 'add_plugin_eventItems');  
     	 add_filter('mce_buttons_3', 'register_eventItems'); 
		 
		 //Staff items
		 add_filter('mce_external_plugins', 'add_plugin_staffItems');  
     	 add_filter('mce_buttons_3', 'register_staffItems'); 		 
		
	}

}


//ACTIVE
function register_staffItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "staffItems");  
   return $buttons;  
}
function add_plugin_staffItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_eventItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "eventItems");  
   return $buttons;  
}
function add_plugin_eventItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['eventItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_postItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "postItems");  
   return $buttons;  
}
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_eventPost($buttons) { //Registers the TinyMCE button
   array_push($buttons, "eventPost");  
   return $buttons;  
}
function add_plugin_eventPost($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['eventPost'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_hopeButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "hopeButton");  
   return $buttons;  
} 
function add_plugin_hopeButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['hopeButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_singlepost($buttons) { //Registers the TinyMCE button
   array_push($buttons, "singlepost");  
   return $buttons;  
}
function add_plugin_singlepost($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['singlepost'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_progressBar($buttons) { //Registers the TinyMCE button
   array_push($buttons, "progressBar");  
   return $buttons;  
}
function add_plugin_progressBar($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['progressBar'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_columnContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "columnContainer");  
   return $buttons;  
}
function add_plugin_columnContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['columnContainer'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_container($buttons) { //Registers the TinyMCE button
   array_push($buttons, "container");  
   return $buttons;  
}
function add_plugin_container($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['container'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_column($buttons) { //Registers the TinyMCE button
   array_push($buttons, "column");  
   return $buttons;  
}
function add_plugin_column($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['column'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_socialGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "socialGroup");  
   return $buttons;  
}
function add_plugin_socialGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['socialGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_socialIcon($buttons) { //Registers the TinyMCE button
   array_push($buttons, "socialIcon");  
   return $buttons;  
}
function add_plugin_socialIcon($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['socialIcon'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

/*function register_html5Video($buttons) {
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { 
   $plugin_array['html5Video'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}*/

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_panelHeader($buttons) { //Registers the TinyMCE button
   array_push($buttons, "panelHeader");  
   return $buttons;  
}
function add_plugin_panelHeader($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['panelHeader'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_testimonials($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonials");  
   return $buttons;  
}
function add_plugin_testimonials($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonials'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_imagePanel($buttons) { //Registers the TinyMCE button
   array_push($buttons, "imagePanel");  
   return $buttons;  
}
function add_plugin_imagePanel($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['imagePanel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_featuredPanel($buttons) {  
   array_push($buttons, "featuredPanel");  
   return $buttons;  
}
function add_plugin_featuredPanel($plugin_array) {  
   $plugin_array['featuredPanel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_staffProfile($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffProfile");  
   return $buttons;  
} 
function add_plugin_staffProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_featureBox($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "featureBox");  
   return $buttons;  
} 
function add_plugin_featureBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['featureBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_sponsorsCarousel($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "sponsorsCarousel");  
   return $buttons;  
} 
function add_plugin_sponsorsCarousel($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['sponsorsCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 




function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim(  do_shortcode( $content ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

?>