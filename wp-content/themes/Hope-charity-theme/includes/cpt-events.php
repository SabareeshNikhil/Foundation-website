<?php

function cpt_event(){
	
	global $hope_options;
	
	if( $hope_options ){
		$url_rewrite = $hope_options['opt-events-post-slug'];
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'event'; 
		} 
	} else {
		$url_rewrite = 'event';
	}

	register_post_type('post_events',
		array(
			'labels' => array(
				'name' =>  esc_attr__( 'Events', 'localization' ),
				'singular_name' => esc_attr__( 'Event entry', 'localization' ),
				'add_new' => esc_attr__( 'Add New Event entry', 'localization' ),
				'add_new_item' => esc_attr__( 'Add New Event entry', 'localization' ),
				'edit' => esc_attr__( 'Edit Event', 'localization' ),
				'edit_item' => esc_attr__( 'Edit Event entry', 'localization' ),
				'new_item' => esc_attr__( 'New Event entry', 'localization' ),
				'view' => esc_attr__( 'View', 'localization' ),
				'view_item' => esc_attr__( 'View Event entry', 'localization' ),
				'search_items' => esc_attr__( 'Search Events', 'localization' ),
				'not_found' => esc_attr__( 'No Events found', 'localization' ),
				'not_found_in_trash' => esc_attr__( 'No Events found in Trash', 'localization' ),
				'parent' => esc_attr__( 'Parent Event entry', 'localization' )
			),
			'description' => esc_attr__( 'Easily lets you add new events', 'localization' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}


function event_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_html__( 'Event Categories', 'localization' ),
		'singular_name' => esc_html__( 'Event Categories', 'localization' ),
		'search_items' =>  esc_html__( 'Search Event Categories', 'localization' ),
		'popular_items' => esc_html__( 'Popular Event Categories', 'localization' ),
		'all_items' => esc_html__( 'All Event Categories', 'localization' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_html__( 'Edit Event Category', 'localization' ),
		'update_item' => esc_html__( 'Update Event Category', 'localization' ),
		'add_new_item' => esc_html__( 'Add Event Category', 'localization' ),
		'new_item_name' => esc_html__( 'New Event Category', 'localization' ),
		'separate_items_with_commas' => esc_html__( 'Separate Event Categories with commas', 'localization' ),
		'add_or_remove_items' => esc_html__( 'Add or remove Event Categories', 'localization' ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used Event Categories', 'localization' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'event_categories', 'post_events', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'event-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}


add_action('init', 'cpt_event');
add_action('init', 'event_categories');