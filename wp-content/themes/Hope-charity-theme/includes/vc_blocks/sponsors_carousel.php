<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_sponsors_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"icon" => 'fa fa-thumbs-o-up',
			"controls" => 'true',
			"sponsors_text" => 'Our Sponsors',
			"target_window" => '_blank'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			
			global $hope_options;
	
			$clients = '';
				
			if( isset($hope_options['opt-client-slides']) && !empty($hope_options['opt-client-slides']) ){
				$clients = $hope_options['opt-client-slides']; //This should return an empty array if no slides are present...not an undefined index notice
			}
						
		?>

        <!-- Element Code start -->
        
        <?php
		
			if ( is_array($clients) ) {
		
				echo '<div id="pm_sponsors_carousel" class="owl-carousel owl-theme"> ';        
					
						foreach( $clients as $c ) {
						
							echo '<div class="pm-carousel-item">'; 
							if($c['url'] != '') {
								
								echo '<a href="'. esc_url($c['url']) .'" '. ($c['description'] !== '' ? 'class="pm_tip" title="'.$c['description'].'"' : '') .'" target="'. esc_attr($target_window) .'"><img src="'. esc_url($c['image']) .'" alt="'. esc_attr($c['title']) .'" /></a>';
								
							} else {
								
								echo '<img src="'. esc_url($c['image']) .'" '. ($c['description'] !== '' ? 'class="pm_tip" title="'.$c['description'].'"' : '') .' alt="'. esc_attr($c['title']) .'" />';
								
							}
							
							echo '</div>';
						
						}//end of foreach
				
				 echo '</div>';
				 
				 if($controls === 'true') {
					 
					 echo '<div class="pm-brand-carousel-btns">';
						echo '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
						echo '<a class="btn pm-owl-play fa fa-stop" id="pm-owl-play"></a>';
						echo '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
					 echo '</div>';
					 
				 }
			 
			}
			
			if($sponsors_text !== '') :
			
				echo '<div class="pm_sponsors_title">';
				
					esc_attr_e($sponsors_text);
					
				echo '</div>';
			
			endif;
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_sponsors_carousel",
    "name"      => __("Sponsors Carousel", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
	
	
		array(
            "type" => "textfield",
            "heading" => __("Carousel Message", 'localization'),
            "param_name" => "sponsors_text",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value"      => 'Our Sponsors'
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'localization'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-thumbs-o-up)", 'localization'),
			"value"      => 'fa fa-thumbs-o-up'
        ),
	
		array(
            "type" => "dropdown",
            "heading" => __("Controls", 'localization'),
            "param_name" => "controls",
            //"description" => __("Set the target window for the client link.", 'localization'),
			"value"      => array( 'true' => 'true', 'false' => 'false' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Browser Target Window", 'localization'),
            "param_name" => "target_window",
            //"description" => __("Set the target window for the client link.", 'localization'),
			"value"      => array( '_blank' => '_blank', '_self' => '_self' ), //Add default value in $atts
        ),
		
		

    )

));