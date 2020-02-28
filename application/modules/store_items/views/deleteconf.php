	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Delete Item</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form action="<?php echo base_url(); ?>store_items/delete/<?php echo $update_id; ?>" method="post">
					<p>Are you sure you want to delete the item? </p>
					<button type="submit" class="btn btn-danger">Delete Item</button>
					<a href="<?php echo base_url();?>store_items/update/<?php echo $update_id ?>" class="btn btn-primary">Cancel</a>
				</form>
			</div>
		</div>
	</div>