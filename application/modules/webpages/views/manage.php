<h1>Content Management System</h1>
<p>	
	<a href="<?php echo base_url(); ?>webpages/create" class="btn btn-primary">
		Create New Webpage
	</a>
</p>
<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white file"></i><span class="break"></span>Custom Webpages</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Sn.</th>
						<th>Page URL</th>
						<th>Page Title</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach($webpages->result() as $row) { 
						$edit_page_url = base_url()."webpages/update/".$row->id;
						$delete_page_url = base_url()."webpages/deleteconf/".$row->id;
						$view_page_url = base_url().$row->page_url;
						?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td class="center">
								<?php echo $view_page_url; ?>
							</td>
							<td class="center">
								<?php echo $row->page_title; ?>
							</td>
							<td class="center">
								<a class="btn btn-success" href="<?php echo $view_page_url; ?>">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?php echo $edit_page_url; ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
								<?php if ($row->id > 2): ?>
									
									<a class="btn btn-danger" href="<?php echo $delete_page_url; ?>">
										<i class="halflings-icon white trash"></i>  
									</a>
								<?php endif ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>