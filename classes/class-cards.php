<?php
// Register Custom Post Type
function cards() {

	$labels = array(
		'name'                => _x( 'Cards', 'Post Type General Name', 'cards' ),
		'singular_name'       => _x( 'Card', 'Post Type Singular Name', 'cards' ),
		'menu_name'           => __( 'Cards', 'cards' ),
		'parent_item_colon'   => __( 'Parent Card:', 'cards' ),
		'all_items'           => __( 'All Cards', 'cards' ),
		'view_item'           => __( 'View Card', 'cards' ),
		'add_new_item'        => __( 'Add New Card', 'cards' ),
		'add_new'             => __( 'Add New', 'cards' ),
		'edit_item'           => __( 'Edit Card', 'cards' ),
		'update_item'         => __( 'Update Card', 'cards' ),
		'search_items'        => __( 'Search Cards', 'cards' ),
		'not_found'           => __( 'Not found', 'cards' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cards' ),
	);
	$args = array(
		'label'               => __( 'cards', 'cards' ),
		'description'         => __( 'Post Type Description', 'cards' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'post-formats', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cards', $args );

}

// Hook into the 'init' action
add_action( 'init', 'cards', 0 );






/**
 * Card
 * Used on dashboard list and on single pages.
 * This function handels creating all of the content for each of the various card formats.
 *
 *
 */
function card($single) { ?>

<?php // Get current crads ID
$post_id = get_the_ID(); ?>

<li class="card-item ui-state-default" id='<?php echo $post_id; ?>'>

	<?php // This card-link-wrapper class is what keeps the cards at an 8:10 ratio ?>
	<div class="card-link-wrapper">

		<?php // Get a list of card categories. Each card will be tested and layout determined by the category.
			  // The category is automatically set by the Gravity Forms form.
			$post_id = get_the_ID();
			$categories = get_the_category($post->ID);
			foreach($categories as $category) {





				// Logo Card

				// Get Card ID
				$post_id = get_the_ID();

				if ($category->slug == 'logo') { ?>
				<div class="card-link logos logo"  style='background: #<?php $mykey_values = get_post_custom_values( "card-logo-color" ); foreach ( $mykey_values as $key => $value ) { echo "$value";} ?>;'>
					<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>
						<div class="logo card-inner">
							<?php // Get Featured Image
								  // There is jQuery that targets this image by the class and scales it proportionatly for the size of the card.
							if ( has_post_thumbnail() ) { the_post_thumbnail('web', array( 'class' => 'card-image' )); } ?>
						</div>
					<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>
				</div>





				<?php // Image Card

				// Get Card ID
				$post_id = get_the_ID();

				} elseif ($category->slug == 'image') { ?>
				<div class="card-link images image">
						<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>
						<div class="image">
							<?php // Get Featured Image
								  // There is jQuery that targets this image by the class and scales it proportionatly for the size of the card.
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('web', array('class' => 'main-img')); } ?>
						</div>
						<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>
				</div>






				<?php // Color Card

				// Get Card ID
				$post_id = get_the_ID();

				} elseif ($category->slug == 'color') { ?>

					<?php // This custom field is a string created by a list field in Gravity Forms
					$mykey_values = get_post_custom_values( 'card-color' );

						// We use a foreach loop to break the string into seperate values. (There should only be one string to loop through on a Color Card.)
						foreach ( $mykey_values as $key => $value ) {

							// Split the string into an array, We do this by spereateing at the "|" character
						    $colors = explode("|", $value);

						    // Create a string of RBB values seperated by commas.
						    $RGB = "$colors[3], $colors[4], $colors[5]";

						    // Create a string of CMYK values seperated by commas
						    $CMYK = "$colors[6], $colors[7], $colors[8], $colors[9]";

						    // Create a Pantone string.
						    $Pantone = $colors[2];

						    // Create the Color Name string.
						    $color_name = $colors[0];

						    // Let's check to see if the user provided the # character with the HEX value
						    // If they didn't we add it.
					    	if (preg_match('#', $colors[1]) === 1) {
			    				$HEX = $colors[1];
							} else {
								$HEX = "#$colors[1]";
							}

							// We need to echo the color into the div to set the background colors.
							// We prever to use the HEX value, but if it isn't available we use the RGB value.
							if($colors[1]) {
								$color = $HEX;
							} else {
								$color = "rgb($RGB)";
							}
					  } ?>

					<div class="card-link colors color" style="background: <?php /* Echo the color variable we set above */ echo $color; ?>;">
							<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>
							<div class="color">

								<?php // If a value is given, display it on the front end. ?>
								<div class="color-labels">
									<h2><?php if($colors[0]) { echo $color_name; } ?></h2>
									<ul>
										<li><?php if($colors[2]) { echo "Pantone: $Pantone"; } ?></li>
										<li><?php if($colors[1]) { echo "HEX: $HEX"; } ?></li>
										<li><?php if($colors[3]) { echo "RBG: $RGB"; } ?></li>
										<li><?php if($colors[6]) { echo "CMYK: $CMYK"; } ?></li>
									</ul>
								</div>

							</div>
							<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>
				</div>









				<?php // Color Palette Card

				// Get Card ID
				$post_id = get_the_ID();

				} elseif ($category->slug == 'palette') { ?>
					<div class="card-link palettes palette">
						<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>
						<div class="palette">

							<?php // This custom field is a string created by a list field in Gravity Forms
							$mykey_values = get_post_custom_values( 'card-palette' );

								// We use a foreach loop to break the string into seperate values. (There should only be one string to loop through on a Color Card.)
								foreach ( $mykey_values as $key => $value ) {

									// Split the string into an array, We do this by spereateing at the "|" character
								    $colors = explode("|", $value);

								    // Create a string of RBB values seperated by commas.
								    $RGB = "$colors[3], $colors[4], $colors[5]";

								    // Create a string of CMYK values seperated by commas
								    $CMYK = "$colors[6], $colors[7], $colors[8], $colors[9]";

								    // Create a Pantone string.
								    $Pantone = $colors[2];

								    // Create the Color Name string.
								    $color_name = $colors[0];

								    // Let's check to see if the user provided the # character with the HEX value
								    // If they didn't we add it.
							    	if (preg_match('#', $colors[1]) === 1) {
					    				$HEX = $colors[1];
									} else {
										$HEX = "#$colors[1]";
									}

									// We need to echo the color into the div to set the background colors.
									// We prever to use the HEX value, but if it isn't available we use the RGB value.
									if($colors[1]) {
										$color = $HEX;
									} else {
										$color = "rgb($RGB)";
									} ?>

									<?php // If a value is given, display it on the front end. ?>
									<div class="palette-item col span_1-5">
										<div class="swatch" style="background: <?php echo $color; ?>;"></div>
										<h2><?php if($colors[0]) { echo $color_name; } ?></h2>
										<ul>
											<li><?php if($colors[2]) { echo "Pantone: $Pantone"; } ?></li>
											<li><?php if($colors[1]) { echo "HEX: $HEX"; } ?></li>
											<li><?php if($colors[3]) { echo "RBG: $RGB"; } ?></li>
											<li><?php if($colors[6]) { echo "CMYK: $CMYK"; } ?></li>
										</ul>
									</div>

							  	<?php } ?>

						</div>
						<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>

				</div>









				<?php // Typography Card
				} elseif ($category->slug == 'typography') { ?>

				<?php // Get current post ID.
				$post_id = get_the_ID();

				// Creat Font Name
				$font_name_full = get_post_meta($post_id, 'card-font-name', true);
				$font_clean = preg_replace('/[^a-z]/i','',$font_name_full);
				$font_name = strtolower($font_clean);

				?>

					<?php // Embeds the uploaded font onto the page to use as an example
						  // It also sets up the font name to use later. ?>
					<style type="text/css">
						@font-face {
						    font-family: "<?php echo $font_name; ?>";
						    src: url('<?php echo get_post_meta($post_id, 'card-font-ttf', true); ?>') format('truetype');
						    src: url('<?php echo get_post_meta($post_id, 'card-font-woff', true); ?>') format('woff');
						}
						</style>

					<div class="card-link typography">
						<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>
						<div class="typography">
							<div class="row example-typography">
								<div class="col span_14 left">
									<?php // Applies the font name to a style element for each text item. ?>
									<h2 style="font-family: <?php echo $font_name; ?>;">Aa</h2>
									<h4 style="font-family: <?php echo $font_name; ?>;">ABCDEFGHIJKLMNOPQRSTUVWXYZ</h4>
									<h4 style="font-family: <?php echo $font_name; ?>;">abcdefghijklmnopqrstuvwxwz</h4>
								</div>
								<div class="col span_10 right">
									<h3 style="font-family: <?php echo $font_name; ?>;"><?php echo get_post_meta($post_id, 'card-font-name', true); ?></h3>
									<p style="font-family: <?php echo $font_name; ?>;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque a tristique tellus, a mattis nulla. Cras eu leo non orci convallis suscipit. Mauris aliquet tempus quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
								</div>
							</div>
						</div>
						<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>
				</div>









				<?php // Video Card
				} elseif ($category->slug == 'video') { ?>

					<?php // Get current post ID.
					$post_id = get_the_ID(); ?>

					<?php // The Video class is used by fitvid.js to make the video responsive. ?>
					<div class="card-link video">
						<?php if(!$single) { ?><a href="<?php the_permalink(); ?>" class="card-link-a"><?php } ?>

						<?php // Check for a vimeo or a youtube id. ?>
						<?php $vimeo = get_post_meta($post_id, 'card-video-vimeo', true); ?>
					    <?php $youtube = get_post_meta($post_id, 'card-video-youtube', true); ?>


					    <?php // If it is the single Card page display the actual video with an iframe embed
						if( $single == 'single' ) { ?>

							<?php // if there is a vimeo code embed the vimeo player with the retreived ID inserted.
							if(!empty($vimeo)) { ?>
								<iframe src="//player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff" width="820" height="461" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					        <?php } ?>


					        <?php  // if there is a youtube code embed the youtube player with the retreived ID inserted
					        if(!empty($youtube)) { ?>
								<iframe width="820" height="485" src="//www.youtube.com/embed/<?php echo $youtube ?>?rel=0" frameborder="0" allowfullscreen></iframe>
					        <?php } ?>


						<?php // if the card is used anywhere else get a thumbnail preview.
						} else { ?>

							<div class="image">

							<?php // Ad a play icon to the bottom left to show the image is a video. ?>
								<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/play.svg" width="35px" class="video-play" />

					        	<?php // Get a thumbnail image from Vimeo if there is a vimeo ID.
					        	if(!empty($vimeo)) {
					        		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo.php")); ?>
					        		<img class="vimeo main-img" src="<?php echo $hash[0]['thumbnail_large']; ?>" />
					        	<?php } ?>


					        	<?php // Get a thumbnail image from Youtube if there is a youtube ID.
					        	if(!empty($youtube)) {
					        		$thumb1 = "http://img.youtube.com/vi/$youtube/hqdefault.jpg"; ?>
					        		<img class="youtube main-img" src="<?php echo $thumb1 ?>" />
					        	<?php } ?>
					        </div>

					     <?php } ?>

						<?php if(!$single) { ?></a><?php } ?>

					<?php // Add Edit icon and link in bottom corner. ?>
					<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?><a href="/edit-card/?id=<?php echo $post_id;?>" class="edit-icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/edit.svg" width="35px" class="branding" /></a><?php } ?>
				<?php }
			} ?>



	</div>
</li>



<?php }










/**
 * Related Files
 * This function checks the post for related files and creates the download form on the single card page.
 *
 *
 */
function related_files() {

	// Get the Cards ID
	$post_id = get_the_ID();

	// Check the Card for Related Fields or color palette
	$files = get_post_meta($post_id, 'card-related-files', $single);
	$palette = get_post_meta($post_id, 'card-palette', $single );

	// If files exist create the form
	if($files) { ?>

		<div class="card-files">
			<h3>Download Related Files</h3>
			<form class="form-horizontal" action="<?php echo get_template_directory_uri(); ?>/functions/function-download.php" method="get">

				<input type="checkbox" id="selecct_all" name="select_all" value="select_all">
				<label class="checkbox" for="select_all">Select All Files</label>

				<hr>

			<?php // build counter
			$i = 0;

			// Loop through each of files
			foreach ( $files as $file => $value ) {

					// set the $url variable to the files url.
					$url = $value;

					// Get basic file information from the files header at that url
					$headers = get_headers($url, true);

					// Split all of that information into parts
					$path_parts = pathinfo("$file => $value");

					// Set the File Name Variable
					$file_name = substr($path_parts['filename'], -20);

					// Get the extension as a way of showing the file type
					$file_extension = $path_parts['extension'];

					// Check the site of the file and display it in "mb"
					$size = round($headers['Content-Length'] / 1048576, 2) . 'mb';

					// Add 1
					$i++;

				// If all this information exists:
				if ( isset($headers['Content-Length']) ) { ?>

					<?php // Create a label and checkbox for each file. ?>
				   	<input type="checkbox" class="sub_checkbox" name="file_url[]" id="checkboxes-<?php echo $i; ?>" value="<?php echo $url; ?>">
					<label class="checkbox" for="file_url-<?php echo $i; ?>"> <?php echo $file_name.'.'.$file_extension; ?><span><?php echo $size; ?></span></label>

				<?php // If there isn't sufficent file information avaible list the size as uknown.
				} else {
				   $size = 'file size: unknown';
				}
			} // End foreach loop through files ?>


		<?php // the code below creates the name that will be passed on for the .zip file. (exampel: BrandName_Card-Name.zip)
			global $blog_id;
			global $post;

			// Get this brands details
		  	$blog_details = get_blog_details($blog_id);

		  	// Get the main BrandCards details
		  	$site_details = get_blog_details(1);

		  	// Get the BrandCards domain
		  	$main_url = '.'.$site_details->domain;

		  	// Get the current Brand's name
		  	$site_name = str_replace($main_url, "", $blog_details->domain);

		  	// Get this cards slug
		  	$slug = get_post( $post )->post_name;

		  	// Put the site name and slug together.
		  	$file_name = $site_name . '_' . $slug;

		  		// Pass this file name in a hidden input. ?>
				<input type="hidden" name="card_name" value="<?php echo $file_name; ?>">

				<div class="controls">
				 	<input type="submit" id="singlebutton" name="singlebutton" class="button button-block" value="Download">
				</div>
			</form>
		</div>


	<?php // If the card is a color palette, create a .ase file to download.
	} elseif ($palette) { ?>

		<?php
		// Get the title of the card
		$card_title = get_the_title();

		// Get an array of the colors in the palette
		$colors = get_post_custom_values( 'card-palette' );

		// Create an empty array that we will fill and send to teh .ase file generator
		$colors_array = '';

			// For each color in the palette
			foreach ( $colors as $key => $value ) {

				// seperate out the values
				$colors = explode("|", $value);

				// Get the color name
			    $color_name = $colors[0];

			    // Remove the # character if it has been added
			    $HEX = preg_replace('{^\.}', '', $colors[1], 1);

			    // Create the color variable
				$color = array($HEX, $color_name);

				// Add it to the array we are passign to teh .ase file gnerator
				$colors_array[] = $color;
			}
		?>

		<?php // Create the full array that is sent through the form
		$palettes = array (
	        array (
	            "title"     => $card_title,
	            "colors"    => $colors_array,
	        ),
	    );


	    // Pass this array in a hidden input. ?>
	    <div class="card-files">
			<h3>Download Related Files</h3>
			<form class="form-horizontal" action="<?php echo get_template_directory_uri(); ?>/functions/function-download-palette.php" method="get">

			<?php // the code below creates the name that will be passed on for the .zip file. (exampel: BrandName_Card-Name.zip)
			global $blog_id;
			global $post;

			// Get this brands details
		  	$blog_details = get_blog_details($blog_id);

		  	// Get the main BrandCards details
		  	$site_details = get_blog_details(1);

		  	// Get the BrandCards domain
		  	$main_url = '.'.$site_details->domain;

		  	// Get the current Brand's name
		  	$site_name = str_replace($main_url, "", $blog_details->domain);

		  	// Get this cards slug
		  	$slug = get_post( $post )->post_name;

		  	// Put the site name and slug together.
		  	$file_name = $site_name . '_' . $slug;

		  		// Pass this file name in a hidden input. ?>
				<input type="hidden" name="ase_name" value="<?php echo $file_name; ?>">

				<input type="checkbox" name="ase" value="<?php echo 'Adobe Color Swatch File'; ?>" checked>
				<label class="checkbox" for="ase"><?php echo 'Adobe Color Swatch File'; ?></label>

				<div class="controls">
					<input type="hidden" name="palette_array" value="<?php echo base64_encode(serialize($palettes)); ?>">
				 	<input type="submit" id="singlebutton" name="singlebutton" class="button button-block" value="Download">
				</div>
			</form>
		</div>


	<?php // If no files exist create the "no related files" box.
	} else { ?>

			<p class="secondary no-files">Looks like there are no related files for this card.

			<?php // If the user can add files, give them a link to edit the card.
			if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<a href="/edit-card/?id=<?php echo $post_id;?>">Add Some</a></p>
			<?php } ?>

	<?php } // End Else

}


