<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_single_post extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'id' => '',
			'display_social_meta' => 'on',
			'display_comments_count' => 'on',
			'display_excerpt' => 'off',
			'display_meta' => 'on',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Method to retrieve a single post
		$queried_post = get_post($id);
		$postID = $queried_post->ID;
		$postLink = get_permalink($postID);
		$postTitle = $queried_post->post_title;
		$postDate =  mysql2date('l, F j, Y', $queried_post->post_date);
		$postAuthorID = $queried_post->post_author;
		$postAuthor = get_the_author_meta('nickname', $postAuthorID);
		//$postTags = get_the_tags($postID);
		$postCommentCount = $queried_post->comment_count;
		$postExcerpt = $queried_post->post_excerpt;
		$postContent = $queried_post->post_content;
		$postTip = get_post_meta($postID, 'pm_post_tooltip_meta_function', true);
		$postIconSaved = get_post_meta($postID, 'pm_post_icon_meta', true);
		$postIcon = $postIconSaved != '' ? $postIconSaved : 'fa fa-file';
		
		$displayExcerptOnMeta = get_theme_mod('displayExcerptOnMeta', 'on');
			
        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-single-post-shortcode-container">
	
            <div class="pm_span_header pm_post_single">
            <h4>
            
            <span><?php esc_attr_e($postTitle); ?></span>
            
            <?php if( $postTip !== '' ){ ?>
                <a class="<?php esc_attr_e($postIcon); ?> pm_tip" title="<?php esc_attr_e($postTip); ?>" href="<?php echo esc_url($postLink); ?>"></a>
            <?php } else { ?>
                <a class="<?php esc_attr_e($postIcon); ?>" href="<?php echo esc_url($postLink); ?>"></a>
            <?php } ?>
                        
            </h4>
            </div>
            
            <div class="pm-hover-item">
            
                <div class="pm-hover-item-title-panel">
                <a class="icon-location-arrow pm_float_right pm_panel_touch_btn"></a>
                            
                <?php if( $display_meta === 'on' ) { ?>
                    <p><b><?php esc_attr_e('Posted','localization'); ?></b> <?php esc_attr_e($postDate); ?><b> <?php esc_attr_e('by','localization'); ?></b> <?php esc_attr_e($postAuthor); ?></p>
                <?php } ?>
                
                <?php if( $displayExcerptOnMeta === 'on' ){ ?>
                    <p><?php echo pm_hope_string_limit_words($postExcerpt, 7); ?>...</p>
                <?php } ?>
                
                </div>
                
                <div class="pm-hover-item-details">
                    <div class="pm-hover-item-spacer">
                    
                    	<?php if( $display_excerpt === 'on' ){ ?>
                            <p><?php echo pm_hope_string_limit_words($postExcerpt, 20); ?>...</p>
                        <?php } ?>
                                            
                        <a href="<?php echo esc_url($postLink); ?>"><?php esc_attr_e('Read More','localization'); ?> &raquo;</a>
                    
                        
                        <?php if($display_comments_count === 'on'){ ?>
                            <div class="pm_post_tags">
                            <i class="fa fa-comment"></i><?php echo get_comments_number(); ?> <?php esc_attr_e('comments', 'localization'); ?>	
                            </div>
                        <?php } else { ?>
                            <div class="pm_post_tags" style="margin-bottom:0px;">
                            </div>	
                        <?php } ?>
                        
                        <?php if( $display_social_meta === 'on' ) : ?>										
                                                    
                            <ul class="pm-post-social-icons">
                            
                                <li class="twitter">
                                <a target="_blank" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                                
                                <li class="facebook">
                                <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                                
                                <li class="linkedin">
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </li>
                                
                                <li class="gplus">
                                <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                                </li>
                            
                            </ul>
                        
                        <?php endif; ?>	
                    
                    </div>
                </div>
                
                <div class="pm-hover-item-img">
                	<?php echo get_the_post_thumbnail( $postID ); ?>
                </div>
                
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

    "base"      => "pm_ln_single_post",
    "name"      => __("Single Post", 'localization'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", 'localization'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Post ID", 'localization'),
            "param_name" => "id",
            "description" => __("Enter the post ID number of the post you wish to display.", 'localization'),
			"value" => ''
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Social Links?", 'localization'),
            "param_name" => "display_social_meta",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Comments Count?", 'localization'),
            "param_name" => "display_comments_count",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Excerpt?", 'localization'),
            "param_name" => "display_excerpt",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Meta info?", 'localization'),
            "param_name" => "display_meta",
            //"description" => __("Choose the divider style you desire.", 'localization'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),

    )

));