<?php 
if(isset($errors)) {
	?>
	<div class="notification is-danger">
		<button class="delete"></button>
		<?php echo $errors; ?>
	</div>
	<?php
}
?>

<section class="hero is-success is-fullheight" style="margin-bottom: 20px;">
	<div class="hero-body">
		<div class="container has-text-centered">
			<div class="column is-4 is-offset-4">
				<h3 class="title has-text-black">Login</h3>
				<hr class="login-hr">
				<p class="subtitle has-text-black">Please login to proceed.</p>
				<div class="box">
					<figure class="avatar">
						<!-- <img src="https://placehold.it/128x128"> -->
						<img src="<?php echo base_url(); ?>assets/frontend/img/avatar.png" alt="" width="128">
					</figure>
					<form>
						<div class="field">
							<div class="control">
								<input class="input" type="username" placeholder="Your Email" autocomplete="disabled" name="username">
							</div>
						</div>

						<div class="field">
							<div class="control">
								<input class="input" type="password" placeholder="Your Password" name="password">
							</div>
						</div>
						<div class="field">
							<label class="checkbox">
								<input type="checkbox">
								Remember me
							</label>
						</div>
						<button class="button is-block is-info is-large is-fullwidth">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
					</form>
				</div>
				<p class="has-text-grey">
					<a href="<?php echo base_url(); ?>member/register">Sign Up</a> &nbsp;·&nbsp;
					<a href="<?php echo base_url(); ?>member/forget_password">Forgot Password</a>
				</p>
			</div>
		</div>
	</div>
</section>
