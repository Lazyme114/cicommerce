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
	<?php $this->load->module("homepage_blocks"); ?>
	<?php foreach($homepage_blocks->result() as $row) { 
		$edit_homepage_offers_url = base_url()."homepage_blocks/update/".$row->id;

		?>
		<li class="sort" id="<?php echo $row->id; ?>">
			<div class="row-fluid">
				<div class="span1">
					<i class="icon-sort"></i>
				</div>
				<div class="span4">
					<?php echo $row->block_title; ?>
				</div>
				<div class="span1">
					<a class="btn btn-info" href="<?php echo $edit_homepage_offers_url; ?>">
						<i class="halflings-icon white edit"></i>  
					</a>
				</div>
			</div>
		</li>
	<?php } ?>


</ul>