<?php
/**
 * brand functions and definitions
 *
 * @package brand
 */

if ( ! function_exists( 'brand_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brand_setup() {

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'account' => __( 'Account Menu' ),
	) );


}
endif; // brand_setup
add_action( 'after_setup_theme', 'brand_setup' );


/**
 * Enqueue scripts and styles.
 */
function brand_scripts() {
	wp_enqueue_style( 'brand-style', get_stylesheet_uri() );
	// This link shares the stylesheet from the main site for these inner pages.
	wp_enqueue_style( 'brandcards-style-main', network_home_url() . '/wp-content/themes/brandcards/css/main.css' );
	wp_enqueue_script( 'brand-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', array(), '1', true );
	wp_enqueue_script( 'brand-color', get_template_directory_uri() . '/js/colpick.js', array(), '1', true );
	wp_enqueue_script( 'brand-forms', get_template_directory_uri() . '/js/forms.js', array(), '1', true );
	wp_enqueue_script( 'brand-modal', get_template_directory_uri() . '/js/modal.js', array(), '1', true );
	wp_enqueue_script( 'brand-fitvid', get_template_directory_uri() . '/js/fitvid.js', array(), '1', true );
	wp_enqueue_script( 'brand-sortable', get_template_directory_uri() . '/js/sortable.js', array(), '1', true );


}
add_action( 'wp_enqueue_scripts', 'brand_scripts' );

function jquery_method() {
	wp_deregister_script( 'jquery' );
	wp_register_script(   'jquery'
	    , '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, false);

	wp_enqueue_script('jquery');
}

if( !is_admin() ) {
	add_action('init', 'jquery_method');
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Link to Brand Details file.
 */
require get_template_directory() . '/classes/class-details.php';

/**
 * Link to Invites file.
 */
require get_template_directory() . '/classes/class-invites.php';

/**
 * Link to Transfer file
 */
require get_template_directory() . '/classes/class-transfers.php';

/**
 * Link to Cards file
 */
require get_template_directory() . '/classes/class-cards.php';

/**
 * Link to User file
 */
require get_template_directory() . '/classes/class-users.php';

/**
 * Link to Activity file
 */
require get_template_directory() . '/classes/class-activity.php';


/**
 * Functions to include
 */
require get_template_directory() . '/functions/function-remove-user.php';
require get_template_directory() . '/functions/function-archive-brand.php';
require get_template_directory() . '/functions/function-delete-brand.php';
require get_template_directory() . '/functions/function-switch-role.php';
require get_template_directory() . '/functions/function-card.php';
require get_template_directory() . '/functions/function-reorder-cards.php';

/**
 * Hide Admin Bar.
 */
add_filter('show_admin_bar', '__return_false');



/**
 * Checks for a profile image and returns image or default.
 *
 *
 */
function user_profile_image($user_id, $size) {


}



/**
 * Adds a log out button to the account menu created above.
 *
 *
 */


add_filter('allowed_redirect_hosts','allow_ms_parent_redirect');
function allow_ms_parent_redirect($allowed)
{
	$url = home_url();
    $allowed[] = $url;
    return $allowed;
}




/**
 * Adds support for featured images.
 *
 *
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'web', 800, 1000 );




/*
 * Redirect everyone except for super admin to the dashboard

add_action( 'admin_init', 'custom_wpadmin_blockusers_init' );
function custom_wpadmin_blockusers_init() {
  if ( !current_user_can( 'manage_network' ) ) {
    wp_redirect( home_url() );
    exit;
  }
}

*/




add_action( 'template_redirect', 'redirect_to_specific_page' );

function redirect_to_specific_page() {

	$args = array( 'posts_per_page' => 1, 'post_type' => 'brand_details' );
	$details = get_posts( $args );

		foreach ( $details as $detail ) :
			$privacy = get_post_meta($detail->ID, 'brand_privacy', true);
			var_dump($privacy);

				if (!is_user_logged_in() && $privacy === "Private") {

					$location = network_site_url();
					var_dump($location);

				  	// redirect after header definitions - cannot use wp_redirect($location);
					?>
					   <script type="text/javascript">
					   <!--
					      window.location= <?php echo "'" . $location . "'"; ?>;
					   //-->
					   </script>
					<?php
				}

		endforeach;

}










// Allows Wordpress to acces .svg files
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');





add_filter('gform_notification_format','gf_email_format');
function gf_email_format(){
	return 'text/plain';
}




