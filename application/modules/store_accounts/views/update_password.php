<h1><?php echo $heading; ?></h1>
<?php echo validation_errors("<p style='color: red'>", "</p>"); ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Password</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			$url = base_url()."store_accounts/update_password/".$update_id;
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="password">Password </label>
						<div class="controls">
							<input type="password" class="span5" name="password" id="password">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="repeat_password">Repeat Password </label>
						<div class="controls">
							<input type="password" class="span5" name="repeat_password" id="repeat_password">
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>store_accounts/update/<?php echo $update_id; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>