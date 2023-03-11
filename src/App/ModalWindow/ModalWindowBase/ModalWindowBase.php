<?php
namespace AlexExtraCore\App\ModalWindow\ModalWindowBase;



class ModalWindowBase {

	private static $instance;



	public function __construct() {



	}



	/**
	 * set enqueue scripts for modal window
	 */
	public static function enqueueScripts(){
/**
 * скрипт подулючается всесте со всеми скриптами сайта
 */
//		add_action('wp_enqueue_scripts',function (){

//			if(get_post_type() ===  'material' && is_single() || is_page()  ) {

//				wp_enqueue_script( 'alex-extra-core-mw', AlexExtraCorePluginURI . 'assets/js/alex-extra-core-modal-window-email.js', [ 'jquery' ], null, true );

//			}
//		});
	}

	/**
	 * set enqueue style for modal window
	 */
	private function enqueueStyle(){
// do not use -- style with SASS compiler
	}



	/**
	 * @param $args
	 *
	 * @return mixed
	 * $is_hortcode true $content - shortcode  - else $content - html
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}
}