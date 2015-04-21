<?php
// Register Custom Post Type
function activity() {

	$labels = array(
		'name'                => _x( 'Activity', 'Post Type General Name', 'activity' ),
		'singular_name'       => _x( 'Activity', 'Post Type Singular Name', 'activity' ),
		'menu_name'           => __( 'Activity', 'activity' ),
		'parent_item_colon'   => __( 'Parent Item:', 'activity' ),
		'all_items'           => __( 'All Activity', 'activity' ),
		'view_item'           => __( 'View Activity', 'activity' ),
		'add_new_item'        => __( 'Add New Invite', 'activity' ),
		'add_new'             => __( 'Add New', 'activity' ),
		'edit_item'           => __( 'Edit Activity', 'activity' ),
		'update_item'         => __( 'Update Activity', 'activity' ),
		'search_items'        => __( 'Search Activity', 'activity' ),
		'not_found'           => __( 'Not found', 'activity' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'activity' ),
	);
	$args = array(
		'label'               => __( 'activity', 'activity' ),
		'description'         => __( 'Provides the details related to this brand.', 'activity' ),
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
	register_post_type( 'activity', $args );

}

// Hook into the 'init' action
add_action( 'init', 'activity', 0 );

