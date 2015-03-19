<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package brand
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'brand' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'brand' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'brand' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'brand' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'brand_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function brand_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'brand' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'brand' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'brand_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function brand_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'brand' ) );
		if ( $categories_list && brand_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'brand' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'brand' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'brand' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'brand' ), __( '1 Comment', 'brand' ), __( '% Comments', 'brand' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'brand' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'brand' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'brand' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'brand' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'brand' ), get_the_date( _x( 'Y', 'yearly archives date format', 'brand' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'brand' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'brand' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'brand' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'brand' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'brand' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'brand' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'brand' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'brand' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'brand' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function brand_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'brand_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'brand_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so brand_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so brand_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in brand_categorized_blog.
 */
function brand_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'brand_categories' );
}
add_action( 'edit_category', 'brand_category_transient_flusher' );
add_action( 'save_post',     'brand_category_transient_flusher' );







/**
 * User Sidebar List
 *
 *
 */
function user_sidebar() { ?>
	<div class="new-user">
		<a href="/invite">Invite New User</a>
	</div>

	<div class="owner-user">
		<?php $users = get_users( array('role' => 'administrator' ) );
		if($users) { ?><p class="user-title secondary row-border-bottom">Owner</p><?php }
		foreach ( $users as $user ) {
			$user_id = $user->ID; ?>
			<div class="user-item row gutters">
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>
				<div class="col span_19">
					<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
					<div class="user-links">
						<p>
							<a href="/transfer-ownership" class="transfer-link">Transfer Ownership</a>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="editors-user">
		<?php $users = get_users( array('role' => 'editor' ) );
		if($users) { ?><p class="user-title secondary row-border-bottom">Editors</p><?php }
		foreach ( $users as $user ) {
			$user_id = $user->ID;
			$role = $user->roles[0]; ?>
			<div class="user-item row gutters">
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>
				<div class="col span_19">
					<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
					<div class="user-links">
						<p>
							<?php $url = add_query_arg(array('action'=>'remove_user', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id));
							echo  "<a href='".$url. "'>Remove</a>"; ?>
							<?php $url = add_query_arg(array('action'=>'switch_role', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id, 'role'=>$role));
							echo  "<a href='".$url. "'>Switch Role</a>"; ?>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="subscribers-user">
		<?php $users = get_users( array('role' => 'subscriber' ) );
		if($users) { ?><p class="user-title secondary row-border-bottom">Subscribers</p><?php }
		foreach ( $users as $user ) {
			$user_id = $user->ID;
			$role = $user->roles[0]; ?>
			<div class="user-item row gutters">
				<div class="col span_5">
					<?php switch_to_blog(1); echo get_avatar( $user_id, 45 ); restore_current_blog(); ?>
				</div>
				<div class="col span_19">
					<p class="username"><a href="#"><?php echo  $user->first_name . ' ' . $user->last_name; ?></a></p>
					<div class="user-links">
						<p>
							<?php $url = add_query_arg(array('action'=>'remove_user', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id));
							echo  "<a href='".$url. "'>Remove</a>"; ?>
							<?php $url = add_query_arg(array('action'=>'switch_role', 'user_id'=>$user_id, 'blog_id'=>$blog_details->blog_id, 'role'=>$role));
							echo  "<a href='".$url. "'>Switch Role</a>"; ?>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="invites-user">
		<?php $invites = get_posts( array('post_type' => 'invites' ) );
		if($invites) { ?><p class="user-title secondary row-border-bottom">Invited</p><?php }
		foreach ( $invites as $invite ) { ?>
			<div class="user-item user-item-invited row gutters">
				<div class="col span_5">
					<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/invited.svg" width="170px"/>
				</div>
				<div class="col span_19">
					<p class="username"><a href="#"><?php echo get_post_meta( $invite->ID, 'invite_email', 'true' ); ?></a></p>
					<div class="user-links">
						<p>
							<a href="<?php echo get_delete_post_link( $invite->ID, true ); ?>">Delete</a>
						</p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

<?php

}



/**
 * Brand Header
 *
 *
 */
function brand_header() {

if ( is_front_page() ) { ?>

	<div class="brand-header">
		<div class="row brand-dash-header gutters container">
			<div class="col span_3">
				<?php brand_cover(); ?>
			</div>
			<div class="col span_15 brand-dash-header_text">
				<?php $blog_details = get_blog_details(); ?>
				<h1><?php echo $blog_details->blogname; ?> </h1>
				<p class="secondary edit-links">
					<a href="/edit-details/" class="secondary">Edit</a>
					<a href="/archive" class="secondary">Archive</a>
					<a href="/delete" class="secondary">Delete</a>
				</p>
			</div>
			<div class="col span_6 new-card">
				<a href="#">Add New Card</a>
			</div>
		</div>
	</div>

<?php } else { ?>

<div class="brand-header">
		<div class="row brand-dash-header gutters container">
			<div class="col span_18 brand-dash-header_text">
				<?php $blog_details = get_blog_details(); ?>
				<h1><a href="/"><?php echo $blog_details->blogname; ?> </a></h1>
				<p class="secondary edit-links">
					<a href="/" class="secondary">Back</a>
			</div>

		</div>
	</div>

<?php }

}