<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

<?php $homepageLayout = get_theme_mod('homepageLayout'); ?>

<div class="container pm_paddingVertical60 clearfix pm_posts">
    
    <div class="row">
        
		<?php if($homepageLayout == 'full-width') { ?>
         
            <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
            
                <!-- LOOP -->
                <article <?php post_class(); ?>>
                    <div class="span12">
                        <?php get_template_part( 'content', 'post' ); ?>
                    </div>
                </article>
                <!-- LOOP -->
            
            <?php }//end of posts ?>
    
            <?php } else { ?>
                 <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
            <?php } ?> 
            
            
            <div class="span12">
            <?php  
                if(function_exists('pm_hope_kriesi_pagination')){
					pm_hope_kriesi_pagination();
				} else {
					posts_nav_link();	
				} 
                //pm_hope_restore_query();  
            ?>
            </div>       
        
        <?php } elseif($homepageLayout == 'left-sidebar') { ?>
        
            <?php get_sidebar('home'); ?>
            
            <div class="span8 blog-column">
            
               <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'postcolumn' ); ?>
                                 
                    <div class="pm_posts_divider"></div>   
                
                <?php }//end of posts ?>
    
                <?php } else { ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php } ?> 
                
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					} 
                    //pm_hope_restore_query();  
                ?>
              
            </div><!-- /blog-column -->            
        
        <?php } elseif($homepageLayout == 'right-sidebar') { ?>
            
            <div class="span8 blog-column">
                    
                <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'postcolumn' ); ?>
                    
                    <div class="pm_posts_divider"></div>
                
                <?php }//end of posts ?>
    
                <?php } else { ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php } ?> 
                
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					}
                    //pm_hope_restore_query();  
                ?>
              
            </div><!-- /blog-column -->
            
            <?php get_sidebar('home'); ?>
            
        <?php } elseif($homepageLayout == 'dual-left-sidebar') { ?>
                                
            <?php get_sidebar('homeleft'); ?>
            <?php get_sidebar('homeright'); ?>
            
            <div class="span6 blog-column">
            
                <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                                
                    <?php get_template_part( 'content', 'postcolumn' ); ?>
                                 
                    <div class="pm_posts_divider"></div>   
                
                <?php }//end of posts ?>
    
                <?php } else { ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php } ?> 
                
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					} 
                    //pm_hope_restore_query();  
                ?>
              
            </div><!-- /blog-column -->
        
        <?php } elseif($homepageLayout == 'dual-right-sidebar') { ?>
        
            <div class="span6 blog-column">
                    
                <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'postcolumn' ); ?>
                    
                    <div class="pm_posts_divider"></div>
                
                <?php }//end of posts ?>
    
                <?php } else { ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php } ?> 
                
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					} 
                ?>
              
            </div><!-- /blog-column -->
            
            <?php get_sidebar('homeleft'); ?>
            <?php get_sidebar('homeright'); ?>
        
        <?php } elseif($homepageLayout == 'dual-sidebar') { ?>
        
            <?php get_sidebar('homeleft'); ?>
            
            <div class="span6 blog-column">
                    
                <?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'postcolumn' ); ?>
                    
                    <div class="pm_posts_divider"></div>
                
                <?php }//end of posts ?>
    
                <?php } else { ?>
                     <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                <?php } ?> 
                
                <?php  
                    if(function_exists('pm_hope_kriesi_pagination')){
						pm_hope_kriesi_pagination();
					} else {
						posts_nav_link();	
					} 
                ?>
              
            </div><!-- /blog-column -->
            
            <?php get_sidebar('homeright'); ?>
        
        <?php } else { ?>
        	
            	<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
            
                    <!-- LOOP -->
                    <article <?php post_class(); ?>>
                        <div class="span12">
                            <?php get_template_part( 'content', 'post' ); ?>
                        </div>
                    </article>
                    <!-- LOOP -->
            
            <?php }//end of posts ?>
    
            <?php } else { ?>
                 <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
            <?php } ?> 
            
            
            <div class="span12">
            <?php  
                if(function_exists('pm_hope_kriesi_pagination')){
					pm_hope_kriesi_pagination();
				} else {
					posts_nav_link();	
				} 
            ?>
            </div>     
            
        <?php } ?>
    
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>