<?php
include_once('admin.php');
class Dashboard extends Admin {
	private $param = array();

	function __construct(){
		$this->param['alink'] = SITE_URL."/join?afid=".$_SESSION['user_ID'];
	}
	function FIRST(){
		Load::model('geology');
		$Geology = new Geology();
		$result = $Geology->get_summary();

		include('ewallet.php');
		$Ewallet = new Ewallet();
		$this->param['weekly'] = $Ewallet->get_weekly($result['OUT']);
		Load::view('dashboard',$this->param);
	}
	public static function news_and_updates(){
		$n = file_get_contents("http://www.abs-cbnnews.com/"); 

		preg_match_all('/<div class=\"front\-section">(.*?)<div class=\"posted">(.*?)<\/div>/s', $n, $news);
		foreach ($news[0] as $news) {
			echo str_replace(array('h2','<a href="'), array('h4','<a target="_blank" href="http://www.abs-cbnnews.com'), $news);
			echo '<br/>';
		}	
	}
}