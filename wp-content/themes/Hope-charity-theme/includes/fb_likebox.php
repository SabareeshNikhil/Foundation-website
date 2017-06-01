<?php 

add_action('widgets_init','fb_likebox_widget');

function fb_likebox_widget() {
	register_widget('fb_likebox_widget');
	
	}

class fb_likebox_widget extends WP_Widget {
	function fb_likebox_widget() {
			
		$widget_ops = array('classname' => 'Like-box','description' => esc_attr__('Facebook Like Box','localization'));

		parent::__construct('Like-box',esc_attr__('[Micro Themes] - Facebook Likebox','localization'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'FaceBook' ) : $instance['title'], $instance, $this->id_base );
		$show_header = empty( $instance['show_header'] ) ? '' : $instance['show_header'];
		$show_faces = empty( $instance['show_faces'] ) ? '' : $instance['show_faces'];
		$show_border = empty( $instance['show_border'] ) ? '' : $instance['show_border'];
		$show_stream = empty( $instance['show_stream'] ) ? '' : $instance['show_stream'];
		$height = empty( $instance['height'] ) ? '' : $instance['height'];
		$page = empty( $instance['page'] ) ? '' : $instance['page'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
			
?>
        <div class="like_box_footer">
                
        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_html($page); ?>&amp;width=100&amp;height=<?php echo esc_attr($height); ?>&amp;colorscheme=light&amp;show_faces=<?php echo $show_faces == 1 ? 'true' : 'false' ?>&amp;header=<?php echo $show_header == 1 ? 'true' : 'false' ?>&amp;stream=<?php echo $show_stream == 1 ? 'true' : 'false' ?>&amp;show_border=<?php echo $show_border == 1 ? 'true' : 'false' ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:<?php echo esc_attr($height); ?>px;" allowTransparency="true"></iframe>
        
		</div><!--like_box_footer-->
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_header'] = strip_tags($new_instance['show_header']);
		$instance['show_faces'] = strip_tags($new_instance['show_faces']);
		$instance['show_border'] = strip_tags($new_instance['show_border']);
		$instance['show_stream'] = strip_tags($new_instance['show_stream']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['page'] = $new_instance['page'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => '',
			'page' => '',
			'show_header' => 0,
			'show_faces' => 0,
			'show_border' => 0,
			'show_stream' => 0,
			'height' => 0,
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e('Title:', 'localization') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>  
            <input id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_header'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_header' ); ?>"><?php esc_attr_e('Show Header?', 'localization'); ?></label>  
        </p>  
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_faces'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php esc_attr_e('Show Faces?', 'localization'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_border'); ?>" name="<?php echo $this->get_field_name('show_border'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_border'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>"><?php esc_attr_e('Show Border?', 'localization'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_stream'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_stream' ); ?>"><?php esc_attr_e('Show Stream?', 'localization'); ?></label>  
        </p>  

    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php esc_attr_e('Height:', 'localization') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo esc_attr($instance['height']); ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo esc_html($this->get_field_id( 'page' )); ?>"><?php esc_attr_e('Facebook Page URL:', 'localization') ?></label>
		<input id="<?php echo esc_html($this->get_field_id( 'page' )); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" value="<?php echo esc_html($instance['page']); ?>"  class="widefat" />
		</p>
        
   <?php 
}
	} //end class