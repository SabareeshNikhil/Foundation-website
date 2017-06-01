<?php get_header(); ?>

<?php 
	
	$eventDate = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
	
	$eventDateNew = str_replace(",", "", $eventDate);
	$datePieces = explode(" ", $eventDateNew);
	
	$month = mb_substr($datePieces[0], 0, 3);
	$day = $datePieces[1];
	$year = $datePieces[2];
				
	$eventTip = get_post_meta(get_the_ID(), 'pm_event_tooltip_meta', true);
	$eventIconFile = get_post_meta(get_the_ID(), 'pm_event_icon_meta', true);
	$eventIcon = $eventIconFile == '' ? 'fa fa-calendar' : $eventIconFile;
	$countdown = get_post_meta(get_the_ID(), 'pm_event_countdown_meta', true);
	$pm_event_panel_info_meta = get_post_meta(get_the_ID(), 'pm_event_panel_info_meta', true);
?>

<div class="container pm_paddingVertical80 pm_event_single_post">
    <div class="row">
    
    	<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
        
        	<div class="span12">
                
                <div class="pm_span_header">
                  <h4>
                        <div class="pm_event_single_post_time">
                        
                        	<?php if($pm_event_panel_info_meta == 'eventTitle') {//event title ?>
                            	<span><?php the_title(); ?> - <i class="<?php esc_attr_e($eventIcon); ?>"></i> <?php echo $datePieces[0]; ?> <?php echo $day; ?> <?php echo $year; ?></span>
                            <?php } elseif($pm_event_panel_info_meta == 'eventMeta') {//meta info ?>
                            	<span><i class="fa fa-user"></i> <?php esc_attr_e('Organizer','localization') ?>: <?php the_author(); ?> &nbsp;  <i class="fa fa-clock-o"></i> <?php the_time('l F d, Y'); ?></span>
                            <?php } else {//default meta ?>
                            	<span><i class="fa fa-user"></i> <?php esc_attr_e('Organizer','localization') ?>: <?php the_author(); ?> &nbsp;  <i class="fa fa-clock-o"></i> <?php the_time('l F d, Y'); ?></span>
                            <?php } ?>
                        
                            
                        </div>
                        <?php if($eventTip !== '') { ?>
                                <a class="<?php echo esc_attr($eventIcon); ?> pm_tip" title="<?php echo esc_attr($eventTip); ?>"></a>
                        <?php } else { ?>
                                <a class="<?php echo esc_attr($eventIcon); ?>"></a>
                        <?php } ?>
                        
                    </h4>
                </div><!-- /pm_span_header -->
                                    
            </div><!-- /span12 -->
            
              <div class="span2 pm_event_single_post_countdown_container">
                 <div class="pm_event_single_post_countdown">
                 
                    <ul class="pm_event_post_countdown_ul">
                    
                        <li><i class="<?php echo esc_attr($eventIcon); ?>"></i></li>
                        <li><p><?php echo $day; ?></p></li>
                        <li><p><?php echo $month; ?></p></li>
                        
                        <li>
                            <div class="pm_event_counter">
                            	<?php 
                                
                                	$secondaryColor = get_option('secondaryColor', '#ACDB05');
									
                                 ?>
                                <input class="knob days" data-width="100" data-min="0" data-max="365" data-displayPrevious=true data-fgColor="<?php echo $secondaryColor; ?>" data-readOnly="true" value="1">
                            </div>
                        </li>
                        
                        <li><p class="pm_event_days_left"><?php esc_attr_e('days left','localization'); ?></p></li>
                    
                    </ul>
                     
                 </div>
              </div>
                
              <div class="span10 pm_event_single_post_content">
                    
                    <?php 
					
						if( has_post_thumbnail() ) :
							the_post_thumbnail();
						endif;
					
					?>
                    
                    <?php the_content(); ?>
              </div>
              
              <?php
              	
				//calculate days remaining based on countdown date
				$dateConverted = str_replace(',', '-', $countdown);
				$rem = strtotime($dateConverted) - time();
				$days = ceil($rem / 86400);
			  
			  ?>
              
              <div class="pm_countdown_mini_container">
                    <ul class="pm_countdown_mini_ul">
                        <li class="pm_countdown_icon"><i class="fa fa-calendar"></i></li>
                        <li class="pm_countdown_date"><strong><?php echo $day; ?></strong> <?php echo $month; ?></li>
                        <li class="pm_countdown_days_left"><strong>  <?php echo $days; ?>  </strong> <?php esc_attr_e('days left','localization'); ?></li>
                    </ul>
              </div>
        
        <?php }
                
		} else { ?>
			
			<?php esc_attr_e('There is no event available.', 'localization'); ?>
				
		<?php } ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php if($countdown !== '') { ?>

<!-- localize variable -->
<?php
	
	$countdownDates = explode(",", $countdown);
	$year = $countdownDates[0];
	$month = $countdownDates[1];
	$day = $countdownDates[2];
	
	wp_enqueue_script( 'js_handler', true );
    $array = array( 
		'pmYear' => $year,
		'pmMonth' => $month,
		'pmDay' => $day,
	);
    wp_localize_script( 'js_handler', 'pmobject', $array );
	
?>

<?php } ?>

<?php get_footer(); ?>