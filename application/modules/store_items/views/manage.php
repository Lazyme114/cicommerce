<h1>Manage Items</h1>
<p>	
	<a href="<?php echo base_url(); ?>store_items/create" class="btn btn-primary">
		Add New Item
	</a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white shopping-cart"></i><span class="break"></span>Items Inventory</h2>
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
						<th>Item Title</th>
						<th>Price</th>
						<th>Was Price</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach($store_items->result() as $row) { 
						$edit_item_url = base_url()."store_items/update/".$row->id;
						?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td class="center">
								<?php echo $row->item_title; ?>
							</td>
							<td class="center">
								<?php echo $row->item_price; ?>
							</td>
							<td>
								<?php echo $row->was_price; ?>
							</td>
							<td class="center">
								<?php if($row->status == 1) { ?>
									<span class="label label-success">Active</span>
								<?php } else { ?>
									<span class="label label-default">Inactive</span>
								<?php } ?>
							</td>
							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?php echo $edit_item_url; ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>