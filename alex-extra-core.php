<?php
/**
 * Plugin Name:       Alex Extra Core
 * Description:       Additional func for AlexTheme
 * Requires at least: 1.0
 * Requires PHP: 7.4
 * Version:           1.0
 * Author:            aleksey34
 * License:           GPL-2.0-or-later
 * Text Domain:       alex_theme
 /
 * @package          plugin core of alextheme
 */
// - if file of translate in plugin - Domain Path: /languages
namespace AlexExtraCore\App ;


//use Carbon_Fields\CarbonFieldsInit;

if(!defined('ABSPATH')) exit;

define("AlexExtraCorePluginDIR" , plugin_dir_path(__FILE__) );
define("AlexExtraCorePluginURI" , plugin_dir_url( __FILE__ ));
define("AlexExtraCorePluginPageTemplateDir" , plugin_dir_path(__FILE__)  . 'page-template/' );
define("AlexExtraCorePluginTemplateDir" , plugin_dir_path(__FILE__)  . 'src/app-template/' );



/**
 * post meta -- material post type - key
 */
define('AlexMaterialMetaKey' , 'ferrara_material_data');

/**
 * define options name
 */
define("AlexExtraCorePluginOptionName" , 'alex_extra_core_options');



/**
 * name field for nonce
 * and nonce action
 */
define('AlexExtraCoreNonceName' , 'alex_extra_core_nonce_name');
define('AlexExtraCoreNonceAction' , 'alex_extra_core_nonce_action');

/**
 * do not need init class!!
 * there are no classes there
 * helpers and others
 *
 * add helpers here!!
 * REQUIRE in TOP
 */
require_once AlexExtraCorePluginDIR .'src/functions/functions-core.php';

//================== helpers included==============================================



/**
 * folder - includes --
 * contain file for included like in Theme ar Child Theme included and structure
 *
 */
	alex_extra_core_require_once_dir( 'src/includes/includes-core.php' );


/**
 * ANY change in composer.json - require command in console -- composer update -- IMPORTANT
 *
 */
/**
 * composer autoload classes
 */
require_once  AlexExtraCorePluginDIR .  'vendor/autoload.php';


/**
 * Carbon fields init meta and theme options
 */
//CarbonFieldsInit::instance();



function AlexExtraCoreInit(){

	App::instance();

}

AlexExtraCoreInit();