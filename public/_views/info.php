<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->

<div role="tabpanel">
<?php Load::view( 'partials/account-menu' , array('page'=>1) ); ?>

	<div style="max-width:400px;">
		<form action="" method="POST">
			<div class="form-group">
			    <label for="btnphoto">Your Picture</label><br />
			    <img class="upload_prev" src="<?php echo SITE_URL ?>/uploads/<?php echo $photo ?>" width="300" />
			    <br /><br />
			    <input type="file" class="" id="btnphoto" name="file" />
			    <input type="hidden" name="photo" id="photo" />
				<div id="progress" class="progress">
			        <div class="progress-bar progress-bar-success"></div>
			    </div>		
			</div>
			<div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />
			</div>
			<div class="form-group">
			    <label for="name">Fullname</label>
			    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" />
			</div>
			<div class="form-group">
			    <label for="address">Address</label>
			    <textarea class="form-control" name="address"><?php echo $address ?></textarea>			
			</div>
			<div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" name="email" value="<?php echo $email ?>" />
			</div>
			<div class="form-group">
			    <label for="mobile">Mobile</label>
			    <input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>" />
			</div>
			Sponsor : (<?php echo $s_ID ?>) <?php echo $s_name ?> <br />
			<hr />
			<input type="submit" value="Save" />
		</form>
	</div>
</div>
<!-- End Editing Here -->

</div>
</div>
</div>