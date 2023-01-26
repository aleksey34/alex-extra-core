<?php
namespace AlexExtraCore\App\Shortcode;

use AlexExtraCore\App\Shortcode\Inc\CustomLogo;

class Shortcode{

	private static $instance;

	public function __construct(){

		$this->init();
	}

	private function init(){

		CustomLogo::instance();

	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}


}