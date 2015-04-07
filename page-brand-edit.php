<?php
/*  Template Name: Brand: Edit Details  */

/**
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package brand
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<?php $blog_details = get_blog_details(); ?>
				<h1>Your Editing <?php echo $blog_details->blogname; ?> Details</h1>
			</div>

			<div class="row gutters large-gutters">
				<div class="col span_14 details-form">
					<?php $args = array(
						'post_type' => 'brand_details',
						"posts_per_page" => 1
					);

					$details = get_posts( $args );

					foreach ( $details as $detail ) : ?>
						<?php $detail_ID = $detail->ID; ?>
						<?php echo do_shortcode("[gravityform id='1' title='false' update=".$detail_ID."]"); ?>
					<?php endforeach; ?>

					<?php if(! $detail_ID) { gravity_form( 1, false, false, false, '', false ); } ?>
				</div>

				<div class="col span_10 details-card">
					<h4><?php echo $blog_details->blogname; ?></h4>
					<div class="card">

						<?php brand_cover(); ?>

						<?php if(! $detail_ID) { ?>
							<div class="brand-cover brand-cover-logo" style="background-color: #dedede;">
								<div class="card-inner">
									<img id="image" src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/gray.svg" />
								</div>
							</div>
						<?php } ?>

					</div>
					<div class="brand-cover-author">
						<?php $blog_admin = get_bloginfo('admin_email');
						switch_to_blog(1); echo get_avatar( $blog_admin, 50 ); restore_current_blog(); ?>
						<?php $user = get_user_by( 'email', $blog_admin ); ?>
						<p><?php echo  $user->first_name . ' ' . $user->last_name; ?></p>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
