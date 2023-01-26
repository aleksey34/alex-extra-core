<?php
/**
 * Plugin Name:       Alex Extra Core
 * Description:       Additional func for AlexTheme
 * Requires at least: 1.0
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            aleksey34
 * License:           GPL-2.0-or-later
 * Text Domain:      alex-theme
 /
 * @package          plugin core of alextheme
 */
// - if file of translate in plugin - Domain Path: /languages
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
namespace AlexExtraCore\App ;





use Carbon_Fields\CarbonFieldsInit;

if(!defined('ABSPATH')) exit;


define('AlexExtraCorePluginDIR' , plugin_dir_path(__FILE__) );
define("AlexExtraCorePluginURI" , plugin_dir_url( __FILE__ ));

/**
 * do not need init class!!
 * there are no classes there
 * helpers and others
 */
require_once AlexExtraCorePluginDIR .'/src/functions/functions-core.php';


/**
 * ANY change in composer.json - require command in console -- composer update -- IMPORTANT
 *
 */
/**
 * composer autoload
 */
require_once AlexExtraCorePluginDIR .'/vendor/autoload.php';



/**
 * Carbon fields init meta and theme options
 */
//CarbonFieldsInit::instance();



function AlexExtraCoreInit(){

	App::instance();

}

AlexExtraCoreInit();