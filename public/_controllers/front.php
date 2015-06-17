<?php

class Front{
	function __construct(){
		// always called first
		session_start();
		Load::view('partials/header');
	}
	function end(){
		// always called last
		Load::view('partials/footer');
	}
	function FIRST(){
		// first to call
		$this->home();
	}

	private function home(){
		Load::view('home');
	}

	public function about(){
		Load::view('about');
	}
	public function investors(){
		Load::view('investors');
	}
	public function products_services(){
		Load::view('products_services');
	}
	public function login(){
		$param=array();
		if(isset($_POST['username'])) {
			Load::model('user');
			$User = new User();			
			if( $User->validate_login($_POST) )
				Load::redirect('admin/dashboard');
			else
				$param = array("msg"=>"Wrong username and password.");
		}
		Load::view('login',$param);
		Load::hook_footer('signin');
	}
	public function join(){
		$this->signup();
	}
	public function signup(){
		if(isset($_POST['username'])) {
			Load::model('user');
			$User = new User();

			$info = $_POST;
			$User->insert($info);
			Load::redirect('admin/dashboard'); // if successfull
			exit();
		}
		else{
			$param = array();
			$param['afid'] = (isset($_GET['afid'])) ? $_GET['afid'] : DEFAULT_AFID ;
			Load::view('signup',$param);
			Load::hook_footer('signup');
		}
	}
	public function forgotpassword(){
		if(isset($_POST['email'])) {
			$param['title'] = "Thank you very much!";
			$param['content'] = "You should now recieve a password reset link in your email. <br /> Haven't recieved the email? Try to resend again. <br /> <hr />";
			Load::view('thankyou',$param);
		}
		Load::view('forgotpassword'); // always shows :)
	}	
}