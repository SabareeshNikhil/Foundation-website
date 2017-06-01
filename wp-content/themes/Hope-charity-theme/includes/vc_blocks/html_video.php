<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_html_video extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_webm" => '',
			"el_mp4" => '',
			"el_ogg" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php 
			
			echo '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$el_mp4.'" type="video/mp4"><source src="'.$el_webm.'" type="video/webm"><source src="'.$el_ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
			
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_html_video",
    "name"      => __("HTML5 Video", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("WebM video", 'localization'),
            "param_name" => "el_webm",
            "description" => __("Enter the URL path to your WebM formatted video.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("MP4 video", 'localization'),
            "param_name" => "el_mp4",
            "description" => __("Enter the URL path to your MP4 formatted video.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("OGG video", 'localization'),
            "param_name" => "el_ogg",
            "description" => __("Enter the URL path to your OGG formatted video.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'localization'),
            "param_name" => "content",
            "description" => __("Enter content if required.", 'localization'),
			"value" => ''
        ),

    )

));