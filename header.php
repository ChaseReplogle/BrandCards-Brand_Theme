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

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

<?php gravity_form_enqueue_scripts( 7, true ); ?>
<?php wp_head(); ?>

<?php $args = array( 'posts_per_page' => 1, 'post_type' => 'brand_details' );
	$details = get_posts( $args );

		foreach ( $details as $detail ) :
			$privacy = get_post_meta($detail->ID, 'brand_privacy', true);
			var_dump($privacy);

			$location = network_site_url();
			var_dump($location);

				if (!is_user_logged_in() && $privacy === "Private") {

				  	// redirect after header definitions - cannot use wp_redirect($location);
					?>
					   <script type="text/javascript">
					   <!--
					      window.location= <?php echo "'" . $location . "'"; ?>;
					   //-->
					   </script>
					<?php
				}

		endforeach; ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">





	<?php $user_id = get_current_user_id();?>
			<header class="main-nav main-nav-right marketing-nav">
				<div class="container mobile-nav">
					<a href="<?php echo network_home_url(1); ?>/dashboard"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/logo.svg" width="150px" class="branding" /></a>
					<a href="#" class="mobile-menu-icon"><svg width="40px" height="40px" viewBox="0 0 240 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"><g id="Page 1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Menu" fill="#444444"><path d="M0,160 L0,200 L240,200 L240,160 L0,160 Z M0,160" id="Rectangle 3"></path><path d="M0,80 L0,120 L240,120 L240,80 L0,80 Z M0,80" id="Rectangle 2"></path><path d="M0,0 L0,40 L240,40 L240,0 L0,0 Z M0,0" id="Rectangle 1"></path></g></g></svg></a>
				 </div>

				 <div class="container wide-nav">
					<a href="<?php echo network_home_url(1); ?>/dashboard"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/logo.svg" width="150px" class="branding" /></a>
					<?php if (is_user_logged_in()) { ?>
					<a href="<?php echo network_home_url(1); ?>/membership-account"><?php
							switch_to_blog(1);
  							echo get_avatar( $user_id, 30 );?></a>
				 			<?php wp_nav_menu( array('menu' => 'Account Menu' )); ?>
				 	<?php restore_current_blog(); ?>
				 	<?php } ?>
				 </div>
			</header>


	<?php transfer_notification_bar(); ?>

	<?php brand_header() ?>

	<div id="content" class="container">
