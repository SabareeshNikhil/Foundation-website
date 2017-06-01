<?php

/*

Plugin Name: MailChimp Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a mailchimp newsletter signup form
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_newsletter_widget');

//register our widget
function pm_newsletter_widget() {
	register_widget('pm_mailchimp_widget');
}

//pm_mailchimp_widget class
class pm_mailchimp_widget extends WP_Widget {
	
	//process the new widget
	function pm_mailchimp_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_mailchimp_widget',
			'description' => esc_attr__('Setup a mailchimp powered newsletter signup form','localization')
		);
		
		parent::__construct('pm_mailchimp_widget', esc_attr__('[Micro Themes] - Newsletter Signup','localization'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => '', 
			'desc' => '',
			'url' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$desc = $instance['desc'];
		$url = $instance['url'];
		
		?>
        
        	<p><?php esc_attr_e( 'Title', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e( 'Description:', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" type="text" value="<?php echo esc_attr($desc); ?>" /></p>
            <p><?php esc_attr_e( 'Signup Form URL:', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Newsletter Signup', 'localization' ) : $instance['title'], $instance, $this->id_base );
		$desc = empty( $instance['desc'] ) ? '' : $instance['desc'];
		$url = empty( $instance['url'] ) ? '' : $instance['url'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		//form code here
		if(trim($desc) !== ''){
			echo '<p>'.$desc.'</p>';
		}
		
		echo '<form action="'.htmlspecialchars($url).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  
			<input name="MERGE1" type="text" class="newsletter_field" id="MERGE1" placeholder="'.esc_attr__( 'first name', 'localization' ).'">
			<input name="MERGE0" type="email" class="newsletter_field" id="MERGE0" placeholder="'.esc_attr__( 'email address', 'localization' ).'">
			<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="subscribe" class="newsletter_submit">
		</form>';
				
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>