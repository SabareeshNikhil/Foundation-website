<?php get_header(); ?>
<?php 
	
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = !empty($getPageLayout) ? $getPageLayout : 'no-sidebar';
	
	$getDisableContainer = get_post_meta(get_the_ID(), 'pm_page_disable_container_meta', true);
	$disableContainer = $getDisableContainer == '' ? 'no' : $getDisableContainer;
	
	$getContainerPadding = get_post_meta(get_the_ID(), 'pm_bootstrap_container_padding_meta', true);
	$containerPadding = $getContainerPadding == '' ? '80' : $getContainerPadding;
	
	
?>

<?php if($pageLayout == 'no-sidebar') { //no sidebars - display full screen content ?>

	<?php if($disableContainer == 'yes') { ?>
    
    	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>
        
        <?php endwhile; else: ?>
        
            <p><?php esc_attr_e('No content was found.', 'localization'); ?></p>
            
        <?php endif; ?>
    
    <?php } else { ?>
    
    	<div class="container pm_paddingVertical<?php echo $containerPadding; ?>">
            <div class="row">
            	<div class="span12">
                	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

						<?php the_content(); ?>
                    
                    <?php endwhile; else: ?>
                    
                        <p><?php esc_attr_e('No content was found.', 'localization'); ?></p>
                        
                    <?php endif; ?>
                </div>            
            </div>
        </div>
    
    <?php } ?>
    
<?php } ?>	

<?php if($pageLayout == 'left-sidebar') { ?>

		<div class="container pm_paddingVertical<?php echo $containerPadding; ?>">
			<div class="row">
			
				<?php get_sidebar('page'); ?>
				
				<div class="span8 pm_default_column">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
					   <?php the_content(); ?>
					<?php endwhile; else: ?>
						<p><?php echo esc_attr_e('No content was found.', 'localization'); ?></p>
					<?php endif; ?>
				</div>
				
			</div>
		</div>     
<?php } ?>       
    
<?php if($pageLayout == 'right-sidebar') { ?>
	
		<div class="container pm_paddingVertical<?php echo $containerPadding; ?>">
			<div class="row">
				
				<div class="span8 pm_default_column">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
					   <?php the_content(); ?>
					<?php endwhile; else: ?>
						<p><?php echo esc_attr_e('No content was found.', 'localization'); ?></p>
					<?php endif; ?>
				</div>
				
				<?php get_sidebar('page'); ?>
				
			</div>
		</div>            

<?php } ?>

<?php get_footer(); ?>