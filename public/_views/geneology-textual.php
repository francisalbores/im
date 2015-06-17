<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<div role="tabpanel">
	<?php Load::view('partials/geneology-menu', array('page'=>2)); ?>

<br /><br />
<h3>Summary</h3>
<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Total # Affiliates :</th>
				<td colspan="3"><?php echo $Total; ?></td>
			</tr>
			<tr>
				<th>Direct :</th>
				<td><?php echo $Direct; ?></td>
				<th>Indirect :</th>
				<td><?php echo $Indirect; ?></td>
			</tr>
			<tr>
				<th>Total # Left :</th>
				<td><?php echo $Left; ?></td>
				<th>Total # Right :</th>
				<td><?php echo $Right; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Direct Points:</th>
				<td><?php echo $Direct_points; ?></td>
			</tr>
			<tr>
				<th>Left Points:</th>
				<td><?php echo $Left_points; ?></td>
			</tr>
			<tr>
				<th>Right Points :</th>
				<td><?php echo $Right_points; ?></td>
			</tr>
		</table>
	</div>
</div>

<h3>Level Heirarchical</h3>
<table class="table">
	<thead>
		<tr>
			<th>Level</th>
			<th>Affiliate</th>
			<th>Upline</th>
			<th>Sponsor</th>
			<th>Register</th>
			<th>Type</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($QUERY as $k=>$v) : ?>
		<tr>
			<td><?php echo $v['_level'] ?></td>
			<td><?php echo "(".$v['uID'].") ".$v['uName'] ?></td>
			<td><?php echo "(".$v['pID'].") ".$v['pName'] ?></td>
			<td><?php echo "(".$v['sID'].") ".$v['sName'] ?></td>
			<td><?php echo $v['dateRegister'] ?></td>
			<td><?php echo $v['_type'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

</div>
<!-- End Editing Here -->

</div>
</div>
</div>