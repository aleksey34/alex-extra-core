<?php
namespace AlexExtraCore\App\ScriptStyle;

class ScriptStyle{

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
				wp_enqueue_style( 'alex-extra-core-common-style',  AlexExtraCorePluginURI  . 'assets/css/common-plugin-style.css');

		// plugin script
		//wp_enqueue_script('alex-extra-core-script' , AlexExtraCorePluginURI . '/include/favorite-product/assets/js/index.js' , ['jquery'] , null , true  );
		// end switch on here =======================================================
	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}

}
