<h1 class="has-text-centered is-size-2">Register</h1>
<div class="columns">
	<div class="column is-2"></div>
	<div class="column is-8">

		<?php 
		if(isset($error)) {
			?>
			<div class="notification is-danger">
				<button class="delete"></button>
				<?php echo $error; ?>
			</div>
			<?php
		}


		?>


		<div class="box">
			<div class="container">
				<form action="<?php echo base_url(); ?>member/register" method="POST">
					<div class="columns">
						<div class="column is-half">
							<div class="field">
								<label class="label">First Name <span style="color: red;">*</span></label>
								<div class="control">
									<input class="input" type="text" placeholder="First Name" name="first_name" value="<?php echo $first_name;?>" required>
								</div>
							</div>
						</div>
						<div class="column is-half">
							<div class="field">
								<label class="label">Last Name <span style="color: red;">*</span></label>
								<div class="control">
									<input class="input" type="text" placeholder="Last Name" name="last_name" value="<?php echo $last_name;?>" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field">
						<label class="label">Username <span style="color: red;">*</span></label>
						<div class="control">
							<input class="input" type="text" placeholder="Username" name="username" value="<?php echo $username;?>" required>
						</div>
					</div>

					<div class="field">
						<label class="label">Email <span style="color: red;">*</span></label>
						<div class="control">
							<input class="input" type="email" placeholder="Email" name="email" value="<?php echo $email;?>" autocomplete="diasbled" required>
						</div>
					</div>

					<div class="columns">
						<div class="column is-half">
							<div class="field">
								<label class="label">Country</label>
								<div class="control">
									<input class="input" type="text" placeholder="Country" name="country" value="<?php echo $country;?>">
								</div>
							</div>
						</div>
						<div class="column is-half">
							<div class="field">
								<label class="label">Town </label>
								<div class="control">
									<input class="input" type="text" placeholder="Town" name="town" value="<?php echo $town;?>">
								</div>
							</div>
						</div>
					</div>

					<div class="columns">
						<div class="column is-half">
							<div class="field">
								<label class="label">Address 1 <span style="color: red;">*</span></label>
								<div class="control">
									<input class="input" type="text" placeholder="Address 1" name="address1" value="<?php echo $address1;?>" required>
								</div>
							</div>
						</div>
						<div class="column is-half">
							<div class="field">
								<label class="label">Address 2</label>
								<div class="control">
									<input class="input" type="text" placeholder="Address 2" name="address2" value="<?php echo $address2;?>">
								</div>
							</div>
						</div>
					</div>

					<div class="columns">
						<div class="column is-half">
							<div class="field">
								<label class="label">Phone <span style="color: red;">*</span></label>
								<div class="control">
									<input class="input" type="text" placeholder="Phone" name="telephone" value="<?php echo $telephone;?>" required>
								</div>
							</div>
						</div>
						<div class="column is-half">
							<div class="field">
								<label class="label">Postal Code </label>
								<div class="control">
									<input class="input" type="text" placeholder="Postal Code" name="postcode" value="<?php echo $postcode;?>">
								</div>
							</div>
						</div>
					</div>


					<div class="field">
						<label class="label">Password <span style="color: red;">*</span></label>
						<div class="control">
							<input class="input" type="password" placeholder="Password" name="password" required>
						</div>
					</div>
					<div class="field">
						<label class="label">Confirm Password <span style="color: red;">*</span></label>
						<div class="control">
							<input class="input" type="password" placeholder="Confirm Password" name="re_password" required>
						</div>
					</div>



					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input type="checkbox">
								I agree to the <a href="#">terms and conditions</a>
							</label>
						</div>
					</div>

					<div class="field is-grouped is-grouped-centered">
						<div class="control">
							<button class="button is-danger is-rounded" type="submit" name="submit" value="submit">Register</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
