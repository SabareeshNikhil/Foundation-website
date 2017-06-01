<?php 

add_action('widgets_init','pulsar_video_widgets');

function pulsar_video_widgets() {
	register_widget('pulsar_video_widgets');
}

class pulsar_video_widgets extends WP_Widget {
	
	function pulsar_video_widgets() {
			
		$widget_ops = array('classname' => 'pulsar-videos','description' => esc_attr__('Video Widget - supports Youtube, Vimeo, Dailymotion','localization'));
		/* $control_ops = array( 'twitter name' => 'pulsar', 'count' => 3, 'avatar_size' => '32' ); */		
		parent::__construct('pulsar-videos',esc_attr__('[Micro Themes] - Videos','localization'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Video' ) : $instance['title'], $instance, $this->id_base );
		$type = $instance['type'];
		$id = $instance['id'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
	<?php if($type == 'Youtube') { ?>
		<iframe width="100%" height="235" src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'Vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="100%" height="235" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'Dailymotion') { ?>
		<iframe frameborder="0" width="100%" height="235" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
	<?php } ?>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_attr__('Videos','localization'), 
			'title' => '', 
			'type' => 'Youtube',
			'id' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e('Title:', 'localization') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

        <p>
        <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php esc_attr_e('Video Type:', 'localization') ?></label>
        <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
            <option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Youtube', 'localization') ?></option>
            <option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Vimeo', 'localization') ?></option>
            <option <?php if ( 'Dailymotion' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Dailymotion', 'localization') ?></option>
        </select>
        </p>

		<p>
		<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php esc_attr_e('Video ID:', 'localization') ?></label>
		<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" />
		</p>

        
   <?php 
}
	} //end class