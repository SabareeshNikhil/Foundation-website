<?php 

	//Footer Logo
	$footerLogo = get_theme_mod('footerLogo');
	$logoalt = get_theme_mod('logoalt', '');
	$logoURL = get_theme_mod('logoURL', '');
	
	
	//social icons	
	$facebooklink = get_theme_mod('facebooklink', '');
	$twitterlink = get_theme_mod('twitterlink', '');
	$googlelink = get_theme_mod('googlelink', '');
	$linkedinLink = get_theme_mod('linkedinLink', '');
	$vimeolink = get_theme_mod('vimeolink', '');
	$youtubelink = get_theme_mod('youtubelink', '');
	$dribbblelink = get_theme_mod('dribbblelink', '');
	$pinterestlink = get_theme_mod('pinterestlink', '');
	$instagramlink = get_theme_mod('instagramlink', '');
	$skypelink = get_theme_mod('skypelink', '');
	$flickrlink = get_theme_mod('flickrlink', '');
	$emailLink = get_theme_mod('emailLink', '');
	$rssLink = get_theme_mod('rssLink', '');
		
	//Business Info
	$businessPhone = get_theme_mod('businessPhone', '');
	$businessEmail = get_theme_mod('businessEmail', '');
	
	//Footer Options
	$displayInfo = get_theme_mod('displayInfo', 'on');
	$copyrightNotice = get_theme_mod('copyrightNotice', '');
	
	//Layout Options
	$footerLayout = get_theme_mod('footerLayout', 'footer-four-columns');
	
	//Return to top icon
	$returnToTopIcon = get_theme_mod('returnToTopIcon', 'fa fa-chevron-up');
	
	//Fat footer
	$displayFatFooter = get_theme_mod('displayFatFooter', 'on');

?>

	<?php if($displayFatFooter == 'on') { ?>
    
    	<footer>
                
            <div class="container footer">
            
                <div class="row">
                
                	<?php if($footerLayout == 'footer-three-wide-left') { ?>
                    
                    	<div class="span6 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                        </div>
                    
                    <?php } ?>
                    
                    <?php if($footerLayout == 'footer-three-wide-right') { ?>
                    
                    	<div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                        </div>
                        
                        <div class="span6 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                        </div>
                    
                    <?php } ?>
                
                	<?php if($footerLayout == 'footer-three-columns') { ?>
                    
                    	<div class="span4 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                        </div>
                        
                        <div class="span4 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                        </div>
                        
                        <div class="span4 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                        </div>
                    
                    <?php } ?>
                    
                    <?php if($footerLayout == 'footer-four-columns') { ?>
                    
                    	<div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                        </div>
                        
                        <div class="span3 widget_footer">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column4_widget")) ; ?>
                        </div>
                    
                    <?php } ?>
                    
                </div><!-- row -->
                
            </div><!-- container -->
            
        </footer>
    
    <?php } ?>

		
        
        <?php if($displayInfo == 'on') { ?>
        
        	<!-- footer info -->
            <div class="container footer_info">
                
                <div class="row">
                    
                    <div class="span6">
                        <?php
							wp_nav_menu(array(
								'container' => '',
								'container_class' => '',
								'menu_class' => 'pm-footer-nav',
								'menu_id' => 'pm-footer-nav',
								'theme_location' => 'footer_menu',
								'fallback_cb' => 'display_pmFooterNav',
							   )
							);
							
						?>
                    </div>
                    
                    <div class="span6">
                        <div class="footer_social_icons">
                            <?php if($facebooklink !== '') { 
								echo '<a href="'.esc_html($facebooklink).'" class="fa fa-facebook pm_tip_static" title="'. esc_attr__('Facebook', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($twitterlink !== '') { 
								echo '<a href="'.esc_html($twitterlink).'" class="fa fa-twitter pm_tip_static" title="'. esc_attr__('Twitter', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($googlelink !== '') { 
								echo '<a href="'.esc_html($googlelink).'" class="fa fa-google-plus pm_tip_static" title="'. esc_attr__('Google Plus', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($linkedinLink !== '') { 
								echo '<a href="'.esc_html($linkedinLink).'" class="fa fa-linkedin pm_tip_static" title="'. esc_attr__('Linkedin', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($vimeolink !== '') { 
								echo '<a href="'.esc_html($vimeolink).'" class="fa fa-vimeo pm_tip_static" title="'. esc_attr__('Vimeo Channel', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($youtubelink !== '') { 
								echo '<a href="'.esc_html($youtubelink).'" class="fa fa-youtube pm_tip_static" title="'. esc_attr__('YouTube Channel', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($dribbblelink !== '') { 
								echo '<a href="'.esc_html($dribbblelink).'" class="fa fa-dribbble pm_tip_static" title="'. esc_attr__('Dribbble', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($pinterestlink !== '') { 
								echo '<a href="'.esc_html($pinterestlink).'" class="fa fa-pinterest pm_tip_static" title="'. esc_attr__('Pinterest', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($instagramlink !== '') { 
								echo '<a href="'.esc_html($instagramlink).'" class="fa fa-instagram pm_tip_static" title="'. esc_attr__('Instagram', 'localization') .'" target="_blank"></a>';
							} ?>
							<?php if($flickrlink !== '') { 
								echo '<a href="'.esc_html($flickrlink).'" class="fa fa-flickr pm_tip_static" title="'. esc_attr__('Flickr', 'localization') .'" target="_blank"></a>';
							} ?>
                            <?php if($skypelink !== '') { 
								echo '<a href="skype:'.esc_attr($skypelink).'?call" class="fa fa-skype pm_tip_static" title="'. esc_attr__('Contact us', 'localization') .'"></a>';
							} ?>
							<?php if($emailLink !== '') { 
								echo '<a href="mailto:'.esc_attr($emailLink).'" class="fa fa-envelope pm_tip_static" title="'. esc_attr__('Email us', 'localization') .'"></a>';
							} ?>
							<?php if($rssLink !== '') { 
								echo '<a href="'.esc_html($rssLink).'" class="fa fa-rss pm_tip_static" title="'. esc_attr__('RSS Feed', 'localization') .'" target="_blank"></a>';
							} ?>
                        </div>
                    </div>
                    
                </div>
            
            </div>
            <!-- /footer info -->
        
        <?php } ?>
        
        <!-- footer info -->
        <div class="pm_footer_info">
        
        	<div class="container">
                <div class="row">
                    
                    <div class="span4">
                    	<?php if($footerLogo !== '') { ?>
                        	<a href="<?php echo $logoURL !== '' ? $logoURL : home_url() ?>"><img src="<?php echo esc_html($footerLogo); ?>" alt="<?php echo esc_attr($logoalt); ?>"></a>
                        <?php } ?>
                    </div>
                    
                    <div class="span8">
                        <ul class="pm_footer_info_copyright">
                        	<?php if($copyrightNotice !== '') { ?>
                            	
                                <?php 
									$allowed_html = array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'p' => array(),
										'span' => array(),
										'h6' => array(),
									);
									
								?>
                            
                            	<li> &copy; <?php echo date_i18n('Y'); ?> <?php echo wp_kses($copyrightNotice, $allowed_html) ?></li>
                            <?php } else { ?>
                            	<li> &copy; <?php echo date_i18n('Y'); ?> <?php bloginfo( 'name' ); ?></li>
                            <?php } ?>
                            <li>
                            <?php 
								if($businessPhone !== ''){ ?>
									<?php echo esc_attr($businessPhone); ?> &bull; <a href="mailto:<?php echo esc_attr($businessEmail); ?>"><?php echo $businessEmail; ?></a>
								<?php } else { ?>
									<a href="mailto:<?php echo esc_attr($businessEmail); ?>"><?php echo esc_attr($businessEmail); ?></a>
								<?php }
							?>
							
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /footer info -->
        
        <p id="back-top">
            <?php if($returnToTopIcon !== '') { ?>
            	<!-- icon -->
                <a href="#top"><i class="<?php echo esc_attr($returnToTopIcon); ?>"></i></a>
            <?php } else { ?>
            	<a href="#top"><i class="fa fa-chevron-up"></i></a>
            <?php } ?>
        </p>
        
		<?php wp_footer(); ?> 
    </body>
</html>
