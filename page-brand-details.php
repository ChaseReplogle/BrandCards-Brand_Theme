<?php
/*  Template Name: Brand: Details  */

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
				<h1>Success! Your <?php echo $blog_details->blogname; ?> brand has been created.</h1>
				<p class="secondary">Let's add some additional information about this brand.</p>
			</div>

			<div class="row gutters large-gutters">
				<div class="col span_14 details-form">
					<?php gravity_form( 1, false, false, false, '', false ); ?>
				</div>

				<div class="col span_10 details-card">
					<h4><?php echo $blog_details->blogname; ?></h4>
					<div class="card">
						<?php brand_cover(); ?>
					</div>
					<div class="brand-cover-author">
						<?php $blog_admin = get_bloginfo('admin_email');
						switch_to_blog(1); echo get_avatar( $blog_admin, 60 ); restore_current_blog(); ?>
						<?php $user = get_user_by( 'email', $blog_admin ); ?>
						<p><?php echo  $user->first_name . ' ' . $user->last_name; ?></p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col span_24">
					<span id="pmpro_processing_message" style="visibility: hidden;">
						<p><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/ajax-loader.gif" id="loading-animation" /> Saving Details...</p>
					</span>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
