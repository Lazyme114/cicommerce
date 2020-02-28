<h1>
	<?php echo $heading; ?>
</h1>

<?php echo validation_errors("<p style='color: red'>", "</p>"); ?>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<?php if(isset($update_id) && is_numeric($update_id)) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php if($big_pic == "") { ?>
					<a href="<?php echo base_url(); ?>store_items/upload_image/<?php echo $update_id; ?>" class="btn btn-primary">Upload Item Image</a>
				<?php } else { ?>
					<a href="<?php echo base_url(); ?>store_items/delete_image/<?php echo $update_id; ?>" class="btn btn-danger">Delete Item Image</a>
				<?php } ?>
				<a href="<?php echo base_url(); ?>store_item_colors/update/<?php echo $update_id; ?>" class="btn btn-primary">Update Item Colors</a>
				<a href="<?php echo base_url(); ?>store_item_sizes/update/<?php echo $update_id; ?>" class="btn btn-primary">Update Item Sizes</a>
				<a href="<?php echo base_url(); ?>store_items/<?php echo $update_id; ?>" class="btn btn-primary">Update Item Categories</a>
				<a href="<?php echo base_url(); ?>store_items/<?php echo $update_id; ?>" class="btn btn-danger">Delete Item</a>
			</div>
		</div>
	</div>
<?php } ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if(isset($update_id)) {
				$url = base_url()."store_items/update/".$update_id;
			} else {
				$url = base_url()."store_items/create";
			}
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="item_title">Item Title </label>
						<div class="controls">
							<input type="text" class="span5" name="item_title" id="item_title" value="<?php echo $item_title; ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="item_price">Item Price </label>
						<div class="controls">
							<input type="text" class="span5" name="item_price" id="item_price" value="<?php echo $item_price; ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="was_price">Was Price <span style="color: green; font-size: 0.7em">(Optional)</span> </label>
						<div class="controls">
							<input type="text" class="span5" name="was_price" id="was_price" value="<?php echo $was_price; ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
							<select id="status" name="status">
								<option value="">Please Select Status</option>
								<option value="1" <?php echo ($status == "1") ? "selected" : ""; ?> >Active</option>
								<option value="0" <?php echo ($status == "0") ? "selected" : ""; ?> >In-active</option>
							</select>
						</div>
					</div>


					<div class="control-group hidden-phone">
						<label class="control-label" for="textarea2">Item Description</label>
						<div class="controls">
							<textarea class="cleditor" id="textarea2" name="item_description" rows="3"><?php echo $item_description; ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>store_items/manage" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>


<?php if ($big_pic != ""){ ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<img src="<?php echo base_url(); ?>uploads/items/big_pics/<?php echo $big_pic; ?>" class="img-responsive" alt="<?php echo $item_title; ?>">
			</div>
		</div>
	</div>
	<?php } ?>