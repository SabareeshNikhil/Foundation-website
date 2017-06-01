<?php //HOPE

//News posts meta options
add_action( 'add_meta_boxes', 'add_post_metaoptions' );

//Page meta options
add_action( 'add_meta_boxes', 'add_page_metaoptions' );

//Gallery meta options
add_action( 'add_meta_boxes', 'add_gallery_metaoptions' );

//Organizer meta options
add_action( 'add_meta_boxes', 'add_organizer_metaoptions' );

//Event meta options
add_action( 'add_meta_boxes', 'add_events_metaoptions' );

//Add organizers, events, etc.

//Sidebar selector meta box for posts and pages
//add_action( 'add_meta_boxes', 'pm_ln_add_sidebar_metabox' );

//Save custom post/page data
add_action( 'save_post', 'save_postdata' );
//add_action( 'save_post', 'pm_ln_save_sidebar_postdata' );

//Rewrite default WordPress Featured image box
add_action('do_meta_boxes', 'pm_ln_render_new_post_thumbnail_meta_box');

/*** EVENTS META OPTIONS & FUNCTIONS *****/
function add_events_metaoptions() {

	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'localization' ),  //label
		'pm_header_image_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	//Event Date
	add_meta_box( 
		'pm_event_date_meta', //ID
		 esc_attr__( 'Event Date', 'localization' ),  //label
		'pm_event_date_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	//Tooltip Message
	add_meta_box( 
		'pm_event_tooltip_meta', //ID
		 esc_attr__( 'Tooltip Message', 'localization' ),  //label
		'pm_event_tooltip_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	//FontAwesome Icon
	add_meta_box( 
		'pm_event_icon_meta', //ID
		 esc_attr__( 'FontAwesome Icon', 'localization' ),  //label
		'pm_event_icon_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	//Countdown Timer
	add_meta_box( 
		'pm_event_countdown_meta', //ID
		 esc_attr__( 'Countdown Timer', 'localization' ),  //label
		'pm_event_countdown_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	//Panel Header Info
	add_meta_box( 
		'pm_event_panel_info_meta', //ID
		 esc_attr__( 'Panel Header Info', 'localization' ),  //label
		'pm_event_panel_info_meta_function' , //function
		'post_events', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_event_date_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_event_date_meta = get_post_meta( $post->ID, 'pm_event_date_meta', true );
	
	?>
    	<p><?php esc_attr_e('Enter the date for this event.','localization'); ?></p>
		<input id="eventDate" type="text" value="<?php echo esc_attr($pm_event_date_meta); ?>" name="pm_event_date_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_event_tooltip_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_event_tooltip_meta = get_post_meta( $post->ID, 'pm_event_tooltip_meta', true );
	
	?>
    	<p><?php esc_attr_e('Enter a tooltip text.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_event_tooltip_meta); ?>" name="pm_event_tooltip_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_event_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_event_icon_meta = get_post_meta( $post->ID, 'pm_event_icon_meta', true );
	
	?>
    	<p><?php esc_attr_e('Enter your own FontAwesome icon for this event post. (ex. fa fa-globe)','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_event_icon_meta); ?>" name="pm_event_icon_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_event_countdown_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_event_countdown_meta = get_post_meta( $post->ID, 'pm_event_countdown_meta', true );
	
	?>
    	<p><?php esc_attr_e('If you would like to activate the countdown timer for this event please enter the full event date in the following format: 2013,12,25 (year,month,day).','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_event_countdown_meta); ?>" name="pm_event_countdown_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_event_panel_info_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_event_panel_info_meta = get_post_meta( $post->ID, 'pm_event_panel_info_meta', true );
	
	?>
    	<p><?php esc_attr_e('Choose between displaying meta information or the event title in the panel header.', 'localization'); ?></p>
        <select id="pm_event_panel_info_meta" name="pm_event_panel_info_meta" class="pm-admin-select-list">  
        	<option value="eventTitle" <?php selected( $pm_event_panel_info_meta, 'eventTitle' ); ?>><?php esc_attr_e('Event Title', 'localization') ?></option>
            <option value="eventMeta" <?php selected( $pm_event_panel_info_meta, 'eventMeta' ); ?>><?php esc_attr_e('Event Meta', 'localization') ?></option>
        </select>
    <?php
	
}


/*** ORGANIZER META OPTIONS & FUNCTIONS *****/
function add_organizer_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'localization' ),  //label
		'pm_header_image_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Orgainzer title
	add_meta_box( 
		'pm_organizer_title_meta', //ID
		 esc_attr__( 'Organizer Title', 'localization' ),  //label
		'pm_organizer_title_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Tooltip
	add_meta_box( 
		'pm_organizer_tooltip_meta', //ID
		 esc_attr__( 'Tooltip Message', 'localization' ),  //label
		'pm_organizer_tooltip_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Contact number
	add_meta_box( 
		'pm_organizer_contact_number_meta', //ID
		 esc_attr__( 'Contact Number', 'localization' ),  //label
		'pm_organizer_contact_number_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Email address
	add_meta_box( 
		'pm_organizer_email_meta', //ID
		 esc_attr__( 'Email Address', 'localization' ),  //label
		'pm_organizer_email_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Personal Website
	add_meta_box( 
		'pm_organizer_webiste_meta', //ID
		 esc_attr__( 'Personal Website', 'localization' ),  //label
		'pm_organizer_webiste_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Linkedin Profile
	add_meta_box( 
		'pm_organizer_linkedin_meta', //ID
		 esc_attr__( 'Linkedin Profile', 'localization' ),  //label
		'pm_organizer_linkedin_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Twitter Profile
	add_meta_box( 
		'pm_organizer_twitter_meta', //ID
		 esc_attr__( 'Twitter Profile', 'localization' ),  //label
		'pm_organizer_twitter_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Facebook Profile
	add_meta_box( 
		'pm_organizer_facebook_meta', //ID
		 esc_attr__( 'Facebook Profile', 'localization' ),  //label
		'pm_organizer_facebook_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Google Plus Profile
	add_meta_box( 
		'pm_organizer_google_meta', //ID
		 esc_attr__( 'Google Plus Profile', 'localization' ),  //label
		'pm_organizer_google_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
	//Skype Address
	add_meta_box( 
		'pm_organizer_skype_meta', //ID
		 esc_attr__( 'Skype Address', 'localization' ),  //label
		'pm_organizer_skype_meta_function' , //function
		'post_organizers', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_organizer_title_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_title_meta = get_post_meta( $post->ID, 'pm_organizer_title_meta', true );
	
	?>
    	<p><?php esc_attr_e('Type in the official title of this organizer. (ex. Staff Volunteer)','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_title_meta); ?>" name="pm_organizer_title_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_tooltip_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_tooltip_meta = get_post_meta( $post->ID, 'pm_organizer_tooltip_meta', true );
	
	?>
    	<p><?php esc_attr_e('Add a tooltip message for this organizer if desired.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_tooltip_meta); ?>" name="pm_organizer_tooltip_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_contact_number_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_contact_number_meta = get_post_meta( $post->ID, 'pm_organizer_contact_number_meta', true );
	
	?>
    	<p><?php esc_attr_e('Add a contact number for this organizer if desired.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_contact_number_meta); ?>" name="pm_organizer_contact_number_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_email_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_email_meta = get_post_meta( $post->ID, 'pm_organizer_email_meta', true );
	
	?>
    	<p><?php esc_attr_e('Add an email address for this organizer if desired.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_email_meta); ?>" name="pm_organizer_email_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_webiste_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_webiste_meta = get_post_meta( $post->ID, 'pm_organizer_webiste_meta', true );
	
	?>
    	<p><?php esc_attr_e('Add a web address URL for this organizer if desired.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_webiste_meta); ?>" name="pm_organizer_webiste_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_linkedin_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_linkedin_meta = get_post_meta( $post->ID, 'pm_organizer_linkedin_meta', true );
	
	?>
    	<p><?php esc_attr_e('Copy and paste in the public Linkedin URL address associated with this organizer - this will activate the Linkedin button.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_linkedin_meta); ?>" name="pm_organizer_linkedin_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_twitter_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_twitter_meta = get_post_meta( $post->ID, 'pm_organizer_twitter_meta', true );
	
	?>
    	<p><?php esc_attr_e('Copy and paste in the Twitter profile address associated with this staff member - this will activate the Twitter button.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_twitter_meta); ?>" name="pm_organizer_twitter_meta" class="pm-admin-text-field" />
    <?php
	
}


function pm_organizer_facebook_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_facebook_meta = get_post_meta( $post->ID, 'pm_organizer_facebook_meta', true );
	
	?>
    	<p><?php esc_attr_e('Copy and paste in the Facebook profile address associated with this staff member - this will activate the Facebook button.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_facebook_meta); ?>" name="pm_organizer_facebook_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_organizer_google_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_google_meta = get_post_meta( $post->ID, 'pm_organizer_google_meta', true );
	
	?>
    	<p><?php esc_attr_e('Copy and paste in the Google Plus profile address associated with this staff member - this will activate the Google Plus button.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_google_meta); ?>" name="pm_organizer_google_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_organizer_skype_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	$pm_organizer_skype_meta = get_post_meta( $post->ID, 'pm_organizer_skype_meta', true );
	
	?>
    	<p><?php esc_attr_e('Copy and paste in the Skype member name associated with this staff member - this will activate the Skype button.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_organizer_skype_meta); ?>" name="pm_organizer_skype_meta" class="pm-admin-text-field" />
    <?php
	
}




/*** GALLERY META OPTIONS & FUNCTIONS *****/
function add_gallery_metaoptions() {
	
	//Post layout
	add_meta_box( 
		'pm_post_layout_meta', //ID
		 esc_attr__( 'Post Layout', 'localization' ),  //label
		'pm_post_layout_meta_function' , //function
		'post_galleries', //Post type
		'side' 
	);
	
	//Sidebar selector
	add_meta_box(
        'custom_sidebar',
        esc_html__( 'Custom Sidebar', 'localization' ),
        'pm_ln_custom_sidebar_callback',
        'post_galleries',
        'side'
    );
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'localization' ),  //label
		'pm_header_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Gallery image
	add_meta_box( 
		'pm_gallery_image_meta', //ID
		 esc_attr__( 'Gallery Image', 'localization' ),  //label
		'pm_gallery_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Video
	add_meta_box( 
		'pm_gallery_video_meta', //ID
		 esc_attr__( 'Youtube Video', 'localization' ),  //label
		'pm_gallery_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Display Video in carousel
	add_meta_box( 
		'pm_gallery_display_video_meta', //ID
		 esc_attr__( 'Display Youtube Video?', 'localization' ),  //label
		'pm_gallery_display_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);

	
	//Caption
	add_meta_box( 
		'pm_gallery_item_caption_meta', //ID
		 esc_attr__( 'Caption', 'localization' ),  //label
		'pm_gallery_item_caption_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
}


function pm_gallery_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_image_meta = get_post_meta( $post->ID, 'pm_gallery_image_meta', true );
	//echo $pm_gallery_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 900x400px','localization'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_image_meta); ?>" name="pm_gallery_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'localization'); ?>" class="button-primary" />
        <div class="pm-admin-gallery-image-preview"></div>
    
    	<?php if($pm_gallery_image_meta) : ?>
        	<input id="remove_gallery_image_button" type="button" value="<?php esc_html_e('Remove Image', 'localization'); ?>" class="button-primary" />
        <?php endif; ?>
    
    <?php
	
}

function pm_gallery_item_caption_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_item_caption_meta = get_post_meta( $post->ID, 'pm_gallery_item_caption_meta', true );
	//echo $pm_gallery_item_caption_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a caption for your gallery post. This appears in the expanded view.','localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_gallery_item_caption_meta); ?>" name="pm_gallery_item_caption_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_video_meta = get_post_meta( $post->ID, 'pm_gallery_video_meta', true );
	//echo $pm_gallery_video_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Youtube video URL (ex. http://www.youtube.com/watch?v=ai9qbTKxwkc)','localization'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_video_meta); ?>" name="pm_gallery_video_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_display_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_gallery_display_video_meta = get_post_meta( $post->ID, 'pm_gallery_display_video_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Setting this to YES will override the gallery image in the PrettyPhoto carousel.', 'localization'); ?></p>
        <select id="pm_gallery_display_video_meta" name="pm_gallery_display_video_meta" class="pm-admin-select-list">  
        	<option value="no" <?php selected( $pm_gallery_display_video_meta, 'no' ); ?>><?php esc_attr_e('NO', 'localization') ?></option>
            <option value="yes" <?php selected( $pm_gallery_display_video_meta, 'yes' ); ?>><?php esc_attr_e('YES', 'localization') ?></option>
        </select>
    
    <?php
	
}


/* Prints the sidebar meta box content */
function pm_ln_custom_sidebar_callback( $post ){
	
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // Use nonce for verification
    wp_nonce_field( 'custom_sidebar', 'custom_sidebar_nonce' );
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.esc_html__("Choose a sidebar to display", 'localization' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".esc_html__('No Sidebar', 'localization')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar['name'] == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
     
    echo $output;
}

/*** NEW FEATURED IMAGE FOR POSTS WITH DETAILS *****/
function pm_ln_new_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 570x360px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_new_organizers_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 370x260px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_new_events_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 570x320px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_render_new_post_thumbnail_meta_box() {
	
    global $post_type; // lets call the post type 
     
    // remove the old meta box
    remove_meta_box( 'postimagediv','post','side' );
	remove_meta_box( 'postimagediv','post_organizers','side' );
	remove_meta_box( 'postimagediv','post_events','side' );
             
    // adding the new meta box.
    add_meta_box('postimagediv', esc_html__('Featured Image', 'localization'), 'pm_ln_new_post_thumbnail_meta_box', 'post', 'side', 'low');
	add_meta_box('postimagediv', esc_html__('Featured Image', 'localization'), 'pm_ln_new_organizers_post_thumbnail_meta_box', 'post_organizers', 'side', 'low');	
	add_meta_box('postimagediv', esc_html__('Featured Image', 'localization'), 'pm_ln_new_events_post_thumbnail_meta_box', 'post_events', 'side', 'low');
	
}




/*** POST META OPTIONS & FUNCTIONS *****/
function add_post_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		esc_html__( 'Post Header Image' , 'localization' ),  //label
		'pm_header_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		esc_html__( 'Page Layout', 'localization' ),
		'pm_page_layout_meta_function' , //function
		'post', //Post type
		'side'
	);

	//Sidebar selector
	add_meta_box(
        'custom_sidebar',
        esc_html__( 'Custom Sidebar', 'localization' ),
        'pm_ln_custom_sidebar_callback',
        'post',
        'side'
    );
	
	add_meta_box( 
		'pm_post_icon_meta', //ID
		esc_html__( 'FontAwesome 4 Icon' , 'localization' ),  //label
		'pm_post_icon_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	add_meta_box( 
		'pm_post_tooltip_meta', //ID
		esc_html__( 'Tooltip Message' , 'localization' ),  //label
		'pm_post_tooltip_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	/*add_meta_box( 
		'pm_post_slide_transition_meta', //ID
		esc_html__( 'Slider Transition', 'localization' ),
		'pm_post_slide_transition_meta_function' , //function
		'post', //Post type
		'normal'
	);*/
	
	//Property slides
	add_meta_box( 
		'pm_properties_slides', //ID
		__('Slides', 'localization'),  //label
		'pm_post_slides_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_post_slides_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_slides = get_post_meta( $post->ID, 'pm_post_slides', true ); //ARRAY VALUE
	$pm_enable_slider_system = get_post_meta( $post->ID, 'pm_enable_slider_system', true );	
	$pm_post_slide_transition_meta = get_post_meta( $post->ID, 'pm_post_slide_transition_meta', true );
	//print_r($pm_post_slides);
	
	//echo '$pm_post_slide_transition_meta = ' . $pm_post_slide_transition_meta;
	
	?>
    
    	<p><?php _e('Enable Post Slider?', 'localization') ?></p>
        
        <select id="pm_enable_slider_system" name="pm_enable_slider_system" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_enable_slider_system, 'no' ); ?>><?php _e('No', 'localization') ?></option>
            <option value="yes" <?php selected( $pm_enable_slider_system, 'yes' ); ?>><?php _e('Yes', 'localization') ?></option>
        </select>
        
        
        <?php if($pm_enable_slider_system === 'yes') { ?>
        	<div class="pm-featured-properties-settings-container visible" id="pm_featured_properties_settings_container">
        <?php } else { ?>
        	<div class="pm-featured-properties-settings-container hidden" id="pm_featured_properties_settings_container">
        <?php } ?>
        
        	<p><?php esc_html_e('Select the transition type for the Post slider.', 'localization'); ?></p>
            <select id="pm_post_slide_transition_meta" name="pm_post_slide_transition_meta" class="pm-admin-select-list">  
                <option value="slide" <?php selected( $pm_post_slide_transition_meta, 'slide' ); ?>><?php esc_html_e('Slide', 'localization') ?></option>
                <option value="fade" <?php selected( $pm_post_slide_transition_meta, 'fade' ); ?>><?php esc_html_e('Fade', 'localization') ?></option>
            </select>  
                
            <p><?php _e('Add or remove slides. (Recommended size 1170x300px)', 'localization') ?></p>
                    
            <div id="pm-featured-properties-images-container">
            
                <?php 
                
                    $counter = 0;
                
                    if(is_array($pm_post_slides)){
                        
                        foreach($pm_post_slides as $val) {
                        
                            echo '<div class="pm-slider-system-field-container" id="pm_slider_system_field_container_'.$counter.'">';
							echo '<input type="text" value="'.esc_html($val).'" name="pm_slider_system_post[]" id="pm_slider_system_post_'.$counter.'" class="pm-slider-system-upload-field" />';
                            echo '<input type="button" value="'.__('Media Library Image', 'localization').'" class="button-secondary slider_system_upload_image_button" id="pm_slider_system_post_btn_'.$counter.'" />';
                            echo '&nbsp; <input type="button" value="'.__('Remove Slide', 'localization').'" class="button button-primary button-large delete slider_system_remove_image_button" id="pm_slider_system_post_remove_btn_'.$counter.'" />';
							echo '</div>';
                            
                            $counter++;
                            
                        }
                        
                    } else {
                    
                        //Default value upon post initialization
                        echo '<b><i>'.__('No slides found','localization').'</i></b>';
                        
                    }                    
                
                ?>            
            
            </div>
            
            <br />
            <input type="button" id="pm-slider-system-add-new-slide-btn" class="button button-primary button-large" value="<?php _e('New Slide','localization') ?>">
        
        </div><!-- /.pm-featured-properties-settings-container -->        
    
    <?php
	
}


function pm_post_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_post_icon_meta = get_post_meta( $post->ID, 'pm_post_icon_meta', true );		

	//HTML code
	?>    
    	<p><?php esc_html_e('Add a FontAwesome icon for the panel link. (ex. fa fa-globe)', 'localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_post_icon_meta); ?>" name="pm_post_icon_meta" class="pm-admin-text-field" />    
    <?php
	
}

function pm_post_tooltip_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_post_tooltip_meta = get_post_meta( $post->ID, 'pm_post_tooltip_meta', true );		

	//HTML code
	?>    
    	<p><?php esc_html_e('Add a tooltip message if desired.', 'localization'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_post_tooltip_meta); ?>" name="pm_post_tooltip_meta" class="pm-admin-text-field" />    
    <?php
	
}

/*function pm_post_slide_transition_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_slide_transition_meta = get_post_meta( $post->ID, 'pm_post_slide_transition_meta', true );
	
	?>
        <p><?php esc_html_e('Select the transition type for the Post slider.', 'localization'); ?></p>
        <select id="pm_post_slide_transition_meta" name="pm_post_slide_transition_meta" class="pm-admin-select-list">  
            <option value="slide" <?php selected( $pm_post_slide_transition_meta, 'slide' ); ?>><?php esc_html_e('Slide', 'localization') ?></option>
            <option value="fade" <?php selected( $pm_post_slide_transition_meta, 'fade' ); ?>><?php esc_html_e('Fade', 'localization') ?></option>
        </select>  
    
    <?php
	
}*/



function pm_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
		

	//HTML code
	?>
    	<p><?php esc_html_e('Recommended size: 1920x500px', 'localization') ?></p>
		<input type="text" value="<?php echo esc_html($pm_header_image_meta); ?>" name="post-header-image" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_html_e('Media Library Image', 'localization'); ?>" class="button-primary" />
        <div class="pm-admin-upload-field-preview"></div>
        
        <?php if($pm_header_image_meta) : ?>
        	<input id="remove_page_header_button" type="button" value="<?php esc_html_e('Remove Image', 'localization'); ?>" class="button-primary" />
        <?php endif; ?>        
        
        
    
    <?php
	
}

function pm_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_message_meta = get_post_meta( $post->ID, 'pm_header_message_meta', true );
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_header_message_meta); ?>" name="pm_header_message_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_layout_meta = get_post_meta( $post->ID, 'pm_post_layout_meta', true );
	
	?>
        <p><?php esc_html_e('Select your desired layout for this post.', 'localization'); ?></p>
        <select id="pm_post_layout_meta" name="pm_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_post_layout_meta, 'no-sidebar' ); ?>><?php esc_html_e('No Sidebar', 'localization') ?></option>
            <option value="left-sidebar" <?php selected( $pm_post_layout_meta, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar', 'localization') ?></option>
            <option value="right-sidebar" <?php selected( $pm_post_layout_meta, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar', 'localization') ?></option>
        </select>
        
        
    
    <?php
	
}


/*** PAGE META OPTIONS & FUNCTIONS *****/
function add_page_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		esc_html__( 'Page Header Image', 'localization' ),
		'pm_header_image_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		esc_html__( 'Page Layout', 'localization' ),
		'pm_page_layout_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Sidebar selector
	add_meta_box(
        'custom_sidebar',
        esc_html__( 'Custom Sidebar', 'localization' ),
        'pm_ln_custom_sidebar_callback',
        'page',
        'side'
    );
		
	//Disable Container
	add_meta_box( 
		'pm_page_disable_container_meta', //ID
		esc_html__( 'Disable Bootstrap container for full width content?', 'localization' ),
		'pm_page_disable_container_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Container Padding
	add_meta_box( 
		'pm_bootstrap_container_padding', //ID
		esc_html__( 'Bootstrap Container Padding Amount' , 'localization' ),  //label
		'pm_bootstrap_container_padding_function' , //function
		'page', //Post type
		'side'
		//'high' 
	);
	
	//Print and Share
	/*add_meta_box( 
		'pm_page_print_share_meta', //ID
		esc_html__( 'Enable Print and Share options?' , 'localization' ),  //label
		'pm_page_print_share_meta_function' , //function
		'page', //Post type
		'side'
		//'high' 
	);*/
	
	
	
	//Header Message
	add_meta_box( 
		'pm_header_message_meta', //ID
		esc_html__( 'Page Header Message' , 'localization' ),  //label
		'pm_header_message_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_page_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_layout_meta = get_post_meta( $post->ID, 'pm_page_layout_meta', true );
	
	?>
            
        <select id="pm_page_layout_meta" name="pm_page_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_page_layout_meta, 'no-sidebar' ); ?>><?php esc_html_e('No Sidebar', 'localization') ?></option>
            <option value="left-sidebar" <?php selected( $pm_page_layout_meta, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar', 'localization') ?></option>
            <option value="right-sidebar" <?php selected( $pm_page_layout_meta, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar', 'localization') ?></option>
        </select>
    
    <?php
	
}

function pm_page_disable_container_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_disable_container_meta = get_post_meta( $post->ID, 'pm_page_disable_container_meta', true );
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_page_disable_container_meta" class="pm-admin-select-list"> 
        	<option value="no" <?php selected( $pm_page_disable_container_meta, 'no' ); ?>><?php esc_html_e('No', 'localization') ?></option> 
            <option value="yes" <?php selected( $pm_page_disable_container_meta, 'yes' ); ?>><?php esc_html_e('Yes', 'localization') ?></option>
        </select>
    
    <?php
	
}

function pm_bootstrap_container_padding_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_bootstrap_container_padding_meta = get_post_meta( $post->ID, 'pm_bootstrap_container_padding_meta', true );
	
	?>
            
        <select id="pm_bootstrap_container_padding_meta" name="pm_bootstrap_container_padding_meta" class="pm-admin-select-list"> 
        	<option value="120" <?php selected( $pm_bootstrap_container_padding_meta, '120' ); ?>>120</option>
        	<option value="110" <?php selected( $pm_bootstrap_container_padding_meta, '110' ); ?>>110</option>
            <option value="100" <?php selected( $pm_bootstrap_container_padding_meta, '100' ); ?>>100</option>
            <option value="90" <?php selected( $pm_bootstrap_container_padding_meta, '90' ); ?>>90</option>
            <option value="80" <?php selected( $pm_bootstrap_container_padding_meta, '80' ); ?>>80</option>
            <option value="70" <?php selected( $pm_bootstrap_container_padding_meta, '70' ); ?>>70</option>
            <option value="60" <?php selected( $pm_bootstrap_container_padding_meta, '60' ); ?>>60</option>
            <option value="50" <?php selected( $pm_bootstrap_container_padding_meta, '50' ); ?>>50</option>
            <option value="40" <?php selected( $pm_bootstrap_container_padding_meta, '40' ); ?>>40</option>
            <option value="30" <?php selected( $pm_bootstrap_container_padding_meta, '30' ); ?>>30</option>
            <option value="20" <?php selected( $pm_bootstrap_container_padding_meta, '20' ); ?>>20</option>
        	<option value="10" <?php selected( $pm_bootstrap_container_padding_meta, '10' ); ?>>10</option> 
        	<option value="0" <?php selected( $pm_bootstrap_container_padding_meta, '0' ); ?>>0</option> 
        	
        </select>
    
    <?php
	
}


function pm_page_print_share_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_print_share_meta = get_post_meta( $post->ID, 'pm_page_print_share_meta', true );
	
	?>
            
        <select id="pm_page_print_share_meta" name="pm_page_print_share_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_page_print_share_meta, 'on' ); ?>><?php esc_html_e('ON', 'localization') ?></option> 
            <option value="off" <?php selected( $pm_page_print_share_meta, 'off' ); ?>><?php esc_html_e('OFF', 'localization') ?></option>
        </select>
    
    <?php
	
}

function pm_display_header_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_display_header_meta = get_post_meta( $post->ID, 'pm_display_header_meta', true );
	
	?>
            
        <select id="pm_display_header_meta" name="pm_display_header_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_display_header_meta, 'on' ); ?>><?php esc_html_e('ON', 'localization') ?></option> 
            <option value="off" <?php selected( $pm_display_header_meta, 'off' ); ?>><?php esc_html_e('OFF', 'localization') ?></option>
        </select>
    
    <?php
	
}



function pm_disable_share_feature_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_disable_share_feature = get_post_meta( $post->ID, 'pm_disable_share_feature', true );
	
	?>
        <select id="pm_disable_share_feature" name="pm_disable_share_feature" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_disable_share_feature, 'no' ); ?>><?php esc_html_e('No', 'localization') ?></option>
            <option value="yes" <?php selected( $pm_disable_share_feature, 'yes' ); ?>><?php esc_html_e('Yes', 'localization') ?></option>
        </select>
            
    <?php
	
}





/* When the post is saved, saves our custom data */
function save_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['post_meta_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['post_meta_nonce'], 'theme_metabox' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
			
		//Check for post values
		if(isset($_POST['post-header-image'])){
			$postHeaderImage = $_POST['post-header-image'];
			update_post_meta($post_id, "pm_header_image_meta", $postHeaderImage);
		}		
		if(isset($_POST['pm_header_message_meta'])){
			$pmHeaderMessageMeta = $_POST['pm_header_message_meta'];
			update_post_meta($post_id, "pm_header_message_meta", $pmHeaderMessageMeta);
		}
	 
	 	if(isset($_POST['pm_post_layout_meta'])){
			$pmPostLayoutMeta = $_POST['pm_post_layout_meta'];
			update_post_meta($post_id, "pm_post_layout_meta", $pmPostLayoutMeta);
		}
		
		if(isset($_POST['pm_post_icon_meta'])){
			update_post_meta($post_id, "pm_post_icon_meta", $_POST['pm_post_icon_meta']);
		}
		
		if(isset($_POST['pm_post_tooltip_meta'])){
			update_post_meta($post_id, "pm_post_tooltip_meta", $_POST['pm_post_tooltip_meta']);
		}
		
		if(isset($_POST['pm_post_slide_transition_meta'])){
			update_post_meta($post_id, "pm_post_slide_transition_meta", $_POST['pm_post_slide_transition_meta']);
		}
		
		if(isset($_POST["pm_enable_slider_system"])){
			update_post_meta($post_id, "pm_enable_slider_system", $_POST["pm_enable_slider_system"]);
		}
		
		if(isset($_POST["pm_slider_system_post"])){
				
			$images = array();				
			$counter = 0;
							
			foreach($_POST["pm_slider_system_post"] as $key => $text_field){
				
				if(!empty($text_field)){
					$images[$counter] = $text_field;
				}					
				$counter++;					
			}
						
			//$pm_slider_system_post = $_POST['pm_slider_system_post'];
			update_post_meta($post_id, "pm_post_slides", $images);
			
		} else {
		
			$images = '';			
			update_post_meta($post_id, "pm_post_slides", $images);
			
		}		
		
				
		//Check for page values
		if(isset($_POST['pm_header_image_meta'])){
			$pmPageHeaderImageMeta = $_POST['pm_header_image_meta'];
			update_post_meta($post_id, "pm_header_image_meta", $pmPageHeaderImageMeta);
		}
		
		if(isset($_POST['pm_page_layout_meta'])){
			$pmPageLayoutMeta = $_POST['pm_page_layout_meta'];
			update_post_meta($post_id, "pm_page_layout_meta", $pmPageLayoutMeta);
		}
		
		if(isset($_POST['pm_page_disable_container_meta'])){
			$pmPageDisableContainerMeta = $_POST['pm_page_disable_container_meta'];
			update_post_meta($post_id, "pm_page_disable_container_meta", $pmPageDisableContainerMeta);
		}
		
		if(isset($_POST['pm_bootstrap_container_padding_meta'])){
			update_post_meta($post_id, "pm_bootstrap_container_padding_meta", $_POST['pm_bootstrap_container_padding_meta']);
		}
		
		if(isset($_POST['pm_page_print_share_meta'])){
			$pmPagePrintShareMeta = $_POST['pm_page_print_share_meta'];
			update_post_meta($post_id, "pm_page_print_share_meta", $pmPagePrintShareMeta);
		}
		
		if(isset($_POST['pm_display_header_meta'])){
			$pmDisplayHeaderMeta = $_POST['pm_display_header_meta'];
			update_post_meta($post_id, "pm_display_header_meta", $pmDisplayHeaderMeta);
		}	
		
		if(isset($_POST['custom_sidebar'])){
			update_post_meta($post_id, "custom_sidebar", $_POST['custom_sidebar']);
		}		
			 
		
		//Gallery values
		
		if(isset($_POST['pm_gallery_image_meta'])){
			update_post_meta($post_id, "pm_gallery_image_meta", $_POST['pm_gallery_image_meta']);
		}
		
		if(isset($_POST['pm_gallery_item_caption_meta'])){
			update_post_meta($post_id, "pm_gallery_item_caption_meta", $_POST['pm_gallery_item_caption_meta']);
		}
		
		if(isset($_POST['pm_gallery_video_meta'])){
			update_post_meta($post_id, "pm_gallery_video_meta", $_POST['pm_gallery_video_meta']);
		}
		
		if(isset($_POST['pm_gallery_display_video_meta'])){
			update_post_meta($post_id, "pm_gallery_display_video_meta", $_POST['pm_gallery_display_video_meta']);
		}
		
		//Organizer values
		if(isset($_POST['pm_organizer_title_meta'])){
			update_post_meta($post_id, "pm_organizer_title_meta", $_POST['pm_organizer_title_meta']);
		}
		
		if(isset($_POST['pm_organizer_tooltip_meta'])){
			update_post_meta($post_id, "pm_organizer_tooltip_meta", $_POST['pm_organizer_tooltip_meta']);
		}
		
		if(isset($_POST['pm_organizer_contact_number_meta'])){
			update_post_meta($post_id, "pm_organizer_contact_number_meta", $_POST['pm_organizer_contact_number_meta']);
		}
		
		if(isset($_POST['pm_organizer_email_meta'])){
			update_post_meta($post_id, "pm_organizer_email_meta", $_POST['pm_organizer_email_meta']);
		}
		
		if(isset($_POST['pm_organizer_webiste_meta'])){
			update_post_meta($post_id, "pm_organizer_webiste_meta", $_POST['pm_organizer_webiste_meta']);
		}
		
		if(isset($_POST['pm_organizer_linkedin_meta'])){
			update_post_meta($post_id, "pm_organizer_linkedin_meta", $_POST['pm_organizer_linkedin_meta']);
		}
		
		if(isset($_POST['pm_organizer_twitter_meta'])){
			update_post_meta($post_id, "pm_organizer_twitter_meta", $_POST['pm_organizer_twitter_meta']);
		}
		
		if(isset($_POST['pm_organizer_facebook_meta'])){
			update_post_meta($post_id, "pm_organizer_facebook_meta", $_POST['pm_organizer_facebook_meta']);
		}
		
		if(isset($_POST['pm_organizer_google_meta'])){
			update_post_meta($post_id, "pm_organizer_google_meta", $_POST['pm_organizer_google_meta']);
		}
		
		if(isset($_POST['pm_organizer_skype_meta'])){
			update_post_meta($post_id, "pm_organizer_skype_meta", $_POST['pm_organizer_skype_meta']);
		}
				
				
		//Event values
		if(isset($_POST['pm_event_date_meta'])){
			update_post_meta($post_id, "pm_event_date_meta", $_POST['pm_event_date_meta']);
		}
		
		if(isset($_POST['pm_event_tooltip_meta'])){
			update_post_meta($post_id, "pm_event_tooltip_meta", $_POST['pm_event_tooltip_meta']);
		}
		
		if(isset($_POST['pm_event_icon_meta'])){
			update_post_meta($post_id, "pm_event_icon_meta", $_POST['pm_event_icon_meta']);
		}
		
		if(isset($_POST['pm_event_countdown_meta'])){
			update_post_meta($post_id, "pm_event_countdown_meta", $_POST['pm_event_countdown_meta']);
		}
		
		if(isset($_POST['pm_event_panel_info_meta'])){
			update_post_meta($post_id, "pm_event_panel_info_meta", $_POST['pm_event_panel_info_meta']);
		}
		
			
	} else {
		return;
	}	
    
}

/* When the post is saved, saves our custom data */
function pm_ln_save_sidebar_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['custom_sidebar_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], 'custom_sidebar' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	 
		$data = $_POST['custom_sidebar'];
	 
		update_post_meta($post_id, "custom_sidebar", $data);
	
	} else {
		return;
	}	
	
    
}


?>