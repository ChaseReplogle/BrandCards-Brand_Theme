<?php
/*  Template Name: Brand: Card Edit  */

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

				<div class="col span_24 card-column">

					<?php while ( have_posts() ) : the_post(); ?>

						<header class="entry-header row">
							<div class="col span_12">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</div>
							<div class="col span_12">
								<a href="#card-delete" rel="leanModal" class="button card-delete">Delete This Card</a>
							</div>
						</header><!-- .entry-header -->

						<?php $card_id = $_GET[id]; ?>

						<?php get_post($card_id); ?>

						<?php if($card_id) {

							$categories = get_the_category($card_id);
							foreach($categories as $category) {

								if ($category->slug == 'logo') {
									echo do_shortcode("[gravityform id='7' ajax='true' title='false' update=".$card_id."]");

								} elseif ($category->slug == 'image') {
									echo do_shortcode("[gravityform id='8' title='false' update=".$card_id."]");

								} elseif ($category->slug == 'color') {
									echo do_shortcode("[gravityform id='9' title='false' update=".$card_id."]");

								} elseif ($category->slug == 'palette') {
									echo do_shortcode("[gravityform id='10' title='false' update=".$card_id."]");

								} elseif ($category->slug == 'typography') {
									echo do_shortcode("[gravityform id='11' title='false' update=".$card_id."]");

								} elseif ($category->slug == 'video') {
									echo do_shortcode("[gravityform id='12' title='false' update=".$card_id."]");
								}
							}


						} ?>

					<?php endwhile; // end of the loop. ?>

				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->




<?php delete_modal(); ?>

<?php get_footer(); ?>
