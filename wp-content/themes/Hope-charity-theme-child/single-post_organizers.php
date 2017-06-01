<?php get_header(); ?>

<?php 
	$organizerTitle = get_post_meta(get_the_ID(), 'pm_organizer_title_meta', true);
	$organizerTip = get_post_meta(get_the_ID(), 'pm_organizer_tooltip_meta', true);
	$organizerNumber = get_post_meta(get_the_ID(), 'pm_organizer_contact_number_meta', true);
	$organizerEmail = get_post_meta(get_the_ID(), 'pm_organizer_email_meta', true);
	$organizerWebsite = get_post_meta(get_the_ID(), 'pm_organizer_webiste_meta', true);
	
	$googlePlusProfile = get_post_meta(get_the_ID(), 'pm_organizer_google_meta', true);
	$facebookProfile = get_post_meta(get_the_ID(), 'pm_organizer_facebook_meta', true);
	$twitterProfile = get_post_meta(get_the_ID(), 'pm_organizer_twitter_meta', true);
	$linkedinProfile = get_post_meta(get_the_ID(), 'pm_organizer_linkedin_meta', true);
	$skypeAddress = get_post_meta(get_the_ID(), 'pm_organizer_skype_meta', true);
	
?>


<div class="container pm_paddingVertical80">
    <div class="row">
    
    	<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
        
        	<div class="span12">
                	<div class="pm_span_header pm_organizer_post">
                   	  <h4>
                        	<span><?php the_title(); ?></span>
                            <?php if($organizerTip !== '') { ?>
                                <a class="fa fa-user pm_tip" title="<?php echo esc_attr($organizerTip); ?>"></a>
                            <?php } else { ?>
                                <a class="fa fa-user"></a>
                            <?php } ?>
                        </h4>
                    </div><!-- /pm_span_header -->
              </div><!-- /span12 -->
              
              <div class="span4 pm_organizer_post_profile">
              	
                <ul class="pm_organizer_single_details">
                
                	<li>
                    	<?php 
						
							if( has_post_thumbnail() ) :							
								the_post_thumbnail();							
							endif;
						
						?>
                    </li>
                    
                    <li><?php echo esc_attr($organizerTitle); ?></li>
                    
                    <?php if($organizerNumber !== '') { ?>
                    	<li><?php esc_attr_e('Phone','localization') ?>: <span><?php echo esc_attr($organizerNumber); ?></span></li>
                    <?php } ?>
                    
                    <?php if($organizerEmail !== '') { ?>
                    	<li><?php esc_attr_e('Email','localization') ?>: <a href="mailto:<?php echo esc_attr($organizerEmail); ?>"><?php echo esc_attr($organizerEmail); ?></a></li>
                    <?php } ?>
                    
                    <?php if($organizerWebsite !== '') { ?>
                    	<li><?php esc_attr_e('Personal website','localization') ?>: <a href="<?php echo esc_html($organizerWebsite); ?>" target="_blank"><?php echo esc_html($organizerWebsite); ?></a></li>
                    <?php } ?>
                    
                    <?php if($googlePlusProfile !== '' && $facebookProfile !== '' && $twitterProfile !== '' && $linkedinProfile !== '' && $skypeAddress !== '') { ?>
                    	<li><?php esc_attr_e('Social Connections','localization') ?>:</li>
                    <?php } ?>
                    
                    
                </ul>
                <ul class="pm_organizer_social_icons">
                	<?php if($googlePlusProfile !== '') { ?>
                    	<li class="pm_organizer_social_icon_gplus">
                            <a class="fa fa-google-plus" href="<?php echo esc_html($googlePlusProfile); ?>" target="_blank"></a>
                        </li>
                    <?php } ?>
                    <?php if($facebookProfile !== '') { ?>
                    	<li class="pm_organizer_social_icon_fb">
                            <a class="fa fa-facebook" href="<?php echo esc_html($facebookProfile); ?>" target="_blank"></a>
                        </li>
                    <?php } ?>
                    <?php if($twitterProfile !== '') { ?>
                    	<li class="pm_organizer_social_icon_twitter">
                            <a class="fa fa-twitter" href="<?php echo esc_html($twitterProfile); ?>" target="_blank"></a>
                        </li>
                    <?php } ?>
                    <?php if($linkedinProfile !== '') { ?>
                    	<li class="pm_organizer_social_icon_linkedin">
                            <a class="fa fa-linkedin" href="<?php echo esc_html($linkedinProfile); ?>" target="_blank"></a>
                        </li>
                    <?php } ?>
                    <?php if($skypeAddress !== '') { ?>
                    	<li class="pm_organizer_social_icon_skype">
                            <a class="fa fa-skype" href="skype:<?php echo esc_attr($skypeAddress); ?>?call"></a>
                        </li>
                    <?php } ?>     
                    
                </ul>
              </div>
              
              <div class="span8 pm_organizer_post_content">
              	<?php the_content(); ?>
              </div>
        
        <?php }
                
		} else { ?>
			
			<?php esc_attr_e('Sorry, no content was found.', 'localization'); ?>
				
		<?php } ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>