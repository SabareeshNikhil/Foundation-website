<?php
/**
 * The default template for displaying an event post page with no sidebars.
 */
?>

<?php 
            	
	$eventDate = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
	
	$eventDateNew = str_replace(",", "", $eventDate);
	$datePieces = explode(" ", $eventDateNew);
	
	$month = mb_substr($datePieces[0], 0, 3);
	$day = $datePieces[1];
	$year = $datePieces[2];
	
	$countdown = get_post_meta(get_the_ID(), 'pm_event_countdown_meta', true);
	$eventTip = get_post_meta(get_the_ID(), 'pm_event_tooltip_meta', true);
	
	$eventIconFile = get_post_meta(get_the_ID(), 'pm_event_icon_meta', true);
	$eventIcon = $eventIconFile == '' ? 'fa fa-calendar' : $eventIconFile;
	
?>

<?php 
$terms = get_the_terms($post->ID, 'event_categories' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
		$term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- event -->
<div class="span6 pm-event-post-shortcode-overflow pm-isotope-organizer-item <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">
	<div class="pm_span_header pm_event">
		<h4>
			<span><?php the_title(); ?></span>
			<?php if($eventTip !== '') { ?>
				<a class="<?php echo esc_attr($eventIcon); ?> pm_tip" title="<?php echo esc_attr($eventTip); ?>" href="<?php the_permalink(); ?>"></a>
			<?php } else { ?>
				<a class="<?php echo esc_attr($eventIcon); ?>" href="<?php the_permalink(); ?>"></a>
			<?php } ?>
			
		</h4>
	</div>
	<!-- organizer post -->
	<div class="pm-hover-item pm-event-activate">
		<div class="pm-hover-item-title-panel">
			<a class="fa fa-location-arrow pm_float_right" href="#"></a>
			<p><b><?php esc_attr_e('Organizer', 'localization') ?>:</b> <?php the_author(); ?></p>
		</div>
		<div class="pm-hover-item-details">
			<div class="pm-hover-item-spacer">
			
				<ul class="pm-event-info-ul-date">
					<li><strong><?php echo $day; ?></strong></li>
					<li><p><?php echo $month; ?></p></li>
					<li class="visible-phone" style="margin-top:15px;"><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></li>
				</ul>
			
				<div class="pm-event-info-excerpt">
					<p>
					<?php  $excerpt = get_the_excerpt();
					  echo pm_hope_string_limit_words($excerpt,50) .'...'; 
					?>
					</p>
					<p><a href="<?php the_permalink(); ?>"><?php esc_attr_e('View Event','localization'); ?> &raquo;</a></p>
				</div>
				
				
			</div>
		</div>
		<div class="pm-hover-item-img <?php echo !has_post_thumbnail() ? 'event-post' : '' ?>">
			<?php 
					
				if( has_post_thumbnail() ) :
					the_post_thumbnail();
				endif;
			
			?>
		</div>
	</div>
	<!-- /event post -->
</div>
<!-- /event -->