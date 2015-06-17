<?php
class User{
	function __construct(){
		
	}
	function add_account(){
		$db = new DB();
		$proc_name = 'addAccount';
		$param = array(
			array('pos'=>"OUT",'nam'=>'_error','typ'=>"VARCHAR",'lim'=>100),
			array('pos'=>"IN",'nam'=>'_ID','typ'=>"INT",'lim'=>10,'val'=>$_SESSION['user_ID']),
			array('pos'=>"IN",'nam'=>'_placement_ID','typ'=>"INT",'lim'=>10,'val'=>$_POST['pid']),
			array('pos'=>"IN",'nam'=>'_position','typ'=>"VARCHAR",'lim'=>5,'val'=>$_POST['position']),
			array('pos'=>"IN",'nam'=>'_type','typ'=>"VARCHAR",'lim'=>10,'val'=>$_POST['acc_type']),
			array('pos'=>"IN",'nam'=>'_amount','typ'=>"INT",'lim'=>10,'val'=>$_POST['amount']),
			array('pos'=>"IN",'nam'=>'_username','typ'=>"VARCHAR",'lim'=>100,'val'=>$_POST['username']),
		);
		$result = $db->create_proc($proc_name,$param);
		return $result[0];
		//$db->drop_proc($proc_name);
	}
	function insert($info){
		$db = new DB();
		$proc_name = 'userReg';
		$param=array(
			array('pos'=>"OUT",'nam'=>'_user_ID','typ'=>"INT",'lim'=>10),
			// users
		    array('pos'=>"IN",'nam'=>'_name','typ'=>"VARCHAR",'lim'=>100,'val'=>$info['name']),
		    array('pos'=>"IN",'nam'=>'_password','typ'=>"TEXT",'val'=>$info['password']),
		    array('pos'=>"IN",'nam'=>'email','typ'=>"VARCHAR",'lim'=>100,'val'=>$info['email']),
		    array('pos'=>"IN",'nam'=>'mobile','typ'=>"VARCHAR",'lim'=>100,'val'=>$info['mobile']),
		    array('pos'=>"IN",'nam'=>'photo','typ'=>"TEXT",'val'=>$info['photo']),
		    array('pos'=>"IN",'nam'=>'address','typ'=>"TEXT",'val'=>$info['address']),
		    array('pos'=>"IN",'nam'=>'username','typ'=>"VARCHAR",'lim'=>100,'val'=>$info['username']),	    
		    // user-meta
		    array('pos'=>"IN",'nam'=>'sponsor_ID','typ'=>"INT",'lim'=>10,'val'=>$info['sid']),
		    array('pos'=>"IN",'nam'=>'placement_ID','typ'=>"INT",'lim'=>10,'val'=>$info['pid']),
		    array('pos'=>"IN",'nam'=>'_position','typ'=>"VARCHAR",'lim'=>5,'val'=>$info['position']),
		    array('pos'=>"IN",'nam'=>'_type','typ'=>"VARCHAR",'val'=>$info['type']),
		    // user-payment
		    array('pos'=>"IN",'nam'=>'payment_type','typ'=>"VARCHAR",'lim'=>50,'val'=>$info['payment_type']),
		    array('pos'=>"IN",'nam'=>'amount','typ'=>"INT",'lim'=>7,'val'=>$info['payed_amount']),
		    array('pos'=>"IN",'nam'=>'_code','typ'=>"TEXT",'val'=>$info['actcode']),
		    array('pos'=>"IN",'nam'=>'receipt_url','typ'=>"TEXT",'val'=>$info['payment_receipt'])
		);

		$result = $db->create_proc($proc_name,$param);
		$_SESSION['user_ID'] = $result[0]['@user_ID'];
		$_SESSION['name'] = $info['name'];
		$_SESSION['photo'] = $info['photo'];

		$db->drop_proc('userReg');
	}
	function validate_login(){
		$db = new DB();
		$param = array(
				'username'=>$_POST['username'],
				'password'=>$_POST['password']
			);
		$stmt = $db->query("SELECT ID, photo, name, b._type as user_type  FROM users, `user-meta` as b WHERE username=:username AND password=:password AND ID = b.user_ID",$param);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(empty($result))
			return false;
		else{
			$_SESSION['user_ID'] = $result[0]['ID'];
			$_SESSION['name'] = $result[0]['name'];
			$_SESSION['user_type'] = $result[0]['user_type'];
			$_SESSION['photo'] = $result[0]['photo'];
			return true;
		}			
	}
	public function get_info(){
		$db = new DB();
		$param = array(
			'user_ID'=>$_SESSION['user_ID']
		);
		$stmt = $db->query("SELECT photo, username, address, email, mobile FROM users WHERE ID = :user_ID",$param);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$result[0]['name']=$_SESSION['name'];
		$result[0]['ID']=$_SESSION['user_ID'];
		return (empty($result)) ? false : $result[0]; 
	}
	public function get_sponsor(){
		$db = new DB();
		$param = array(
			'user_ID'=>$_SESSION['user_ID']
		);
		$stmt = $db->query("SELECT b.sponsor_ID as s_ID, name as s_name  FROM users as a, `user-meta` as b WHERE b.user_ID = :user_ID AND a.ID = b.sponsor_ID",$param);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result[0]; 		
	}
	public function get_codes(){
		$db = new DB();
		$param = array(
			'user_ID'=>$_SESSION['user_ID']
		);
		$stmt = $db->query("SELECT codes, 
								CASE `status`
									WHEN 0 THEN 'Active'
									WHEN 1 THEN 'Used'
								END as `status`, 
								CASE `used_by`
									WHEN 0 THEN 'n/a'
									ELSE `used_by`
								END as `used_by`, 
								CASE `use-date`
									WHEN 0 THEN 'n/a'
									ELSE `used_by`
								END as `use-date`,
								`buy-date` 
							FROM `user-codes` WHERE user_ID = :user_ID",$param);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result; 		
	}
}