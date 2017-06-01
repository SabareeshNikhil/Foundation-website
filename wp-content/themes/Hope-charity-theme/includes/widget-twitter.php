<?php 

add_action('widgets_init','lateset_tweets');

function lateset_tweets() {
	register_widget('lateset_tweets');
	
	}

class lateset_tweets extends WP_Widget {
	function lateset_tweets() {
			
		$widget_ops = array('classname' => 'tweets','description' => esc_attr__('Twitter Widget - displays Latest Tweets','localization'));
/*		$control_ops = array( 'twitter name' => 'pulsar', 'count' => 3, 'avatar_size' => '32' );
*/		
		parent::__construct('latest-tweets',esc_attr__('[Micro Themes] - Twitter','localization'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$twitterWidgetID = $instance['twitterWidgetID'];
		$count = $instance['count'];
		$enableLinks = empty($instance['enableLinks']) ? '0' : $instance['enableLinks'];
		$showUser = empty($instance['showUser']) ? '0' : $instance['showUser'];
		$showTime = empty($instance['showTime']) ? '0' : $instance['showTime'];
		$showInteraction = empty($instance['showInteraction']) ? '0' : $instance['showInteraction'];
		//$avatar_size = $instance['avatar'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>

			<div id="pm-twitter-news" class="pm-tweet-list"></div> 
            
			<script type="text/javascript">
							  
				(function($) {
					
					$(document).ready(function(e) {
												
						var twitterConfig = {
						  "id": '<?php echo $twitterWidgetID; ?>',
						  "domId": 'pm-twitter-news',
						  "maxTweets": <?php echo $count; ?>,
						  "enableLinks": <?php echo $enableLinks == 1 ? 'true' : 'false' ?>,
						  "showUser": <?php echo $showUser == 1 ? 'true' : 'false' ?>,
						  "showTime": <?php echo $showTime == 1 ? 'true' : 'false' ?>,
						  "dateFunction": '',
						  "showRetweet": true,
						  "customCallback": handleTweets,
						  "showInteraction": <?php echo $showInteraction == 1 ? 'true' : 'false' ?>,
						};
						
						function handleTweets(tweets){
							var x = tweets.length;
							var n = 0;
							var element = document.getElementById('pm-twitter-news');
							var html = '<ul class="tweet_list">';
							while(n < x) {
							  html += '<li>' + tweets[n] + '</li>';
							  n++;
							}
							html += '</ul>';
							element.innerHTML = html;
						}
						
						twitterFetcher.fetch(twitterConfig);
												
					});
				  
				})(jQuery);
				
			</script>
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitterWidgetID'] = strip_tags( $new_instance['twitterWidgetID'] );
		$instance['count'] = $new_instance['count'];
		$instance['enableLinks'] = strip_tags($new_instance['enableLinks']);
		$instance['showUser'] = strip_tags($new_instance['showUser']);
		$instance['showTime'] = strip_tags($new_instance['showTime']);
		$instance['showInteraction'] = strip_tags($new_instance['showInteraction']);

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_attr__('Twitter','localization'), 
			'twitterWidgetID' => '', 
			'count' => 3,
			'enableLinks' => 0,
			'showUser' => 0,
			'showTime' => 0,
			'showInteraction' => 0,
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = $instance['title'];
		$twitterWidgetID = $instance['twitterWidgetID'];
		$count = $instance['count'];
		$enableLinks = $instance['enableLinks'];
		$showUser = $instance['showUser'];
		$showTime = $instance['showTime'];
		$showInteraction = $instance['showInteraction'];
		?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e('Title:', 'localization') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'twitterWidgetID' ); ?>"><?php esc_attr_e('Twitter Widget ID:', 'localization'); ?> <a href="https://www.microthemes.ca/knowledge-base/how-to-generate-a-twitter-widget-id/" target="_blank"><?php esc_attr_e('More info', 'localization'); ?></a></label>
		<input id="<?php echo $this->get_field_id( 'twitterWidgetID' ); ?>" name="<?php echo $this->get_field_name( 'twitterWidgetID' ); ?>" value="<?php echo esc_attr($twitterWidgetID); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_attr_e('Number of tweets to display:', 'localization') ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr($count); ?>" class="widefat" />
		</p>
        
        <p>  
            <input id="<?php echo $this->get_field_id('enableLinks'); ?>" name="<?php echo $this->get_field_name('enableLinks'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['enableLinks'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'enableLinks' ); ?>"><?php esc_attr_e('Activate Links?', 'localization'); ?></label>  
        </p>
        
        
        
        
        <p>  
            <input id="<?php echo $this->get_field_id('showUser'); ?>" name="<?php echo $this->get_field_name('showUser'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showUser'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'showUser' ); ?>"><?php esc_attr_e('Display User Thumbnail?', 'localization'); ?></label>  
        </p>
        
        <p>  
            <input id="<?php echo $this->get_field_id('showTime'); ?>" name="<?php echo $this->get_field_name('showTime'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showTime'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'showTime' ); ?>"><?php esc_attr_e('Display time of tweet?', 'localization'); ?></label>  
        </p>
        
        <p>  
            <input id="<?php echo $this->get_field_id('showInteraction'); ?>" name="<?php echo $this->get_field_name('showInteraction'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showInteraction'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'showInteraction' ); ?>"><?php esc_attr_e('Display Interaction Links?', 'localization'); ?></label>  
        </p>
        
   <?php 
}
	} //end class