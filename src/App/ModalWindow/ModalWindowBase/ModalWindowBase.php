<?php
namespace AlexExtraCore\App\ModalWindow\ModalWindowBase;



class ModalWindowBase {

	private static $instance;



//	public function __construct() {
//
//
//
//	}

	protected function getWindowHtml($args){
		$html = '';

		$html .= '<div id="'. $args['id']  .'"   class="'.  $args['classes'] .' modal  ">';

			$html .= ' <a href="#" rel="modal:close">закрыть</a>';

			$html .= $args['content']  ;

		$html .= '</div>';

		return $html;
	}

	protected function getWindowInitJs($args){
		$html = '';
		$html .= '<script>';

			$html .=
				' 
		    jQuery(function (){ 
			   jQuery("a[href=#'. $args['id']  .']").click(function(event) {
			        jQuery(this).modal({
			            fadeDuration: 250
			        });
			        return false;
			    });
			 });
		   ';

		$html .= '</script>';

		return $html;
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
//	public static function instance() {
//		if ( is_null( self::$instance ) ) {
//			self::$instance = new self();
//		}
//
//		return static::$instance;
//
//	}
}