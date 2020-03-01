<h1>
	<?php echo $heading; ?>
</h1>

<?php echo validation_errors("<p style='color: red'>", "</p>"); ?>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Page Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if(isset($update_id)) {
				$url = base_url()."webpages/update/".$update_id;
			} else {
				$url = base_url()."webpages/create";
			}
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="page_title">Page Title </label>
						<div class="controls">
							<input type="text" class="span5" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="page_keywords">Page Keyword </label>
						<div class="controls">
							<textarea name="page_keywords" id="page_keywords"  class="span5"><?php echo $page_keywords; ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="page_descriptions">Page Description </label>
						<div class="controls">
							<textarea name="page_descriptions" id="page_descriptions"  class="span5"><?php echo $page_descriptions; ?></textarea>
						</div>
					</div>




					<div class="control-group hidden-phone">
						<label class="control-label" for="page_content">Page Content</label>
						<div class="controls">
							<textarea class="cleditor" id="page_content" name="page_content" rows="3"><?php echo $page_content; ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>webpages/manage" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>
