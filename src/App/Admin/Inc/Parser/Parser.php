<?php
namespace AlexExtraCore\App\Admin\Inc\Parser;

use AlexExtraCore\App\Helper\Helper;

/**
 * для парсинга стороних сайтов - получение данных о товарах и тд
 * сейчас парсинг сайта по домену ferrara-design.ru  --  получение данных о товаре
 **/
class Parser {

	private static $instance;

	public function __construct (){

		/**
		 * init
		 */
		$this->init();

	}




	private function init(){

		/**
		 *
		 */
		add_action("after_setup_theme" , [$this , 'handlerParsingDataForm'] , 9);
		add_action("after_setup_theme" , [$this , 'startParsing'] , 11);


	}

	public function handlerParsingDataForm(){
		if(is_admin() && defined('AlexExtraCoreOptions')  && AlexExtraCoreOptions['parser_section_enable']){

			// check security
			if( !Helper::issetCheckFormSecurity('alex_parser_form_id') ){
				return;
			}
			// end check security

			// check data  and update date
			$plugin_settings = Helper::getAlexExtraCoreOptions();

			if(!isset($_POST['parser_url']) && !isset($plugin_settings['parser_url'])){
				$plugin_settings['parser_url'] = false;
				Helper::addAdminNotice('warning');
				Helper::updateAlexExtraCoreOptions($plugin_settings);
				return ;
			}
			if( isset($_POST['parser_url']) && !isset($plugin_settings['parser_url']) ){
				$plugin_settings['parser_url'] = $_POST['parser_url'] ;
			}

			if( isset($_POST['parser_url'])  && $_POST['parser_url'] !== $plugin_settings['parser_url']  ){
				$plugin_settings['parser_url'] = $_POST['parser_url'] ;

			}
			if(!$plugin_settings['parser_url']){
				Helper::addAdminNotice('warning');
				return ;
			}

			Helper::updateAlexExtraCoreOptions($plugin_settings);

// end -check data and update date

		}

	}

	public function startParsing(){
		if(is_admin() && defined('AlexExtraCoreOptions')  && AlexExtraCoreOptions['parser_section_enable']) {

			// check security
			if ( ! Helper::issetCheckFormSecurity( 'alex_start_parser_form_id' ) ) {
				return;
			}
			// end check security
			//start parsing



			// end parsing
		}
	}




	private function getHtmlByUrl($url){

		return file_get_contents ($url);

//		$handle = curl_init();
//		curl_setopt($handle, CURLOPT_URL, "http://www.example.com/");
//		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//		$homepage = curl_exec($handle);
//		curl_close($handle);
//		echo $homepage;

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}




