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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Blog Entry Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if(isset($update_id)) {
				$url = base_url()."blog/update/".$update_id;
			} else {
				$url = base_url()."blog/create";
			}
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="date_published">Date input</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="date_published" name="date_published" value="<?php echo $date_published; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="blog_title">Blog Entry Title </label>
						<div class="controls">
							<input type="text" class="span5" name="blog_title" id="blog_title" value="<?php echo $blog_title; ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="blog_keywords">Blog Entry Keyword </label>
						<div class="controls">
							<textarea name="blog_keywords" id="blog_keywords"  class="span5"><?php echo $blog_keywords; ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="blog_descriptions">Blog Entry Description </label>
						<div class="controls">
							<textarea name="blog_descriptions" id="blog_descriptions"  class="span5"><?php echo $blog_descriptions; ?></textarea>
						</div>
					</div>

					<div class="control-group hidden-phone">
						<label class="control-label" for="blog_content">Blog Entry Content</label>
						<div class="controls">
							<textarea class="cleditor" id="blog_content" name="blog_content" rows="3"><?php echo $blog_content; ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="author">Author </label>
						<div class="controls">
							<input type="text" class="span5" name="author" id="author" value="<?php echo $author; ?>">
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>blog/manage" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>

<?php if(isset($update_id) && is_numeric($update_id)) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Blog Entry Option</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php if(isset($picture) && $picture == "") { ?>
					<a href="<?php echo base_url(); ?>blog/upload_image/<?php echo $update_id; ?>" class="btn btn-primary">Upload Blog Image</a>
				<?php } else { ?>
					<a href="<?php echo base_url(); ?>blog/delete_image/<?php echo $update_id; ?>" class="btn btn-danger">Delete Blog Image</a>
				<?php } ?>
				<a href="<?php echo base_url(); ?>blog/deleteconf/<?php echo $update_id; ?>" class="btn btn-danger">Delete Blog</a>
				<a href="<?php echo base_url(); ?>blog/view/<?php echo $update_id; ?>" class="btn btn-default">View Blog</a>
			</div>
		</div>
	</div>
<?php } ?>


<?php if(isset($picture) && $picture != "") { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Image</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<img src="<?php echo base_url(); ?>uploads/blogs/<?php echo $picture; ?>" alt="<?php echo $blog_title; ?>">
			</div>
		</div>
	</div>
	<?php } ?>