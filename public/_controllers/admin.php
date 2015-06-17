<?php
class Admin{
	function __construct(){
		// always called first
		if(!isset($_SESSION)){session_start();}
		$data = array(
				'name'=>$_SESSION['name'],
				'photo'=>$_SESSION['photo'],
				'acc_type'=>$_SESSION['user_type']
			);
		if(!isset($_GET['ajax'])){
			Load::view('partials/admin-header',$data);
			Load::view('partials/admin-sidebar');	
		}		
	}
	function end(){
		// always called last
		Load::view('partials/admin-footer');
	}
	function logout(){
		session_destroy();
		header("Location:".SITE_URL);
	}
	function FIRST(){
		// first to call
		$this->dashboard();
	}
	function dashboard(){
		Load::controller('dashboard');
		
	}
	function ewallet(){
		Load::controller('ewallet');
	}
	function geneology(){
		Load::controller('geneology');
	}
	function library(){
		Load::controller('library');
	}
	function jobs(){
		Load::controller('jobs');
	}
	function account(){
		Load::controller('account');
	}

	// special

	function request(){
		Load::controller('request');
	}
	function db(){
		Load::controller('memberdb');
	}
	function bstatus(){
		Load::controller('bstatus');
	}
}