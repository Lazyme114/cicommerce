<?php 
$url = base_url()."blog/upload_image/".$update_id;

?>

<h1><?php echo $heading; ?></h1>
<?php 
if(isset($errors)) {
	foreach($errors as $error) {
		echo "<span style='color: red;'>".$error."</span>";
	}
}

?>

<?php if($this->session->flashdata("success")): ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Image</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="image">Image</label>
						<div class="controls">
							<input class="input-file uniform_on" id="image" type="file" name="image">
						</div>
					</div>  

					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Upload</button>
						<a href="<?php echo base_url(); ?>blog/update/<?php echo $update_id;?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form> 
		</div>
	</div>
</div>