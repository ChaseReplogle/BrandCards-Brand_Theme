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
								<li class="menu-item toggle current-menu-item all"><a href="#">All</a></li>
								<li class="menu-item toggle"><a href="#">Logos</a></li>
								<li class="menu-item toggle"><a href="#">Images</a></li>
								<li class="menu-item toggle"><a href="#">Colors</a></li>
								<li class="menu-item toggle"><a href="#">Palettes</a></li>
								<li class="menu-item toggle"><a href="#">Typography</a></li>
								<li class="menu-item toggle"><a href="#">Video</a></li>
								<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><li class="menu-item right new-card-link"><a href="/new-card/">+ Add New Card</a></li><?php } ?>
							</ul>
						</div>
					</div>


					<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/ajax-loader.gif" id="loading-animation" />
					<ul class="cards-grid" <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>id="sortable"<?php } ?>>
						<?php // WP_Query arguments
						$args = array (
							'post_type'             => 'cards',
						    'orderby' 				=> 'menu_order',
						    'order' 				=> 'ASC'
						);


						$cards = new WP_Query( $args );

						if ( $cards->have_posts() ) {
							while ( $cards->have_posts() ) {
								$cards->the_post();

									card();
							 }
						} else {
						}
						wp_reset_postdata(); ?>
					</ul>


					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
					<div class="new-card">
						<div class="card-link-wrapper">
							<div class="card-link">
								<a href="/new-card">Add New Card</a>
							</div>
						</div>
					</div>
					<?php } ?>

					<div class="clear"></div>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><p class="secondary drag-text">TIP: Click and drag cards to re-order.</p><?php } ?>
				</div>

				<div class="col span_6 user-column large-gutter">
					<?php user_sidebar(); ?>
				</div>

			</div>



		</main><!-- #main -->
	</div><!-- #primary -->



<?php get_footer(); ?>
