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


alex_extra_core_require_once_dir('src/includes/contact-form-set-title-field-material.php');


/**
 * settings for plugin
 * forms , etc
 */
alex_extra_core_require_once_dir('src/includes/settings.php');

/**
 * oceanwp function rewrite
 * and others
 */
alex_extra_core_require_once_dir('src/includes/oceanwp/material-single-custom-tax.php');
alex_extra_core_require_once_dir('src/includes/oceanwp/show-sidebar-settings.php');

/**
 * oceanwp
 * logo - rewrite function for show logo
 */
alex_extra_core_require_once_dir('src/includes/oceanwp/header/logo.php');

/**
 * related materials
 */
alex_extra_core_require_once_dir('src/includes/oceanwp/related-materials.php');