<?php
/**
 * use for DEV
 */

function alex_var_dump($variable , $is_exit = true){
	echo  '<pre>';
                var_dump($variable);
				if($is_exit) exit;
	echo  '</pre>';
}
function alex_print_r($variable , $is_exit = true){
	echo  '<pre>';
				print_r($variable);
				if($is_exit) exit;
	echo  '</pre>';
}