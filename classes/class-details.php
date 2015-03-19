<?php
// Register Custom Post Type
function brand_details() {

	$labels = array(
		'name'                => _x( 'Brand Details', 'Post Type General Name', 'brand_details' ),
		'singular_name'       => _x( 'Brand Details', 'Post Type Singular Name', 'brand_details' ),
		'menu_name'           => __( 'Brand Details', 'brand_details' ),
		'parent_item_colon'   => __( 'Parent Item:', 'brand_details' ),
		'all_items'           => __( 'All Details', 'brand_details' ),
		'view_item'           => __( 'View Details', 'brand_details' ),
		'add_new_item'        => __( 'Add New Details', 'brand_details' ),
		'add_new'             => __( 'Add New', 'brand_details' ),
		'edit_item'           => __( 'Edit Detials', 'brand_details' ),
		'update_item'         => __( 'Update Details', 'brand_details' ),
		'search_items'        => __( 'Search Details', 'brand_details' ),
		'not_found'           => __( 'Not found', 'brand_details' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'brand_details' ),
	);
	$args = array(
		'label'               => __( 'brand_details', 'brand_details' ),
		'description'         => __( 'Provides the details related to this brand.', 'brand_details' ),
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
	register_post_type( 'brand_details', $args );

}

// Hook into the 'init' action
add_action( 'init', 'brand_details', 0 );





// Brand Cover
function brand_cover() {  ?>

<div class="card">

		<?php // get_posts gets the details post for this brand
		$args = array(
			'post_type' 		=> 	'brand_details',
			"posts_per_page" 	=> 	1
		);

		$details = get_posts( $args );

		// If there are details
		if ($details) {

			// Loop through and create the brand cover
			foreach ( $details as $detail ) :
			$detail_ID = $detail->ID; ?>
				<a href="/">

					<?php //  Get the Cover Image and Cover Logo (should be one or the other)
					$cover_image = get_post_meta($detail->ID, 'cover_image', true);
					$cover_logo = get_post_meta($detail->ID, 'cover_logo', true); ?>

					<?php // If there is a Logo use it to make the cover
					if ($cover_logo) { ?>

						<div class="brand-cover brand-cover-logo" style="background: #<?php echo get_post_meta($detail->ID, 'cover_color', true); ?>;">
							<div class="card-inner">
								<img id="image" src="<?php echo $cover_logo ?>" class="card-image" />
							</div>
						</div>

					<?php // If there is no logo, there should be a cover image to use,
					} elseif ($cover_image ) { ?>

						<div class="brand-cover">
							<img src="<?php echo $cover_image ?>" class="card-image" />
						</div>

					<?php } else {
						//
						// Need to put a default if empty image
						//
					} ?>
				</a>
			<?php endforeach; ?>

		<?php } ?>
	</div>

<?php }