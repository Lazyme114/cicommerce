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

					<!-- <div class="control-group">
						<label class="control-label" for="fileInput">File input</label>
						<div class="controls">
							<input class="input-file uniform_on" id="fileInput" type="file">
						</div>
					</div>    -->       
					<div class="control-group hidden-phone">
						<label class="control-label" for="textarea2">Item Description</label>
						<div class="controls">
							<textarea class="cleditor" id="textarea2" name="item_description" rows="3"><?php echo $item_description; ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				</fieldset>
			</form>   

		</div>
	</div><!--/span-->

			</div><!--/row-->