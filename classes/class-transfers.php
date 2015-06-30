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






/**
 * Tansfer Notification bar
 * Any time there is a pending transfer of a brand, this header is added with a link to revoke the transfer.
 *
 *
 */
function transfer_notification_bar() {

if( current_user_can('editor') || current_user_can('administrator') ) {
	// Query the transfer posty type and display only 1 post.
	$args = array (
		'post_type'             => 'transfers',
	    'posts_per_page'		=> 1,
	   );

	// The loop
	$transfer = new WP_Query( $args );

	if ( $transfer->have_posts() ) {
		while ( $transfer->have_posts() ) {
			$transfer->the_post();

			// Get the transfer post ID
			$post_id = get_the_ID(); ?>

			<div class="notification-bar">
				<div class="container">
					<div class="row">

						<?php // Display the email of the person who the brand is transfering too. ?>
						<div class="col span_20">
							<p class="secondary">There is a pending transfer of this brand to: <?php echo get_post_meta($post_id, 'transfer_email', true); ?></p>
						</div>

						<?php // Create link that delets the transfer post. This post is check and confirmed to exist before transfer is executed. ?>
						<div class="col span_4">
							<a href="<?php echo get_delete_post_link( $post_id ); ?>">Revoke Transfer</a>
						</div>

					</div>
				</div>
			</div>
		 <?php }
	} else {

	}

	wp_reset_postdata();
}
}