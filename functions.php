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


	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
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
	wp_enqueue_script( 'brand-color', get_template_directory_uri() . '/js/colpick.js' );
	wp_enqueue_script( 'brand-forms', get_template_directory_uri() . '/js/forms.js' );
	wp_enqueue_script( 'brand-modal', get_template_directory_uri() . '/js/modal.js' );

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
 * Functions to include
 */
require get_template_directory() . '/functions/function-remove-user.php';
require get_template_directory() . '/functions/function-archive-brand.php';
require get_template_directory() . '/functions/function-switch-role.php';

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
