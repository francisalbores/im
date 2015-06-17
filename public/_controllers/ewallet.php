<?php
include_once('admin.php');
class Ewallet extends Admin{
	function FIRST(){
		Load::model('geology');
		Load::model('transaction');
		$Geology = new Geology();
		$Transaction = new Transaction();
		$result = $Geology->get_summary();

		$param['record'] = $Transaction->viewTransactions();
		$param['weekly'] = $this->get_weekly($result['OUT']);
		$param['current'] = $this->get_current($result['OUT'],$param['record']);			
		Load::view('ewallet',$param);
	}

	// Widthrawal 
	function send_widthraw_request(){
		Load::model('transaction');
		$Transaction = new Transaction();
		$Transaction->add_widthraw_request($_POST['amount']);
		echo 1;
		exit();
	}
	function widthraw(){
		Load::hook_js('modal');
		Load::view('ewallet-widthraw');
		Load::hook_footer('ewallet-widthraw');
	}
	// end

	// Add account
	function addaccount(){
		Load::hook_js('modal');
		Load::view('ewallet-addaccount');
		Load::hook_footer('ewallet-addaccount');
	}
	function use_addaccount(){
		Load::model('user');
		$User = new User();
		$result = $User->add_account();
		if($result['@_error']=="")
			echo 1; 
		else
			echo $result['@_error'];
		exit();
	}
	// end

	// Buy Codes
	function buycodes(){		
		Load::hook_js('modal');
		Load::view('ewallet-buycodes');
		Load::hook_footer('ewallet-buycodes');
	}
	function use_buycodes(){
		Load::model('codes');
		Load::model('transaction');

		$Codes = new Codes();
		$Transaction = new Transaction();
		
		if($_POST['source']=="Commission Deduction"){
			$Transaction->add_buycodes($_POST['amount']);
			$Codes->add($_POST['howmany'], $_POST['acc_type']);
		}
		else{
			$Transaction->add_buycodes_request($_POST['howmany'],$_POST['acc_type'],$_POST['amount']);
		}
		echo 1; exit();
	}
	// end

	// Earnings	
	function get_current($geo_summary, $records){
		Load::model('transaction');
		$expenses = 0;
		if($records){
			foreach($records as $k=>$v){
				if($v['status']=="Complete")
					$expenses += $v['amount'];
			}
		}
		return $this->get_weekly($geo_summary) + $this->get_monthly($geo_summary) - $expenses;
	}
	function get_weekly($geo_summary){
		$pa = $this->get_PA($geo_summary['@Direct_points']);
		$gpa = $this->get_GPA($geo_summary['@Left_points'], $geo_summary['@Right_points']);
		
		return $pa+$gpa;
	}
	function get_monthly($geo_summary){
		return 0; // under construction
	}
	function get_PA($direct){		
		return PA_PV * $direct;
	}
	function get_GPA($left, $right){
		return GPA_PV * min($left,$right);
	}
}