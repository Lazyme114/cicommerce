<div class="columns">
	<div class="column is-4" style="margin-top: 24px;">
		<figure class="image is-fullwidth">
			<img src="<?php echo base_url(); ?>uploads/items/big_pics/<?php echo $big_pic; ?>" alt="<?php echo $item_title; ?>">
		</figure>
	</div>
	<div class="column is-5">
		<h1 class="is-size-1"><?php echo $item_title; ?></h1>
		<div style="clear: both;">
			<?php echo nl2br($item_description); ?>
		</div>
	</div>
	<div class="column is-3">Auto</div>
</div>