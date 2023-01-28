<?php
/**
 * folder - includes --
 * contain file for included like in Theme ar Child Theme included and structure
 *
 */

if(is_admin()){
	/**
	 * do for admin  ONLY
	 */
	alex_extra_core_require_once_dir('src/includes/admin/prohibition-modify-file.php');

}

alex_extra_core_require_once_dir('src/includes/remove-admin-bar.php');