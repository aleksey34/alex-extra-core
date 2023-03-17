<?php
namespace AlexExtraCore\App\ScriptStyle;

class ScriptStyle{

	private static $instance;

	public function __construct(){

		$this -> init();
	}

	private function init(){

		add_action( 'wp_enqueue_scripts',[$this ,  'scriptsStyle'] , 30);
	}

	public function scriptsStyle(){
		// switch on here -----------------------------------
		// plugin style
		wp_enqueue_style( 'alex-extra-core-common-style',  AlexExtraCorePluginURI  . 'assets/css/common-plugin-style.min.css');

		// plugin script сдесь собраны бибилотеки и кастомный скрипт
		// jquery modal script , slick slider min.js
		wp_enqueue_script('alex-extra-core-script' , AlexExtraCorePluginURI . 'assets/js/scripts.js' , ['jquery'] , null , true  );
		// end switch on here =======================================================


		// click slider for gallery OceanWp and guttenberg - any post page
		if(true){
//		if(is_single()  && 'gallery' === get_post_format()){
			// deregister owp depend  - если подключена родительская тема oceanWp
			wp_deregister_script( 'ow-flickity'  );
			wp_deregister_script( 'oceanwp-slider' );

			//register - enqueue   style
			wp_enqueue_style('slick' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick.css'  );
			wp_enqueue_style('slick-theme' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick-theme.css'  );
		}


	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}

}
