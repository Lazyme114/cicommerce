<ul class="dashboard-list metro">
	<li class="green" style="padding: 20px;">
		<h1><strong><?php echo $query->subject; ?></strong> </h1>            
	</li>
	<li style="padding: 20px;">
		<div class="span6">
			<i class="icon-user"></i> <?php echo $customer_name; ?> &nbsp;
			<span class="label label-success"><?php echo $mail_type; ?></span>
		</div>
		<div class="span6 text-right">
			<i class="icon-time"></i>
			<b><?php echo date("jS F, Y", strtotime($query->created_at)); ?></b>
		</div>
		<div class="clearfix"></div>
		<div class="container" style="margin-top: 25px;">
			<?php echo $query->message; ?>
		</div>
	</li>
	
</ul>