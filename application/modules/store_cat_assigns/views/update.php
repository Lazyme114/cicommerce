<h1>
	<?php echo $heading; ?>
</h1>

<?php echo validation_errors("<p style='color: red'>", "</p>"); ?>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>New Category</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			$url = base_url()."store_cat_assigns/update/".$item_id;
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="color">New Category </label>
						<div class="controls">
							<select id="category_id" name="category_id">
								<option value="">Please Select Category</option>
								<?php foreach ($sub_categories as $key => $value): ?>
									<?php if(!in_array($key, array_column($assigned_categories->result_array(), 'category_id'))) { ?>
										<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
									<?php } ?>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
						<a href="<?php echo base_url(); ?>store_items/update/<?php echo $item_id; ?>" class="btn">Finished</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>


<?php if ($assigned_categories->num_rows() > 0 ): ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white user"></i><span class="break"></span>Existing Categories</h2>
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
							<th>Category</th>
							<th>Actions</th>
						</tr>
					</thead>   
					<tbody>
						<?php $this->load->module("store_categories"); ?>
						<?php $i = 1; foreach($assigned_categories->result() as $row) { 
							$delete_item_url = base_url()."store_cat_assigns/delete/".$row->id."/".$row->item_id;
							?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td class="center">
									<?php echo $this->store_categories->_get_category_title($row->category_id); ?>
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