<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(	
			"btn_text" => '',
			"color" => '#ACDB05',
			"textcolor" => '#ffffff',
			"type" => 'small',
			"url" => '#',
			"target" => '_self',
			"margin" => 10,
			"icon" => 'fa fa-chevron-right'
			), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <a class="button-<?php esc_attr_e($type); ?>" style="background-color:<?php esc_attr_e($color); ?>; margin:<?php esc_attr_e($margin); ?>px 0;" href="<?php echo esc_url($url); ?>" target="<?php esc_attr_e($target); ?>"><span style="color:<?php esc_attr_e($textcolor); ?> !important;"><?php esc_attr_e($btn_text); ?></span><i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($textcolor); ?> !important;"></i></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'localization'),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", 'localization'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'localization'),
            "param_name" => "url",
            //"description" => __("Enter a CSS class if required.", 'localization'),
			"value" => '#'
        ),

		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'localization'),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", 'localization'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Spacing", 'localization'),
            "param_name" => "margin",
            "description" => __("Accepts a positive integer value.", 'localization'),
			"value" => 10
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-angle-right)", 'localization'),
			"value" => 'fa fa-chevron-right'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Color", 'localization'),
            "param_name" => "color",
            //"description" => __("Enter an icon value.", 'localization'),
			"value" => '#ACDB05'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'localization'),
            "param_name" => "textcolor",
            //"description" => __("Enter an icon value.", 'localization'),
			"value" => '#ffffff'
        ),	
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Type", 'localization'),
            "param_name" => "type",
            "description" => __("Set the size of your button.", 'localization'),
			"value"      => array( 'small' => 'small', 'medium' => 'medium', 'large' => 'large' ), //Add default value in $atts
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Button Type", 'localization'),
            "param_name" => "button_type",
            //"description" => __("Adds a rollover animation effect to the icon.", 'localization'),
			"value"      => array( 'opaque' => 'opaque', 'transparent' => 'transparent' ), //Add default value in $atts
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Class", 'localization'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'localization'),
			"value" => ''
        ),*/


    )

));