<?php /* Template Name: Organizers Template */ ?>
<?php get_header(); ?>


        
<?php $terms = get_terms('organizer_item_types' ); ?>

	
<?php if ($terms && !is_wp_error($terms)) : ?>

    <div class="container" style="padding-top:40px; padding-bottom:20px;">
        <div class="row">
            <div class="span12">
    
            <div class="pm-dropdown pm-staff-menu">
                <div class="pm-dropmenu">
                    <p class="pm-menu-title"><?php esc_attr_e('View by Title', 'localization'); ?></p>
                    <i class="fa fa-angle-down"></i>
                </div>
                <div class="pm-dropmenu-active">
                    <ul>
                    
                        <?php 
                        
                            //$term_slugs_arr = array();
                            echo '<li><a href="#" id="all">'.esc_attr__('View all', 'localization').'</a></li>';
                            foreach ($terms as $term) {
                                //$term_slugs_arr[] = $term->slug;
                                echo '<li><a href="#" id="'.$term->slug.'">'.$term->name.'</a></li>';
                            }
                            //$terms_slug_str = join( " ", $term_slugs_arr);
                        
                        ?>
                    
                    </ul>
                </div>
            </div> 
            <!-- /dropdown -->
            
            </div>
        </div>
    </div>

<?php endif; ?>  	     

<?php

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post_organizers',
		'post_status' => 'publish',
		'paged' => $paged,
		'posts_per_page' => -1,
	);

	$post_query = new WP_Query($arguments);

	pm_hope_set_query($post_query);
	
	$posts_per_page = get_option('posts_per_page');
	$count_posts = wp_count_posts('post_organizers');
	$published_posts = $count_posts->publish;
	
?>

<?php if ($terms && !is_wp_error($terms)) { ?>
	<div class="container pm_organizers" style="padding-top:20px; padding-bottom:20px;">
<?php } else { ?>
	<div class="container pm_organizers" style="padding-top:50px; padding-bottom:20px;">
<?php } ?>
        
    <div class="row">
    
    	<div id="pm-isotope-organizers-container">
        
    		<?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
            	<?php get_template_part('content', 'organizerspost'); ?>
                        
                <?php endwhile; else: ?>
                 <p><?php esc_attr_e('No organizer profiles were found.', 'localization'); ?></p>
                <?php endif; ?>
                                     
        </div><!-- /isotope -->
    
    </div> <!-- /row -->

</div> <!-- /container -->  


<?php pm_hope_restore_query(); ?> 

<?php get_footer(); ?>