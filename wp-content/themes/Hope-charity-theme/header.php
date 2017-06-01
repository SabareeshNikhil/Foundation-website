<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
   
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
    
    <?php $userScalable = get_theme_mod('userScalable'); ?>
    
    <?php if($userScalable == 'on') { ?>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">
    <?php } else { ?>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php } ?>
        
    <?php wp_head(); ?>
</head>

<?php 

	//Logo
	$logo = get_theme_mod('businessLogo');
	$logoalt = get_theme_mod('logoalt', '');
	$logoURL = get_theme_mod('logoURL', '');
	
	//Header
	$headerBackgroundImage = get_theme_mod('headerBackgroundImage');
	$headerBackgroundColor = get_option('headerBackgroundColor', '#007F84');
	
	//Header Options
	$headerHeight = get_theme_mod('headerHeight', 80);
	$headerPadding = get_theme_mod('headerPadding', 20);
	
	$headerSlogan = get_theme_mod('headerSlogan', '');
	$disableSearchBar = get_theme_mod('disableSearchBar', 'on');
	$disableCrumbs = get_theme_mod('disableCrumbs', 'on');
	
	$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');
		
	//Quick Nav
	$enableQuickNav = get_theme_mod('enableQuickNav', 'on');
	
	//social icons	
	$globalButtonText = get_theme_mod('globalButtonText', esc_attr__( 'Donate Today', 'localization' ));
	$globalButtonLink = get_theme_mod('globalButtonLink', '#');
	$globalButtonTargetWindow = get_theme_mod('globalButtonTargetWindow', '_self');
	
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
	
	//Background image for subpages
	$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
	$repeatBackground = get_theme_mod('repeatBackground', 'no-repeat');
	
	$subHeaderBackgroundColor = get_option('subHeaderBackgroundColor', '#dedede');
	
?>


<?php if($pageBackgroundImage != '') { ?>
		<body <?php body_class(); ?> style="background-image:url('<?php echo esc_html($pageBackgroundImage); ?>'); background-repeat:<?php echo $repeatBackground; ?>;" >
<?php } else { ?>
		<body <?php body_class(); ?>>
<?php } ?>

	<?php 
		
		//Activate the Theme color sampler
		$colorSampler = get_theme_mod('colorSampler', 'off');			
		if($colorSampler == 'on'){
			if(is_home() || is_front_page()){
						
				?>
					<div id="pm_theme_color_selector">
						<a class="pm_theme_color_selector_btn"><i class="fa fa-cogs"></i></a>
						<p>Primary Color Sampler</p>
						<div id="color-picker"></div>
						<p>Secondary Color Sampler</p>
						<div id="color-picker2"></div>
						<p>Header/Footer Sampler</p>
						<div id="color-picker3"></div>
						<p>Header/Footer BG Sampler</p>
						<ul class="pm_theme_header_selector">
							<li><a href="#" id="blue"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/blue-header.png" /></a></li>
							<li><a href="#" id="green"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/green-header.png" /></a></li>
							<li><a href="#" id="grey"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/grey-header.png" /></a></li>
							<li><a href="#" id="pink"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/pink-header.png" /></a></li>
							<li><a href="#" id="purple"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/purple-header.png" /></a></li>
							<li><a href="#" id="red"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/red-header.png" /></a></li>
							<li><a href="#" id="violet"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/violet-header.png" /></a></li>
							<li><a href="#" id="yellow"><img src="<?php echo get_template_directory_uri(); ?>/img/bgs/yellow-header.png" /></a></li>
						</ul>
					</div>
					
				<?php				
				
			}
			
		}
			
		
			
	?>

	<!-- floating quick nav - slide down nav for quick page access -->
    <?php if($enableQuickNav == 'on') { 
		echo '<div class="pm-quick-nav-container" id="pm-quick-nav">';
	} else {
		echo '<div class="pm-quick-nav-container" id="pm-quick-nav" style="display:none !important;">';	
	}?>
    
        <div class="pm-quick-nav">
        
        	<?php if($globalButtonText !== '') {  ?>
            	<div class="header_donate_btn">
                   <a class="green button-small" href="<?php echo esc_html($globalButtonLink); ?>" target="<?php echo esc_attr($globalButtonTargetWindow); ?>">
                        <span><?php echo esc_attr($globalButtonText); ?></span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
			<?php } ?>
            
            <!-- superfish -->
            <?php
				wp_nav_menu(array(
					'container' => '',
					'container_class' => '',
					'menu_class' => 'sf-menu',
					'menu_id' => 'nav',
					'theme_location' => 'main_menu',
					'fallback_cb' => 'display_pmNav',
				   )
				);
				//display_pulsarNav();
			?>
        </div>
    </div>
    <!-- /pm-quick-nav -->
    
    <?php if($headerBackgroundImage != '') { ?>
    	<header style="background-image:url('<?php echo esc_html($headerBackgroundImage); ?>'); background-color:<?php echo $headerBackgroundColor; ?>; padding:<?php echo $headerPadding; ?>px 0; height:<?php echo $headerHeight; ?>px; ">
    <?php } else { ?>
    	<header style="height:<?php echo $headerHeight; ?>px; background-color:<?php echo $headerBackgroundColor; ?>; padding:<?php echo $headerPadding; ?>px 0;">
    <?php } ?>
            
        <div class="container header" id="header">
        
            <div class="row">
            
            	<div class="span4 pm_header">
                    <div class="logo_container">
                    	<?php if($logo !== '') { ?>
                        	<a href="<?php echo $logoURL !== '' ? esc_attr($logoURL) : home_url() ?>"><img src="<?php echo esc_html($logo) ?>" alt="<?php echo esc_attr($logoalt); ?>" /></a>
                        <?php } ?>
                    </div>
                </div>
            
            	<?php if($headerSlogan !== '') { ?>
                
                    <div class="span4 pm_header_slogan">
                        <p><?php echo esc_attr($headerSlogan); ?></p>
                    </div>
                
                <?php } ?>
                                
                
                <?php if($headerSlogan !== '') { ?>
                	<div class="span4 pm_header_donate">
                <?php } else { ?>
               	 	<div class="span8 pm_header_donate">
                <?php } ?>                    
                    <?php if($globalButtonText !== '') {  ?>
                        <div class="header_donate_btn">
                            <a class="green button-small" href="<?php echo esc_html($globalButtonLink); ?>" target="<?php echo esc_attr($globalButtonTargetWindow); ?>">
                                <span><?php echo esc_attr($globalButtonText); ?></span>
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    <?php } ?>
                    
                    
                    
                    <div class="header_social_icons">   
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
                    
                    <?php if($enableLanguageSelector === 'on') : ?>
                                
						<?php pm_ln_icl_post_languages('desktop'); ?> 
                        
                    <?php endif; ?>
                    
                </div><!-- /span8 -->
                
            </div><!-- /row -->
        
        </div><!-- /container -->
    
    </header>
        
        

    <!--<div class="pm_main_nav_container affix-top" data-spy="affix" data-offset-top="98">-->
    <div id="pm_nav_wrapper">
    
        <div class="pm_main_nav_container">
    
            <!-- Main nav -->
            <div class="container">
                <div class="row">
                
                	<?php if($disableSearchBar == 'on') { ?>
                    	<div class="span8 pm_navigation">
                    <?php } else { ?>
                    	<div class="span12 pm_navigation">
                    <?php } ?>                    
                        <?php
							wp_nav_menu(array(
								'container' => '',
								'container_class' => '',
								'menu_class' => 'sf-menu',
								'menu_id' => 'pm_nav',
								'theme_location' => 'main_menu',
								'fallback_cb' => 'display_pmNav',
								'link_before'     => '<span>',
								'link_after'      => '</span>',
							   )
							);
							//display_pulsarNav();
						?>
                        
                    </div>
                    
                    <?php if($disableSearchBar == 'on') { ?>
                    	<div class="span4 pm_search">
                            <div class="pm_searchbar_container">
                                
                                <div class="pm_search_field_container searchbar" id="pm_search_field">
                                  <form action="<?php echo home_url( '/' ); ?>" method="get" id="searchform">
                                      <input type="text" name="s" id="s" class="pm_searchfield" maxlength="100" placeholder="<?php esc_attr_e('Type Keywords...', 'localization') ?>">                                      
                                      <a href="#" class="searchBtn searchsubmit" id="searchsubmit"><i class="fa fa-search"></i></a>
                                   </form>
                                </div>
                                
                            </div>
                        </div>
                    <?php } ?>
                    
                    
                </div>
            </div>
            <!-- /Main nav -->
            
        </div><!-- /pm_main_nav_container -->
        
    </div><!-- /pm_nav_wrapper -->
    
    <?php 
	
		global $hope_options;
		
		$enableMicroSlider = get_theme_mod('enableMicroSlider', 'yes');
		$customSlider = $hope_options['opt-custom-slider'];
		$enableFixedHeight = 'false';
	
	?>
    
        
    <?php if(is_home() || is_front_page()) { ?>
    
    		<!-- MICRO SLIDER -->
			<?php if($enableMicroSlider === 'yes') { ?>
            
                    <?php 
                        global $hope_options;
                        
                        $slides = '';
                        
                        if( isset($hope_options['opt-pulse-slides']) && !empty($hope_options['opt-pulse-slides']) ){
                            $slides = $hope_options['opt-pulse-slides'];
                        }
                    ?>
                    
                    <?php 
                    
                        if(is_array($slides)) :
                    
                            $sliderCounter = 0;
                        
                            if(count($slides) > 0){
                                
                                echo '<div class="pm-pulse-container" id="pm-pulse-container">';
                                
                                    echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" alt="slider loading" /></div>';
                                    
                                    echo '<div id="pm-slider" class="pm-slider'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                    
                                        echo '<div id="pm-slider-progress-bar"></div>';
                                        
                                        echo '<ul class="pm-slides-container" id="pm_slides_container">';
                                        
                                            foreach($slides as $s) {
                                                
                                                $btnText = '';
                                                $btnUrl = '';
                                                
                                                if(!empty($s['url'])){
                                                    $pieces = explode(" - ", $s['url']);
                                                    $btnText = $pieces[0];
                                                    $btnUrl = $pieces[1];
                                                }
                                                
                                                echo '<li data-thumb="'.$s['image'].'" class="pmslide_'.$sliderCounter.'"><img src="'.$s['image'].'" alt="img" />';
                                    
                                                    echo '<div class="pm-holder'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                                        echo '<div class="pm-caption'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                                        
                                                              if( !empty($s['title']) ){
                                                                  echo '<h1>'.esc_html__($s['title'], 'localization').'</h1>';
                                                              }
                                                              if( !empty($s['description']) ){
                                                                  echo '<span class="pm-caption-decription'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                                                    echo esc_html__($s['description'], 'localization');
                                                                  echo '</span>';
                                                              }
                                                              
                                                              if($btnText !== ''){
                                                                 echo '<a href="'.$btnUrl.'" class="pm-slide-btn animated'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">'.esc_html__($btnText, 'localization').' <i class="fa fa-chevron-right"></i></a>'; 
                                                              }
                                                              
                                                        echo '</div>';
                                                    echo '</div>';
                                                
                                                echo '</li>';
                                                
                                                $sliderCounter++;
                                                        
                                            }
                                                                        
                                        echo '</ul>';
                                    
                                    echo '</div>';
                                
                                echo '</div>';
                                
                            }//end of if
                        
                        endif;
                    
                    ?> 
                    
                    <!-- MICRO SLIDER end -->
            
            <?php } ?>
            
            <?php 
            
                if($customSlider !== '' && $enableMicroSlider === 'no') { 
                   echo do_shortcode($customSlider);
                } 
                
            ?>
            		
	<?php } else { ?>
    
    		
            <?php $displaySubHeader = get_theme_mod('displaySubHeader', 'on'); ?>
            
            <?php if($displaySubHeader === 'on') : ?>
            
            	<?php if( function_exists( 'is_shop' ) || function_exists('is_product_category') || function_exists('is_product_tag') ) { //Woocommerce installed ?>
            
					<?php if( is_shop() ) { ?>
                    
                            <!-- display page header img -->
                            <?php 
                                $page_id = get_option( 'woocommerce_shop_page_id' ); 
                                $pageHeaderImage = get_post_meta($page_id, 'pm_header_image_meta', true); 
                            ?>
                            
                            <?php if($pageHeaderImage !== '') { ?>
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } else { ?>
                                <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } ?>
                            
                    
                    <?php } elseif(is_single() || is_page()) { ?>
                    
                            <?php 
                                $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                                $globalHeaderImage2 = get_theme_mod('globalHeaderImage2');
                            ?>
                            
                            <?php if($pageHeaderImage !== '') { ?>
                                
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } elseif($globalHeaderImage2 !== '') { ?>
                            
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } else { ?>
                            
                                <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } ?>
                    
                    <?php } elseif(is_product_tag() || is_product_category()) { ?>
                    
                            <!-- display global header img from customizer -->
                            <?php $pageHeaderImage = get_theme_mod('wooCategoryHeaderImage'); ?>
                            
                            <?php if($pageHeaderImage !== '') { ?>
                                <div class="pm_subheader_container" style="background-image:url('<?php echo $pageHeaderImage; ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } else { ?>
                                <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } ?>
                    
                    <?php } else { ?>
                    
                            <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) { ?>
                        
                                    <?php 
                                        $globalHeaderImage = get_theme_mod('globalHeaderImage');
                                    ?>
                            
                                    <?php if($globalHeaderImage !== '') { ?>
                                        <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                    <?php } else { ?>
                                        <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                    <?php } ?>
                            
                            <?php } else { ?>
                            
                                    <?php
                                        $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true);
                                    ?>
                            
                                    <?php if($pageHeaderImage !== '') { ?>
                                        <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                    <?php } else { ?>
                                        <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                    <?php } ?>
                            
                            <?php } ?>
                    
                    <?php } ?>
                
                <?php } else {//No Woocommerce installed ?>
                
                    <?php if( is_404() || is_search() || is_tag() || is_category() ) { ?>
                        
                            <?php 
                                $globalHeaderImage = get_theme_mod('globalHeaderImage');
                            ?>
                    
                            <?php if($globalHeaderImage !== '') { ?>
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } else { ?>
                                <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                            <?php } ?>
                    
                    <?php } else { ?>
                    
                            <?php 
                                $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                                $globalHeaderImage2 = get_theme_mod('globalHeaderImage2');
                            ?>
                            
                            <?php if($pageHeaderImage !== '') { ?>
                                
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } elseif($globalHeaderImage2 !== '') { ?>
                            
                                <div class="pm_subheader_container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>'); background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } else { ?>
                            
                                <div class="pm_subheader_container" style="border:none; background-color:<?php echo $subHeaderBackgroundColor; ?>;">
                                
                            <?php } ?>
                    
                    <?php } ?>
                
                <?php } ?>
            
                    <div class="container subHeader">
                
                        <div class="row">
                        
                            <?php if( function_exists('is_shop') || function_exists('is_product') || function_exists('is_product_tag') || function_exists('is_product_category') ) {  //Woocommerce installed ?>
                            
                                <?php if( is_shop() || is_product() || is_product_tag() || is_product_category() ) { ?>
                                                            
                                    <?php if(is_product()) {//product page ?>
                                    
                                        <div class="span12">
                                            <h2 class="pm_page_title"><?php the_title(); ?></h2> 
                                            
                                    <?php } else if(is_shop()) { //shop page ?>
                                    
                                        <div class="span6">
                                            <h2 class="pm_page_title"><?php woocommerce_page_title(); ?></h2> 
                                            
                                    <?php } else {//tag and category pages ?>
                                    
                                        <div class="span12">
                                            <h2 class="pm_page_title"><?php woocommerce_page_title(); ?></h2> 
                                    
                                    <?php }//end of if is_product() ?>
                                    
                                    <?php if($disableCrumbs == 'on') { ?>
                                        
                                        <?php				
                                            $args = array(
                                                    'delimiter' => '<li> :: </li>',
                                                    'wrap_before' => '<ul class="woocommerce-breadcrumb" itemprop="breadcrumb">',
                                                    'wrap_after' => '</ul>',
                                                    'before' => '<li>',
                                                    'after' => '</li>',
                                            );
                                        ?>
                                        <?php woocommerce_breadcrumb( $args ); ?>
                                        
                                    <?php }//end of if crumbs ?>
                                    
                                 <?php } else { //end of if shopping pages ?>
                                 
                                        <?php if(is_single() || is_404() || is_search() || is_tag() || is_category() || is_archive() || is_day() || is_month() || is_year() ) { ?>
                                            <div class="span12">
                                        <?php } else { ?>
                                            <div class="span6">
                                        <?php } ?>
                                        
                                            <?php if(is_single() ) { ?>
                                                <h2 class="pm_page_title"><?php the_title(); ?></h2>                                                
                                            <?php } else if(is_tax('gallerycats') ) { ?>            
            									<h2 class="pm_page_title"><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></h2>                                                                
                                            <?php } else if(is_tax('gallerytags') ) { ?>                                            
                                            	<h2 class="pm_page_title"><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></h2> 
                                            <?php } elseif(is_tag()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Posts tagged with', 'localization'); ?> <?php echo get_query_var('tag'); ?></h2>
                                            <?php } elseif(is_category()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Posts filed in', 'localization'); ?> <?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?></h2>
                                            <?php } elseif(is_month()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('F, Y'); ?></h2>
                                            <?php } elseif(is_day()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('F jS, Y'); ?></h2>
                                            <?php } elseif(is_year()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('Y');?></h2>
                                            <?php } elseif(is_author()) { ?>
                                                <h2 class="pm_page_title"><?php _e('Author Archive', 'localization'); ?></h2>
                                            <?php } elseif(is_404()) { ?>
                                                <h2 class="pm_page_title"><?php _e('404 Page Not Found', 'localization'); ?></h2>
                                            <?php } elseif(is_search()) { ?>
                                                <h2 class="pm_page_title"><?php esc_attr_e('Search results for', 'localization'); ?> "<?php echo get_search_query(); ?>"</h2>                                             
                                            <?php } elseif(is_tax('organizer_item_types')) { ?>
                                                <h2 class="pm_page_title"><?php single_tag_title(); ?></h2>
                                            <?php } else { ?>
                                                <h2 class="pm_page_title"><?php the_title(); ?></h2>
                                            <?php } ?>
                                            
                                            <?php if($disableCrumbs == 'on') { ?>
                                                <?php pm_hope_page_crumbs(); ?>
                                            <?php } ?>
                                                                            
                                  <?php } ?>  
                                                           
                            
                            <?php } else { //No Woocommerce installed ?>
                            
                                    <?php if(is_single() || is_404() || is_search() || is_tag() || is_category() || is_archive() || is_day() || is_month() || is_year() ) { ?>
                                        <div class="span12">
                                    <?php } else { ?>
                                        <div class="span6">
                                    <?php } ?>
                                    
                                        <?php if(is_single() ) { ?>
                                            <h2 class="pm_page_title"><?php the_title(); ?></h2>
                                        <?php } elseif(is_tag()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Posts tagged with', 'localization'); ?> <?php echo get_query_var('tag'); ?></h2>
                                        <?php } elseif(is_category()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Posts filed in', 'localization'); ?> <?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?></h2>
                                        <?php } elseif(is_month()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('F, Y'); ?></h2>
                                        <?php } elseif(is_day()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('F jS, Y'); ?></h2>
                                        <?php } elseif(is_year()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Archive for', 'localization'); ?> <?php the_time('Y');?></h2>
                                        <?php } elseif(is_author()) { ?>
                                            <h2 class="pm_page_title"><?php _e('Author Archive', 'localization'); ?></h2>
                                        <?php } elseif(is_404()) { ?>
                                            <h2 class="pm_page_title"><?php _e('404 Page Not Found', 'localization'); ?></h2>
                                        <?php } elseif(is_search()) { ?>
                                            <h2 class="pm_page_title"><?php esc_attr_e('Search results for', 'localization'); ?> "<?php echo get_search_query(); ?>"</h2>                                             
                                        <?php } elseif(is_tax('organizer_item_types')) { ?>
                                            <h2 class="pm_page_title"><?php single_tag_title(); ?></h2>
                                        <?php } else { ?>
                                            <h2 class="pm_page_title"><?php the_title(); ?></h2>
                                        <?php } ?>
                                            
                                        <?php if($disableCrumbs == 'on') { ?>
                                            <?php pm_hope_page_crumbs(); ?>
                                        <?php } ?>
                                    
                                    <?php } ?>  
                                                                    
                                
                            </div><!-- closing span header div -->
                            
                            <?php if( function_exists('is_shop') || function_exists('is_product') ) {  //Woocommerce installed ?>
                            
                                 <?php if( is_shop() ) { ?>
                                                                     
                                        <?php 
                                            $page_id = get_option( 'woocommerce_shop_page_id' ); 
                                            $pageMessage = get_post_meta($page_id, 'pm_header_message_meta', true); 
                                        ?>
                            
                                        <div class="span6">
                                            <?php if($pageMessage !== '') { ?>
                                                <div class="pm_header_quote">
                                                    <span><?php echo esc_attr($pageMessage); ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                 
                                 <?php } else { ?>  
                                 
                                        <?php if( !is_single() && !is_404() && !is_search() && !is_tag() && !is_category() && !is_archive() ) { ?>
                        
                                            <?php $pageMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); ?>
                                        
                                            <div class="span6">
                                                <?php if($pageMessage !== '') { ?>
                                                    <div class="pm_header_quote">
                                                        <span><?php echo esc_attr($pageMessage); ?></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            
                                        <?php } ?>
                                 
                                 <?php } ?>  
                            
                            <?php } else { ?>  
                            
                                <?php if( !is_single() && !is_404() && !is_search() && !is_tag() && !is_category() && !is_archive() ) { ?>
                        
                                    <?php $pageMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); ?>
                                
                                    <div class="span6">
                                        <?php if($pageMessage !== '') { ?>
                                            <div class="pm_header_quote">
                                                <span><?php echo esc_attr($pageMessage); ?></span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                <?php } ?>
                            
                            <?php } ?>               
                        
                        </div>
                        
                    </div><!-- /subpage header -->
                
                </div><!-- /pm_subheader_container -->
            
            <?php endif; //end of displaySubHeader ?>
    
    		
        
    <?php } //end of is_home() ?>