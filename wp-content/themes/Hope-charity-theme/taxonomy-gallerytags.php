<?php get_header(); ?>

<div class="container pm_paddingVertical60">

	<div class="row">
             
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        
            <?php get_template_part( 'content', 'gallerypost' ); ?>
        
        <?php endwhile; else: ?>
             <p><?php esc_attr_e('No post was found.', 'localization'); ?></p>
        <?php endif; ?> 
    
    </div>

</div>

<?php get_footer(); ?>