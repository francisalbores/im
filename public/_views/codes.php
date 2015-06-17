<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->

<div role="tabpanel">
<?php Load::view('partials/account-menu',array('page'=>3)); ?>
	
<h3>Status : Active</h3>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Code</th>
			<th>Date Bought</th>
			<th>Status</th>
			<th>Used By</th>
			<th>Date Used</th>
		</tr>
	</thead>
	<tbody>
		<?php if(empty($codes)) : ?>
			<tr><td colspan="3">No record</td></td>
		<?php else: ?>
			<?php foreach($codes as $k=>$v) : ?>
			<tr>
				<td><?php echo $v['codes'] ?></td>				
				<td><?php echo $v['buy-date'] ?></td>
				<td><?php echo $v['status'] ?></td>
				<td><?php echo $v['used_by'] ?></td>
				<td><?php echo $v['use-date'] ?></td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>	
</table>
  

<!-- End Editing Here -->

</div>
</div>
</div>