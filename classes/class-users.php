<?php

/**
 * 	User Sidebar List
 *
 *	This sidebar handels all of the functionality for displaying users as well as links for inviting, removing, and transfering.
 */

function user_sidebar() { ?>

	<?php // Invite Link for inviting new users --> ?>

	<div class="new-user">
		<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/invite">Invite New User</a><?php } ?>
	</div>





	<?php // Display Owner ?>

	<div class="owner-user">

		<?php // Get users by role of editor
		$users = get_users( array('role' => 'administrator' ) );
		if($users) { ?>

			<p class="user-title secondary row-border-bottom">Owner</p>

		<?php }

		// Loop through each of the ownders... should only be one.
		foreach ( $users as $user ) {
			$user_id = $user->ID; ?>

			<div class="user-item row gutters">
				<?php //  User Avatar: stored in the main network blog, so we need to switch to it. ?>
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>

				<div class="col span_19">

					<?php // If the user is the owner, they can transfer to a new owner.

					if( current_user_can('administrator') ) {  ?>
						<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
						<p class="email email-toggle"><?php echo  $user->user_email; ?></p>
						<div class="user-links">
							<p>
								<!-- Link to transfer ownership -->
								<a href="/transfer-ownership" class="transfer-link">Transfer Ownership</a>
							</p>
						</div>

					<?php // All other users will just see the owners name and email

					} else { ?>
						<p class="username"><?php echo  $user->first_name . ' ' . $user->last_name; ?></p>
						<p class="email"><?php echo  $user->user_email; ?></p>
					<?php } ?>

				</div>
			</div>
		<?php } ?>
	</div>







	<?php // Display Editors ?>

	<div class="editors-user">

		<?php // Get users by role of editor
		$users = get_users( array('role' => 'editor' ) );
		if($users) { ?>

			<p class="user-title secondary row-border-bottom">Editors</p>

		<?php }

		// Loop through each of the editors
		foreach ( $users as $user ) {
			$user_id = $user->ID;
			$role = $user->roles[0]; ?>

			<div class="user-item row gutters">
				<?php //  User Avatar: stored in the main network blog, so we need to switch to it. ?>
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>

				<div class="col span_19">

					<?php // If the current user can edit users we display the link version of each users information.

					if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
						<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
						<p class="email email-toggle"><?php echo  $user->user_email; ?></p>
						<div class="user-links">
							<p>
								<?php /*  Link to remove user from brand: This link submits some information back to the "functions-remove-user.php" file.
									It passes:
										1. The action title: "remove_user"
										2. The Users Id
										3. The current Blog's Id  */ ?>

								<?php $url = add_query_arg(array('action'=>'remove_user', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id));
								echo  "<a href='".$url. "'>Remove</a>"; ?>

								<?php /*  Link to switch the user's role for this brand: This link submits some information back to the "functions-switch-role.php" file.
									It passes:
										1. The action title: "switch_role"
										2. The Users Id
										3. The current Blog's Id */?>

								<?php $url = add_query_arg(array('action'=>'switch_role', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id, 'role'=>$role));
								echo  "<a href='".$url. "'>Switch Role</a>"; ?>
							</p>
						</div>

					<?php // If they are just a subscriber, they get just names and eamils... no links to edit.

					} else { ?>
						<p class="username"><?php echo  $user->first_name . ' ' . $user->last_name; ?></p>
						<p class="email"><?php echo  $user->user_email; ?></p>
					<?php } ?>

				</div>
			</div>
		<?php } // End of foreach loop ?>
	</div>






	<?php // Display Subscribers ?>

	<div class="subscribers-user">

		<?php // Get users by role of subscriber
		$users = get_users( array('role' => 'subscriber' ) );
		if($users) { ?>

			<p class="user-title secondary row-border-bottom">Subscribers</p>

		<?php }

		// Loop through each of the subscriebrs
		foreach ( $users as $user ) {
			$user_id = $user->ID;
			$role = $user->roles[0]; ?>

			<div class="user-item row gutters">
				<?php //  User Avatar: stored in the main network blog, so we need to switch to it. ?>
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>

				<div class="col span_19">

					<?php // If the current user can edit users we display the link version of each users information.

					if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
						<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
						<p class="email email-toggle"><?php echo  $user->user_email; ?></p>
						<div class="user-links">
							<p>

								<?php /*  Link to remove user from brand: This link submits some information back to the "functions-remove-user.php" file.
									It passes:
										1. The action title: "remove_user"
										2. The Users Id
										3. The current Blog's Id  */ ?>

								<?php $url = add_query_arg(array('action'=>'remove_user', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id));
								echo  "<a href='".$url. "'>Remove</a>"; ?>

								<?php /*  Link to switch the user's role for this brand: This link submits some information back to the "functions-switch-role.php" file.
									It passes:
										1. The action title: "switch_role"
										2. The Users Id
										3. The current Blog's Id */?>

								<?php $url = add_query_arg(array('action'=>'switch_role', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id, 'role'=>$role));
								echo  "<a href='".$url. "'>Switch Role</a>"; ?>
							</p>
						</div>

					<?php // If they are just a subscriber, they get just names and eamils... no links to edit.

					} else { ?>
						<p class="username"><?php echo  $user->first_name . ' ' . $user->last_name; ?></p>
						<p class="email"><?php echo  $user->user_email; ?></p>
					<?php } ?>

				</div>
			</div>
		<?php } // End of foreach loop ?>
	</div>







	<!-- Display Invited Users -->

	<div class="invites-user">

		<?php // Slightly different from above, this gets posts from the invites cusom post type that is created when an invite is sent.
		$invites = get_posts( array('post_type' => 'invites', 'posts_per_page', -1 ) );
		if($invites) { ?>

			<p class="user-title secondary row-border-bottom">Invited</p>

		<?php }

		// Loop through each of the invite posts
		foreach ( $invites as $invite ) { ?>

			<div class="user-item user-item-invited row gutters">

				<?php //  Sets a default avatar icon for pending invitations ?>
				<div class="col span_5">
					<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/invited.svg" width="170px"/>
				</div>

				<div class="col span_19">

					<?php // If the current user can edit users we display the link version to delete the invite.

					if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
						<p class="username"><a href="#"><?php echo get_post_meta( $invite->ID, 'invite_email', 'true' ); ?></a></p>
						<p class="email email-toggle">Invited</p>
						<div class="user-links">
							<p>
								<?php /*  provides a link that deltes the invite post... which must be checked in order to add the user... see file in BrandCards. */ ?>

								<a href="<?php echo get_delete_post_link( $invite->ID, true ); ?>">Delete</a>
							</p>
						</div>

					<?php } else { ?>

						<?php // If they are just a subscriber, they get just names and eamils... no links to edit. ?>

						<p class="username"><?php echo get_post_meta( $invite->ID, 'invite_email', 'true' ); ?></p>
						<p class="email">Invited</p>
					<?php } ?>

				</div>
			</div>
		<?php } // End of foreach loop ?>
	</div>

<?php

}
