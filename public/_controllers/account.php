<?php
include_once('admin.php');
class Account extends Admin{
	function FIRST(){
		$this->info();
	}
	function info(){
		Load::model('user');
		$User = new User();
		$info = $User->get_info();
		$sponsor = $User->get_sponsor();

		// only for account #1 case
		if(!$sponsor) $sponsor = array('s_ID'=>'n/a','s_name'=>'n/a');
		$info = array_merge($info, $sponsor);
		Load::view('info',$info);
	}
	function security(){
		Load::view('security');
	}
	function codes(){
		Load::model('user');
		$User = new User();
		$param['codes'] = $User->get_codes();
		Load::view('codes',$param);
	}
}