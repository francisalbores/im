<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<div role="tabpanel">
	<?php Load::view('partials/ewallet-menu', array('page'=>0)); ?>

<br /><br />
	<h3>Your current balance : <?php echo Func::to_money($current) ?></h3>
	<hr />
	<h3>Accumulated Commission</h3>
	<b>Weekly : <?php echo Func::to_money($weekly) ?></b><br />
	<b>Monthly : P0.00</b><br />
	<hr />

	<h3>Recent transactions</h3>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
				<th>Transaction Type</th>
				<th>Amount</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($record)>0) : ?>
				<?php
				if($record) :
					foreach($record as $k=>$v) : ?>
					<tr>
						<td><?php echo $v['date_trans'] ?></td>
						<td><?php echo $v['type'] ?></td>
						<td><?php echo Func::to_money($v['amount']) ?></td>
						<td><?php echo $v['status'] ?></td>
					</tr>
					<?php endforeach;
				else: ?>
					<tr>
						<td colspan="4">No record yet</td>
					</tr>
				<?php
				endif;
				?>
			<?php else: ?>
				<tr>
					<td colspan="4">No record yet</td>
				</tr>
			<?php endif; ?>

		</tbody>
	</table>
</div>
<!-- End Editing Here -->

</div>
</div>
</div>



