<?php
$count = 0;
$this->load->module("site_settings");
$this->load->module("homepage_offers");
?>
<?php foreach ($query->result() as $row): 
	$num_items_on_block = $this->homepage_offers->count_where("block_id", $row->id);
	$count++;
	if($count > 4) {
		$count = 1;
	}
	$theme = $this->site_settings->_get_dynamic_theme($count); ?>
	
	<?php if ($num_items_on_block > 0): ?>		
		<article class="panel <?php echo $theme; ?>">
			<p class="panel-heading">
				<?php echo $row->block_title; ?>
			</p>
			<div class="panel-block">
				<div class="container">
					<div class="columns is-multiline">

						<?php $this->homepage_offers->_draw_homepage_offers($row->id, $theme); ?>
					</div>

				</div>
			</div>
		</article>
	<?php endif ?>
<?php endforeach ?>
