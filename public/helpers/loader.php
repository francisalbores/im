<?php
class Load{

	public static function view($file,$var=null){
		if(is_array($var)){
			foreach( $var as $k=>$v ) {
				$k = str_replace("@", '', $k);
				$var[$k] = $v;
			}
			extract($var); // must be array always
			
			// for stored proc that has additional select query after.
			if(isset($var['OUT'])) { 
				foreach( $var['OUT'] as $k=>$v ) {
					$k = str_replace("@", '', $k);
					$var['OUT'][$k] = $v;
				}
				extract($var['OUT']);
			}
		}
		include_once('_views/'.$file.'.php');
	}
	public static function controller($file,$var=null){
		if(is_array($var))
			extract($var); // must be array always
		$current_page = isset($file) ? $file : FRONT_PAGE;
		include_once('_controllers/'.$file.'.php');	
		$controller = new $current_page();
		$controller->FIRST();
	} 
	public static function model($file){
		include_once('_models/'.$file.'.php');	
	} 
	public static function redirect($url){
		header('Location:/'.$url); die();
	}

	// Hooks	
	public static function hook_css($file){
		global $hook_css;
		$hook_css = $file;
	}
	public static function do_css(){
		global $hook_css;
		$file = 'assets/css/'.$hook_css.'.css';
		if(file_exists($file))
			echo '<link rel="stylesheet" href="'.SITE_URL.'/'.$file.'" />';
	}
	public static function hook_js($file){
		global $hook_js;
		$hook_js = $file;
	}
	public static function do_js(){
		global $hook_js;
		$file = 'assets/js/'.$hook_js.'.js';
		if(file_exists($file))
			echo '<script src="'.SITE_URL.'/'.$file.'"></script>';
	}
	public static function hook_footer($file){
		global $hook_file;
		$hook_file = $file;
	}
	public static function do_footer(){
		global $hook_file;
		$file = '_views/hook_footer/'.$hook_file.'.php';
		if(file_exists($file))
			include($file);
	}
}