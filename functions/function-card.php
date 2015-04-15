<?php

/**
 * By default the next and previous post links are automatically based on the post date.
 * This function filters those links and instead bases the link on menu order.
 * This ensures that the next links match the order on the dashboard.
 */

function wpse73190_gist_adjacent_post_where($sql) {
  if ( !is_main_query() || !is_singular() )
    return $sql;

  $the_post = get_post( get_the_ID() );
  $patterns = array();
  $patterns[] = '/post_date/';
  $patterns[] = '/\'[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}\'/';
  $replacements = array();
  $replacements[] = 'menu_order';
  $replacements[] = $the_post->menu_order;
  return preg_replace( $patterns, $replacements, $sql );
}
add_filter( 'get_next_post_where', 'wpse73190_gist_adjacent_post_where' );
add_filter( 'get_previous_post_where', 'wpse73190_gist_adjacent_post_where' );

function wpse73190_gist_adjacent_post_sort($sql) {
  if ( !is_main_query() || !is_singular() )
    return $sql;

  $pattern = '/post_date/';
  $replacement = 'menu_order';
  return preg_replace( $pattern, $replacement, $sql );
}
add_filter( 'get_next_post_sort', 'wpse73190_gist_adjacent_post_sort' );
add_filter( 'get_previous_post_sort', 'wpse73190_gist_adjacent_post_sort' );






/**
 * Delete Card Modal
 * This modal content should be added to any page where a card can be deleted. It creates a modal window with the delte link.
 *
 *
 */
function delete_modal() {

// Get Card ID from URL
$card_id = $_GET[id];

?>

<div class="modal" id="card-delete">
  <div class="header">
    <h2>Delete This Card</h2>
    <p>This action can not be undone. Deleting the card will remove all images, related files, and explanations.</p>
  </div>
  <div class="form">
    <a href="<?php echo get_delete_post_link( $card_id ); ?> " class="button button-warning button-block">Confirm Delete</a>
  </div>
</div>

<?php }


// When any card is deleted the user is redirected back to the brand dashbaord.
add_action( 'trashed_post', 'wpse132196_redirect_after_trashing', 10 );
function wpse132196_redirect_after_trashing() {
    wp_redirect( home_url('/') );
    exit;
 }



// When a new card is created this function redirects them to the card just created.

add_filter("gform_confirmation", "custom_confirmation", 10, 4);
function custom_confirmation($confirmation, $form, $lead) {
    $post_id = $lead['post_id'];
    $confirmation_url = get_site_url() . "/cards?p=" . $post_id;
    $confirmation = array("redirect" => $confirmation_url);

    return $confirmation;
}