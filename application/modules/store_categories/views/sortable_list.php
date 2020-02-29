<style>
	.sort {
		list-style-type: none;
		border: 1px #ccc solid;
		color: #333;
		padding: 10px;
		margin-bottom: 10px;
	}
</style>


<ul id="sortlist">
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
		<li class="sort" id="<?php echo $row->id; ?>">
			<div class="row-fluid">
				<div class="span1">
					<i class="icon-sort"></i>
				</div>
				<div class="span4">
					<?php echo $row->category_title; ?>
				</div>
				<div class="span3">
					<?php echo $parent_category_title; ?>
				</div>
				<div class="span3">
					<a class="btn btn-default" href="<?php echo $sub_categories_url; ?>">
						<i class="halflings-icon white eye-open"></i>&emsp;
						<?php echo $sub_categories. (($sub_categories == 1 || $sub_categories == 0) ? " Category" : " Categories"); ?>
					</a>
				</div>
				<div class="span1">
					<a class="btn btn-info" href="<?php echo $edit_categories_url; ?>">
						<i class="halflings-icon white edit"></i>  
					</a>
				</div>
			</div>
		</li>
	<?php } ?>


</ul>