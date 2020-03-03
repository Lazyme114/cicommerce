<?php $this->load->module("homepage_blocks"); ?>
<?php foreach ($parent_Homepage Offers->result() as $parent_cat): ?>
	<div class="navbar-item has-dropdown is-hoverable">
		<a class="navbar-link">
			<?php echo $parent_cat->block_title; ?>
		</a>
		<div class="navbar-dropdown">
			<?php $sub_Homepage Offers = $this->homepage_blocks->_get_sub_cats_for_parent_homepage offer($parent_cat->id); ?>

			<?php foreach ($sub_Homepage Offers->result() as $sub_cat): ?>
				<a href="<?php echo $target_url_start.$sub_cat->homepage offer_url; ?>" class="navbar-item">
					<?php echo $sub_cat->block_title; ?>
				</a>
			<?php endforeach ?>
		</div>
	</div>
	<?php endforeach; ?>