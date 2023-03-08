<?php
/**
 * use for DEV
 */
if(!function_exists('alex_var_dump')){
	function alex_var_dump($variable , $exit = true){
		echo  '<pre>';
		var_dump($variable);
		if($exit) exit;
		echo  '</pre>';
	}
}
if(!function_exists('alex_print_r')){
	function alex_print_r($variable , $exit = true){
		echo  '<pre>';
		print_r($variable);
		if($exit) exit;
		echo  '</pre>';
	}
}