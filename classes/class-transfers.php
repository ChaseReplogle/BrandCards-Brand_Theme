<?php
// Register Custom Post Type
function transfers() {

	$labels = array(
		'name'                => _x( 'Transfers', 'Post Type General Name', 'transfers' ),
		'singular_name'       => _x( 'Transfer', 'Post Type Singular Name', 'Transfer' ),
		'menu_name'           => __( 'Transfers', 'transfers' ),
		'parent_item_colon'   => __( 'Parent Item:', 'transfers' ),
		'all_items'           => __( 'All Transfers', 'transfers' ),
		'view_item'           => __( 'View Transfers', 'transfers' ),
		'add_new_item'        => __( 'Add New Transfer', 'transfers' ),
		'add_new'             => __( 'Add New', 'transfers' ),
		'edit_item'           => __( 'Edit Transfers', 'transfers' ),
		'update_item'         => __( 'Update Transfers', 'transfers' ),
		'search_items'        => __( 'Search Transfers', 'transfers' ),
		'not_found'           => __( 'Not found', 'transfers' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'transfers' ),
	);
	$args = array(
		'label'               => __( 'transfers', 'transfers' ),
		'description'         => __( 'Provides the details related to this brand.', 'transfers' ),
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
	register_post_type( 'transfers', $args );

}

// Hook into the 'init' action
add_action( 'init', 'transfers', 0 );




