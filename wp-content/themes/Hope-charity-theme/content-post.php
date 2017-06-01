<?php
/**
 * The default template for displaying blog post(s) without sidebars. Used for index/blog/archive/tags.
 */
?>

<?php 
            
	$postIconFile = get_post_meta(get_the_ID(), 'pm_post_icon_meta', true);
	$postIcon = $postIconFile == '' ? 'fa fa-file' : $postIconFile;
	$postToolTip = get_post_meta(get_the_ID(), 'pm_post_tooltip_meta', true);
	
	$displaySocialMeta = get_theme_mod('displaySocialMeta','on');
	$displayMetaInfo = get_theme_mod('displayMetaInfo','on'); 
	$displayExcerptOnMeta = get_theme_mod('displayExcerptOnMeta','off'); 
	
?>
			
<div class="pm_span_header pm_post">
    <h4>
        <span><?php the_title(); ?></span>
        <?php if($postToolTip !== '') { ?>
            <a class="<?php echo esc_attr($postIcon); ?> pm_tip" title="<?php echo esc_attr($postToolTip); ?>" href="<?php the_permalink(); ?>"></a>
        <?php } else { ?>
            <a class="<?php echo esc_attr($postIcon); ?>" href="<?php the_permalink(); ?>"></a>
        <?php } ?>
        
    </h4>
</div>
<!-- news post -->
<div class="pm-hover-item">
    <div class="pm-hover-item-title-panel">
        <a class="fa fa-location-arrow pm_float_right" href="#"></a>
        
        <?php if($displayMetaInfo === 'on') : ?>
        	<p><b><?php esc_attr_e('Posted', 'localization') ?></b> <?php the_time('l F d, Y'); ?> <b><?php esc_attr_e('by', 'localization') ?></b> <?php the_author(); ?></p>
        <?php endif; ?>
        
        
        <?php if($displayExcerptOnMeta === 'on') : ?>
        
        	<p class="pm-hover-item-excerpt">
				<?php  
                    $excerpt = get_the_excerpt();
                    echo pm_hope_string_limit_words($excerpt,12) .'...'; 
                ?>
            </p>
        
        <?php endif; ?>
        
    </div>
    <div class="pm-hover-item-details">
        <div class="pm-hover-item-spacer">
            <p><?php  $excerpt = get_the_excerpt();
              echo pm_hope_string_limit_words($excerpt,30) .'...'; 
            ?></p>
            <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'localization'); ?> &raquo;</a>
            
            <div class="pm_post_tags">
                <?php if( !is_search() ) : ?>
                    <i class="fa fa-tags"></i>
                    <?php the_tags('',', '); ?>
                    
                    <?php if($displaySocialMeta === 'on') : ?>
                    
                    	<i class="fa fa-comments" style="margin-left:5px;"></i>
                    	<?php echo get_comments_number(); ?> <?php esc_attr_e('comments', 'localization') ?>
                    
                    <?php endif; ?>  
                    
                    
                <?php endif; ?>
            </div>            
            
            
            <?php if($displaySocialMeta === 'on') : ?>
            
            	<ul class="pm-post-social-icons">       
                    <li class="twitter">
                    <a target="_blank" href="https://twitter.com/share?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>"><i class="fa fa-twitter"></i></a>
                    </li>
                    
                    <li class="facebook">
                    <a target="_blank" href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>"><i class="fa fa-facebook"></i></a>
                    </li>
                    
                    <li class="linkedin">
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </li>
                    
                    <li class="gplus">
                    <a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </li>                           
                </ul>
            
            <?php endif; ?>   
            
            
        </div>
    </div>
    <div class="pm-hover-item-img news-post">
        <?php if(has_post_thumbnail()) { ?>
            <?php the_post_thumbnail(); ?>
        <?php } ?>
    </div>
</div>
	
<!-- LOOP -->