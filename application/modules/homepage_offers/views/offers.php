
<?php foreach ($query->result() as $row): ?>

	<?php 
	$small_pic_path = base_url()."uploads/items/small_pics/".$row->small_pic;
	$item_page_url = base_url().$item_segments.$row->item_url;
	?>
	
	<div class="column is-4">
		<div class="card large has-ribbon">
			<div class="ribbon <?php echo $theme; ?>"><?php echo $row->block_title; ?></div>
			<div class="card-image">
				<figure class="image image-small">
					<img src="<?php echo $small_pic_path; ?>" alt="<?php echo $row->item_title; ?>" title="<?php echo $row->item_title; ?>">
				</figure>
			</div>
			<div class="card-content">
				<div class="media">
					<div class="media-content">
						<p class="title is-5 no-padding"><a href="<?php echo $item_page_url; ?>"><?php echo $row->item_title; ?></a></p>
						<p>
							<span class="title is-6 has-text-danger has-text-weight-bold">
								<?php echo $currency_symbol.number_format($row->item_price, 2); ?>
							</span>
							<?php if ($row->was_price > 0): ?>
								<span class="title is-6 has-text-grey-light has-text-weight-bold" style="text-decoration: line-through;">
									<?php echo $currency_symbol.number_format($row->was_price, 2); ?>
								</span>
							<?php endif ?>
						</p>
					</div>
				</div>
				<div class="content">
				</div>
			</div>
		</div>

	</div>
	<?php endforeach ?>