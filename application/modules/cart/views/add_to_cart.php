<style type="text/css">
	.is-borderless td, .table th {
		border: none !important;
	}
</style>

<div class="card">
	<div class="card-content">
		<div class="content">
			<table class="table is-fullwidth is-borderless">
				<?php if ($colors->num_rows() > 0): ?>
					<tr>
						<th>Color:</th>
						<td>
							<div class="columns">
								<div class="column is-10">
									<div class="select">
										<select>
											<option>Select...</option>
											<?php foreach ($colors->result() as $color): ?>
												<option value="<?php echo $color->id; ?>"><?php echo $color->color; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
						</td>
					</tr>
				<?php endif ?>

				<?php if ($sizes->num_rows() > 0): ?>
					<tr>
						<th>Size:</th>
						<td>
							<div class="columns">
								<div class="column is-10">
									<div class="select">
										<select>
											<option>Select...</option>
											<?php foreach ($sizes->result() as $size): ?>
												<option value="<?php echo $size->id; ?>"><?php echo $size->size; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
						</td>
					</tr>
				<?php endif ?>
				<tr>
					<th>
						<div class="field-label is-normal">
							<label class="label">Qty:</label>
						</div>
					</th>
					<td>
						<div class="columns">
							<div class="column is-8">
								<input class="input" type="number" min="1">
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<footer class="card-footer">
		<a href="#" class="card-footer-item button is-primary">
			<i class="fa fa-shopping-cart"></i>&emsp; Add to Cart
		</a>
	</footer>
</div>