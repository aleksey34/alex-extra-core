<?php
/**
 * Подключение всех файлов functions сдесь
 *
 */

if(WP_DEBUG){

	/**
	 * work WP_DEBUG ONLY
	 * For dev mode
	 */
	require_once AlexExtraCorePluginDIR .'src/functions/inc/dev-helpers.php';

}

if(is_admin()){
	/**
	 * do for admin  ONLY
	 */
	require_once AlexExtraCorePluginDIR .'src/functions/inc/admin/prohibition-modify-file.php';
}


