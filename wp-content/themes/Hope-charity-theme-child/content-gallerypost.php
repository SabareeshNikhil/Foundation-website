<?php
/**
 * The default template for displaying staff posts on the staff template.
 */
?>

<?php 
            
	$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
	$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
	$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
	$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
		
	$ppShowTitle = get_theme_mod('ppShowTitle');
	
?>

<?php 
$terms = get_the_terms($post->ID, 'gallerycats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- gallery item -->
<div class="pm-isotope-item span4 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">

    <div class="pm-gallery-item-container">
    
    	<div class="pm-gallery-item-title">
        	<p><?php the_title(); ?></p>
        </div>
        
        <div class="pm-gallery-item-hover-btn"></div>
        
        <div class="pm-gallery-item-caption">
        	<p><?php echo esc_attr($pm_gallery_item_caption_meta); ?></p>
        </div>
        
        <ul class="pm-gallery-item-btns">
        
        	<?php if($pm_gallery_video_meta !== '') { ?>
            
            	<?php if($pm_gallery_display_video_meta == 'yes') { ?>
                                    
                    <li><a href="<?php echo esc_html($pm_gallery_video_meta); ?>" data-rel="prettyPhoto[gallery]" class="fa fa-video-camera lightbox"  <?php echo $ppShowTitle == 'true' ? 'title="'.esc_attr($pm_gallery_item_caption_meta).'"' : ''; ?>></a></li>
                
                <?php } else { ?>
                                    
                    <li><a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="fa fa-camera lightbox" <?php echo $ppShowTitle == 'true' ? 'title="'.esc_attr($pm_gallery_item_caption_meta).'"' : ''; ?>></a></li>
                
                <?php } ?>
            
            <?php } else { ?>
            
            	<li><a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="fa fa-camera lightbox" <?php echo $ppShowTitle == 'true' ? 'title="'.esc_attr($pm_gallery_item_caption_meta).'"' : ''; ?>></a></li>
            
            <?php } ?>
        
        	
            <li><a href="<?php the_permalink(); ?>" class="fa-bars"></a></li>
            <li><a class="fa-close pm-gallery-item-close"></a></li>
        </ul>
    
        <div class="pm-gallery-item-img-container" style="background-image:url(<?php echo esc_html($pm_gallery_image_meta); ?>);">
            <span></span>
        </div>
        
    </div>
    
</div><!-- /.col-lg-4 -->
<!-- /gallery item -->