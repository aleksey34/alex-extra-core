<?php
namespace AlexExtraCore\App\Admin\Inc;


/**
 * add custom img in start login page
 */
class StartLoginPage {

	private static $instance;

	public function __construct() {

		/**
		 * init
		 */
		$this->init();

	}


	private function init() {

		/**
		 *
		 */
		$this->addLogoToStartPageWp();

	}

	private function addLogoToStartPageWp(){

		add_action('login_head', [$this , 'showLogo' ]);


	}

	public function showLogo(){

		require_once AlexExtraCorePluginTemplateDir . 'admin/start-login-page.php';

	}



	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}

}