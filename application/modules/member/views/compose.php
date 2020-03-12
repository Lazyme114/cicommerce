<div class="column is-8">
	<div class="card">
		<header class="card-header has-background-danger">
			<p class="card-header-title has-text-white is-size-4">
				<i class="fas fa-plus-circle" aria-hidden="true"></i> &nbsp;
				Compose
			</p>
		</header>

		<div class="card-content">
			<div class="content">
				<form action="<?php echo base_url(); ?>message/compose" method="POST">
					<fieldset>
						<div class="field">
							<div class="control">
								<input class="input" type="text" name="subject" placeholder="Enter subject">
							</div>
						</div>
						<div class="field">
							<div class="control">
								<textarea class="textarea" placeholder="Explain how we can help you"></textarea>
							</div>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<button class="button is-primary" type="submit" name="submit" value="submit">
										Send message
									</button>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>