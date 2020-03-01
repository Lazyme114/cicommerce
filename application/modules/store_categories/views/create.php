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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Category Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if(isset($update_id)) {
				$url = base_url()."store_categories/update/".$update_id;
			} else {
				$url = base_url()."store_categories/create";
			}
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="parent_id">Parent Category <span style="color: green; font-size: 0.7em">(Optional)</span></label>
						<div class="controls">
							<select id="parent_id" name="parent_id">
								<option value="">Please Select Parent Category</option>
								<?php foreach ($categories->result() as $row): ?>
									<option value="<?php echo $row->id; ?>" <?php echo (($parent_id == $row->id) ? "selected" : ""); ?> ><?php echo $row->category_title; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="category_title">Category Title </label>
						<div class="controls">
							<input type="text" class="span5" name="category_title" id="category_title" value="<?php echo $category_title; ?>">
						</div>
					</div>


					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>store_categories/manage" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>
