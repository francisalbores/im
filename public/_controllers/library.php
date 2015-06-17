<?php
include_once('admin.php');
class Library extends Admin{
	function FIRST(){
		//$this->ebooks();
		Func::under_construction();
	}
	function videos(){
		Load::view('library-videos');
	}
	function ebooks(){
		Load::view('library-ebooks');
	}
	function audiobooks(){
		Load::view('library-audiobooks');
	}
}