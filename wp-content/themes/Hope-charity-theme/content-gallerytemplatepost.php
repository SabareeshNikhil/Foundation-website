<?php
/**
 * The default template for displaying a gallery post within a grid format.
 */
?>

<?php 

	 
	$counterTitle = get_the_title();
	$finalCounterTitle = str_replace(" ", "_", $counterTitle);
	
	$galleryCounter = 0;
	
?>
			
<div class="span4 pm-gallery-template-list-item">

    <?php
               
	   /* get the slider array */
	   $photoItems = get_post_meta($post->ID, 'galleryItems', true) ;

		if (!empty($photoItems)) {
			
			echo '<ul class="pm-gallery-template-list" id="pm-gallery-template-list-'.$finalCounterTitle.'">';
			
				foreach ($photoItems as $photo) {
						
					
					if($galleryCounter == 0){
						
						echo '<div class="pm_span_header" style="margin-bottom:1px; width:100%;">';
							echo '<h4>';
								echo '<span>'. get_the_title() .'</span>';
								
								echo '<a href="'. get_the_permalink() .'" class="fa fa-external-link" title="'. get_the_title() .'"></a>';
								
								if($photo['youtubeVideo'] !== '') {
									
									echo '<a href="'. esc_html($photo['youtubeVideo']) .'" rel="prettyPhoto[gallery_'. $finalCounterTitle .']" class="fa fa-expand lightbox" title="'. esc_attr($photo['photoCaption']) .'"></a>';
									
								} else {
									
									echo '<a href="'. esc_html($photo['galleryPhoto']) .'" rel="prettyPhoto[gallery_'. $finalCounterTitle .']" class="fa fa-expand lightbox" title="'. esc_attr($photo['photoCaption']) .'"></a>';
									
								}
								
								
							echo '</h4>';
						echo '</div>';
                            
						
						//display image
						if($photo['youtubeVideo'] !== '') {
							
							//render video
							echo '<li><img src="'. esc_html($photo['galleryPhoto']) .'"></li>';
							
						} else {
							
							//render photo
							echo '<li><img src="'. esc_html($photo['galleryPhoto']) .'"></li>';
							
						}
						
						
						
					} else {
						
						if($photo['youtubeVideo'] !== '') {
							
							//render video
							echo '<li style="display:none;"><a href="'. esc_html($photo['youtubeVideo']) .'" rel="prettyPhoto[gallery_'. $finalCounterTitle .']" class="lightbox" title="'. esc_attr($photo['photoCaption']) .'"><img src="'. esc_html($photo['galleryPhoto']) .'"></a></li>';
							
						} else {
							
							//render photo
							echo '<li style="display:none;"><a href="'. esc_html($photo['galleryPhoto']) .'" rel="prettyPhoto[gallery_'. $finalCounterTitle .']" class="lightbox" title="'. esc_attr($photo['photoCaption']) .'"><img src="'. esc_html($photo['galleryPhoto']) .'"></a></li>';
							
						}
						
						
					}				
					
					
					$galleryCounter++;
					
				}
			
			echo '</ul>';

			
		}
	
	?>

</div>

