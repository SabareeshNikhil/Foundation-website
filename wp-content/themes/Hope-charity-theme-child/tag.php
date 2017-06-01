<?php get_header(); ?>

<?php 
$blogTemplateLayout = get_theme_mod('blogTemplateLayout', 'full-width');
?>

<?php
	//global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
		'tag' => get_query_var('tag')
	);

	$blog_query = new WP_Query($arguments);

	pm_hope_set_query($blog_query);
?>


<div class="container pm_paddingVertical60 pm_posts">
    <div class="row">
    
		<?php if($blogTemplateLayout == 'full-width') { ?>
             
				<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                    <!-- LOOP -->
                    <article <?php post_class(); ?>>
                        <div class="span12">
                            <?php get_template_part( 'content', 'post' ); ?>
                        </div>
                    </article>
                    <!-- LOOP -->
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php endif; ?> 
                
                
                <div class="span12">
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					}
                    pm_hope_restore_query();  
                ?>
                </div>       
            
            <?php } elseif($blogTemplateLayout == 'left-sidebar') { ?>
            
                <?php get_sidebar('blog'); ?>
                
                <div class="span8 blog-column">
                
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                       	<?php get_template_part( 'content', 'postcolumn' ); ?>
                                     
                        <div class="pm_posts_divider"></div>   
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                    <?php endif; ?>
                    
                    <?php  
                        if(function_exists('pm_hope_kriesi_pagination')){
							pm_hope_kriesi_pagination();
						} else {
							posts_nav_link();	
						} 
                        pm_hope_restore_query();  
                    ?>
                  
                </div><!-- /blog-column -->            
            
            <?php } elseif($blogTemplateLayout == 'right-sidebar') { ?>
                
                <div class="span8 blog-column">
                        
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'postcolumn' ); ?>
                        
                        <div class="pm_posts_divider"></div>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found. Sorry!', 'localization'); ?></p>
                    <?php endif; ?>
                    
                    <?php  
                        if(function_exists('pm_hope_kriesi_pagination')){
							pm_hope_kriesi_pagination();
						} else {
							posts_nav_link();	
						}
                        pm_hope_restore_query();  
                    ?>
                  
                </div><!-- /blog-column -->
                
                <?php get_sidebar('blog'); ?>
                
            <?php } elseif($blogTemplateLayout == 'dual-left-sidebar') { ?>
                                    
            	<?php get_sidebar('blogdualone'); ?>
                <?php get_sidebar('blogdualtwo'); ?>
                
                <div class="span6 blog-column">
                
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'postcolumn' ); ?>
                                     
                        <div class="pm_posts_divider"></div>   
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                    <?php endif; ?>
                    
                    <?php  
                        if(function_exists('pm_hope_kriesi_pagination')){
							pm_hope_kriesi_pagination();
						} else {
							posts_nav_link();	
						} 
                        pm_hope_restore_query();  
                    ?>
                  
                </div><!-- /blog-column -->
            
            <?php } elseif($blogTemplateLayout == 'dual-right-sidebar') { ?>
            
            	<div class="span6 blog-column">
                        
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'postcolumn' ); ?>
                        
                        <div class="pm_posts_divider"></div>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found. Sorry!', 'localization'); ?></p>
                    <?php endif; ?>
                    
                    <?php  
                        if(function_exists('pm_hope_kriesi_pagination')){
							pm_hope_kriesi_pagination();
						} else {
							posts_nav_link();	
						} 
                        pm_hope_restore_query();  
                    ?>
                  
                </div><!-- /blog-column -->
                
                <?php get_sidebar('blogdualone'); ?>
                <?php get_sidebar('blogdualtwo'); ?>
            
            <?php } elseif($blogTemplateLayout == 'dual-sidebar') { ?>
            
            	<?php get_sidebar('blogdualone'); ?>
                
                <div class="span6 blog-column">
                        
                    <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'postcolumn' ); ?>
                        
                        <div class="pm_posts_divider"></div>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found. Sorry!', 'localization'); ?></p>
                    <?php endif; ?>
                    
                    <?php  
                        if(function_exists('pm_hope_kriesi_pagination')){
							pm_hope_kriesi_pagination();
						} else {
							posts_nav_link();	
						} 
                        pm_hope_restore_query();  
                    ?>
                  
                </div><!-- /blog-column -->
                
                <?php get_sidebar('blogdualtwo'); ?>
            
            <?php } else { ?>
                
                <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                    <!-- LOOP -->
                    <article <?php post_class(); ?>>
                        <div class="span12">
                            <?php get_template_part( 'content', 'post' ); ?>
                        </div>
                    </article>
                    <!-- LOOP -->
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php endif; ?> 
                
                
                <div class="span12">
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					} 
                    pm_hope_restore_query();  
                ?>
                </div>     
                
            <?php } ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>