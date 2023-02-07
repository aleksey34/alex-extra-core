<?php
/**
 * use for DEV
 */

function alex_var_dump($variable , $exit = true){
	echo  '<pre>';
                var_dump($variable);
				if($exit) exit;
	echo  '</pre>';
}
function alex_print_r($variable , $exit = true){
	echo  '<pre>';
				print_r($variable);
				if($exit) exit;
	echo  '</pre>';
}