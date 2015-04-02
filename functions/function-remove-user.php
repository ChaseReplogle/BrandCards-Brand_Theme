<?php
/*
 * Handles Removing Users from a Brand
 *
 *
 */


// Check to make sure the link for removing users has been submitted
if(isset($_GET['action']) && $_GET['action']=='remove_user') {
    add_action('init','remove_user');
}

function remove_user(){

	// Get User ID
    $user_id = $_GET['user_id'];

    // Get Current Brand ID
    $blog_id = $_GET['blog_id'];

    // Remove the User
    remove_user_from_blog($user_id, $blog_id);

    // Redirect back to the Brand Dashboard
    wp_redirect( home_url() ); exit;
}
