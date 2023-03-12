<?php
namespace AlexExtraCore\App\FavoritePost\Inc;

class FavoriteScriptStyle{

	private static $instance;

	public function __construct(){

		$this -> init();
	}

	private function init(){

		add_action( 'wp_enqueue_scripts',[$this ,  'scriptsStyle'] );
	}

	public function scriptsStyle(){
		// switch on here -----------------------------------
// plugin style
//		wp_enqueue_style( 'alex-extra-core-favorite',  AlexExtraCorePluginURI  . '/include/favorite-product/assets/css/index.css');

// plugin script код перенесен в остноый js файла сайта - в папке assets/js -- подключение там - в общем js
//		wp_enqueue_script('alex-extra-core-favorite-script' , AlexExtraCorePluginURI . '/src/App/FavoritePost/assets/js/index.js' , ['jquery'] , null , true  );
// end switch on here =======================================================
	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}

}
