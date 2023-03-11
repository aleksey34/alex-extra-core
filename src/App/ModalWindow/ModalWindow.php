<?php
namespace AlexExtraCore\App\ModalWindow;



use AlexExtraCore\App\ModalWindow\ModalWindowBase\ModalWindowBase;

class ModalWindow extends ModalWindowBase {

	private static $instance;

	private static $args ;

	public function __construct($args) {
		static::$args = $args;

		/**
		 * init classes
		 */
		$this->init();

	}

	private function init() {

		add_action('wp_footer', function (){
			echo $this->getLayout(static::getArgs());
		}, 100);

	}

	public function getLayout($args){
      $html = '';

      $html .= $this->getWindowHtml($args);

      $html .= $this->getWindowInitJs($args);

	    return $html;
    }



	public static function getArgs(){
		return static::$args;
	}

	/**
	 * @param $args
	 *
	 * @return mixed
	 * $is_hortcode true $content - shortcode  - else $content - html
	 */
	public static function instance($args) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self($args);
		}

		return static::$instance;

	}
}