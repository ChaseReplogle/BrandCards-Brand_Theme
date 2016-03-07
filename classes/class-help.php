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
					    <p>You can easily transfer a brand by providing the email address of the person you wish to take ownership. If the new owner does not have a paid BrandCards account, they will be given an opportunity to purchase one.</p>
					    <p><a href="/transfer-ownership">Transfer Ownership Now</a></p>
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
		    <p><strong>Public brands</strong> can be shared publically with the url. Users will need to be invited to edit the brand, but anyone can view cards and download files.</p>
		    <hr>
		    <p><strong>Private brands</strong> are restricted completely to those you have invted. No one else will be able to view cards or download files.</p>
		    <p><a href="/edit-details">Edit This Brand's Visibility</a></p>
		</div>
	</div>

<?php } ?>