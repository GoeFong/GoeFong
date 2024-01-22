<?php

/**
* 
*/
class Controller
{
	protected $folder;
	
	function render($file, $data = array(), $title = null, $admin = null){
		$file_path = "views/".$file.".php";
		if(file_exists($file_path)){

			ob_start();//start output buffering
			require_once($file_path);
			
		} else {
			echo "Khong tim thay view";
			echo "<br>".$file_path;
		}
	}
}