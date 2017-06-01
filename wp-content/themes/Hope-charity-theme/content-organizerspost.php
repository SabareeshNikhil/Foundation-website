<?php
/**
 * The default template for displaying an organizer post on the organizers template
 */
?>

<?php       
	$organizerTitle = get_post_meta(get_the_ID(), 'pm_organizer_title_meta', true);
	$organizerTip = get_post_meta(get_the_ID(), 'pm_organizer_tooltip_meta', true);                
?>

<?php 
$terms = get_the_terms($post->ID, 'organizer_item_types' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
		$term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<div class="span4 pm-isotope-organizer-item <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">

	<div class="pm_span_header pm_organizer">
		<h4>
			<span><?php the_title(); ?></span>
			<?php if($organizerTip !== '') { ?>
				<a class="fa fa-user pm_tip" title="<?php echo esc_attr($organizerTip); ?>" href="<?php the_permalink(); ?>"></a>
			<?php } else { ?>
				<a class="fa fa-user" href="<?php the_permalink(); ?>"></a>
			<?php } ?>
			
		</h4>
	</div>
	<!-- organizer post -->
	<div class="pm-hover-item pm-organizer-activate">
		<div class="pm-hover-item-title-panel">
			<a class="fa fa-location-arrow pm_float_right" href="#"></a>
			<p><?php echo esc_attr($organizerTitle); ?></p>
		</div>
		<div class="pm-hover-item-details">
			<div class="pm-hover-item-spacer">
				<p>
				<?php  $excerpt = get_the_excerpt();
				  echo pm_hope_string_limit_words($excerpt,50) .'...'; 
				?>
				</p>
				<p><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View full profile','localization'); ?> &raquo;</a></p>
				
			</div>
		</div>
		<div class="pm-hover-item-img organizer-post">
			<?php 
						
				if( has_post_thumbnail() ) :							
					the_post_thumbnail();							
				endif;
			
			?>
		</div>
	</div>
	<!-- /organizer post -->
</div>