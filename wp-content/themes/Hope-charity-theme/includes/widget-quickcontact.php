<?php

/*

Plugin Name: Quick Contact Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a quick contact form
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_contact_widget');

//register our widget
function pm_contact_widget() {
	register_widget('pm_quickcontact_widget');
}

//pm_quickcontact_widget class
class pm_quickcontact_widget extends WP_Widget {
	
	//process the new widget
	function pm_quickcontact_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_quickcontact_widget',
			'description' => esc_attr__('Insert a quick contact form','localization')
		);
		
		parent::__construct('pm_quickcontact_widget', esc_attr__('[Micro Themes] - Quick Contact Form','localization'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => '', 
			'desc' => '',
			'email' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$desc = $instance['desc'];
		$email = $instance['email'];
		
		?>
        
        	<p><?php esc_attr_e( 'Title', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e( 'Description:', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" type="text" value="<?php echo esc_attr($desc); ?>" /></p>
            <p><?php esc_attr_e( 'Email address:', 'localization' ) ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Quick Contact', 'localization' ) : $instance['title'], $instance, $this->id_base );
		$desc = empty( $instance['desc'] ) ? '&nbsp;' : $instance['desc'];
		$email = empty( $instance['email'] ) ? '&nbsp;' : $instance['email'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		//form code here
		
		if($desc != '&nbsp;'){
			echo '<p>'.$desc.'</p>';
		}
		
		if(isset($_SESSION['pm_ln_quick_contact_index'])){
			$_SESSION['pm_ln_quick_contact_index']++;
		} else {
			$_SESSION['pm_ln_quick_contact_index'] = 1;
		}
		
		
		echo '
		<form action="#" method="post" id="quick-contact-form-'.$_SESSION['pm_ln_quick_contact_index'].'" class="validate quick-contact-form" target="_blank" novalidate>  
			<input name="full_name" type="text" class="quick_contact_field" id="pm_full_name" placeholder="'.esc_attr__( 'full name', 'localization' ).'">
			<input name="email_address" type="email" class="quick_contact_field" id="pm_email_address" placeholder="'.esc_attr__( 'email address', 'localization' ).'">
			<textarea name="message" id="pm_message" cols="" rows="" class="quick_contact_textarea" placeholder="'.esc_attr__( 'message', 'localization' ).'"></textarea>
			<input name="subscribe" id="quick-contact-submit-'.$_SESSION['pm_ln_quick_contact_index'].'" type="submit" value="Send" class="quick_contact_submit"> ';
			
			?>
            
            <?php wp_nonce_field("pm_ln_nonce_action","pm_ln_send_quick_contact_nonce");  ?>
            
            <div id="form-response-<?php echo $_SESSION['pm_ln_quick_contact_index']; ?>" class="pm-ln-form-response"></div>
			
		<?php echo '<input name="email_address_contact" id="pm_email_address_contact" type="hidden" value="'.esc_attr($email).'">
			<input name="quick_contact_submitted" type="hidden" value="true">
		</form>';
				
		echo $after_widget;
		
		// output template path to locate php file on server ?>
        <script> var templateDir = "<?php echo get_template_directory_uri(); ?>"; </script>
        
        <?php
		
	}//end of widget function
	
}//end of class

?>