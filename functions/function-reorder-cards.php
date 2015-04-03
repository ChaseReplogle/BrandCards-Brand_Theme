<?php

add_action('wp_ajax_reorder', 'my_save_item_order');

// Reorder Ajax Request
function my_save_item_order() {
    global $wpdb;

    $order = explode(',', $_POST['order']);
    $counter = 0;
    $post_type = 'cards';
    foreach ($order as $item_id) {
        // Update post 37
		  $menu_update = array(
		      'ID'          	=> $item_id,
		      'menu_order' 		=> $counter,
		      'post_type'		=> 'cards',
		  );

		// Update the post into the database
		  wp_update_post( $menu_update );

  		$counter++;
    }
    die(1);
}
