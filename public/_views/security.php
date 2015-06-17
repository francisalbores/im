<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->

<div role="tabpanel">
<?php Load::view('partials/account-menu',array('page'=>2)); ?>
	
<div class="row">
  <div class="col-xs-12 col-md-6">
	<form action="" method="POST">

		<h3>Change Password</h3>

		<div class="form-group">
		    <label for="username">Old Password</label>
		    <input type="password" class="form-control" name="oldpass" />
		</div>
		<div class="form-group">
		    <label for="username">New Password</label>
		    <input type="password" class="form-control" name="newpass" />
		</div>
		<div class="form-group">
		    <label for="username">Old Password</label>
		    <input type="password" class="form-control" name="newpass2" />
		</div>

		<input type="submit" class="btn btn-primary" value="Change Password" />
	</form>
  </div>
  <div class="col-xs-12 col-md-6">
  	<form action="" method="POST">
		
		<h3>Change PIN</h3>

		<div class="form-group">
		    <label for="oldpin">Old PIN</label>
		    <input type="password" class="form-control" name="oldpin" />
		</div>
		<div class="form-group">
		    <label for="newpin">New PIN</label>
		    <input type="password" class="form-control" name="newpin" />
		</div>
		<div class="form-group">
		    <label for="newpin2">Retype New PIN</label>
		    <input type="password" class="form-control" name="newpin2" />
		</div>

		<input type="submit" class="btn btn-default" value="Change PIN" />
	</form>
  </div>
</div>

</div>
<!-- End Editing Here -->

</div>
</div>
</div>