<?php
/*
 * Handles the Archiving of Brands
 *
 *
 */


// Prepopulates the Gravity Form Archive Form with the blog_ID
add_filter('gform_field_value_brand_id', 'archive_brand_id');
function archive_brand_id($value){
    return get_current_blog_id();
}


// On Submission of Gravity Form
add_action( 'gform_after_submission_5', 'after_archive_submission', 10, 2 );

    function after_archive_submission($entry, $form){

    	// Get the Brand ID from the gravity form
    	$brand_ID = rgar( $entry, 2);

    	// Set archive variable to True
    	$archived = 1;

    	//Perform the Archive Function
    	update_archived( $brand_ID, $archived );

    	//Get main site URL
    	$main_site = get_site_url(1);

    	// Redirect to main site dashboard after archive function
    	wp_redirect( $main_site . "/dashboard"); exit;
}