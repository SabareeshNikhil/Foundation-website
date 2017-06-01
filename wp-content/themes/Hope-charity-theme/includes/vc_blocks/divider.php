<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_content_divider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $margin_top = $margin_bottom = $divider_style = $fancy_title = $color_selection = '' ;

        extract(shortcode_atts(array(  			
			"height" => '1',
			"width" => '',
			"bg_color" => '#00B7C2',
			"margin_top" => 20,
			"margin_bottom" => 20
		), $atts)); 


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>

        <!-- Element Code start -->
        
		<div class="pm-divider" style="height:<?php esc_attr_e($height); ?>px;  <?php echo ($width !== '' ? 'width:'.$width.'px;' : ''); ?>  background-color:<?php esc_attr_e($bg_color); ?>; margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"></div>
                   
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_content_divider",
    "name"      => __("Content Divider", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Height", 'localization'),
            "param_name" => "height",
            //"description" => __("Enter a positive integer for the top margin spacing.", 'localization'),
			"value" => '1'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'localization'),
            "param_name" => "width",
            //"description" => __("Enter a positive integer for the top margin spacing.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'localization'),
            "param_name" => "bg_color",
            //"description" => __("Enter a positive integer for the bottom margin spacing.", 'localization'),
			"value" => '#00B7C2'
        ),		
	
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", 'localization'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer for the top margin spacing.", 'localization'),
			"value" => 20
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", 'localization'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer for the bottom margin spacing.", 'localization'),
			"value" => 20
        ),
			

    )

));