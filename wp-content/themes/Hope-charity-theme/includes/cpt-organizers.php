<?php
function cpt_organizer(){
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-organizers-post-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'organizer'; 
		} 
	} else {
		$url_rewrite = 'organizer';
	}

	register_post_type('post_organizers',
		array(
			'labels' => array(
				'name' => esc_attr__('Organizers', 'localization'),
				'singular_name' => esc_attr__('Organizer', 'localization'),
				'add_new' => esc_attr__('Add New Organizer', 'localization'),
				'add_new_item' => esc_attr__('Add New Organizer', 'localization'),
				'edit' => esc_attr__('Edit', 'localization'),
				'edit_item' => esc_attr__('Edit Organizer', 'localization'),
				'new_item' => esc_attr__('New Organizer', 'localization'),
				'view' => esc_attr__('View', 'localization'),
				'view_item' => esc_attr__('View Organizer', 'localization'),
				'search_items' => esc_attr__('Search Organizers', 'localization'),
				'not_found' => esc_attr__('No Organizers found', 'localization'),
				'not_found_in_trash' => esc_attr__('No Organizers found in Trash', 'localization'),
				'parent' => esc_attr__('Parent Organizer', 'localization')
			),
			'description' => esc_attr__('Easily lets you add new organizer profiles to your system.', 'localization'),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'capability_type' => 'page',
			'hierarchical' => false,
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		)
	); 
	flush_rewrite_rules();
}

function tax_organizer() {
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-organizers-taxonomy-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'organizers'; 
		} 
	} else {
		$url_rewrite = 'organizers';
	}

	
	//Add category support
	register_taxonomy('organizer_item_types', 'post_organizers', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true, //Set to true for categories or false for tags
		'show_admin_column' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => esc_attr__('Organizer Titles', 'localization'),
			'singular_name' => esc_attr__('Organizer Titles', 'localization'),
			'search_items' =>  esc_attr__('Search Organizer Titles', 'localization'),
			'all_items' => esc_attr__('Popular Organizer Titles', 'localization'),
			'parent_item' => esc_attr__('Parent Organizer Titles', 'localization'),
			'parent_item_colon' => esc_attr__('Parent Organizer Title:', 'localization'),
			'edit_item' => esc_attr__('Edit Organizer Title', 'localization'),
			'update_item' => esc_attr__('Update Organizer Title', 'localization'),
			'add_new_item' => esc_attr__('Add New Organizer Title', 'localization'),
			'new_item_name' => esc_attr__('New Organizer Titles', 'localization'),
			'menu_name' => esc_attr__('Organizer Titles', 'localization'),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => $url_rewrite, // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_organizer');
add_action('init', 'tax_organizer');