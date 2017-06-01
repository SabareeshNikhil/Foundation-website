<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_youtube_video extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_video_id" => '',
			"el_width" => 300,
			"el_height" => 250,
			"el_responsive" => 'yes',
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
			
		if($el_responsive == 'yes'){
			$finalWidth = 100 .'%';
		} else {
			$finalWidth = $el_width . 'px';	
		}
		
		echo '<iframe src="http://www.youtube.com/embed/'.esc_attr($el_video_id).'" height="'.esc_attr($el_height).'" style="width:'. esc_attr($finalWidth) .';"></iframe>';  
			
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_youtube_video",
    "name"      => __("YouTube Video", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Video ID", 'localization'),
            "param_name" => "el_video_id",
            "description" => __("Enter your Youtube video ID.", 'localization')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video width", 'localization'),
            "param_name" => "el_width",
            "description" => __("Enter a custom width for your video.", 'localization'),
			"value"      => 300, //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video height", 'localization'),
            "param_name" => "el_height",
            "description" => __("Enter a custom height for your video.", 'localization'),
			"value"      => 250, //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Make video responsive?", 'localization'),
            "param_name" => "el_responsive",
            "description" => __("Enable responsiveness for your video - this value overrides the Video width value.", 'localization'),
			"value"      => array( 'yes' => 'yes', 'no' => 'no'), //Add default value in $atts
        ),

    )

));