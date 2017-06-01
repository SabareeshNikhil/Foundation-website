<?php 


//Convert HEX to RGB
if( !function_exists('pm_ln_hex2rgb') ){
	
	function pm_ln_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
}



if( !function_exists('pm_ln_is_plugin_active') ){
	
	function pm_ln_is_plugin_active($plugin) {

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	
		return is_plugin_active($plugin);
	
	}
	
}


if( !function_exists('pm_ln_has_shortcode') ) {
	
	function pm_ln_has_shortcode($shortcode = '') {
     
		$post_to_check = get_post(get_the_ID());
		 
		// false because we have to search through the post content first
		$found = false;
		 
		// if no short code was provided, return false
		if (!$shortcode) {
			return $found;
		}
		// check the post content for the short code
		if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
			// we have found the short code
			$found = true;
		}
		 
		// return our final results
		return $found;
	}
	
}




if( !function_exists('pm_ln_validate_email') ) {
	
	function pm_ln_validate_email($value){
			
		if( !empty($value) ) {
			if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $value)) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
		
	}//end of validate_email()
	
}




if( !function_exists('pm_ln_icl_post_languages') ) {
	
	//WPML custom language selector
	function pm_ln_icl_post_languages($class = ''){
		
	  if( function_exists('icl_get_languages') ){
		  
		  $languages = icl_get_languages('skip_missing=1');
	  
		  if(1 < count($languages)){
			  
			  echo '<div class="pm-micro-nav-lang-selector '.$class.'">';
							
				 echo '<div class="pm-dropdown pm-language-selector-menu">';
					 echo '<div class="pm-dropmenu">';
						 echo '<p class="pm-menu-title">'.esc_attr__('Language','localization').'</p>';
						 echo '<i class="fa fa-angle-down"></i>';
					 echo '</div>';
					 echo '<div class="pm-dropmenu-active">';
						 echo '<ul>';
						 foreach($languages as $l){
							if(!$l['active']) echo '<li><img src="'.$l['country_flag_url'].'" /><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
						 }
						 echo '</ul>';
					 echo '</div>';
				 echo '</div>';
			
			 echo '</div>';
				
			
			//echo join(', ', $langs);
			
		  }
		  
	  }//end of check function
	  
	}
	
}



//Custom WordPress functions

if( !function_exists('pm_hope_set_query') ) {
	
	function pm_hope_set_query($custom_query=null) { 
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query_old = $wp_query;
		$wp_query = $custom_query;
		$orig_post = $post;
	}
	
}



if( !function_exists('pm_hope_restore_query') ) {
	
	function pm_hope_restore_query() {  
		global $wp_query, $wp_query_old, $post, $orig_post;
		$wp_query = $wp_query_old;
		$post = $orig_post;
		setup_postdata($post);
	}
	
}



if( !function_exists('pm_hope_string_limit_words') ) {
	
	//Limit words in a paragraphs
	function pm_hope_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  return implode(' ', $words);
	}
	
}



if( !function_exists('pm_hope_hex2rgb') ) {
	
	//Convert HEX to RGB
	function pm_hope_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	
}



if( !function_exists('pm_hope_parse_yturl') ) {
	
	//YOUTUBE Thumbnail Extract
	function pm_hope_parse_yturl($url) {
		$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
		preg_match($pattern, $url, $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}
	
}



if( !function_exists('pm_hope_page_crumbs') ) {
	
	//PM Breadcrumbs
	function pm_hope_page_crumbs() {
		
		$post_type = get_post_type();
		
		if ((is_page() && !is_front_page()) || is_home() || is_category() || is_single() || is_tag() || is_404()) {
			
		 echo '<ul class="breadcrumbs" id="breadcrumbs">';
		 echo '<li><a href="'.get_bloginfo('url').'">'. esc_attr__('Home', 'localization') .'</a></li>';
		 
		 global $post;
		 
		 $post_ancestors = get_post_ancestors($post);
		 
		 
		 if ($post_ancestors) {
			$post_ancestors = array_reverse($post_ancestors);
			foreach ($post_ancestors as $crumb){
				//echo '<li><a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a>&raquo;</li>';
				//$top_parent_link = get_permalink( end($parents) );
				echo '<li>:: <a href="'.get_permalink( $crumb ).'">'.get_the_title($crumb).'</a></li>';
			}
		 }
		 
		 //category and single post breadcrumb
		 /*if (is_category() || is_single()) {
			$category = get_the_category();
			echo '<li>:: <a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
			echo '<li>'.$category[0]->cat_name.'</li>';
		 }*/
		 
		 //tag breadcrumb
		 if (is_tag()) {
			echo '<li>:: '.get_query_var('tag').'</li>';
			echo '</ul>';
		 }
		 
		 //tag breadcrumb
		 if (is_404()) {
			echo '<li>:: 404 Page Not Found</li>';
			echo '</ul>';
		 }
		 
		 //search breadcrumb
		 if (is_search()) {
			echo '<li>:: Search Results</li>';
			echo '</ul>';
		 }
		 //default breadcrumb
		 if ( is_page() ) {
			echo '<li>:: '.get_the_title().'</li>';
			echo '</ul>';
		 } 
		 
		 if( is_category() ) {
			 
			 $category = get_the_category();
			 echo '<li>:: <a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
			 echo '</ul>';
			 
		 }
		 
		 if( is_single() && $post_type != 'post_events' && $post_type != 'post_organizers' && $post_type != 'post_galleries'  ) {
			 
			 $category = get_the_category();
			 echo '<li>:: <a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
			 echo '<li>:: '.get_the_title().'</li>';
			 echo '</ul>';
			 
		 }
		 
		 if ( $post_type == 'post_events' || $post_type == 'post_organizers' ) {
			 
			 $post_type_data = get_post_type_object( $post_type );
			 $post_type_slug_value = $post_type_data->rewrite['slug'];
			 $post_type_slug = str_replace("-", " ", $post_type_slug_value);
			 $post_type_link = site_url($post_type_slug_value);
			 
			 echo '<li> :: <a href="'.$post_type_link.'">'.$post_type_slug.'</a> :: '.get_the_title().'</li>';
			 
		 } 
		 
		 if ( $post_type == 'post_galleries' ) {
			 
			 $post_type_data = get_post_type_object( $post_type );
			 $post_type_slug = $post_type_data->rewrite['slug'];
			 $post_type_link = site_url($post_type_slug);
			 
			 echo '<li> :: '.$post_type_slug.' :: '.get_the_title().'</li>';
			 
		 } 
		 
		 
		}
		 
	}//end of breadcrumbs function
	
}




//COMMENTS CONTROL
if( !function_exists('pm_hope_mytheme_comment') ) {	
	
	function pm_hope_mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
		
		<div class="comment-author vcard">
		<?php echo get_avatar($comment,$size='70'); ?>
		<?php printf(esc_attr__('<cite class="fn">%s</cite>', 'localization'), get_comment_author_link()) ?> //
		<a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>">
		<?php printf(esc_attr__('%1$s at %2$s', 'localization'), get_comment_date(),get_comment_time()) ?></a><?php edit_comment_link(esc_attr__('(Edit)', 'localization'),' ','') ?>
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
		<em style="margin-left:27px;"><?php esc_attr_e('Your comment is awaiting moderation.', 'localization') ?></em>
		<br />
		<?php endif; ?>
		 
		<div class="comment-meta commentmetadata"></div>
		 
		<div style="margin-left:27px;"><?php comment_text() ?></div>
		<?php if($args['max_depth']!=$depth) { ?>
		<div class="reply">
		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php } ?>
		</div>
		<?php
		
		//Required for Themeforest regulations.
		$comments_args = array(
		  'title_reply'       => esc_attr__( 'Leave a Reply', 'localization' ),
		  'title_reply_to'    => esc_attr__( 'Leave a Reply to %s', 'localization' ),
		  'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'localization' ),
		  'label_submit'      => esc_attr__( 'Post Comment', 'localization' ),
		);
	
		comment_form($comments_args);
			
	}//end of comments control
	
}



//Menu functions

if( !function_exists('display_pmNav') ) {
	
	function display_pmNav() {
		echo '<ul class="sf-menu" id="nav">';
			  wp_list_pages('title_li=&depth=3'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}


if( !function_exists('display_pmFooterNav') ) {
	
	function display_pmFooterNav() {
		echo '<ul class="pm-footer-nav" id="pm-footer-nav">';
			  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
		echo '</ul>';
	}
	
}

if( !function_exists('pulsar_load_more') ) {
	
	//Ajax loader for Organizers
	function pulsar_load_more(){
		
		if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
		
		$section = '';
		
		$args = '';
		if(isset($_POST['section']) && $_POST['section']){
			$section = $_POST['section'];
			if($section == 'gallery'){
				$args = 'post_type=post'.$_POST['section'].'&';
			} else {
				$args = 'post_type=post_'.$_POST['section'].'&';
			}
			
		}
	
		if($section == 'gallery') {
			$args .= 'post_status=publish&posts_per_page='.$galleryPostsDisplay.'&paged='. $_POST['page'];
		} else {
			$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
		}
			
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
			get_template_part( 'content', $section.'post' );
		}
		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		
		exit;
		
	}
	
}



if( !function_exists('pm_ln_send_quick_contact_form') ) {
	
	function pm_ln_send_quick_contact_form() {
			
		 // Verify nonce
		 if( isset( $_POST['pm_ln_send_quick_contact_nonce'] ) ) {
		
		   if ( !wp_verify_nonce( $_POST['pm_ln_send_quick_contact_nonce'], 'pm_ln_nonce_action' ) ) {
			   die( 'A system error has occurred, please try again later.' );
		   }	   
		  
		 }
	
		 //Post values
		 $full_name = sanitize_text_field($_POST['full_name']);
		 $email_address = sanitize_text_field($_POST['email_address']);
		 $message = sanitize_text_field($_POST['message']);
		 $recipient = sanitize_text_field($_POST['recipient']);
		 
		
		 if ( empty($full_name) ){
			
			echo 'full_name_error';
			die();
	
			
		} elseif( pm_ln_validate_email($email_address) == false ){
			
			echo 'email_error';
			die();
			
		} elseif( empty($message) ){
			
			echo 'message_error';
			die();
			
		} 
		
		//All good, send email
		$multiple_recipients = array(
			$recipient
		);
		
		$subj = esc_html__('Quick Contact Form Inquiry', 'localization');
		
		$body = ' 
		
		  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'localization') .' ****
		  
		  '. esc_html__('Full Name', 'localization') .': '.$full_name.'
		  '. esc_html__('Email Address', 'localization') .': '.$email_address.'
		  '. esc_html__('Message', 'localization') .': '.$message.'
		  
		';
		
		$send_mail = wp_mail( $multiple_recipients, $subj, $body );
		
		if($send_mail) {
			
			echo 'success';
			die();
			
		} else {
			
			echo 'failed';
			die();
				
		}
			
	}
	
}



?>