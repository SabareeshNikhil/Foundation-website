<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_id" => '',
			"icon" => 'fa fa-user'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
			
			//Method to retrieve a single post
			$queried_post = get_post($post_id);
			$postID = $queried_post->ID;
			$postLink = get_permalink($postID);
			$postTitle = $queried_post->post_title;
			//$postTags = get_the_tags($postID);
			$postExcerpt = $queried_post->post_excerpt;
			$shortExcerpt = pm_hope_string_limit_words($postExcerpt, 50);
			
			$organizerTitle = get_post_meta($postID, 'pm_organizer_title_meta', true);
			$organizerTip = get_post_meta($postID, 'pm_organizer_tooltip_meta', true);   
		
		?>

        <!-- Element Code start -->
        
        <div class="pm_span_header pm_organizer">
            <h4>
                <span><?php echo esc_attr($postTitle); ?></span>
                <?php if($organizerTip !== '') { ?>
                    <a class="<?php esc_attr_e($icon); ?> pm_tip" title="<?php esc_attr_e($organizerTip); ?>" href="<?php echo get_post_permalink($postID); ?>"></a>
                <?php } else { ?>
                    <a class="<?php esc_attr_e($icon); ?>" href="<?php echo esc_url($postLink); ?>"></a>
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
                
                	<?php if($shortExcerpt !== '') : ?>                    
                    	<p>
						 <?php esc_attr_e($shortExcerpt); ?>...
                        </p>                    
                    <?php endif; ?>                
                    
                    <p><a href="<?php echo esc_url($postLink); ?>"><?php  esc_attr_e('View full profile', 'localization'); ?> &raquo;</a></p>
                    
                </div>
            </div>
            <div class="pm-hover-item-img">
                <?php echo get_the_post_thumbnail( $postID ); ?>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_staff_profile",
    "name"      => __("Organizer Profile", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Staff Post ID", 'localization'),
            "param_name" => "post_id",
            "description" => __("Enter the ID number of the organizer post you wish to display.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value icon. (Ex. fa fa-user)", 'localization'),
			"value" => 'fa fa-user'
        ),

		/*array(
            "type" => "colorpicker",
            "heading" => __("Name Color", 'localization'),
            "param_name" => "name_color",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => '#2C5E83' //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'localization'),
            "param_name" => "title_color",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => '#4B4B4B' //Add default value in $atts
        ),*/	
		

    )

));