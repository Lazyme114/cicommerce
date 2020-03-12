<div class="column is-8">
	<div class="card">
		<header class="card-header has-background-danger">
			<p class="card-header-title has-text-white is-size-4">
				<i class="fas fa-inbox" aria-hidden="true"></i> &nbsp;
				Inbox
			</p>
		</header>

		<div class="card-content">
			<div class="content">
				<table class="table is-fullwidth is-striped">
					<tbody>
						<?php foreach ($query->result() as $row): ?>
							<tr>
								<?php if ($row->is_open == 0){ ?>
									<td width="5%">
										<i class="fas fa-envelope"  style="color: hsl(348, 100%, 61%)"></i>
									</td>
								<?php }else{ ?>
									<td width="5%">
										<i class="fas fa-envelope-open"></i>
									</td>
								<?php } ?>
								<td>
									<a href="<?php echo base_url(); ?>member/message_show/<?php echo $row->id; ?>" class="has-text-black">
										<b><?php echo $row->subject; ?></b>
									</a>
								</td>
								<td class="level-right">
									<?php echo date("jS F, Y", strtotime($row->created_at)); ?>
								</td>
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>