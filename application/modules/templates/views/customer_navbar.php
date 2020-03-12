<?php
$segment_2 = $this->uri->segment(2);
?>

<div class="column is-4">
	<article class="panel is-danger">
		<p class="panel-heading has-text-centered">
			Member Setting Section
		</p>
		<div class="panel-block">
			<p class="control">
				<i class="fas fa-user" aria-hidden="true"></i>
				&nbsp; My Profile
			</p>
		</div>
		<a href="<?php echo base_url(); ?>member/account" class="panel-block <?php echo (($segment_2 == 'account') ? 'has-background-danger has-text-white' : ''); ?> ">
			<span class="panel-icon <?php echo (($segment_2 == 'account') ? 'has-text-white' : ''); ?>">
				<i class="fas fa-address-card" aria-hidden="true"></i>
			</span>
			My Details
		</a>

		<div class="panel-block">
			<p class="control">
				<i class="fas fa-envelope" aria-hidden="true"></i>
				&nbsp; Message
			</p>
		</div>
		<a href="<?php echo base_url(); ?>member/compose" class="panel-block <?php echo (($segment_2 == 'compose') ? 'has-background-danger has-text-white' : ''); ?>">
			<span class="panel-icon <?php echo (($segment_2 == 'compose') ? 'has-text-white' : ''); ?>">
				<i class="fas fa-plus-circle" aria-hidden="true"></i>
			</span>
			Create
		</a>
		<a href="<?php echo base_url(); ?>member/inbox" class="panel-block <?php echo (($segment_2 == 'inbox') ? 'has-background-danger has-text-white' : ''); ?>">
			<span class="panel-icon <?php echo (($segment_2 == 'inbox') ? 'has-text-white' : ''); ?>">
				<i class="fas fa-inbox" aria-hidden="true"></i>
			</span>
			Inbox
		</a>

		<a href="<?php echo base_url(); ?>member/sent" class="panel-block <?php echo (($segment_2 == 'sent') ? 'has-background-danger has-text-white' : ''); ?>">
			<span class="panel-icon <?php echo (($segment_2 == 'sent') ? 'has-text-white' : ''); ?>">
				<i class="fas fa-paper-plane" aria-hidden="true"></i>
			</span>
			Sent
		</a>
	</article>
</div>