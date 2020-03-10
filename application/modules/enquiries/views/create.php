<form class="replyForm" method="post" action="<?php echo base_url(); ?>enquiries/create">
	<fieldset>
		<div class="control-group">
			<div class="controls">
				<select id="sent_to" name="sent_to" class="span12" data-rel="chosen">
					<option value="">Select User</option>
					<?php foreach ($query->result() as $row): ?>
						<option value="<?php echo $row->id ?>">
							<?php echo $row->first_name ." ". $row->last_name . "( " . $row->username . " )"; ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<input type="text" class="form-control span12" name="subject" placeholder="Enter Subject">
		</div>


		<textarea tabindex="3" class="input-xlarge span12" id="message" name="message" rows="12" placeholder="Enter your message"></textarea>

		<div class="actions">
			<button tabindex="3" type="submit" class="btn btn-success" name="submit" value="submit">Send message</button>
		</div>
	</fieldset>
</form>