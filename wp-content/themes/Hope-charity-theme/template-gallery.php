<?php /* Template Name: Gallery Template */ ?>
<?php get_header(); ?>

<?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-80">
        <div class="row">
            <div class="span12">
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    
                    <?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     
                <?php endif; ?> 
            
            </div>
        </div>
    </div>

<?php } ?>


<?php 
	$terms = get_terms('gallerycats');
?>

<!-- Events filter system -->
<?php if($content = $post->post_content) { ?>
	<div class="container pm_paddingTopVertical40 pm_paddingBottomVertical80">
<?php } else { ?>
	<div class="container pm_paddingVertical80">
<?php } ?>

    <div class="row">
    
        <div class="span12 pm-containerPadding-bottom-40">
            
            <div class="pm-featured-header-container">
                
                <!-- Filter menu -->
                <div class="pm-isotope-filter-container">
                    <ul class="pm-isotope-filter-system">
                        <li class="pm-isotope-filter-system-expand"><?php esc_attr_e('Currently Viewing:', 'localization'); ?> <i class="fa fa-angle-down"></i></li>
                        <li>
                        	<div class="pm-rounded-btn gallery-filter">
                            	<a href="#" class="current" id="all"><?php esc_attr_e('All', 'localization'); ?></a>
                            </div>
                        </li>
                        <?php
							foreach ($terms as $term) {
								echo '<li><div class="pm-rounded-btn"><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></div></li>';	
							}
						?>
                    </ul>
                </div>
                <!-- Filter menu end -->
            
            </div>
            
        </div><!-- /.col-lg-12 -->
        
        <?php
			//global $paged;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'paged' => $paged,
				'posts_per_page' => -1,
				//'tag' => get_query_var('tag')
			);
		
			$blog_query = new WP_Query($arguments);
					
			$count_posts = wp_count_posts('post_galleries');
			$published_posts = $count_posts->publish;
			
		?>
        
        <div id="pm-isotope-item-container">
        
        	<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        		
				<?php get_template_part( 'content', 'gallerypost' ); ?>
            
            <?php endwhile; else: ?>
                 <p><?php esc_attr_e('No gallery posts were found.', 'localization'); ?></p>
            <?php endif; ?>
                        
            <?php wp_reset_postdata(); ?> 
        
        </div>        
                        
    </div>
</div>
<!-- Gallery system end -->

<?php get_footer(); ?>