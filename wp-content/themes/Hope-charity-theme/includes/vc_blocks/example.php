<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_shortcode_name extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'el_class' => '',

        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_visual_service",
    "name"      => __("Visual Service Block", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Class", 'localization'),
            "param_name" => "el_class",
            "description" => __("Enter a CSS class if required.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Divider Style", 'localization'),
            "param_name" => "divider_style",
            "description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'simple' => 'simple', 'title' => 'title', 'column' => 'column', 'fancy' => 'fancy' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textarea",
            "heading" => __("Description", 'localization'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'localization')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Description", 'localization'),
            "param_name" => "el_description",
            "description" => __("Enter a short description for your service.", 'localization')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Image", 'localization'),
            "param_name" => "el_image",
            "description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),

    )

));