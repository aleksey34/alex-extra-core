<?php
namespace AlexExtraCore\App\PageTemplate;

/**
 * Class PageTemplate
 * @package AlexExtraCore\App\PageTemplate
 * подключение шаблонов к постам и тд
 * -- подключение шаблонов с выбором в админке -- Смотрите CustomPageTemplate.php !!!!!!!!
 */


class PageTemplate {

	private static $instance;

	public function __construct (){

		$this->addCustomTemplate();


		//$this->addTemplate();

	}

	/**
	 * init template
	 * in folder - page-template
	 * all part for template  set folder page-template-part
	 */
	private function addCustomTemplate(){

		## выбор шаблонов из плагина в атрибутах страницы
		add_filter( 'theme_page_templates', function ( $templates ) {

			## сканируем папку шаблонов в плагине
			$array_templates = array_diff( scandir( AlexExtraCorePluginPageTemplateDir ), array('.', '..') );

			foreach( $array_templates as $plugin_template ) {

				$str_template = str_replace( ".php", "", $plugin_template ); // очищаем от .php

				$str_template = str_replace( "-", " ", $str_template ); // очищаем от "-"

				// Выводим имя в формате: My Template
				$template_name = mb_convert_case( $str_template, MB_CASE_TITLE, 'UTF-8' );

				// Подключаем выбор шаблона в атрибутах
				$templates[ $plugin_template ] = $template_name;

			}

			return $templates;

		} );



		## подключение шаблонов из плагина
		add_filter( 'template_include', function ( $template ) {

			// запрашиваем активный шаблон текущей страницы
			$page_template = get_page_template_slug();

			## подключение шаблонов
			// сканируем папку с шаблонами
			$mland_templates = array_diff( scandir( AlexExtraCorePluginPageTemplateDir ), array('.', '..') );

			foreach( $mland_templates as $mland_template ) {

				// сравнение активного шаблона и шаблона выбранного в атрибутах
				if ( $mland_template == basename ( $page_template ) ) {

					// подключение шаблона
					return wp_normalize_path( AlexExtraCorePluginPageTemplateDir . '/' . $mland_template );

				}

			}

			return $template;
		} );



	}



	private function addTemplate(){

		/**
		 * @param $template
		 * фильтр передает переменную $template - путь до файла шаблона.
		 *  Изменяя этот путь мы изменяем файл шаблона.
		 * @return string
		 */
		add_filter( 'template_include', function ($template){
			# аналог второго способа
			// если это страница со слагом portfolio, используем файл шаблона page-portfolio.php
			// используем условный тег is_page()
//		if( is_page('portfolio') ){
//			if ( $new_template = locate_template( array( 'page-portfolio.php' ) ) )
//				return $new_template ;
//		}

			# шаблон для группы рубрик
			// этот пример будет использовать файл из папки темы tpl_special-cats.php,
			// как шаблон для рубрик с ID 9, названием "Без рубрики" и слагом "php"
//		if( is_category( array( 9, 'Без рубрики', 'php') ) ){
//			return get_stylesheet_directory() . '/tpl_special-cats.php';
//		}

			# шаблон для записи по ID
			// файл шаблона расположен в папке плагина /my-plugin/site-template.php
//		global $post;
//		if( $post->ID == 12 ){
//			return wp_normalize_path( WP_PLUGIN_DIR ) . '/my-plugin/site-template.php';
//		}

			# шаблон для страниц произвольного типа "book"
			// предполагается, что файл шаблона book-tpl.php лежит в папке темы
//		global $post;
//		if( $post->post_type == 'book' ){
//			return get_stylesheet_directory() . '/book-tpl.php';
//		}

//		global $post;
//		if( $post->post_type == 'page' ){
//			return  AlexExtraCorePluginDIR .'/include/custom-page-template/templates/favorite-template.php';
//		}


//		global $post;
//		if( $post->post_name == 'about-us' ){
//			return  AlexExtraCorePluginDIR .'/include/custom-page-template/templates/favorite-template.php';
//		}

			return $template;
		});

	}


//	public function addIncludeTemplate($template){
//		# аналог второго способа
//		// если это страница со слагом portfolio, используем файл шаблона page-portfolio.php
//		// используем условный тег is_page()
////		if( is_page('portfolio') ){
////			if ( $new_template = locate_template( array( 'page-portfolio.php' ) ) )
////				return $new_template ;
////		}
//
//		# шаблон для группы рубрик
//		// этот пример будет использовать файл из папки темы tpl_special-cats.php,
//		// как шаблон для рубрик с ID 9, названием "Без рубрики" и слагом "php"
////		if( is_category( array( 9, 'Без рубрики', 'php') ) ){
////			return get_stylesheet_directory() . '/tpl_special-cats.php';
////		}
//
//		# шаблон для записи по ID
//		// файл шаблона расположен в папке плагина /my-plugin/site-template.php
////		global $post;
////		if( $post->ID == 12 ){
////			return wp_normalize_path( WP_PLUGIN_DIR ) . '/my-plugin/site-template.php';
////		}
//
//		# шаблон для страниц произвольного типа "book"
//		// предполагается, что файл шаблона book-tpl.php лежит в папке темы
////		global $post;
////		if( $post->post_type == 'book' ){
////			return get_stylesheet_directory() . '/book-tpl.php';
////		}
//
////		global $post;
////		if( $post->post_type == 'page' ){
////			return  AlexExtraCorePluginDIR .'/include/custom-page-template/templates/favorite-template.php';
////		}
//
//
////		global $post;
////		if( $post->post_name == 'about-us' ){
////			return  AlexExtraCorePluginDIR .'/include/custom-page-template/templates/favorite-template.php';
////		}
//
//		return $template;
//	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}