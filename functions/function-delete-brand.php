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
add_action( 'gform_after_submission_6', 'after_archive_submission', 10, 2 );

    function after_archive_submission($entry, $form){

    	// Get the Brand ID from the gravity form
    	$brand_ID = rgar( $entry, 2);

    	//Perform the Archive Function
    	wpmu_delete_blog( $brand_ID, $drop );

    	//Get main site URL
    	$main_site = get_site_url(1);

    	// Redirect to main site dashboard after archive function
    	wp_redirect( $main_site . "/dashboard"); exit;
}