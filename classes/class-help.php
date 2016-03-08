<?php function help_owner() { ?>

	<a href="#help_owner" rel="leanModal" class="help_icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icon.png"></a>

	<div class="modal help_modal" id="help_owner">
		<div class="my-slider help_owner">
			<ul>
				<li>
					<div class="header">
						<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icons/help_owner.png">
					    <h2>Tip: The Owner's Role</h2>
					    <hr>
					    <p>The owner of a brand is responsible for managing the brand's account. In order to own the brand, a user must have a paid subscription. At anytime ownership of the brand can be transfered to a new owner.</p>
					    <p><a href="#">Learn More</a></p>
					</div>
				</li>
				<li>
					<div class="header">
						<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icons/help_transfer.png">
					    <h2>Tip: Transfering Ownership</h2>
					    <hr>
					    <p>The current owner of a brand can transfer ownership by providing the email address of the person they wish to take over. If the new owner does not have a paid BrandCards account, they will be given an opportunity to purchase one.</p>
					    <?php if( current_user_can('administrator') ) {  ?>
					    <p><a href="/transfer-ownership">Transfer Ownership Now</a></p>
					    <?php } ?>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('.my-slider.help_owner').unslider();

			$('#help_owner .unslider-arrow').appendTo('#help_owner .unslider-nav');
		});
	</script>
<?php } ?>




<?php function help_publicLink() { ?>

	<a href="#help_publicLink" rel="leanModal" class="help_icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icon.png"></a>

	<div class="modal help_modal" id="help_publicLink">
		<div class="header">
		<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icons/help_privacy.png">
		    <h2>Visibility of Your Brand</h2>
		    <hr>
		    <p><strong>Public brands</strong> can be shared using the url. Anyone with the url will be able to view cards and download files—they will not be able to make changes. <i>Note: Brands are public by default.</i></p>
		    <hr>
		    <p><strong>Private brands</strong> are restricted to those you have been invited as an editor or subscriber. No one else will be able to view cards or download files.</p>
		    <?php if( current_user_can('administrator') ) {  ?>
		    	<p><a href="/edit-details">Edit This Brand's Visibility</a></p>
		    <?php } ?>
		</div>
	</div>

<?php } ?>




<?php function help_download() { ?>

	<a href="#help_download" rel="leanModal" class="help_icon"><img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icon.png"></a>

	<div class="modal help_modal" id="help_download">
		<div class="my-slider help_download">
			<ul>
				<li>
					<div class="header">
						<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icons/help_download.png">
					    <h2>Tip: Downloading Files</h2>
					    <hr>
					    <p>Related files is a great way to pass on variations of a logo or alternative file formats. Understanding file formats is critical to using the brand well. Below is a link to a comprensive glossary of file formats.</p>
					    <p><a href="/file-formats" class="button button-block button-primary">Glossary of File Formats</a></p>
					</div>
				</li>
				<li>
					<div class="header">
						<img src="<?php network_site_url(); ?>/wp-content/themes/brandcards/images/help_icons/help_swatch.png">
					    <h2>Tip: Swatch Files</h2>
					    <hr>
					    <p>When you are viewing a color palette card, you will be given the option to download an Adobe Color Swatch Files. .ase files can be easily imported in Adobe software such as Photoshop and Illustrator.</p>
					    <?php if( current_user_can('administrator') ) {  ?>
					    <p><a href="/ase">Learn More About .ase Files</a></p>
					    <?php } ?>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('.my-slider.help_download').unslider();

			$('#help_download .unslider-arrow').appendTo('#help_download .unslider-nav');
		});
	</script>
<?php } ?>