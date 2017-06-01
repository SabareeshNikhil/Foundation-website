<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {

	public static function register ( $wp_customize ) {
	
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		 
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'localization' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'localization' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'localization'),
				'priority' => 1,
			 )
		);
			
		/**** Header Options ****/
		
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_attr__( 'Header Options', 'localization' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'businessLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'businessLogo', 
			array(
				'label'    => esc_attr__( 'Logo', 'localization' ),
				'section'  => 'header_options',
				'settings' => 'businessLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'headerBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'headerBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Header Background Image', 'localization' ),
				'section'  => 'header_options',
				'settings' => 'headerBackgroundImage',
				'priority' => 2,
				) 
			) 
		);	
		
		//Radio Options		
		$wp_customize->add_setting('enableQuickNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableQuickNav', array(
			'label'      => esc_attr__('Quick Navigation', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'enableQuickNav',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON','localization'),
				'off'  => esc_attr__('OFF','localization'),
			),
		));
		
		$wp_customize->add_setting('disableSearchBar', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('disableSearchBar', array(
			'label'      => esc_attr__('Search Bar', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'disableSearchBar',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON','localization'),
				'off'  => esc_attr__('OFF','localization'),
			),
		));
		
	
				
		$wp_customize->add_setting('disableCrumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('disableCrumbs', array(
			'label'      => esc_attr__('Breadcrumbs', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'disableCrumbs',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON','localization'),
				'off'  => esc_attr__('OFF','localization'),
			),
		));
		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_attr__('Enable WPML Language selector?', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON','localization'),
				'off'  => esc_attr__('OFF','localization'),
			),
		));
		
		$wp_customize->add_setting('globalButtonTargetWindow', array(
			'default' => '_self',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('globalButtonTargetWindow', array(
			'label'      => esc_attr__('Header Button Target Window', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'globalButtonTargetWindow',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'_self'   => esc_attr__('Self','localization'),
				'_blank'  => esc_attr__('Blank','localization'),
			),
		));
		
		$wp_customize->add_setting('displaySubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displaySubHeader', array(
			'label'      => esc_attr__('Display Sub-Header?', 'localization'),
			'section'    => 'header_options',
			'settings'   => 'displaySubHeader',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON','localization'),
				'off'  => esc_attr__('OFF','localization'),
			),
		));
		
		//Textfields
		$wp_customize->add_setting(
			'globalButtonText', array(
				'default' => esc_attr__( 'Donate Today', 'localization' ),
				'sanitize_callback' => 'esc_attr',
			)
		);
	
		$wp_customize->add_control(
			'globalButtonText',
			 array(
				'label' => esc_attr__( 'Header Button Text', 'localization' ),
				'section' => 'header_options',
				'priority' => 9,
			 )
		);
		
		$wp_customize->add_setting(
			'globalButtonLink', array(
				'default' => '#',
				'sanitize_callback' => 'esc_attr',
			)
		);
	
		$wp_customize->add_control(
			'globalButtonLink',
			 array(
				'label' => esc_attr__( 'Header Button URL', 'localization' ),
				'section' => 'header_options',
				'priority' => 10,
			 )
		);
		
		
		$wp_customize->add_setting( 
			'headerSlogan', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			) 
		);
		 
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( $wp_customize, 'headerSlogan', array(
			'label'   => esc_attr__( 'Header Slogan', 'localization' ),
			'section' => 'header_options',
			'settings'   => 'headerSlogan',
			'priority' => 12,
		) ) );
				
		//Header height
		$wp_customize->add_setting(
			'headerHeight', array(
				'default' => 80,
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'headerHeight', 
				array(
					'label'   => esc_attr__( 'Header Height', 'localization' ),
					'section' => 'header_options',
					'settings'   => 'headerHeight',
					'priority' => 13,
					'choices'  => array(
						'min'  => 80,
						'max'  => 260,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'headerPadding', array(
				'default' => 20,
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'headerPadding', 
				array(
					'label'   => esc_attr__( 'Header Padding', 'localization' ),
					'section' => 'header_options',
					'settings'   => 'headerPadding',
					'priority' => 14,
					'choices'  => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 2,
					),
				) 
			) 
		);

		
		$headerOptionColorsPriority = 15;
		
		//Header Option Colors
		$headerOptionColors = array();
		$headerOptionColors[] = array(
			'slug'=>'headerBackgroundColor',
			'default' => '#007F84',
			'label' => esc_attr__('Header Background Color', 'localization')
		);
		$headerOptionColors[] = array(
			'slug'=>'subHeaderBackgroundColor', 
			'default' => '#dedede',
			'label' => esc_attr__('Subpage Header Background Color', 'localization')
		);
		$headerOptionColors[] = array(
			'slug'=>'subHeaderBorderColor', 
			'default' => '#e8e8e8',
			'label' => esc_attr__('Subpage Header Border Color', 'localization')
		);
		$headerOptionColors[] = array(
			'slug'=>'pageTitleColor', 
			'default' => '#2E2E2E',
			'label' => esc_attr__('Page Title Color', 'localization')
		);
		$headerOptionColors[] = array(
			'slug'=>'pageQuoteColor', 
			'default' => '#2E2E2E',
			'label' => esc_attr__('Page Quote Color', 'localization')
		);
		$headerOptionColors[] = array(
			'slug'=>'breadcrumbBg', 
			'default' => '#2E2E2E',
			'label' => esc_attr__('Breadcrumb Background Color', 'localization')
		);
			
		foreach( $headerOptionColors as $color ) {
					
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
						'label' => $color['label'], 
						'section' => 'header_options',
						'priority' => $headerOptionColorsPriority,
						'settings' => $color['slug'],
					)
				)
			);
			
			$headerOptionColorsPriority++;
			
		}//end of foreach
		
		
		/**** Navigation Options ****/
		$wp_customize->add_section( 'navigation_options' , array(
			'title'    => esc_attr__( 'Navigation Options', 'localization' ),
			'priority' => 30,
		));
		
		$NavigationColors = array();
		
		$NavigationColors[] = array(
			'slug'=>'navBgColor', 
			'default' => '#070707',
			'label' => esc_attr__('Navigation Color', 'localization')
		);
		$NavigationColors[] = array(
			'slug'=>'navHoverColor', 
			'default' => '#00A4AD',
			'label' => esc_attr__('Hover Color', 'localization')
		);
		$NavigationColors[] = array(
			'slug'=>'searchIconColor',
			'default' => '#BBBBBB',
			'label' => esc_attr__('Search Icon Color', 'localization')
		);
		
		foreach( $NavigationColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'navigation_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_attr__( 'Layout Options', 'localization' ),
			'priority' => 50,
		));
		
		
		//Radio Options
		$wp_customize->add_setting('enableResponsiveness', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableResponsiveness', array(
			'label'      => esc_attr__('Responsiveness', 'localization'),
			'section'    => 'layout_options',
			'settings'   => 'enableResponsiveness',
			'priority' => 1,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('userScalable', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('userScalable', array(
			'label'      => esc_attr__('Pinch and Zoom (for touch devices)', 'localization'),
			'section'    => 'layout_options',
			'settings'   => 'userScalable',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		//Image Radio Options
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'full-width',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_attr__( 'Homepage Layout', 'localization' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'priority' => 3,
					'choices'  => array(
						'full-width' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
						'dual-left-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-left-sidebar.png',
						'dual-right-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-right-sidebar.png',
						'dual-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-sidebar.png',
					),
				) 
			) 
		);
		
		
		
		$wp_customize->add_setting(
			'blogTemplateLayout', array(
				'default' => 'full-width',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'blogTemplateLayout', 
				array(
					'label'   => esc_attr__( 'Blog Template Layout', 'localization' ),
					'section' => 'layout_options',
					'settings'   => 'blogTemplateLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'priority' => 4,
					'choices'  => array(
						'full-width' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
						'dual-left-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-left-sidebar.png',
						'dual-right-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-right-sidebar.png',
						'dual-sidebar' => get_template_directory_uri() . '/css/img/layouts/dual-sidebar.png',
					),
				) 
			) 
		);


		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_attr__( 'Footer Layout', 'localization' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'priority' => 5,
					'choices'  => array(
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
			
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_attr__( 'Footer Options', 'localization' ),
			'priority' => 60,
		));
		
		//Images
		$wp_customize->add_setting( 'footerLogo' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerLogo', 
			array(
				'label'    => esc_attr__( 'Footer Logo', 'localization' ),
				'section'  => 'footer_options',
				'settings' => 'footerLogo',
				'priority' => 1
				) 
			) 
		);
		
		$wp_customize->add_setting( 'footerBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Footer Background Image', 'localization' ),
				'section'  => 'footer_options',
				'settings' => 'footerBackgroundImage',
				'priority' => 2
				) 
			) 
		);
			
		//Radio Options	
		$wp_customize->add_setting('displayInfo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayInfo', array(
			'label'      => esc_attr__('Footer Navigation', 'localization'),
			'section'    => 'footer_options',
			'settings'   => 'displayInfo',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayFatFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayFatFooter', array(
			'label'      => esc_attr__('Fat Footer', 'localization'),
			'section'    => 'footer_options',
			'settings'   => 'displayFatFooter',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		//slider elements
		$wp_customize->add_setting(
			'footerPadding', array(
				'default' => 30,
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'footerPadding', 
				array(
					'label'   => esc_attr__( 'Fat Footer Padding', 'localization' ),
					'section' => 'footer_options',
					'settings'   => 'footerPadding',
					'priority' => 5,
					'choices'  => array(
						'min'  => 20,
						'max'  => 200,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerNavPadding', array(
				'default' => 20,
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'footerNavPadding', 
				array(
					'label'   => esc_attr__( 'Footer Nav Padding', 'localization' ),
					'section' => 'footer_options',
					'settings'   => 'footerNavPadding',
					'priority' => 6,
					'choices'  => array(
						'min'  => 20,
						'max'  => 200,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerInfoPadding', array(
				'default' => 20,
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'footerInfoPadding', 
				array(
					'label'   => esc_attr__( 'Footer Info Padding', 'localization' ),
					'section' => 'footer_options',
					'settings'   => 'footerInfoPadding',
					'priority' => 7,
					'choices'  => array(
						'min'  => 20,
						'max'  => 200,
						'step' => 2,
					),
				) 
			) 
		);
	
		
		//Textfields
		$wp_customize->add_setting(
			'copyrightNotice', array(
				'default' => '',
				//'sanitize_callback' => 'esc_attr', 
			)
		);
		
		$wp_customize->add_control( 'copyrightNotice', array(
			'label'   => esc_attr__('Copyright', 'localization'),
			'section' => 'footer_options',
			'settings' => 'copyrightNotice',
			'priority' => 8,
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting(
			'returnToTopIcon', array(
				'default' => 'fa fa-chevron-up',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'returnToTopIcon', array(
			'label'   => esc_attr__('Return To Top Icon', 'localization'),
			'section' => 'footer_options',
			'settings' => 'returnToTopIcon',
			'priority' => 9,
			'type'    => 'text',
		) );
		
		
		//colors
		$FooterColors = array();
		
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#007f84',
			'label' => esc_attr__('Footer Background Color', 'localization')
		);
		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#1C1C1C',
			'label' => esc_attr__('Fat Footer Background Color', 'localization')
		);
		$FooterColors[] = array(
			'slug'=>'fatFooterBorderColor', 
			'default' => '#3C3C3C',
			'label' => esc_attr__('Fat Footer Border Color', 'localization')
		);
		
		$priority = 10;
		
		foreach( $FooterColors as $color ) {
			
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'footer_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
			
			$priority++;
			
		}//end of foreach
		
		
		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_attr__( 'Global Options', 'localization' ),
			'priority' => 70,
		));
		
		//images
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Background image', 'localization' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'no-repeat',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_attr__('Background Repeat', 'localization'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'no-repeat'   => 'No Repeat',
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
			),
		));
		
		/*$wp_customize->add_setting( 'columnBorderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'columnBorderImage', 
			array(
				'label'    => esc_attr__( 'Column Border Image', 'localization' ),
				'section'  => 'global_options',
				'settings' => 'columnBorderImage',
				'priority' => 3,
				) 
			) 
		);*/
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_attr__( 'Global Header Image (archives, category, 404)', 'localization' ),
				'section'  => 'global_options',
				'settings' => 'globalHeaderImage',
				'priority' => 4,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_attr__( 'Global Header Image (pages and posts)', 'localization' ),
				'section'  => 'global_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 5,
				) 
			) 
		);
		
		//Radio Options
		$wp_customize->add_setting('colorSampler',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('colorSampler', array(
			'label'      => esc_attr__('Theme Sampler', 'localization'),
			'section'    => 'global_options',
			'settings'   => 'colorSampler',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableRetina',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableRetina', array(
			'label'      => esc_attr__('Enable Retina Support?', 'localization'),
			'section'    => 'global_options',
			'settings'   => 'enableRetina',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
				
		$wp_customize->add_setting(
			'logoalt', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( 'logoalt', array(
			'label'   => esc_attr__('Logo Alt Tag', 'localization'),
			'section' => 'global_options',
			'settings' => 'logoalt',
			'priority' => 10,
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'logoURL', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( 'logoURL', array(
			'label'   => esc_attr__('Logo URL', 'localization'),
			'section' => 'global_options',
			'settings' => 'logoURL',
			'priority' => 11,
			'type'    => 'text',
		) );
		
		//colors	
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Background Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#00B7C2',
			'label' => esc_attr__('Primary Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#ACDB05',
			'label' => esc_attr__('Secondary Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#ACDB05',
			'label' => esc_attr__('ToolTip Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'filterMenuColor', 
			'default' => '#8A8A8A',
			'label' => esc_attr__('Filter Menu Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'filterMenuHoverColor', 
			'default' => '#7d7d7d',
			'label' => esc_attr__('Filter Menu Hover Color', 'localization')
		);
		$GlobalColors[] = array(
			'slug'=>'socialIconsColor', 
			'default' => '#00b7c2',
			'label' => esc_attr__('Social Icons Color', 'localization')
		);
		
		$GlobalColors[] = array(
			'slug'=>'searchFieldColor', 
			'default' => '#494949',
			'label' => esc_attr__('Searchfield Color', 'localization')
		);
		
		$GlobalColors[] = array(
			'slug'=>'searchFieldTextColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Searchfield Text Color', 'localization')
		);
		
		$GlobalColors[] = array(
			'slug'=>'featuredColumnBorders', 
			'default' => '#3d3d3d',
			'label' => esc_attr__('Featured Column Borders', 'localization')
		);
		
		$globalColorsPriority = 12;
		
		foreach( $GlobalColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'global_options',
					'settings' => $color['slug'],
					'priority' => $globalColorsPriority,
					)
				)
			);
			
			$globalColorsPriority++;
			
		}//end of foreach
		
		
		/**** Business Info ****/
		
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_attr__( 'Business Info', 'localization' ),
			'priority' => 90,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( 'businessPhone', array(
			'label'   =>  esc_attr__( 'Phone Number', 'localization' ),
			'section' => 'business_info',
			'settings' => 'businessPhone',
	
			'priority' => 10,
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => esc_attr__( 'Email Address', 'localization' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'priority' => 20,
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_attr__( 'Facebook URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'priority' => 30,
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_attr__( 'Twitter URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'priority' => 40,
			'type'    => 'text',
		) );
		
		//G Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_attr__( 'Google Plus URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'priority' => 50,
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_attr__( 'Linkedin URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'priority' => 60,
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_attr__( 'Vimeo URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'priority' => 70,
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_attr__( 'YouTube URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'priority' => 80,
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_attr__( 'Dribbble URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'priority' => 90,
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_attr__( 'Pinterest URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'priority' => 90,
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_attr__( 'Instagram URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'priority' => 100,
			'type'    => 'text',
		) );
		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_attr__( 'Skype Name', 'localization' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'priority' => 110,
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_attr__( 'Flickr URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'priority' => 110,
			'type'    => 'text',
		) );
		
		//Email Icon
		$wp_customize->add_setting(
			'emailLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'emailLink', array(
			'label'   => esc_attr__( 'Email Address (Icon)', 'localization' ),
			'section' => 'business_info',
			'settings' => 'emailLink',
			'priority' => 140,
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_attr__( 'RSS URL', 'localization' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'priority' => 150,
			'type'    => 'text',
		) );
		
		
		/**** Woocommerce Options ****/
		 
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_attr__( 'Woocommerce Options', 'localization' ),
			'priority' => 100,
		));
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '8',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => esc_attr__( 'Products Per Page', 'localization' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'24' => '24',
					'28' => '28',
					'32' => '32',
				),
			)
		);

		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_attr__( 'Category/Tag Page Header Image', 'localization' ),
				'section'  => 'woo_options',
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_attr__( 'Post Options', 'localization' ),
			'priority' => 110,
		));
		
		$wp_customize->add_setting('displaySocialMeta',
			array(
				'default' => 'on',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displaySocialMeta',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Social Options?', 'localization' ),
				'section' => 'post_options',
				'priority' => 2,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		$wp_customize->add_setting('displayCommentsCount',
			array(
				'default' => 'on',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayCommentsCount',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Comments Count?', 'localization' ),
				'section' => 'post_options',
				'priority' => 3,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		$wp_customize->add_setting('displayCategories',
			array(
				'default' => 'on',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayCategories',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Categories?', 'localization' ),
				'section' => 'post_options',
				'priority' => 4,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		$wp_customize->add_setting('displayComments',
			array(
				'default' => 'on',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayComments',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Comments Area?', 'localization' ),
				'section' => 'post_options',
				'priority' => 5,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		
		$wp_customize->add_setting('displayMetaInfo',
			array(
				'default' => 'on',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayMetaInfo',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Meta info?', 'localization' ),
				'section' => 'post_options',
				'priority' => 6,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		
		$wp_customize->add_setting('displayExcerptOnMeta',
			array(
				'default' => 'off',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayExcerptOnMeta',
			array(
				'type' => 'radio',
				'label' => esc_attr__( 'Display Excerpt beneath meta info?', 'localization' ),
				'section' => 'post_options',
				'priority' => 7,
				'choices' => array(
					'on' => esc_attr__( 'ON', 'localization' ),
					'off' => esc_attr__( 'OFF', 'localization' ),
				),
			)
		);
		
		
		$wp_customize->add_setting('enablePostZoom',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enablePostZoom', array(
			'label'      => esc_attr__('Enable Post Zoom effect?', 'localization'),
			'section'    => 'post_options',
			'settings'   => 'enablePostZoom',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enablePostHover',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enablePostHover', array(
			'label'      => esc_attr__('Enable Post Hover effect?', 'localization'),
			'section'    => 'post_options',
			'settings'   => 'enablePostHover',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		/**** Custom Post Type Options ****/
		 
		$wp_customize->add_section( 'cpt_options' , array(
			'title'    => esc_attr__( 'Custom Post Type Options', 'localization' ),
			'priority' => 110,
		));
		
		
		//Radio options
		$wp_customize->add_setting('eventsPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('eventsPostOrder', array(
			'label'      => esc_attr__('Events Post Order', 'localization'),
			'section'    => 'cpt_options',
			'settings'   => 'eventsPostOrder',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
		
		$wp_customize->add_setting('sortEventsbyEventDate', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('sortEventsbyEventDate', array(
			'label'      => esc_attr__('Sort events by event date?', 'localization'),
			'section'    => 'cpt_options',
			'settings'   => 'sortEventsbyEventDate',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableEventPostZoom',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableEventPostZoom', array(
			'label'      => esc_attr__('Enable Event Post Zoom effect?', 'localization'),
			'section'    => 'cpt_options',
			'settings'   => 'enableEventPostZoom',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableEventPostHover',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableEventPostHover', array(
			'label'      => esc_attr__('Enable Event Post Hover effect?', 'localization'),
			'section'    => 'cpt_options',
			'settings'   => 'enableEventPostHover',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		/**** Micro Slider Options ****/
		$wp_customize->add_section( 'presentation_options' , array(
			'title'    => esc_html__( 'Micro Slider Options', 'localization' ),
		));
		
		
		
		$wp_customize->add_setting('enableMicroSlider', array(
			'default' => 'yes',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableMicroSlider', array(
			'label'      => esc_html__('Enable Micro Slider?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'enableMicroSlider',
			'type'       => 'radio',
			'choices'    => array(
				'yes'   => 'ON',
				'no'  => 'OFF',
			),
		));
		
		/*$wp_customize->add_setting('enableFixedHeight', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableFixedHeight', array(
			'label'      => esc_html__('Fixed Height?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'enableFixedHeight',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));*/
		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => esc_html__('Enable SlideShow?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'enableSlideShow',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => esc_html__('Loop Slides?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'slideLoop',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => esc_html__('Enable Bullets?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'enableControlNav',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => esc_html__('Pause on hover?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'pauseOnHover',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => esc_html__('Display arrows?', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'showArrows',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('animtionType', array(
			'default' => 'fade',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('animtionType', array(
			'label'      => esc_html__('Animation Type', 'localization'),
			'section'    => 'presentation_options',
			'settings'   => 'animtionType',
			'type'       => 'radio',
			'choices'    => array(
				'fade'   => 'Fade',
				'slide'  => 'Slide',
			),
		));

		
		
		$wp_customize->add_setting(
			'slideShowSpeed', array(
				'default' => 8000,
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'slideShowSpeed', 
				array(
					'label'   => esc_html__( 'Slide Show Speed', 'localization' ),
					'section' => 'presentation_options',
					'settings'   => 'slideShowSpeed',
					'choices'  => array(
						'min'  => 1000,
						'max'  => 10000,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'slideSpeed', array(
				'default' => 500,
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'slideSpeed', 
				array(
					'label'   => esc_html__( 'Slide Speed', 'localization' ),
					'section' => 'presentation_options',
					'settings'   => 'slideSpeed',
					'choices'  => array(
						'min'  => 500,
						'max'  => 1000,
						'step' => 2,
					),
				) 
			) 
		);
		
		
		//Slider
		$wp_customize->add_setting(
			'textBackgroundOpacity', array(
				'default' => 80,
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'textBackgroundOpacity', 
				array(
					'label'   => esc_html__( 'Text background opacity', 'localization' ),
					'section' => 'presentation_options',
					'settings'   => 'textBackgroundOpacity',
					'choices'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				) 
			) 
		);
		
				
		$PresentationColors = array();
		
		$PresentationColors[] = array(
			'slug'=>'textBackgroundColor', 
			'default' => '#000000',
			'label' => esc_html__('Text background color', 'localization')
		);
		
		/*$PresentationColors[] = array(
			'slug'=>'buttonColor', 
			'default' => '#ef5438',
			'label' => esc_html__('Button color', 'localization')
		);*/
		
		foreach( $PresentationColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'presentation_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
			
		
		
		/**** Shortcode Options ****/
		 
		/*$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_attr__( 'Shortcode Options', 'localization' ),
			'priority' => 110,
		));
		
		$ShortcodeColors = array();
		
		$ShortcodeColors[] = array(
			'slug'=>'featureSliderCaptionBG', 
			'default' => '#2E2E2D',
			'label' => esc_attr__('Caption Background color', 'localization'),
		);
		
		
		foreach( $ShortcodeColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'featureSlider_options',
					'settings' => $color['slug'],
					)
				)
			);
		}//end of foreach	*/
		
	}//end of register
	
}//end of class




if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
					<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
				<?php } ?>
			</span>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}
   
//add_action( 'customize_register' , 'PulsarCustomizer' );

add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );


?>