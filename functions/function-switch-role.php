<?php
/*
 * Handles switching user roles between editor and subscriber
 *
 *
 */


// Check to make sure the link for switching user roles has been submitted
if(isset($_GET['action']) && $_GET['action']=='switch_role') {
    add_action('init','switch_role');
}

function switch_role(){

	// Get User Id
    $user_id = $_GET['user_id'];

    // Get Brand Id
    $blog_id = $_GET['blog_id'];

    // Get current Role of User
    $role = $_GET['role'];

    // Switch the User's Role
    if ($role == "editor") {
    	$role = "subscriber";
    } elseif ($role == "subscriber") {
    	$role = "editor";
    }

    // Add the user to the blog with the new role
    add_user_to_blog($blog_id, $user_id, $role);
}
