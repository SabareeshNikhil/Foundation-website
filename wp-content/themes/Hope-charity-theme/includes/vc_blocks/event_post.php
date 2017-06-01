<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_event_post extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'id' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Method to retrieve a single post
		$queried_post = get_post($id);
		$postID = $queried_post->ID;
		$postLink = get_permalink($postID);
		$postTitle = $queried_post->post_title;
		$postDate =  mysql2date('l, F j, Y', $queried_post->post_date);
		$postAuthorID = $queried_post->post_author;
		$postAuthor = get_the_author_meta('nickname', $postAuthorID);
		$postExcerpt = $queried_post->post_excerpt;
		
		$eventMonthValue = get_post_meta($postID, 'eventMonth', true);
		if($eventMonthValue !== '') { 
			$eventMonth = substr($eventMonthValue, 0, 3);
		}
		
		$eventDate = get_post_meta($postID, 'pm_event_date_meta', true);
		
		$eventDateNew = str_replace(",", "", $eventDate);
		$datePieces = explode(" ", $eventDateNew);
		
		$month = mb_substr($datePieces[0], 0, 3);
		$day = $datePieces[1];
		$year = $datePieces[2];
		
		$countdown = get_post_meta($postID, 'pm_event_countdown_meta', true);
		$eventTip = get_post_meta($postID, 'pm_event_tooltip_meta', true);
		
		$eventIconFile = get_post_meta($postID, 'pm_event_icon_meta', true);
		$eventIcon = $eventIconFile == '' ? 'fa fa-calendar' : $eventIconFile;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm_span_header pm_event">
            <h4>
                <span><?php esc_attr_e($postTitle); ?></span>
                <?php if($eventTip !== '') { ?>
                    <a class="<?php esc_attr_e($eventIcon); ?> pm_tip" title="<?php esc_attr_e($eventTip); ?>" href="<?php echo esc_url($postLink); ?>"></a>
                <?php } else { ?>
                    <a class="<?php esc_attr_e($eventIcon); ?>" href="<?php echo esc_url($postLink); ?>"></a>
                <?php } ?>
            </h4>
        </div>
        <div class="pm-hover-item pm-event-activate">
            <div class="pm-hover-item-title-panel">
                <a class="fa fa-location-arrow pm_float_right" href="#"></a>
                <p><b><?php esc_attr_e('Organizer', 'localization') ?>:</b> <?php esc_attr_e($postAuthor); ?></p>
            </div>
            <div class="pm-hover-item-details">
                <div class="pm-hover-item-spacer">
                    <ul class="pm-event-info-ul-date">
                        <li><strong><?php esc_attr_e($day); ?></strong></li>
                        <li><p><?php esc_attr_e($month); ?></p></li>
                        <li class="visible-phone" style="margin-top:15px;"><a href="<?php echo esc_url($postLink); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></li>
                    </ul>
                    <div class="pm-event-info-excerpt" style="float:none !important; width:auto !important;">
                        <p><?php echo pm_hope_string_limit_words($postExcerpt,30); ?>...</p>
                        <p><a href="<?php echo esc_url($postLink); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></p>
                    </div>
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

    "base"      => "pm_ln_event_post",
    "name"      => __("Single Event Post", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Event Post ID", 'localization'),
            "param_name" => "id",
            "description" => __("Enter the post ID number of the event post you wish to display.", 'localization'),
			"value"      => '', //Add default value in $atts
        ),

    )

));