<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_social_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			            
            <ul class="pm-personal-icons"><?php echo do_shortcode($content) ?></ul>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_social_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"icon" => 'fa fa-twitter',
				"link" => '#',
				"target" => '_self',
				"size" => '5',
				"color" => '#333333'
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <li><a href="<?php echo esc_url($link); ?>" target="<?php esc_attr_e($target); ?>" style="padding:<?php esc_attr_e($size); ?>px; background-color:<?php esc_attr_e($color); ?>;"><i class="<?php esc_attr_e($icon); ?>"></i></a></li>
                        
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Icon Group", 'localization'),
    "base" => "pm_ln_social_group",
	"category"  => __("Hope Shortcodes", 'localization'),
    "as_parent" => array('only' => 'pm_ln_social_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		/*
		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'localization'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Accordion Menu. If you are creating multiple Accordion Menus on a single page please make sure each accordion menu has a unique number assigned to it in order to avoid conflicts between menus.", 'localization'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		*/
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Icon Group Item", 'localization'),
    "base" => "pm_ln_social_group_item",
	"category"  => __("Hope Shortcodes", 'localization'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_social_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-file)", 'localization'),
			"value" => ''
        ),
		
        array(
            "type" => "textfield",
            "heading" => __("Link", 'localization'),
            "param_name" => "link",
            //"description" => __("Enter a title", 'localization'),
			"value" => '#'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Window Target", 'localization'),
            "param_name" => "target",
            "description" => __("Set the browser target window for the link.", 'localization'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

		array(
            "type" => "textfield",
            "heading" => __("Size", 'localization'),
            "param_name" => "size",
            "description" => __("Accepts a positive integer value.", 'localization'),
			"value" => '5'
        ),

		array(
            "type" => "colorpicker",
            "heading" => __("Color", 'localization'),
            "param_name" => "color",
			"value" => '#333333'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),	
		
    )
) );