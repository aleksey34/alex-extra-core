<?php
namespace AlexExtraCore\App\Admin\Inc;

/**
 * Изменение текста в подвале админ-панели
 **/
class AdminFooter {

	private static $instance;

	public function __construct (){


		/**
		 * init
		 */
		$this->init();

	}




	private function init(){

		/**
		 *
		 */
		add_filter('admin_footer_text', [$this , 'alex_footer_admin_callback']);


	}

	public function alex_footer_admin_callback () {

		require_once AlexExtraCorePluginTemplateDir . 'admin/admin-customize-footer.php';

	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}




