<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_feature_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"icon" => 'fa fa-thumbs-o-up',
			"icon_image" => '',
			"icon_color" => '#ffffff',
			"title_color" => '#ffffff',
			"title" => 'Title goes here',
			"button_text" => '',
			"button_url" => '#',
			"btn_color" => '#ACDB05',
			"btn_text_color" => '#3d3d3d'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($icon_image, "large"); 
			$icon_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="feature-box">
	
            <?php if($icon_image !== ''){ ?>
                <img alt="<?php esc_attr_e($title); ?>" src="<?php esc_attr_e($icon_image); ?>">
            <?php } else { ?>
                <i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($icon_color); ?>;"></i>	
            <?php } ?>
            
            <div class="content">
                <h5 style="color:<?php esc_attr_e($title_color); ?>;"><?php esc_attr_e($title); ?></h5>
                <?php echo do_shortcode($content); ?>
                
                <?php if( $button_text !== '' ) : ?>
                
                	<a class="button-small" href="<?php esc_attr_e($button_url); ?>" style="background-color:<?php esc_attr_e($btn_color); ?>;" target="_self">
                        <span style="color:<?php esc_attr_e($btn_text_color); ?>;"><?php esc_attr_e($button_text); ?></span><i class="fa fa-chevron-right"></i>
                    </a>
                
                <?php endif; ?>               
                
            </div>
            
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_feature_box",
    "name"      => __("Feature Box", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", 'localization'),
            "param_name" => "title",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => 'fa fa-thumbs-o-up'
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Icon Image", 'localization'),
            "param_name" => "icon_image",
            "description" => __("Upload a custom icon image if required.", 'localization')
        ),
		
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'localization'),
            "param_name" => "icon_color",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'localization'),
            "param_name" => "title_color",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => '#ffffff'
        ),		
		
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'localization'),
            "param_name" => "button_text",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'localization'),
            "param_name" => "button_url",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => '#'
        ),	
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Color", 'localization'),
            "param_name" => "btn_color",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => '#ACDB05'
        ),	
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", 'localization'),
            "param_name" => "btn_text_color",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => '#3d3d3d'
        ),	
		
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'localization'),
            "param_name" => "content",
            //"description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value" => ''
        ),
		

    )

));