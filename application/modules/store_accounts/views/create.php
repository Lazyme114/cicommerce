<h1>
	<?php echo $heading; ?>
</h1>

<?php echo validation_errors("<p style='color: red'>", "</p>"); ?>

<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
	</div>

<?php endif; ?>

<?php if(isset($update_id) && is_numeric($update_id)) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<a href="<?php echo base_url(); ?>store_accounts/update_password/<?php echo $update_id; ?>" class="btn btn-primary">Update Password</a>
				<a href="<?php echo base_url(); ?>store_accounts/deleteconf/<?php echo $update_id; ?>" class="btn btn-danger">Delete Account</a>
			</div>
		</div>
	</div>
<?php } ?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if(isset($update_id)) {
				$url = base_url()."store_accounts/update/".$update_id;
			} else {
				$url = base_url()."store_accounts/create";
			}
			?>
			<form class="form-horizontal" action="<?php echo $url; ?>" method="post">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="first_name">First Name </label>
						<div class="controls">
							<input type="text" class="span5" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="last_name">Last Name </label>
						<div class="controls">
							<input type="text" class="span5" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="username">Userame </label>
						<div class="controls">
							<input type="text" class="span5" name="username" id="username" value="<?php echo $username; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="company">Company </label>
						<div class="controls">
							<input type="text" class="span5" name="company" id="company" value="<?php echo $company; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="address1">Address1 </label>
						<div class="controls">
							<input type="text" class="span5" name="address1" id="address1" value="<?php echo $address1; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="address2">Address2 </label>
						<div class="controls">
							<input type="text" class="span5" name="address2" id="address2" value="<?php echo $address2; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="town">Town </label>
						<div class="controls">
							<input type="text" class="span5" name="town" id="town" value="<?php echo $town; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="country">Country </label>
						<div class="controls">
							<input type="text" class="span5" name="country" id="country" value="<?php echo $country; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="postcode">Postcode </label>
						<div class="controls">
							<input type="text" class="span5" name="postcode" id="postcode" value="<?php echo $postcode; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="telephone">Telephone </label>
						<div class="controls">
							<input type="text" class="span5" name="telephone" id="telephone" value="<?php echo $telephone; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email </label>
						<div class="controls">
							<input type="text" class="span5" name="email" id="email" value="<?php echo $email; ?>">
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Save changes</button>
						<a href="<?php echo base_url(); ?>store_accounts/manage" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>   
		</div>
	</div>
</div>