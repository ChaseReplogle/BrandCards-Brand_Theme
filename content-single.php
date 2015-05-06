<?php
/**
 * @package brand
 */
?>

<article id="<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row gutters">
		<div class="col span_4 card-sidebar">
			<ul class="cards-grid" >
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
									$postid = get_the_ID(); ?>
 									<a href="/?p=<?php echo $postid; ?>" >

										<?php card('sidebar'); ?>

									</a>
							<?php }
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
		</div>

		<div class="card-single-wrapper col span_20  ">
			<?php card('single'); ?>

			<div class="col span_24 content-column">
			<?php $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
				  $next     = get_adjacent_post( false, '', false ); ?>

			<nav id="arrow-nav" class="clear" role="navigation">
				<div class="nav-previous"><?php if( $previous ) { previous_post_link( '%link', '<span class="meta-nav">&#8592; Left Arrow</span>' ); } ?></div>
				<div class="nav-label"><?php if( $next && $previous ) { ?><span>Keyboard Shortcuts</span><?php } ?></div>
				<div class="nav-next"><?php if( $next ) { next_post_link( '%link', '<span class="meta-nav">Right Arrow &#8594;</span>' ); } ?></div>
			</nav>


			<div class="entry-content">
				<header class="entry-header clear">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
					<div class="single-card-links">
						<ul>
							<?php $post_id = get_the_ID(); ?>
							<li><a href="#card-delete" rel="leanModal">Delete</a></li>
							<li><a href="/edit-card/?id=<?php echo $post_id;?>">Edit</a></li>
						</ul>
					</div>
					<?php } ?>
				</header><!-- .entry-header -->

				<div class="row gutters">
					<div class="col span_15 card-content">
						<?php $content = get_the_content(); ?>

						<div class="card-meta <?php if( empty($content) ) { echo 'full-width'; }?>">
							<div class="meta-item">
								<span class="label">Created:</span>
								<?php the_date(); ?>
							</div>
							<div class="meta-item">
								<span class="label">Creator:</span>
								<?php the_author(); ?>
							</div>
							<div class="meta-item">
								<span class="label">Category:</span>
								<?php $category = get_the_category(); $firstCategory = $category[0]->cat_name; echo $firstCategory;?>
							</div>
						</div>
						<?php the_content(); ?>
					</div>

					<div class="col span_9">
						<?php related_files(); ?>
					</div>
				</div>
			</div><!-- .entry-content -->


			<?php get_template_part( 'content', 'activity' ); ?>


		</div>


		</div>

	</div>


</article><!-- #post-## -->



<?php delete_modal(); ?>