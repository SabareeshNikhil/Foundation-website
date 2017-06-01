<?php get_header(); ?>

<div class="container pm_paddingVertical60 pm-search-page">
	<div class="row">
        
        <?php if ( have_posts() ) : ?>
                 
        <?php while ( have_posts() ) : the_post(); ?>
                              
            <div class="span6">
            	<?php get_template_part( 'content', 'post' ); ?>
            </div>
                
         
        <?php endwhile; ?>
        <?php  else:  ?>
        
        	<div class="span12">
                <p><?php esc_attr_e('Your search for', 'localization'); ?> "<?php echo $s; ?>" <?php esc_attr_e('did not match', 'localization'); ?></p>
                 
                <p><strong><?php esc_attr_e('A few suggestions', 'localization'); ?></strong></p>
                <ul>
                <li><?php esc_attr_e('Make sure all words are spelled correctly', 'localization'); ?></li>
                <li><?php esc_attr_e('Try different keywords' , 'localization'); ?></li>
                <li><?php esc_attr_e('Try more general keywords', 'localization'); ?></li>
                </ul>
            </div>  
        
        <?php  endif; ?>
        
        <div class="span12">
		<?php  
		
			if(function_exists('pm_hope_kriesi_pagination')){
				pm_hope_kriesi_pagination();
			} else {
				posts_nav_link();	
			}
        ?>
        </div>  

	</div>
</div>

 <?php get_footer(); ?>