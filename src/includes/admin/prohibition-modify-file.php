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
if('1'  !==  get_alex_extra_core_options()['prohibition_edit_file']){
	define('DISALLOW_FILE_EDIT', true);
}

