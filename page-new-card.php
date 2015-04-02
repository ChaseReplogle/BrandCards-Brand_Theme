<?php
/*  Template Name: Brand: New Card Type  */

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

						<h1>Choose A Card Type</h1>

						<ul class="new-card-icons">
							<li><a href="/new-card/logo-card/">Logo<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/logo_card.svg" width="100px" class="icon" /></span></a></li>
							<li><a href="/new-card/image-card/">Image<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/image_card.svg" width="100px" class="icon" /></span></a></li>
							<li><a href="/new-card/color-card/">Color<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/color_card.svg" width="100px" class="icon" /></span></a></li>
							<li><a href="/new-card/palette-card/">Palette<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/palette_card.svg" width="100px" class="icon" /></span></a></li>
							<li><a href="/new-card/typography-card/ ">Typography<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/typography_card.svg" width="100px" class="icon" /></span></a></li>
							<li><a href="/new-card/video-card/">Video<span><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/video_card.svg" width="100px" class="icon" /></span></a></li>
						</ul>

					<?php endwhile; // end of the loop. ?>

				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
