<?php
namespace AlexExtraCore\App\Admin\Parser;

use AlexExtraCore\App\Helper\Helper;
//use voku\helper\HtmlDomParser;


/**
 * для парсинга стороних сайтов - получение данных о товарах и тд
 * сейчас парсинг сайта по домену ferrara-design.ru  --  получение данных о товаре
 *
 * КОД ПАРСИНГА ИНДИВИДУАЛЕН ДЛЯ КАЖДОГО САЙТА !!! И ОБНОЛЯЕТСЯ В ЗАВИСИМОСТИ ОТ ЭТОГО!!!
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
		if(is_admin()
		   && defined('AlexExtraCoreOptions')
		   && AlexExtraCoreOptions['parser_section_enable']
		   && AlexExtraCoreOptions['parser_url']) {

			// check security
			if ( ! Helper::issetCheckFormSecurity( 'alex_start_parser_form_id' ) ) {
				return;
			}
			// end check security
			//start parsing
			$startUrl = AlexExtraCoreOptions['parser_url'];
			$pageLinks =$this->getPageLinkArray($startUrl);

//			foreach ($pageLinks as $pageLink){

//				$productLinkArray  = $this->getProductLinkArray($pageLink);


//			}

// PARSING HERE!!!!! =================================--------------------===========================
			// problem - parsing libs -do not work into WP envavoroment - error warning and etc


//			alex_var_dump(self::$pageLinkArray);



			// end parsing
		}
	}



	private function getPageLinkArray($url){
		$links[]  =$url;
		for($i=2; $i<=7 ; $i++ ){
			$links[] = $url . '?page='.$i ;
		}
		return $links;
	}

	private function getProductLinkArray($pageLink){
		$linkArray = [];

//		$html = file_get_contents($pageLink) ;

//		$dom = HtmlDomParser::str_get_html($html);
//
//		$elements = $dom->findMulti('.product-layout  .item  .caption  h4 a');
//		alex_var_dump($elements);



//		$links = $dom->find('.product-layout  .item  .caption  h4 a');


		return $linkArray;
	}

	private function getProduct(){

	}

	private function setProduct(){

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}




