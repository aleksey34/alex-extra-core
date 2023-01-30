<?php

function alex_extra_core_url($url = ''){

	if($url){
		return  AlexExtraCorePluginURI .  preg_replace('/^\/?|^\\\?/',  '' ,$url);
	}

	return AlexExtraCorePluginURI;
}

function alex_extra_core_dir($dir= ''){

	if($dir){
		return  AlexExtraCorePluginDIR .  preg_replace('/^\/?|^\\\?/' , '' ,$dir);
	}

	return AlexExtraCorePluginDIR;
}

function alex_exra_core_template_dir($dir =''){

	if($dir){
		return  AlexExtraCorePluginTemplateDir .  preg_replace('/^\/?|^\\\?/' , '' ,$dir);
	}

	return AlexExtraCorePluginTemplateDir;
}



function alex_extra_core_require_once_dir($dir){
	if(!$dir) {
		wp_die('function - alex_extra_core_require_once_dir  require argument');
	}
	return require_once  AlexExtraCorePluginDIR .  preg_replace('/^\/?|^\\\?/' , '' ,$dir);
}

function alex_extra_core_require_once_template_dir($dir){
	if(!$dir) {
		wp_die('function - alex_extra_core_require_once_template_dir  require argument');
	}
	return require_once  AlexExtraCorePluginTemplateDir .  preg_replace('/^\/?|^\\\?/' , '' ,$dir);
}

function alex_extra_core_require_once__url($url){
	if(!$url) {
		wp_die('function - alex_extra_core_require_once_uri  require argument');
	}
	return require_once  AlexExtraCorePluginURI .  preg_replace('/^\/?|^\\\?/' ,  '' ,$url);
}