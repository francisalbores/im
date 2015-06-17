<div class="col-sm-9 col-md-10 main">

<!--  Start Editing Here  -->


<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Welcome to <strong>Inlight Mktg Backoffice</strong></h1>
			<p>This is your back office. All you need to do now is share your Inlight Marketing Affiliate link to as many people as possible. The more people you share it with, the bigger your chances you will attain your dreams and aspirations.</p>
			<hr />
			<h3>Accumulated Commissions</h3>
			<p>Weekly : <?php echo Func::to_money($weekly) ?></p>
			<p>Monthly : P0.00</p>
			<hr />
			<div class="alert alert-info">
				Affiliate Link : <?php echo $alink ?>
			</div>
			<hr />
			<h3>Top 10 Earners</h3>
			<p>Be one of the top 10 earners nation wide and we will be giving gifts for you! Plus your name will be published here. </p>
			<hr />
			<h3><i class="fa fa-binoculars"></i> Jobs Here...</h3>
			<p>We have incorporated latest job offers for you into our database within the Philippines.</p>
			<a href="<?php echo SITE_URL ?>/jobs" class="btn btn-primary btn-lg">Start Finding Jobs!</a>
		</div>
		<div class="col-md-6">
			<h3>News and Updates</h3>
			<?php Dashboard::news_and_updates(); ?>
		</div>
	</div>
</div>


<!-- End Editing Here -->

</div>
</div>
</div>
