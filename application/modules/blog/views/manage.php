<h1>Content Management System</h1>
<p>	
	<a href="<?php echo base_url(); ?>blog/create" class="btn btn-primary">
		Create New Blog Entry
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
			<h2><i class="halflings-icon white file"></i><span class="break"></span>Custom Blog Entry</h2>
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
						<th>Blog Entry URL</th>
						<th>Blog Entry Title</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach($blog->result() as $row) { 
						$edit_blog_url = base_url()."blog/update/".$row->id;
						$delete_blog_url = base_url()."blog/deleteconf/".$row->id;
						$view_blog_url = base_url().$row->blog_url;
						?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td class="center">
								<?php echo $view_blog_url; ?>
							</td>
							<td class="center">
								<?php echo $row->blog_title; ?>
							</td>
							<td class="center">
								<a class="btn btn-success" href="<?php echo $view_blog_url; ?>">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?php echo $edit_blog_url; ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
								
								<a class="btn btn-danger" href="<?php echo $delete_blog_url; ?>">
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