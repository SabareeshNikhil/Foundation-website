<?php

/*

Plugin Name: Events Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your events
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_events_widget');

//register our widget
function pm_events_widget() {
	register_widget('pm_eventposts_widget');
}

//pm_eventposts_widget class
class pm_eventposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_eventposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_eventposts_widget',
			'description' => esc_attr__('Display your events.','localization')
		);
		
		parent::__construct('pm_eventposts_widget', esc_attr__('[Micro Themes] - Events','localization'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => '', 
			'numOfPosts' => '3',
			'postOrder' => 'ASC'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		$postOrder = $instance['postOrder'];
		$sortbyEventDate = $instance['sortbyEventDate'];
		
		?>
        
        	<p><?php esc_attr_e('Title:','localization') ?> <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            
            <p><?php esc_attr_e('Number of Events to show:','localization') ?> <input class="widefat" name="<?php echo $this->get_field_name('numOfPosts'); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
            
            <p><?php esc_attr_e('Post Order:','localization') ?>
            
            <select id="<?php echo esc_attr($this->get_field_id( 'postOrder' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'postOrder' )); ?>" class="widefat">
            
                <option <?php if ( 'ASC' == $instance['postOrder'] ) echo 'selected="selected"'; ?> value="ASC"><?php esc_attr_e('Ascending', 'localization') ?></option>
                
                <option <?php if ( 'DESC' == $instance['postOrder'] ) echo 'selected="selected"'; ?> value="DESC"><?php esc_attr_e('Descending', 'localization') ?></option>
                
            </select></p>
            
            
            <p><?php esc_attr_e('Sort by Event Date?:','localization') ?>
            
            <select id="<?php echo esc_attr($this->get_field_id( 'sortbyEventDate' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sortbyEventDate' )); ?>" class="widefat">
            
                <option <?php if ( 'yes' == $instance['sortbyEventDate'] ) echo 'selected="selected"'; ?> value="yes"><?php esc_attr_e('Yes', 'localization') ?></option>
                
                <option <?php if ( 'no' == $instance['sortbyEventDate'] ) echo 'selected="selected"'; ?> value="no"><?php esc_attr_e('No', 'localization') ?></option>
                
            </select></p>
            
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		$instance['postOrder'] = strip_tags( $new_instance['postOrder'] );
		$instance['sortbyEventDate'] = strip_tags( $new_instance['sortbyEventDate'] );		
		
		return $instance;
		
	}//end of update function
	
	
	
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Events', 'localization' ) : $instance['title'], $instance, $this->id_base );
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		$postOrder = empty( $instance['postOrder'] ) ? 'ASC' : $instance['postOrder'];
		$sortbyEventDate = empty( $instance['sortbyEventDate'] ) ? 'yes' : $instance['sortbyEventDate'];
		
		
		if( !empty($title) ){
			
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
		
		if($sortbyEventDate === 'yes') {
			
			$args = array(
				'numberposts' => $numOfPosts,
				'order' => $postOrder,
				'orderby' => 'meta_value',
				'meta_key' => 'pm_event_date_meta',
				'post_type' => 'post_events',
				'post_status' => 'publish',
			);
			
		} else {
			
			$args = array(
				'numberposts' => $numOfPosts,
				'orderby' => 'post_date',
				'order' => $postOrder,
				'post_type' => 'post_events',
				'post_status' => 'publish',
			);
			
		}
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-events-widget">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$eventDate = get_post_meta($recent["ID"], 'pm_event_date_meta', true);
			
			$eventDateNew = str_replace(",", "", $eventDate);
			$datePieces = explode(" ", $eventDateNew);
			
			$month = mb_substr($datePieces[0], 0, 3);
			$day = $datePieces[1];
			$year = $datePieces[2];
			
			$excerpt = $recent["post_excerpt"];
			
			echo '<li>';
			
				echo '
					<div class="pm-events-widget-date">
						<i class="fa fa-calendar"></i>
						<p>'.$day.'</p>
						<p>'.$month.'</p>
					</div>
					<div class="pm-events-widget-info">
						<p><b>'.$recent["post_title"].'</b></p>
						<p>'.pm_hope_string_limit_words($excerpt,8) .'...</p>
						<a href="'.get_permalink($recent["ID"]).'" class="green button-small pm-event-widget-btn">
							<span>'. esc_attr__('View Event','localization') .'</span>
							<i class="fa fa-chevron-right"></i>
						</a>
					</div>
				';
			
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
		

		
	}//end of widget function
	
}//end of class

?>