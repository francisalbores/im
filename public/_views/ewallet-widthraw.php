<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->
<div role="tabpanel">
	<?php Load::view('partials/ewallet-menu', array('page'=>1)); ?>

<br /><br />
	
	<div style="max-width:400px;">
		<form action="" method="POST">

			<h3>Widthraw Details</h3>

			<div class="form-group">
			    <label for="amount">Amount to widthraw</label>
			    <input type="text" class="form-control" name="amount" />
			</div>
			<div class="form-group">
			    <label for="pin">PIN</label>
			    <input type="password" class="form-control" name="pin" />
			</div>

			<input type="submit" id="btnsubmit" class="btn btn-primary" value="Send Request" />

		</form>
	</div>

<!-- End Editing Here -->

</div>
</div>
</div>