<h1>
	<?php echo $heading; ?>
</h1>

<?php echo validation_errors("<p style='item_id: red'>", "</p>"); ?>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>New Offer options</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			$url = base_url()."homepage_offers/update/".$block_id;
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="item_id">New Offer </label>
						<div class="controls">
							<input type="text" class="span5" name="item_id" id="item_id" value="" placeholder="Enter an Item id Here">
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
						<a href="<?php echo base_url(); ?>store_items/update/<?php echo $block_id; ?>" class="btn">Finished</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>


<?php if ($item_ids->num_rows() > 0 ): ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white user"></i><span class="break"></span>Homepage Offers</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Sn.</th>
							<th>Offer</th>
							<th>Actions</th>
						</tr>
					</thead>   
					<tbody>
						<?php $i = 1; foreach($item_ids->result() as $row) { 
							$delete_item_url = base_url()."homepage_offers/delete/".$row->id."/".$row->block_id;
							?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td class="center">
									<?php echo $row->item_id; ?>
								</td>
								<td class="center">
									<a class="btn btn-danger" href="<?php echo $delete_item_url; ?>">
										<i class="halflings-icon white trash"></i>  
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php endif ?>