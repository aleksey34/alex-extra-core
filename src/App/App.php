<?php
namespace AlexExtraCore\App;

use AlexExtraCore\App\Admin\Admin;
use AlexExtraCore\App\ActivateDeactivate\ActivateDeactivate;
use AlexExtraCore\App\Email\Email;
use AlexExtraCore\App\CookiesAgreement\CookiesAgreement;
use AlexExtraCore\App\CustomPostType\CustomPostType;
use AlexExtraCore\App\CustomTaxonomy\CustomTaxonomy;
use AlexExtraCore\App\DevMode\DevMode;
use AlexExtraCore\App\Elementor\Category\Category;
use AlexExtraCore\App\Elementor\Elementor;
use AlexExtraCore\App\Gutenberg\Gutenberg;
use AlexExtraCore\App\ModalWindow\ModalWindow;
use AlexExtraCore\App\ModalWindow\ModalWindowBase\ModalWindowBase;
use AlexExtraCore\App\ScriptStyle\ScriptStyle;
use AlexExtraCore\App\PageTemplate\PageTemplate;
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
		 * create Modal Window , init and setting
		 *
		 * скрипт js - подключается со всеми скриптами сайта
		 */
//		ModalWindowBase::enqueueScripts();

		add_action('wp_head' , function (){

			if(get_post_type() ===  'material' && is_single() ){
				$args = alex_extra_core_get_settings()['modal_window_single_material_id'];
				$args['content'] = do_shortcode('[ferrara-modal-email-form form_id=material_modal ]'  ) ;
				ModalWindow::instance( $args );
			}
			if(is_page()){
				$args = alex_extra_core_get_settings()['modal_window_page_id'];
				$args['content'] = do_shortcode('[alex-common-email-form form_id=email_form ]') ;
				ModalWindow::instance( $args );
			}

			// others modal window and conditions - here

		});



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
		 * назначение шаблонам страницам записям и тд
		 *
		 * а также подкрючение кастомных шаблонов  page-template
		 * и видимость и возможнсоть назначать их из админки
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
		DevMode::instance();

		/**
		 * favorite post or any post type
		 * for DEV NOW !!!
		 */
		FavoritePost::instance();

		/**
		 * custom shortcode
		 */
		Shortcode::instance();


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


		/**
		 * everything for form email
		 * and sent email  etc
		 * handler email form
		 *
		 */
		Email::instance();


	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
