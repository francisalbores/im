<?php

class Codes {
	function _construction(){}
	function add($count, $type){
		$db = new DB();
		$q = "";
		for($x=1;$x<=$count;$x++){
			$q .= "INSERT INTO `user-codes` (`user_ID`,`codes`,`code_type`,`buy-date`,`status`) 
					SELECT ".$_SESSION['user_ID'].", LEFT(UUID(), 10), '".$type."', CURDATE(), 0; ";			
		}
		$db->query($q,array());
	}
}