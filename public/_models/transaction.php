<?php
class Transaction{
	function __construct(){
		
	}
	function add_buycodes($amount){
		$db = new DB();
		$db->set('table_name','transactions');
		$param['user_ID']=$_SESSION['user_ID'];
		$param['type']="Buy Codes";
		$param['date_trans']=date("Y-m-d");
		$param['amount']=$amount;
		$param['notes']="COMMISSION DEDUCTION";
		$param['status']=1;
		$db->insert($param);
	}
	function add_buycodes_request($count,$type,$amount){
		$db = new DB();
		$db->set('table_name','transactions');
		$param['user_ID']=$_SESSION['user_ID'];
		$param['type']="Buy Codes";
		$param['date_trans']=date("Y-m-d");
		$param['amount']=$amount;
		$param['notes']="-";
		$param['status']=0;
		$param['count']=$count;
		$param['acc_type']=$type;
		$db->insert($param);
	}
	function add_widthraw_request($amount){
		$db = new DB();
		$db->set('table_name','transactions');
		$param['user_ID']=$_SESSION['user_ID'];
		$param['type']="Widthraw";
		$param['date_trans']=date("Y-m-d");
		$param['amount']=$amount;
		$param['notes']="-";
		$param['status']=0;
		$db->insert($param);
	}
	function viewAll(){
		$db = new DB();
		$stmt = $db->query("SELECT a.ID, a.user_ID, b.name, a.type, c._type, a.date_trans, a.notes, 
					CASE a.status
						WHEN 0 THEN 'On Process'
						WHEN 1 THEN 'Complete'
					END as `status`
					FROM transactions AS a, users AS b, `user-meta` AS c
					WHERE a.user_ID = b.ID AND c.user_ID = b.ID ORDER BY a.ID DESC", array());
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result;
	}
	function viewTransactions(){
		$db = new DB();
		$stmt = $db->query("SELECT a.ID, a.amount, a.user_ID, b.name, a.type, c._type, a.date_trans, a.notes, 
					CASE a.status
						WHEN 0 THEN 'On Process'
						WHEN 1 THEN 'Complete'
					END as `status`
					FROM transactions AS a, users AS b, `user-meta` AS c
					WHERE a.user_ID = b.ID AND c.user_ID = b.ID AND a.user_ID = ".$_SESSION['user_ID']." ORDER BY a.ID DESC", array());
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result;
	}
}