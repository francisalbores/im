<div class="container">
	<h2>Members Login</h2>
</div>
<hr />
<div class="container" style="max-width:400px;">

<form method="POST">
  <?php if(isset($msg)) : ?>
    <div id="errmsg" class="alert alert-danger alert-dismissible"><?php echo $msg ?></div>
  <?php endif; ?>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  
  <button class="btn btn-primary" type="submit" class="btn btn-default">Login</button>
  <hr />
  <a href="/forgotpassword">Forgot Password</a>
</form>

<p>Not yet a member? <br>Watch the <a href="<?php echo SITE_URL ?>/signup">opportunity and register</a>.</p>

</div>
<hr />
<div id="blurbs">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-desktop"></i>
        <h5>Done For You Sales Videos</h5>
        <p>Not good in selling? No problem! Let us do the hard work for you.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-calendar"></i>
        <h5>Life Changing Events</h5>
        <p>We pay the highest percentage of affiliate commission out there.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-coffee"></i>
        <h5>AutoFill Binary System</h5>
        <p>With our AutoFill functionality, we use the best system to make you earn more in less time.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-group"></i>
        <h5>Advance Geneology</h5>
        <p>With integrated avatar and messaging system, our geneology system is the most advanced among other network marketing services.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-newspaper-o"></i>
        <h5>Updated News</h5>
        <p>Our free news updates are automated to fetch the latest news to keep you updated on what’s going in our country.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-tasks"></i>
        <h5>Job Finder</h5>
        <p>Our free online job finder helps you look for the job openings nationwide.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-support"></i>
        <h5>Chat Support</h5>
        <p>Connect with us in Facebook and we’ll help you for any problems regarding the business.</p>
      </div>
      <div class="col-md-3 col-sm-6">
        <i class="fa fa-rocket"></i>
        <h5>Systematic Marketing</h5>
        <p>We have the most advanced and proven system of marketing that all you need to do is follow the steps, learn and earn.</p>
      </div>
    </div>
  </div>
</div>
<hr />
