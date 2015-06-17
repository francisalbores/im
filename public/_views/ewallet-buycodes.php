<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<div role="tabpanel">
	<?php Load::view('partials/ewallet-menu', array('page'=>3)); ?>

	<div style="max-width:400px;">
		<form action="" method="POST">
			<input type="hidden" name="amount" id="amount" />
			<h3>Buy Codes</h3>		
			<div class="form-group">
			    <label for="source">Source</label>
			    <select class="form-control" name="source" id="source">
					<option val="">-</option>
					<option>Commission Deduction</option>
					<optgroup label="Bank">
						<option>BPI</option>
					</optgroup>
					<optgroup label="Wire Transfer">
						<option>Palawan</option>
						<option>Western Union</option>
						<option>Cebuana</option>
						<option>MLHuillier</option>
						<option>RD Pawnship</option>
						<option>LBC</option>
					</optgroup>
				</select>
			</div>	
			<div class="form-group">
			    <label for="acc_type">Code Type</label>
			    <select class="form-control" name="acc_type" id="acc_type">
					<option val="">-</option>
					<option val="Ultimate">Ultimate</option>
					<option val="Premier">Premier</option>
					<option val="Basic">Basic</option>
				</select>
			</div>
			<div class="form-group">
			    <label for="howmany">How many activation codes?</label>
			    <input type="text" class="form-control" name="howmany" id="howmany" />
			</div>			
			<div class="form-group">
				<i>For Non Commission Deduction type, please attach your pictured receipt below, max size accepted is 70KB :</i><br />
				<label for="btnpayment_receipt">Receipt : </label>
				<img class="upload_prev" />
			    <div class="beforeupload">
					<input type="file" name="file" id="btnpayment_receipt" class="form-control" />
					<input type="hidden" name="payment_receipt" id="payment_receipt" />
					<div id="progress2" class="progress">
				        <div class="progress-bar progress-bar-success"></div>
				    </div>
				</div>
			</div>	
			<p><input type="checkbox" required /> <span id="agreeNote"></span> Are you sure about this? </p>
			<input type="submit" id="btnsubmit" class="btn btn-primary" value="Buy" />
	</form>
<!-- End Editing Here -->

</div>
</div>
</div>