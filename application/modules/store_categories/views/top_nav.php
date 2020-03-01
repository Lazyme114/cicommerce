<?php $this->load->module("store_categories"); ?>
<?php foreach ($parent_categories->result() as $parent_cat): ?>
	<div class="navbar-item has-dropdown is-hoverable">
		<a class="navbar-link">
			<?php echo $parent_cat->category_title; ?>
		</a>
		<div class="navbar-dropdown">
			<?php $sub_categories = $this->store_categories->_get_sub_cats_for_parent_category($parent_cat->id); ?>

			<?php foreach ($sub_categories->result() as $sub_cat): ?>
				<a href="<?php echo base_url(); ?>" class="navbar-item">
					<?php echo $sub_cat->category_title; ?>
				</a>
			<?php endforeach ?>
		</div>
	</div>
	<?php endforeach; ?>