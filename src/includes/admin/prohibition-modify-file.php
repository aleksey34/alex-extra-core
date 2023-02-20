<?php
/**
 * запрет модифифировать файлы сайта через админку
 */
/**
 * Class AlexAllowThemeFile
 * @package Alex\ExtraCore
 * Do not allow change theme file from admin page
 * hide from menu
 */
 add_action('admin_init' , function (){

   if( defined('AlexExtraCoreOptions')  &&  1  !==  AlexExtraCoreOptions['prohibition_edit_file']){

     define('DISALLOW_FILE_EDIT', true);
   }
 } );