<h1>Manage Homepage Offers</h1>
<p>	
	<a href="<?php echo base_url(); ?>homepage_blocks/create" class="btn btn-primary">
		Create New homepage offer
	</a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Existing Homepage Offers</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php 
			echo Modules::run('homepage_blocks/_draw_sortable_list');
			?>
<!-- 			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Sn.</th>
						<th>Homepage Offer Title</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php $this->load->module("homepage_blocks"); ?>
					<?php foreach($homepage_blocks->result() as $row) { 
						$edit_homepage_offers_url = base_url()."homepage_blocks/update/".$row->id;

						?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td class="center">
								<?php echo $row->block_title; ?>
							</td>
							<td class="center">
								<a class="btn btn-info" href="<?php echo $edit_homepage_offers_url; ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table> -->
		</div>
	</div>
</div>