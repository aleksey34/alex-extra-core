<?php
/**
 * Подключение всех файлов functions сдесь
 *
 */
require_once AlexExtraCorePluginDIR .'src/functions/inc/helpers.php';

if(WP_DEBUG){

	/**
	 * work WP_DEBUG ONLY
	 * For dev mode
	 */
//	require_once alex_extra_core_dir('src/functions/inc/dev-helpers.php') ;
    alex_extra_core_require_once_dir('src/functions/inc/dev-helpers.php');

}




