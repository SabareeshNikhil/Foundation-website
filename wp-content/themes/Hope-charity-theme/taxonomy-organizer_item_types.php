<?php get_header(); ?>



<div class="container pm-containerPadding80">
    <div class="row">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
			<?php get_template_part( 'content', 'organizerspost' ); ?>
            
        <?php endwhile; else: ?>
            <p><?php esc_attr_e('No organizers were found.', 'localization'); ?></p>
        <?php endif; ?>        
    
	</div> <!-- /row -->
    
    <div class="row">
    	<div class="span12">
        	<div class="pm-organizers-nav-links">
				<?php 
				
					the_posts_pagination(array(
						'mid_size' => 2,
						'prev_text' => __( 'Prev.', 'textdomain' ),
						'next_text' => __( 'Next', 'textdomain' ),
						'screen_reader_text' => ' '
					)); 
				
				?>
            </div>
        </div>
    </div>
    
</div> <!-- /container -->


<?php get_footer(); ?>