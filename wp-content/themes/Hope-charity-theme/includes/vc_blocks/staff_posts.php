<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '1',
			"order" => 'DESC',
			"organiser_title" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
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

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
	
        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
        
        	<?php 
        
            $organizerTitle = get_post_meta(get_the_ID(), 'pm_organizer_title_meta', true);
            $organizerTip = get_post_meta(get_the_ID(), 'pm_organizer_tooltip_meta', true); 
			
			?>
            
            <div class="span4 pm-staff-post-shortcode-overflow" style="margin-bottom:30px;">
    
                <div class="pm_span_header pm_organizer">
                    <h4>
                        <span><?php the_title(); ?></span>
                        <?php if($organizerTip !== '') { ?>
                            <a class="fa fa-user pm_tip" title="<?php esc_attr_e($organizerTip); ?>" href="<?php the_permalink(); ?>"></a>
                        <?php } else { ?>
                            <a class="fa fa-user" href="<?php the_permalink(); ?>"></a>
                        <?php } ?>
                        
                    </h4>
                </div>
                
                <div class="pm-hover-item pm-organizer-activate">
                    <div class="pm-hover-item-title-panel">
                        <a class="fa fa-location-arrow pm_float_right" href="#"></a>
                        <p><?php esc_attr_e($organizerTitle); ?></p>
                    </div>
                    <div class="pm-hover-item-details">
                        <div class="pm-hover-item-spacer">
                            <p>
                            
                              <?php $excerpt = get_the_excerpt(); ?>
                              <?php echo pm_hope_string_limit_words($excerpt,50); ?>... 
                            
                            </p>
                            <p><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View full profile','localization'); ?> &raquo;</a></p>
                            
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
             <p><?php esc_attr_e('No staff posts were found.', 'localization'); ?></p>
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

    "base"      => "pm_ln_staff_posts",
    "name"      => __("Organizer Posts", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
	
		array(
            "type" => "dropdown",
            "heading" => __("Number of Posts", 'localization'),
            "param_name" => "num_of_posts",
            "description" => __("Select the number of organizer profiles you wish to display. Use -1 to display all organizer profiles.", 'localization'),
			"value"      => array('-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'localization'),
            "param_name" => "order",
            "description" => __("Set the order in which the posts are displayed. ASC = ascending / DESC = descending", 'localization'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
		
	
		array(
            "type" => "textfield",
            "heading" => __("Organizer Title", 'localization'),
            "param_name" => "organiser_title",
            "description" => __("If you wish to display organizer profiles based on a specific title then enter the organizer slug here.", 'localization'),
			"value" => ''
        ),
		

    )

));