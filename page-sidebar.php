<?php
/*  Template Name: Brand: Default Sidebar  */

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


			<div class="row dashboard-main">

				<div class="col span_18 card-column">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>

				</div>

				<div class="col span_6 user-column large-gutter">
					<?php user_sidebar(); ?>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
