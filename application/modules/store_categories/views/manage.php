<h1>Manage Categories</h1>
<p>	
	<a href="<?php echo base_url(); ?>store_categories/create" class="btn btn-primary">
		Add New Category
	</a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Existing Categories</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php 
			echo Modules::run('store_categories/_draw_sortable_list', $parent_cat_id);
			?>
	<!-- 		<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Sn.</th>
						<th>Category Title</th>
						<th>Parent Category</th>
						<th>Sub Categories</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php $this->load->module("store_categories"); ?>
					<?php foreach($store_categories->result() as $row) { 
						$edit_categories_url = base_url()."store_categories/update/".$row->id;
						$sub_categories_url = base_url()."store_categories/manage/".$row->id;
						if($row->parent_id == 0) {
							$parent_category_title = "-";
						} else {
							$parent_category_title = $this->store_categories->_get_category_title($row->parent_id);
						}
						$sub_categories = $this->store_categories->_count_sub_categories($row->id);
						?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td class="center">
								<?php echo $row->category_title; ?>
							</td>
							<td class="center">
								<?php echo $parent_category_title; ?>
							</td>
							<td class="center">
								<a class="btn btn-default" href="<?php echo $sub_categories_url; ?>">
									<i class="halflings-icon white eye-open"></i>&emsp;
									<?php echo $sub_categories. (($sub_categories == 1 || $sub_categories == 0) ? " Category" : " Categories"); ?>
								</a>
							</td>
							<td class="center">
								<a class="btn btn-info" href="<?php echo $edit_categories_url; ?>">
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