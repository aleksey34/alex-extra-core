<?php
namespace AlexExtraCore\App\PageTemplate;

class PageTemplate {

	private static $instance;

	public function __construct (){

		//$this->addTemplate();

		/**
		 * add file ass here!!!!!
		 */
//		require_once __DIR__ . '/templates/favorite-template.php';

	}

	private function addTemplate(){

		add_filter( 'template_include', [$this, 'addIncludeTemplate'] );

	}

	/**
	 * @param $template
	 * фильтр передает переменную $template - путь до файла шаблона.
     *  Изменяя этот путь мы изменяем файл шаблона.
	 * @return string
	 */
	public function addIncludeTemplate($template){
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
	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}