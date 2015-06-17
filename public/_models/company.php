<?php

class Company{
	function get_income(){
		$db = new DB();
		$q = 'SELECT (u.income + p.income + b.income + bu.income + bp.income + bb.income) AS income
			FROM
			(SELECT (COUNT(a.ID) * 6980 ) AS income FROM users AS a, `user-meta` AS d WHERE a.ID = d.user_ID AND d._type = "Ultimate") AS u,
			(SELECT (COUNT(a.ID) * 3480 ) AS income FROM users AS a, `user-meta` AS d WHERE a.ID = d.user_ID AND d._type = "Premier") AS p,
			(SELECT (COUNT(a.ID) * 1640 ) AS income FROM users AS a, `user-meta` AS d WHERE a.ID = d.user_ID AND d._type = "Basic") AS b,
			(SELECT IFNULL(((COUNT(a.user_ID) * 6980 ) * a.count),0) AS income FROM `transactions` AS a WHERE a.type = "Buy Codes" AND a.status = 1 AND a.notes <> "COMMISSION DEDUCTION" AND a.acc_type = "Ultimate") AS bu,
			(SELECT IFNULL(((COUNT(a.user_ID) * 3480 ) * a.count),0) AS income FROM `transactions` AS a WHERE a.type = "Buy Codes" AND a.status = 1 AND a.notes <> "COMMISSION DEDUCTION" AND a.acc_type = "Premier") AS bp,
			(SELECT IFNULL(((COUNT(a.user_ID) * 1640 ) * a.count),0) AS income FROM `transactions` AS a WHERE a.type = "Buy Codes" AND a.status = 1 AND a.notes <> "COMMISSION DEDUCTION" AND a.acc_type = "Basic") AS bb;';
		$stmt = $db->query($q,array());	
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result[0]['income']; 
	}
	function get_expense(){
		$db = new DB();
		$q = 'SELECT IFNULL(SUM(a.amount),0) AS expense FROM transactions AS a WHERE a.status = 1 AND a.type = "Widthraw";';
		$stmt = $db->query($q,array());
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);	
		return (empty($result)) ? false : $result[0]['expense']; 
	}
}