<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_event_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '1',
			"order" => 'ASC',
			"category" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
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

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
	
			<?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
				
                <?php 
				
				$eventDate = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
				$month = date("M", strtotime($eventDate));
				$day = date("d", strtotime($eventDate));
				$year = date("Y", strtotime($eventDate));
				$countdown = get_post_meta(get_the_ID(), 'pm_event_countdown_meta', true);
				$eventTip = get_post_meta(get_the_ID(), 'pm_event_tooltip_meta', true);
				$eventIconFile = get_post_meta(get_the_ID(), 'pm_event_icon_meta', true);
				$eventIcon = $eventIconFile === '' ? 'fa fa-calendar' : $eventIconFile;
				
				?>
				
				<div class="span6 pm-event-post-shortcode-overflow">
					<div class="pm_span_header pm_event">
						<h4>
							<span><?php the_title(); ?></span>
							 <?php if($eventTip !== '') { ?>
								<a class="<?php esc_attr_e($eventIcon); ?> pm_tip" title="<?php esc_attr_e($eventTip); ?>" href="<?php the_permalink(); ?>"></a>
							 <?php } else { ?>
								<a class="<?php esc_attr_e($eventIcon); ?>" href="<?php the_permalink(); ?>"></a>
							 <?php } ?>
							
						</h4>
					</div>					
					<div class="pm-hover-item pm-event-activate">
						<div class="pm-hover-item-title-panel">
							<a class="fa fa-location-arrow pm_float_right" href="#"></a>
							<p><b><?php esc_attr_e('Organizer', 'localization'); ?>:</b> <?php the_author(); ?></p>
						</div>
						<div class="pm-hover-item-details">
							<div class="pm-hover-item-spacer">							
								<ul class="pm-event-info-ul-date">
									<li><strong><?php esc_attr_e($day); ?></strong></li>
									<li><p><?php esc_attr_e($month); ?></p></li>
									<li class="visible-phone" style="margin-top:15px;"><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></li>
								</ul>							
								<div class="pm-event-info-excerpt">
									<p>
										<?php $excerpt = get_the_excerpt(); ?>
									    <?php echo pm_hope_string_limit_words($excerpt,50); ?>... 
									
									</p>
									<p><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></p>
								</div>								
							</div>
						</div>
						<div class="pm-hover-item-img">
							<?php 
							
								if( has_post_thumbnail() ) :
									the_post_thumbnail();
								endif;
							
							?>
						</div>
					</div>					
				</div>
			
			<?php endwhile; else: ?>
				<div class="span12">
				 <p><?php esc_attr_e('No event posts were found.', 'localization'); ?></p>
				</div>
			<?php endif; ?>
	
		</div>
        
        <!-- Element Code / END -->
	
    	<?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_event_posts",
    "name"      => __("Event Posts", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
	
		array(
            "type" => "dropdown",
            "heading" => __("Number of Posts", 'localization'),
            "param_name" => "num_of_posts",
            "description" => __("Select the number of events you wish to display. Use -1 to display all events.", 'localization'),
			"value" => array('-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'localization'),
            "param_name" => "order",
            "description" => __("Set the order in which the posts are displayed. ASC = ascending / DESC = descending", 'localization'),
			"value" => array( 'ASC' => 'ASC', 'DESC' => 'DESC' ), //Add default value in $atts
        ),
		
	
		array(
            "type" => "textfield",
            "heading" => __("Category", 'localization'),
            "param_name" => "category",
            "description" => __("If you wish to display event posts based on a specific event category then enter the event category slug here.", 'localization'),
			"value" => ''
        ),
				

    )

));