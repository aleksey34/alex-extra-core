<?php
namespace AlexExtraCore\App\ActivateDeactivate;

class ActivateDeactivate {

	private static $instance;

	public function __construct (){

		$this->activate();

		$this->deactivate();

	}

	private function activate(){


		register_activation_hook( AlexExtraCorePluginDIR .'/alex-extra-core.php' , [$this , 'pluginActivateCallback'] );


	}


	/**
	 * do for activate ( refresh link etc
	 */
	public function pluginActivateCallback(){

//add_action( 'init', 'myplugin_setup_post_type' );
		//function myplugin_setup_post_type(){
		//	// Регистрируем тип записи "book"
		//	register_post_type('book', array(
		//		'public' => 'true'
		//	) );
		//}
		//
		//register_activation_hook( __FILE__, 'myplugin_install' );
		//function myplugin_install(){
		//	// Запускаем функцию регистрации типа записи
		//	myplugin_setup_post_types();
		//
		//	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
		//	flush_rewrite_rules();
		//}

	}


	private function deactivate(){

		register_deactivation_hook( AlexExtraCorePluginDIR .'/alex-extra-core.php' , [$this , 'pluginDeativateCallback'] );

	}

	/**
	 * do for deactivate
	 */
	public function pluginDeativateCallback(){

//add_action( 'init', 'myplugin_setup_post_type' );
		//function myplugin_setup_post_type(){
		//	// Регистрируем тип записи "book"
		//	register_post_type('book', array(
		//		'public' => 'true'
		//	) );
		//}
		//
		//register_activation_hook( __FILE__, 'myplugin_install' );
		//function myplugin_install(){
		//	// Запускаем функцию регистрации типа записи
		//	myplugin_setup_post_types();
		//
		//	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
		//	flush_rewrite_rules();
		//}

	}



//	private function taxonomyInclude(){
//
//		require_once AlexExtraCorePluginDIR .'/include/custom-taxonomy/class-alex-custom-tax.php';
//
//		AlexCustomTaxonomy::instance();
//	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}