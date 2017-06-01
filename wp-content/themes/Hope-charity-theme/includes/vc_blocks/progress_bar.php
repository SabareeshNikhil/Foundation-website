<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_progress_bar extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"percentage" => '50',
			"type" => 'success',
			"animation" => 'active'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="progress progress-striped progress-<?php esc_attr_e($type); ?> <?php esc_attr_e($animation); ?>">
          <div class="bar" style="width: <?php esc_attr_e($percentage); ?>%"></div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_progress_bar",
    "name"      => __("Progress Bar", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'localization'),
            "param_name" => "percentage",
            "description" => __("Enter a positive integer value between 0 and 100.", 'localization'),
			"value" => '50'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Bar Type", 'localization'),
            "param_name" => "type",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Animation Type", 'localization'),
            "param_name" => "animation",
            //"description" => __("Enter a unique ID number to avoid conflicts with multiple progress bars on the same page.", 'localization'),
			"value"      => array( 'active' => 'active', 'static' => 'static' ), //Add default value in $atts
        ),
				

    )

));