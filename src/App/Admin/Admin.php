<?php
namespace AlexExtraCore\App\Admin;


use AlexExtraCore\App\Admin\Inc\AdminPluginPage\AdminPluginPage;
use AlexExtraCore\App\Admin\Inc\AllowSvg;
use AlexExtraCore\App\Admin\Inc\StartLoginPage;
use AlexExtraCore\App\Admin\Inc\AdminFooter;
use AlexExtraCore\App\Admin\Inc\IconAdminMenuRemove;


class Admin {

	private static $instance;

	public function __construct (){

		/**
		 *
		 */


		/**
		 * init classes
		 */
		$this->init();

	}



	private function init(){

		IconAdminMenuRemove::instance();


		AdminFooter::instance();

		/**
		 * do not init - check code -
		 * current_user_can -do not work - may be need for hook later
		 */
		AllowSvg::instance();

		StartLoginPage::instance();

		/**
		 * Page for plugin in admin panel
		 */
		AdminPluginPage::instance();


	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
