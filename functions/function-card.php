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

  $post_id = get_the_ID();

  $deleted_id = get_post_meta($post_id, 'card_id', true);


    if ( 'activity' == get_post_type($post_id) ) {

      wp_redirect( home_url('/?p=' . $deleted_id ) );

    } else {

      wp_redirect( home_url('/') );
    }

    exit;
 }



// When a new card is created this function redirects them to the card just created.

// Color Card
add_filter("gform_confirmation_9", "custom_confirmation", 10, 4);

// Image Card
add_filter("gform_confirmation_8", "custom_confirmation", 10, 4);

// Logo Card
add_filter("gform_confirmation_7", "custom_confirmation", 10, 4);

// Palette Card
add_filter("gform_confirmation_10", "custom_confirmation", 10, 4);

// Typography Card
add_filter("gform_confirmation_11", "custom_confirmation", 10, 4);

// Video Card
add_filter("gform_confirmation_12", "custom_confirmation", 10, 4);

function custom_confirmation($confirmation, $form, $lead) {
    $post_id = $lead['post_id'];
    $confirmation_url = get_site_url() . "/cards?p=" . $post_id;
    $confirmation = array("redirect" => $confirmation_url);

    return $confirmation;
}




// When a new card is created this function creates a post in the activity post type

// Color Card
add_filter("gform_after_submission_9", "activity_post", 10, 4);

// Image Card
add_filter("gform_after_submission_8", "activity_post", 10, 4);

// Logo Card
add_filter("gform_after_submission_7", "activity_post", 10, 4);

// Palette Card
add_filter("gform_after_submission_10", "activity_post", 10, 4);

// Typography Card
add_filter("gform_after_submission_11", "activity_post", 10, 4);

// Video Card
add_filter("gform_after_submission_12", "activity_post", 10, 4);

function activity_post( $entry, $form ) {

 $created_post_id = $entry['post_id'];
 $user_ID = get_current_user_id();

 if( $form['id'] == 9 ) {
     $content = rgar( $entry, '15' );
 } elseif($form['id'] == 8 ) {
     $content = rgar( $entry, '6' );
 } elseif($form['id'] == 7 ) {
     $content = rgar( $entry, '9' );
 } elseif($form['id'] == 10 ) {
     $content = rgar( $entry, '6' );
 } elseif($form['id'] == 11 ) {
     $content = rgar( $entry, '12' );
 } elseif($form['id'] == 12 ) {
     $content = rgar( $entry, '10' );
 }

     // Create post object
    $new_activity = array(
      'post_title'    => $created_post_id,
      'post_status'   => 'publish',
      'post_author'   => $user_ID,
      'post_content'  => $content,
      'post_type'     => 'activity'
    );

    // Insert the post into the database
    $activity_id = wp_insert_post( $new_activity );
    add_post_meta($activity_id, 'card_id', $created_post_id, 0);

}