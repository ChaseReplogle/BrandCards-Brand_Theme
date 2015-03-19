<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package brand
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();?>
			<header class="main-nav main-nav-right marketing-nav">
				<div class="container">
					<a href="<?php echo network_home_url(1); ?>/dashboard"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/logo.svg" width="150px" class="branding" /></a>
					<a href="<?php echo network_home_url(1); ?>/membership-account"><?php
							switch_to_blog(1);
  							echo get_avatar( $user_id, 30 );?></a>
				 			<?php wp_nav_menu( array('menu' => 'Account Menu' )); ?>
				 	<?php restore_current_blog(); ?>
				 </div>
			</header>
	<?php } ?>


	<?php brand_header() ?>

	<div id="content" class="container">
