<ul class="messagesList">
	<?php foreach ($query->result() as $row): ?>
		<li>
			<a href="<?php echo base_url(); ?>enquiries/show/<?php echo $row->id; ?>">
				<span class="from">
					<?php if ($row->is_open == 1){ ?>
						<i class="icon-envelope"></i>
					<?php } else { ?>
						<i class="icon-envelope-alt" style="color: orange;"></i>
					<?php } ?> 
					&emsp;
					<?php echo $this->store_accounts->_get_customer_name($row->sent_by); ?>
				</span>
				<span class="title">
					<?php echo $row->subject; ?>
				</span>
				<span class="date"><b><?php echo date("jS F, Y", strtotime($row->created_at)); ?></b></span>
			</a>
		</li>
	<?php endforeach ?>
</ul>