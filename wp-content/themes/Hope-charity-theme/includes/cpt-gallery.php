<?php //HOPE

function cpt_gallery(){
	
	$url_rewrite = 'gallery';
	
	global $hope_options;
	
	if( isset($hope_options['opt-gallery-post-type-slug']) && !empty($hope_options['opt-gallery-post-type-slug']) ) {
		$url_rewrite = $hope_options['opt-gallery-post-type-slug'];
	} 


	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Gallery', 'localization' ),
				'singular_name' => esc_attr__( 'Gallery', 'localization' ),
				'add_new' => esc_attr__( 'Add New Gallery item', 'localization' ),
				'add_new_item' => esc_attr__( 'Add New Gallery item', 'localization' ),
				'edit' => esc_attr__( 'Edit', 'localization' ),
				'edit_item' => esc_attr__( 'Edit Gallery item', 'localization' ),
				'new_item' => esc_attr__( 'New Gallery item', 'localization' ),
				'view' => esc_attr__( 'View', 'localization' ),
				'view_item' => esc_attr__( 'View Gallery item', 'localization' ),
				'search_items' => esc_attr__( 'Search Gallery items', 'localization' ),
				'not_found' => esc_attr__( 'No Gallery items found', 'localization' ),
				'not_found_in_trash' => esc_attr__( 'No Gallery items found in Trash', 'localization' ),
				'parent' => esc_attr__( 'Parent Staff', 'localization' )
			),
			'description' => esc_attr__( 'Easily lets you add new gallery items', 'localization' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Categories', 'localization' ),
		'singular_name' => esc_attr__( 'Gallery Categories', 'localization' ),
		'search_items' =>  esc_attr__( 'Search Gallery Categories', 'localization' ),
		'popular_items' => esc_attr__( 'Popular Gallery Categories', 'localization' ),
		'all_items' => esc_attr__( 'All Gallery Categories', 'localization' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'localization' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'localization' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'localization' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'localization' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Categories with commas', 'localization' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Categories', 'localization' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Categories', 'localization' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function gallery_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Tags', 'localization' ),
		'singular_name' => esc_attr__( 'Gallery Tags', 'localization' ),
		'search_items' =>  esc_attr__( 'Search Gallery Tags', 'localization' ),
		'popular_items' => esc_attr__( 'Popular Gallery Tags', 'localization' ),
		'all_items' => esc_attr__( 'All Gallery Tags', 'localization' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'localization' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'localization' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'localization' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'localization' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Tags with commas', 'localization' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Tags', 'localization' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Tags', 'localization' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerytags', 'post_galleries', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_gallery');
add_action('init', 'gallery_categories');
add_action('init', 'gallery_tags');