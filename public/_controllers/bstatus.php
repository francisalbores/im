<?php
include_once('admin.php');
class Bstatus extends Admin{
	function FIRST(){
		$this->display();
	}
	function display(){
		Load::model('company');
		$Company = new Company();

		$param['income'] = $Company->get_income();
		$param['expense'] = $Company->get_expense();
		//$param['onhand'] = $this->get_cashonhand();
		//$param['aff_money'] = $this->get_affmoney();
		Load::view('business-status',$param);
	}
}