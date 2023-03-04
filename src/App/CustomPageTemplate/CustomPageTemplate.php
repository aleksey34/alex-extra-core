<?php
namespace AlexExtraCore\App\CustomPageTemplate;



class CustomPageTemplate {

	private static $instance;

	public function __construct (){

		/**
		 *
		 */


		/**
		 * init template
		 * in folder - page-template
		 * all part for template  set folder page-template-parts
		 */
		$this->init();

	}



	private function init(){

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


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
