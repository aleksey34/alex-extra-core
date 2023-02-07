<?php
namespace AlexExtraCore\App\Admin;


use AlexExtraCore\App\Admin\AdminFooter\AdminFooter;
use AlexExtraCore\App\Admin\AdminPluginPage\AdminPluginPage;
use AlexExtraCore\App\Admin\AllowSvg\AllowSvg;
use AlexExtraCore\App\Admin\IconAdminMenuRemove\IconAdminMenuRemove;
use AlexExtraCore\App\Admin\Parser\Parser;
use AlexExtraCore\App\Admin\PostPage\PostPage;
use AlexExtraCore\App\Admin\StartLoginPage\StartLoginPage;


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

		/**
		 * init parser
		 */
		if(is_admin()){
			Parser::instance();
		}

		/**
		 * creating Post and Page
		 */
		PostPage::instance();


	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
