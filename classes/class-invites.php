<?php
// Register Custom Post Type
function invites() {

	$labels = array(
		'name'                => _x( 'Invites', 'Post Type General Name', 'invites' ),
		'singular_name'       => _x( 'Invite', 'Post Type Singular Name', 'invites' ),
		'menu_name'           => __( 'Invites', 'invites' ),
		'parent_item_colon'   => __( 'Parent Item:', 'invites' ),
		'all_items'           => __( 'All Invites', 'invites' ),
		'view_item'           => __( 'View Invites', 'invites' ),
		'add_new_item'        => __( 'Add New Invite', 'invites' ),
		'add_new'             => __( 'Add New', 'invites' ),
		'edit_item'           => __( 'Edit Invites', 'invites' ),
		'update_item'         => __( 'Update Invites', 'invites' ),
		'search_items'        => __( 'Search Invites', 'invites' ),
		'not_found'           => __( 'Not found', 'invites' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'invites' ),
	);
	$args = array(
		'label'               => __( 'invites', 'invites' ),
		'description'         => __( 'Provides the details related to this brand.', 'invites' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'invites', $args );

}

// Hook into the 'init' action
add_action( 'init', 'invites', 0 );



// Prepopulates the Gravity Form Invite Form with the Brand Name
add_filter('gform_field_value_invite_brand', 'invite_form_population_name');
function invite_form_population_name($value){
	$blog_id = get_current_blog_id();
    return get_blog_details( $blog_id )->blogname;
}

// Prepopulates the Gravity Form Invite Form with the brand ID
add_filter('gform_field_value_invite_brand_id', 'invite_form_population_id');
function invite_form_population_id($value){
    return get_current_blog_id();
}