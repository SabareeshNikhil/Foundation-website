<?php get_header(); ?>

<?php 
	$getPostLayout = get_post_meta(get_the_ID(), 'pm_post_layout_meta', true);
	$postLayout = $getPostLayout !== '' ? $getPostLayout : 'no-sidebar';
?>


<div class="container pm_paddingVertical80 pm_gallery_post">
    
    <div class="row">
    
    	<?php if($postLayout == 'no-sidebar') { ?>
             
             <div <?php post_class('span12'); ?>>
             
             	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
					<?php get_template_part( 'content', 'singlepostgallery' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No post was found.', 'localization'); ?></p>
                <?php endif; ?> 
             
             </div>
        
        <?php } elseif($postLayout == 'left-sidebar') { ?>
        
            <?php get_sidebar('post'); ?>
            
            <div <?php post_class('span8'); ?>>
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                    <?php get_template_part( 'content', 'singlepostgallery' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php endif; ?>
                
            </div><!-- /blogColumn -->
        
        <?php } elseif($postLayout == 'right-sidebar') { ?>
            
            <div <?php post_class('span8'); ?>>
                    
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                    
                    <?php get_template_part( 'content', 'singlepostgallery' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No posts were found. Sorry!', 'localization'); ?></p>
                <?php endif; ?>
                
              
            </div><!-- /blogColumn -->
            
            <?php get_sidebar('post'); ?>
        
        <?php } ?>
            
        
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>