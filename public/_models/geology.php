<?php
class Geology{
	function __construct(){
		
	}
	function get_tree($afid = false){
		$afid = (!$afid) ? $_SESSION['user_ID'] : $afid;
		
		$db = new DB();
		$proc_name = 'getTree';
		$param=array(
			array('pos'=>"IN",'nam'=>'uID_1','typ'=>"INT",'lim'=>10,'val'=>$afid),
			array('pos'=>"OUT",'nam'=>'uID_avatar_1','typ'=>"VARCHAR",'lim'=>100)
		);
		for($x=2;$x<=31;$x++){
			$arr = array('pos'=>"OUT",'nam'=>'uID_'.$x,'typ'=>"INT",'lim'=>10);
			array_push($param, $arr);
			$arr = array('pos'=>"OUT",'nam'=>'uID_avatar_'.$x,'typ'=>"VARCHAR",'lim'=>100);
			array_push($param, $arr);	
		}
		$result = $db->create_proc($proc_name,$param);
		$db->drop_proc('getTree');
		return $result[0];
	}
	function get_detail($guid){
		$db = new DB();
		$param = array(
			'user_ID'=>$guid
		);
		$stmt = $db->query("SELECT ID, name, username, mobile, photo, b._type FROM users, `user-meta` as b WHERE ID = :user_ID AND b.user_ID = ID",$param);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return (empty($result)) ? false : $result[0]; 
	}
	function get_summary(){
		$db = new DB();
		$proc_name = 'getGeoSummary';
		
		$param=array(
			array('pos'=>"IN",'nam'=>'uID','typ'=>"INT",'lim'=>10,'val'=>$_SESSION['user_ID']),
			array('pos'=>"OUT",'nam'=>'sID','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'pID','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Total','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Direct','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Indirect','typ'=>"INT",'lim'=>10),			
			array('pos'=>"OUT",'nam'=>'Left','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Right','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Left_points','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Right_points','typ'=>"INT",'lim'=>10),
			array('pos'=>"OUT",'nam'=>'Direct_points','typ'=>"INT",'lim'=>10)
		);
		$result = $db->create_proc($proc_name,$param,"SELECT * FROM temp_lvl");
		$db->drop_proc('getGeoSummary');
		return $result;
	}
}