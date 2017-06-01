<?php

/*

Plugin Name: Recent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your most recent posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_recent_posts_widget');

//register our widget
function pm_recent_posts_widget() {
	register_widget('pm_recentposts_widget');
}

//pm_recentposts_widget class
class pm_recentposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_recentposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_recentposts_widget',
			'description' => esc_attr__('Display recent posts with style.','localization')
		);
		
		parent::__construct('pm_recentposts_widget', esc_attr__('[Micro Themes] - Recent Posts','localization'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
				
		$defaults = array(
			'title' => '', 
			'numOfPosts' => '3',
			'id' => '' 			
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:','localization') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e('Number of Posts to display:','localization') ?><input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Recent Posts' ) : $instance['title'], $instance, $this->id_base );
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		echo $before_widget;
		
		if( $title ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true );
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-recent-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$featuredBlogImage = get_post_meta($recent["ID"], 'featuredBlogImage', true);
			
			$excerpt = $recent["post_excerpt"];
			
			echo '<li>';
			
				echo '<div class="pm-hover-item pm_recent_posts" style="height:62px;">
						<div class="pm-hover-item-title-panel">
							<a class="icon-location-arrow pm_float_right"></a>
							<p>'. esc_attr__('Posted','localization') .' '. mysql2date('l, F j, Y', $recent["post_date"]) .'</p>
						</div>
						<div class="pm-hover-item-details" style="height:62px;">
							<div class="pm-hover-item-spacer">
								<p>'.pm_hope_string_limit_words($excerpt,10) .'...<a href="'.get_permalink($recent["ID"]).'">'. esc_attr__('Read More &raquo;','localization') .'</a></p>
								<i class="icon-comments"></i> '. $recent["comment_count"] .' '. esc_attr__('comments','localization') .'                                 
							</div>
						</div>
						<div class="pm-hover-item-img">
							<div class="pm-recent-posts-img">';
							 if($featuredBlogImage !== ''){
								 echo '<img src="'.esc_html($featuredBlogImage).'" alt="'.$recent["post_title"].'">';
							 } else {
								 echo get_the_post_thumbnail($recent["ID"]);
							 }
							echo '</div>
						</div>
					</div>';
			
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>