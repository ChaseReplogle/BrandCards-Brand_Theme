<?php
/**
 * @package brand
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row gutters">
		<div class="col span_2 card-left "></div>
		<div class="card-single-wrapper col span_20  ">
			<?php card(); ?>
		</div>
		<div class="col span_2 card-right "></div>
	</div>

	<div class="row">
		<div class="col span_2 filler">.</div>

		<div class="col span_20 content-column">
			<nav id="arrow-nav" class="clear" role="navigation">
				<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&#8592; Left Arrow</span>' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '<span class="meta-nav">Right Arrow &#8594;</span>' ); ?></div>
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
						<div class="card-meta">
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
		</div>

		<div class="col span_2 filler">.</div>
	</div>

</article><!-- #post-## -->


<?php delete_modal(); ?>