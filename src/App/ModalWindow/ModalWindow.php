<?php
namespace AlexExtraCore\App\ModalWindow;



class ModalWindow {

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

			echo $this->getHtml(static::getArgs());
		}, 100);

	}

	public function getHtml($args){
        $html = '';

			$html .= '<div id="'. $args['id']  .'"   class="'.  $args['classes'] .' modal  ">';

					$html .= ' <a href="#" rel="modal:close">закрыть</a>';

					$html .= $args['content']  ;

			$html .= '</div>';

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