<?php
namespace AlexExtraCore\App;

use AlexExtraCore\App\Admin\Admin;
use AlexExtraCore\App\ActivateDeactivate\ActivateDeactivate;
use AlexExtraCore\App\CookiesAgreement\CookiesAgreement;
use AlexExtraCore\App\CustomPostType\CustomPostType;
use AlexExtraCore\App\CustomTaxonomy\CustomTaxonomy;
use AlexExtraCore\App\DevMode\DevMode;
use AlexExtraCore\App\Elementor\Category\Category;
use AlexExtraCore\App\Elementor\Elementor;
use AlexExtraCore\App\Gutenberg\Gutenberg;
use AlexExtraCore\App\ScriptStyle\ScriptStyle;
use AlexExtraCore\App\PageTemplate\PageTemplate;
use AlexExtraCore\App\PostPage\PostPage;
use AlexExtraCore\App\RestApi\RestApi;
use AlexExtraCore\App\Shortcode\Shortcode;

use AlexExtraCore\App\FavoritePost\FavoritePost;

class App {

	private static $instance;

	public function __construct (){

		/**
		 * require files with classes
		 */


		/**
		 * init classes
		 */
		$this->init();

	}




	public function init(){

		/**
		 * activate and deactivate func
		 */
		ActivateDeactivate::instance();

//		RestApi::instance();

		/**
		 * customize admin -- page and others
		 *plugin admin page and others
		 */
		Admin::instance();


		/**
		 * Script and common styles
		 */
		ScriptStyle::instance();



		/**
		 *
		 */
		CookiesAgreement::instance();

		/**
		 * Template for page with programming created
		 */
//		PageTemplate::instance();

		/**
		 * register custom post type
		 */
		CustomPostType::instance();

		/**
		 * Register custom taxonomy
		 */
		CustomTaxonomy::instance();

		/**
		 * Set dev mode
		 * banner dev mode
		 */
//		DevMode::instance();

		/**
		 * favorite post or any post type
		 * for DEV NOW !!!
		 */
//		FavoritePost::instance();

		/**
		 * custom shortcode
		 */
		Shortcode::instance();

		/**
		 * creating Post and Page
		 */
//		PostPage::instance();



		/**
		 * Gutenberg
		 */
		Gutenberg::instance();


		/**
		 * Custom Elementor widgets
		 * set custom category
		 */
		Category::instance();
		Elementor::instance();

	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
