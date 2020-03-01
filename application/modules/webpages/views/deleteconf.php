	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Delete Page</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form action="<?php echo base_url(); ?>webpages/delete/<?php echo $update_id; ?>" method="post">
					<p>Are you sure you want to delete the page? </p>
					<button type="submit" class="btn btn-danger">Delete Page</button>
					<a href="<?php echo base_url();?>webpages/manage" class="btn btn-primary">Cancel</a>
				</form>
			</div>
		</div>
	</div>