<div class="container">
	<h2>Members Login</h2>
</div>
<hr />
<div class="container">

<form method="POST">
	<div class="row">

		<div class="col-md-4 col-sm-12">
			<h3>Personal Info</h3>
			<div class="form-group">
			    <label for="btnphoto">Your Picture</label>
			    <img class="upload_prev" />
			    <div class="beforeupload">
				    <input type="file" class="form-control" id="btnphoto" name="file" />
				    <input type="hidden" name="photo" id="photo" />
					<div id="progress" class="progress">
				        <div class="progress-bar progress-bar-success"></div>
				    </div>
				</div>
			</div>
			<div class="form-group">
			    <label for="name">Fullname</label>
			    <input type="text" class="form-control" name="name" />
			</div>
			<div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" name="username" />
			</div>
			<div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" name="password" />
			</div>
			<div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" name="email" />
			</div>
			<div class="form-group">
			    <label for="mobile">Mobile</label>
			    <input type="text" class="form-control" name="mobile" />
			</div>
			<div class="form-group">
			    <label for="address">Address</label>
			    <textarea class="form-control" name="address"></textarea>			
			</div>		
		</div>
		<div class="col-md-3 col-sm-12">
			<h3>Geneology Info</h3>
			<div class="form-group">
			    <label for="_type">User Type</label>
			    <select name="_type" class="form-control">
					<option val="">--</option>
					<option val="Ultimate">Ultimate</option>
					<option val="Premier">Premier</option>
					<option val="Basic">Basic</option>
				</select>
			</div>
			<div class="form-group">
			    <label for="sid">Sponsor ID</label>
			    <input type="text" class="form-control" name="sid" value="<?php echo $afid ?>" />
			</div>
			<div class="form-group">
			    <label for="pid">Placement ID</label>
			    <input type="text" class="form-control" name="pid" />
			</div>
			<div class="form-group">
			    <label for="position">Position</label>
			    <select name="position" class="form-control">
					<option val="">--</option>
					<option val="Left">Left</option>
					<option val="Right">Right</option>
				</select>
			</div>
		</div>

		<div class="col-md-5 col-sm-12">
			<h3>Payment Info</h3>
			<div class="alert alert-info" role="alert">
				<small>
				For wire transfer payment type, send your payment to the following : <br />
				<strong>Kurt Roy R. Giger<br />
				09107441801<br />
				Blk 9 Lot 2 Freedom St. SGR Vilage Catalunan Grande Davao City</strong>
				<hr />
				For BPI bank payment type, send your payment to the following:<br />
				<strong>
				Account Name : Inlight Marketing <br />
				Account Number : 9459-2342-73
				</strong>
				</small>
			</div>
			<div class="form-group">
			    <label for="payment_type">Payment Type : </label>
			    <select name="payment_type" class="form-control">
					<option val="">--</option>
					<option>Activation Code</option>
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
				<label for="payed_amount">Payed Amount : </label>
				<input type="text" name="payed_amount" class="form-control" placeholder="Payed Amount" />
			</div>
			<div class="form-group">
				<i>For Activation Code payment type, please type your activation code below.</i><br />
				<label for="actcode">Activation Code : </label>
				<input type="text" name="actcode" class="form-control" placeholder="xxxxxx" />
			</div>
			<div class="form-group">
				<i>For Non Activation Code, please attach your pictured receipt below, max size accepted is 70KB :</i><br />
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
		</div>

	</div>
	<hr />
	<input type="submit" id="btn-continue" class="pull-right btn btn-primary " value="Proceed >" />
	<br style="clear:both;" />
	
	<hr />
</form>

</div>