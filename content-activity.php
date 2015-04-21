<?php
/**
 * @package brand
 */
?>


	<div class="row gutters">
		<div class="col span_24 activity">

			<h4>Card Activity</h4>

			<hr>

				<?php $current_id = get_the_ID(); ?>

				<?php // WP_Query arguments
					$args = array (
						'post_type'             => 'activity',
					    'orderby' 				=> 'menu_order',
					    'order' 				=> 'ASC',
					    'meta_key' 				=> 'card_id',
						'meta_value' 			=> $current_id
					);


					$activity = new WP_Query( $args );
					$counter = 0;

					if ( $activity->have_posts() ) {
						while ( $activity->have_posts() ) { $counter++;
							$activity->the_post(); ?>

								<div class="row activity-item">
									<?php $author = get_the_author();?>
									<?php $user_id = $post->post_author; ?>
									<div class="col span_2 activity-label"><p class="secondary"><?php if($counter == 1) { echo 'Created'; } else { echo 'Edited'; } ?></p></div>
									<div class="col span_2 activity-avatar"><?php switch_to_blog(1); echo get_avatar( $user_id, 100 ); restore_current_blog(); ?></div>
									<div class="col span_12 activity-content">
										<p class="secondary activity-content-main"><?php echo get_the_author();?> <?php if($counter == 1) { echo 'created'; } else { echo 'edited'; } ?> this card.</p>
										<div class="secondary activity-content-note"><?php the_content(); ?></div>
										</div>
									<div class="col span_8 activity-content-time"><p class="secondary"><?php the_time('l, F j, Y'); ?> :: <?php the_time('g:i a'); ?></p></div>
								</div>


					<?php }
					} wp_reset_postdata(); ?>


		</div>
	</div>
