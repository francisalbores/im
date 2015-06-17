<?php
include_once('admin.php');
class Memberdb extends Admin{
	function FIRST(){
		$this->display();
	}
	function display(){
		
		Load::view('member_db');
	}
}