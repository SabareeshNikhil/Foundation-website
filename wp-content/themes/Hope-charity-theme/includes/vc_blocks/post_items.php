<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '1',
			"order" => 'DESC',
			'display_social_meta' => 'on',
			'display_comments_count' => 'on',
			'display_excerpt' => 'on',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => $order,
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
		);
	
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
			
			$postIconFile = get_post_meta(get_the_ID(), 'pm_post_icon_meta', true);
			$postDate =  mysql2date('l, F j, Y', get_the_date());
			
			$postTip = get_post_meta(get_the_ID(), 'pm_post_tooltip_meta', true);
			$postIconSaved = get_post_meta(get_the_ID(), 'pm_post_icon_meta', true);
			$postIcon = $postIconSaved != '' ? $postIconSaved : 'fa fa-link';
			
			$displayExcerptOnMeta = get_theme_mod('displayExcerptOnMeta', 'on');
			
			?>
			            
            <div class="span4 pm-post-item-shortcode">
        
                <div class="pm_span_header pm_post_single">
                <h4>
                
                <span><?php the_title(); ?></span>
                
                <?php if( $postTip !== '' ){ ?>
                    <a class="<?php esc_attr_e($postIcon); ?> pm_tip" title="<?php esc_attr_e($postTip); ?>" href="<?php the_permalink(); ?>"></a>
                <?php } else { ?>
                    <a class="<?php esc_attr_e($postIcon); ?>" href="<?php the_permalink(); ?>"></a>
                <?php } ?>
                
                
                </h4>
                </div>
                
                <div class="pm-hover-item">
                
                    <div class="pm-hover-item-title-panel">
                    <a class="icon-location-arrow pm_float_right pm_panel_touch_btn"></a>
                    
                    <p><b><?php  esc_attr_e('Posted', 'localization'); ?></b> <?php esc_attr_e($postDate); ?><b> <?php esc_attr_e('by', 'localization'); ?></b> <?php the_author(); ?></p> 
                    
                    <?php if($displayExcerptOnMeta === 'on') : ?>
                    	<p><?php echo pm_hope_string_limit_words(get_the_excerpt(), 7); ?>...</p>
                    <?php endif; ?>                   				
                    
                    </div>
                    
                    <div class="pm-hover-item-details">
                        <div class="pm-hover-item-spacer">
                        
                        	<?php if( $display_excerpt === 'on' ){ ?>
                                <p><?php echo pm_hope_string_limit_words(get_the_excerpt(), 20); ?>...</p>
                            <?php } ?>			                            
                            
                            <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'localization'); ?> &raquo;</a>
                            
                            <?php if( $display_comments_count === 'on' ) { ?>
                            
                                <div class="pm_post_tags">
                                <i class="fa fa-comment"></i> <?php echo get_comments_number(); ?> <?php esc_attr_e('comments', 'localization'); ?>	
                                </div>
                            
                            <?php } else { ?>
                                
                                <div class="pm_post_tags" style="margin-bottom:0px;">
                                </div>	
                                
                            <?php }	?>
                            
                            <?php if( $display_social_meta === 'on' ) : ?>
                                                                                    
                                <ul class="pm-post-social-icons">
                                
                                    <li class="twitter">
                                        <a target="_blank" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    
                                    <li class="facebook">
                                        <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    
                                    <li class="linkedin">
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    
                                    <li class="gplus">
                                        <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                
                                </ul>
                            
                            <?php endif; ?>						
                        
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
			 <p><?php esc_attr__('No posts were found.', 'localization'); ?></p>
			</div>
		<?php endif; ?>
        
        </div>
                    
        <?php wp_reset_postdata(); ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'localization'),
            "param_name" => "num_of_posts",
            "description" => __("Select the number of news posts you wish to display. Use -1 to display all news posts.", 'localization'),
			"value"      => array('-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'localization'),
            "param_name" => "order",
            "description" => __("Set the order in which news posts will be displayed.", 'localization'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Social Links?", 'localization'),
            "param_name" => "display_social_meta",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Comments Count?", 'localization'),
            "param_name" => "display_comments_count",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Excerpt?", 'localization'),
            "param_name" => "display_excerpt",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		
				
    )

));