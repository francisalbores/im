<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<br /><br />
<h3>Request</h3>
<table class="table">
	<thead>
		<tr>
			<th>TID</th>
			<th>Name</th>
			<th>Request</th>
			<th>Account</th>
			<th>Request Date</th>
			<th>Receipt/Note</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $k=>$v): ?>
		<tr>
			<td><?php echo $v['ID'] ?></td>
			<td><?php echo "({$v['user_ID']}) {$v['name']}" ?></td>
			<td><?php echo $v['type'] ?></td>
			<td><?php echo $v['_type']; ?></td>
			<td><?php echo $v['date_trans'] ?></td>
			<td><?php echo $v['notes'] ?></td>
			<td><?php echo $v['status'] ?></td>
			<td><a href="#">Activate</a> | <a href="#">Activate As SF</a> | <a href="#">Decline</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<!-- End Editing Here -->

</div>
</div>