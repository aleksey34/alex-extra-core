<?php
namespace AlexExtraCore\App\Admin\Email;
use AlexExtraCore\App\Admin\Email\EmailForm\EmailForm;
use AlexExtraCore\App\Helper\Helper;

/**
 * allow using SVG img
 */

class Email {

	private static $instance;

	public function __construct() {



			$this->init();

	}


	private function init() {

		EmailForm::instance();


	}






	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}