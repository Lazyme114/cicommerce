<?php $this->load->module('store_accounts'); ?>
<div class="row-fluid">
	<div class="box span3">
		<div class="box-header">
			<h2><i class="halflings-icon white envelope"></i><span class="break"></span>Internal Messaging Sys.</h2>
		</div>
		<div class="box-content">
			<div class="list-group">
				<a href="<?php echo base_url(); ?>enquiries/create" class="list-group-item list-group-item-action <?php echo (($folder_type == 'create') ? 'active' : ''); ?>">
					<span class="glyphicons <?php echo (($folder_type == 'create') ? 'white' : ''); ?> circle_plus" style="vertical-align: text-top;"><i></i></span>
					Create
				</a>
				<a href="<?php echo base_url(); ?>enquiries/inbox" class="list-group-item list-group-item-action <?php echo (($folder_type == 'inbox') ? 'active' : ''); ?>">
					<span class="glyphicons <?php echo (($folder_type == 'inbox') ? 'white' : ''); ?> inbox" style="vertical-align: text-top;"><i></i></span>
					Inbox
				</a>

				<a href="<?php echo base_url(); ?>enquiries/sent" class="list-group-item list-group-item-action <?php echo (($folder_type == 'sent') ? 'active' : ''); ?>">
					<span class="glyphicons <?php echo (($folder_type == 'sent') ? 'white' : ''); ?> inbox_out" style="vertical-align: text-top;"><i></i></span>
					Sent
				</a>
			</div>
		</div>
	</div><!--/span-->

	<div class="box span9">
		<div class="box-header">
			<h2>
				<i class="halflings-icon white inbox"></i>
				<span class="break"></span>
				<?php echo ucfirst($folder_type); ?>
			</h2>
		</div>
		<div class="box-content">
			
			<?php if (isset($errors)): ?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $errors; ?>
				</div>
			<?php endif ?>

			<?php 
			switch ($folder_type) {
				case 'inbox':
				$this->load->view('inbox');
				break;

				case 'create':
				$this->load->view('create');
				break;

				case 'sent':
				$this->load->view('sent');
				break;

				case 'show':
				$this->load->view('show');
				break;
				
				default:
				$this->load->view('inbox');
				break;
			}
			?>
		</div>
	</div>
</div>