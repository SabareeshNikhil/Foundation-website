<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_alert extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"close" => 'true',
			"type" => 'success'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if($close == 'true'){ ?>
        
            <div class="alert alert-<?php esc_attr_e($type); ?> alert-block fade in"><a class="close" data-dismiss="alert" href="#">&times;</a><?php echo do_shortcode($content); ?></div>
            
        <?php } else { ?>
        
            <div class="alert alert-<?php esc_attr_e($type); ?> alert-block fade in"><?php echo do_shortcode($content); ?></div>
            
        <?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_alert",
    "name"      => __("Alert Message", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
			
		/*array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'localization'),
            "param_name" => "bg_color",
            //"description" => __("Enter a typicon icon value.", 'localization'),
			"value" => '#2C5E83',
        ),*/
			
		array(
            "type" => "dropdown",
            "heading" => __("Display close button?", 'localization'),
            "param_name" => "close",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'true' => 'true', 'false' => 'false' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Alert Type", 'localization'),
            "param_name" => "type",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'success' => 'success', 'info' => 'info', 'danger' => 'danger', 'warning' => 'warning' ), //Add default value in $atts
        ),
			
		/*array(
            "type" => "dropdown",
            "heading" => __("Alert type", 'localization'),
            "param_name" => "alert",
            "description" => __("Select your desired alert type.", 'localization'),
			"value"      => array( 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger' ), //Add default value in $atts
        ),*/
				
		/*array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Enter a typicon icon value.", 'localization'),
			"value" => 'typcn typcn-tick',
        ),*/
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'localization'),
            "param_name" => "content",
            //"description" => __("Enter a typicon icon value.", 'localization'),
        ),

    )

));