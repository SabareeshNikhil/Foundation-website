<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_featured_panel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"bgcolor" => '',
			"bgimage" => '',
			"border_color" => '#3C3C3C',
			"class" => ''
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
		
        if($bgimage != ''){
			
            echo '<div class="pm_feature_container '. ($class !== '' ? esc_attr($class) : '') .'" style="background-image:url('. esc_url($bgimage) .'); background-color:'. esc_attr($bgcolor) .'; border-bottom:8px solid '.esc_attr($border_color) .'; border-top:8px solid '. esc_attr($border_color) .';">'. do_shortcode($content) .'</div>';  
			
        } else {
			
            echo '<div class="pm_feature_container '. ($class !== '' ? esc_attr($class) : '') .'" style="background-color:'. esc_attr($bgcolor) .'; border-bottom:8px solid '. esc_attr($border_color) .'; border-top:8px solid '.esc_attr($border_color) .';">'. do_shortcode($content) .'</div>'; 
				
		}
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_featured_panel",
    "name"      => __("Featured Panel", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Class", 'localization'),
            "param_name" => "class",
            "description" => __("Enter a CSS class if required.", 'localization'),
			"value" => ''
        ),	
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'localization'),
            "param_name" => "bgimage",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),		
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'localization'),
            "param_name" => "bgcolor",
			"value" => ''
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'localization'),
            "param_name" => "border_color",
			"value" => '#3C3C3C'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'localization'),
            "param_name" => "content",
            //"description" => __("Enter a short description for your service.", 'localization')
        ),

    )

));