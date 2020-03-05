<h1>Manage Items</h1>
<p>	
	<a href="<?php echo base_url(); ?>store_accounts/create" class="btn btn-primary">
		Add New Item
	</a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white user"></i><span class="break"></span>Members</h2>
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
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
						<th>Company</th>
						<th>Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php $i = 0; foreach($store_accounts->result() as $row) { 
						$edit_account_url = base_url()."store_accounts/update/".$row->id;
						?>
						<tr>
							<td><?php echo ++$i; ?></td>
							<td class="center">
								<?php echo $row->first_name; ?>
							</td>
							<td class="center">
								<?php echo $row->last_name; ?>
							</td>
							<td class="center">
								<?php echo $row->username; ?>
							</td>
							<td>
								<?php echo $row->company; ?>
							</td>
							<td class="center">
								<?php echo date("Y-m-d", strtotime($row->created_at)); ?>
							</td>
							<td class="center">
								<!-- <a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a> -->
								<a class="btn btn-info" href="<?php echo $edit_account_url; ?>">
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