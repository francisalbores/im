<?php
include_once('admin.php');
class Request extends Admin{
	function FIRST(){
		$this->display();
	}
	function display(){
		Load::model('transaction');
		$Transaction = new Transaction();
		$param['data'] = $Transaction->viewAll();
		Load::view('request',$param);
	}
}