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





/* Brand Cover
*
*  This function gets the details of the brand and creates a cover.
*  Used:
*  1. On the Brand Details Edit page
*  2. On the Brand headers accross the brand site
*/
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
						<div class="brand-cover brand-cover-logo" style="background: <?php echo get_post_meta($detail->ID, 'cover_color', true); ?>;">
							<div class="card-inner">
								<img id="image" src="<?php echo $cover_logo ?>" class="card-image" />
							</div>
						</div>

					<?php // If there is no logo, there should be a cover image to use,
					} elseif ($cover_image ) { ?>
						<div class="brand-cover">
							<img src="<?php echo $cover_image ?>" class="card-image" />
						</div>
					<?php } else { ?>
						<div class="brand-cover brand-cover-logo" style="background-color: #fff; background: <?php echo get_post_meta($detail->ID, 'cover_color', true); ?>; border: 1px solid #dedede;">
							<div class="card-inner">

							</div>
						</div>
					<?php } ?>

				</a>

			<?php endforeach; ?>

		<?php // If there is no details saved yet, use a filler image
		} else { ?>
			<div class="brand-cover brand-cover-logo" style="background-color: #fff; border: 1px solid #dedede;">
				<div class="card-inner">
					<img id="image" src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/white.png"  class="card-image" />
				</div>
			</div>
		<?php } ?>

	</div>

<?php }





/**
 * Brand Header
 * This function is set in the header.php file. It handels the brand cover image and links on every page header.
 *
 *
 */
function brand_header() {


	// The main brand dashboard displays a bigger image with a set of edit links.
	if ( is_front_page() ) { ?>

		<div class="brand-header">
			<div class="row brand-dash-header gutters container">
				<div class="col span_3">

					<?php // The Brand Cover is created in the "class-details.php" file.
					brand_cover(); ?>

				</div>

					<?php $args = array( 'posts_per_page' => 1, 'post_type' => 'brand_details' );
					$details = get_posts( $args ); ?>

				<div class="col span_15 brand-dash-header_text <?php if ( is_front_page() ) { echo 'brand-dash-header_text-main'; } if($details) { echo ' creator-included'; } ?>">
					<?php // Get Blog Details and display the brands name
					$blog_details = get_blog_details(); ?>

					<h1><?php echo $blog_details->blogname; ?> </h1>

					<?php foreach ( $details as $detail ) :
						$creator = get_post_meta($detail->ID, 'brand_creator', true);
						$creator_url = get_post_meta($detail->ID, 'creator_website', true);

						if($creator) { ?>
							<p class="secondary">Created by: <a href="http://<?php echo $creator_url ?>" class="secondary"><?php echo $creator ?></a></p>
						<?php  }

					endforeach; ?>

					<p class="secondary">
						<?php // Editors and Administrators can edit the details of a brand
						if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-details/" class="secondary"><?php } ?>

							<?php
								foreach ( $details as $detail ) :
									$visibility = get_post_meta($detail->ID, 'brand_privacy', true);
									if ($visibility == 'Protected') { switch_to_blog(1); ?> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/public.png"> Public <?php restore_current_blog(); }
									if ($visibility == 'Private') { switch_to_blog(1); ?> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/private.png"> Private <?php restore_current_blog(); }
								endforeach;
							?>

						<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?></a><?php } ?>
					</p>

				</div>

				<?php // Based on a users role edit links for the brand are displayed ?>

				<div class="col span_6">
					<p class="secondary edit-links">

						<?php // Editors and Administrators can edit the details of a brand
						if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-details/" class="secondary">Edit</a><?php } ?>

						<?php // Only the brand owner can archive the brand
						if( current_user_can('administrator') ) {  ?><a href="/archive" class="secondary">Archive</a><?php } ?>

						<?php // Only the brand owner can delete the brand
						if( current_user_can('administrator') ) {  ?><a href="/delete" class="secondary">Delete</a><?php } ?>

					</p>
				</div>
			</div>
		</div>


	<?php
	// If it is an inner brand page, a smaller cover is displayed and only a back button.
	} else { ?>

		<div class="brand-header">
			<div class="row brand-dash-header gutters container">
				<div class="col span_2">

					<a href="/">
						<?php // The Brand Cover is created in the "class-details.php" file.
						brand_cover(); ?>
					</a>

				</div>
				<div class="col span_22 brand-dash-header_text">

					<?php // Get Blog Details and display the brands name
					$blog_details = get_blog_details(); ?>
					<a href="/">
						<h1><?php echo $blog_details->blogname; ?> </h1>
					</a>

					<?php // Back button that takes you to the dashboard ?>
					<p class="secondary">
						<a href="/" class="secondary">Back</a>
					</p>
				</div>
			</div>
		</div>

	<?php }

}


