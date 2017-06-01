<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_accordion_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
				//'expand_options' => 'off',
				//'link_color' => '#ffffff'
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_ln_accordion_id'] = (int) $el_id;
			$GLOBALS['pm_ln_accordion_count'] = 0;
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			            
            <div class="accordion pm-accordion" id="accordion<?php echo $GLOBALS['pm_ln_accordion_id']; ?>"><?php echo do_shortcode($content); ?></div>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_accordion_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"title" => 'Accordion Item 1',
				"icon" => 'fa fa-file'
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
			
            <div class="accordion-group">                
                <div class="accordion-heading">
                <div class="<?php esc_attr_e($icon); ?> pm-primary-color" id="pm-accordionIcon"></div><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $GLOBALS['pm_ln_accordion_id']; ?>" href="#<?php echo $GLOBALS['pm_ln_accordion_id']; ?>collapse<?php echo $GLOBALS['pm_ln_accordion_count']; ?>"><?php esc_attr_e($title); ?></a></div>
                <div id="<?php echo $GLOBALS['pm_ln_accordion_id']; ?>collapse<?php echo $GLOBALS['pm_ln_accordion_count']; ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php echo do_shortcode($content); ?>
                    </div>
                </div>
        	</div>
            
            <?php $GLOBALS['pm_ln_accordion_count']++; ?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Accordion Menu", 'localization'),
    "base" => "pm_ln_accordion_group",
	"category"  => __("Hope Shortcodes", 'localization'),
    "as_parent" => array('only' => 'pm_ln_accordion_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'localization'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Accordion Menu. If you are creating multiple Accordion Menus on a single page please make sure each accordion menu has a unique number assigned to it in order to avoid conflicts between menus.", 'localization'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Accordion Item", 'localization'),
    "base" => "pm_ln_accordion_group_item",
	"category"  => __("Hope Shortcodes", 'localization'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_accordion_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'localization'),
            "param_name" => "title",
            //"description" => __("Enter a title", 'localization'),
			"value" => 'Accordion Item 1'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-file)", 'localization'),
			"value" => 'fa fa-file'
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'localization'),
            "param_name" => "content",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'localization')
        ),
				
		
    )
) );