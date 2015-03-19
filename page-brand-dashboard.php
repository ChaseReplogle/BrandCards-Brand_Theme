<?php
/*  Template Name: Brand: Dashboard  */

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
					<div class="bar-nav">
						<div class="row">
							<ul class="menu">
								<li class="menu-item current-menu-item"><a href="#">All</a></li>
								<li class="menu-item"><a href="#">Logos</a></li>
								<li class="menu-item"><a href="#">Images</a></li>
								<li class="menu-item"><a href="#">Colors</a></li>
								<li class="menu-item"><a href="#">Typography</a></li>
								<li class="menu-item"><a href="#">Video</a></li>
								<li class="menu-item right"><a href="#">Re-Order</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col span_6 user-column large-gutter">
					<?php user_sidebar(); ?>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
