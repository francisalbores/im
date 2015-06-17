<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<div role="tabpanel">
	<?php Load::view('partials/ewallet-menu', array('page'=>2)); ?>

<br /><br />
<div class="row">
	<div class="col-md-6">
		<form action="" method="POST">
			<input type="hidden" name="amount" id="amount" />
			<h3>Add Account Details</h3>

			<div class="form-group">
			    <label for="acc_type">Account Type</label>
			    <select class="form-control" name="acc_type" id="acc_type">
					<option val="">-</option>
					<option val="Ultimate">Ultimate</option>
					<option val="Premier">Premier</option>
					<option val="Basic">Basic</option>
				</select>
			</div>
			<div class="form-group">
			    <label for="pid">Placement ID</label>
			    <input class="form-control" type="text" name="pid" />
			</div>
			<div class="form-group">
			    <label for="position">Position</label>
			    <select class="form-control" name="position">
					<option val="">-</option>
					<option val="Left">Left</option>
					<option val="Right">Right</option>
				</select>
			</div>
			<div class="form-group">
			    <label for="username">Username</label>
			    <input class="form-control" type="text" name="username" />
			</div>
			<p><input type="checkbox" required /> <span id="agreeNote"></span> Are you sure about this? </p>
			<input class="btn btn-primary" id="btnsubmit" type="submit" value="Add Account" />

		</form>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning">
			<h3>Important Note :</h3>
			<ul>
				<li>Each members should only have 7 maximum accounts.</li>
				<li>Crossline registration is prohibited.</li>
				<li>No return policy upon submitting the transaction.</li>	
				<li>Any suspicious activity that will treat the system will be subjected to legal action.</li>			
			</ul>
		</div>
	</div>
</div>

<!-- End Editing Here -->

</div>
</div>
</div>