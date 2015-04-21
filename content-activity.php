<?php
/**
 * @package brand
 */
?>


	<div class="row gutters">
		<div class="col span_24 activity">

			<hr>

			<h4>Card Activity</h4>


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
									<div class="col span_2"><?php if($counter == 1) { echo 'Created'; } else { echo 'Edited'; } ?></div>
									<div class="col span_2"><?php $user_id = $activity->post_author; switch_to_blog(1); echo get_avatar( $user_id, 40 ); restore_current_blog(); ?></div>
									<div class="col span_12">
										<?php echo get_the_author();?> <?php if($counter == 1) { echo 'created'; } else { echo 'edited'; } ?> this card.
										<br/>
										<?php the_content(); ?>
										</div>
									<div class="col span_8"><?php the_time('l, F j, Y'); ?> :: <?php the_time('g:i a'); ?></div>
								</div>


					<?php }
					} wp_reset_postdata(); ?>


		</div>
	</div>
