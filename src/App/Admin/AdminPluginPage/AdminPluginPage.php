<?php
namespace AlexExtraCore\App\Admin\AdminPluginPage;


use AlexExtraCore\App\Helper\Helper;

class AdminPluginPage{

	private static $instance;

	private static $hook_suffix;

	function __construct(){

		$this->init();

	}

	public function init(){
		/**
		 * set page in admin menu
		 */
		add_action( 'admin_menu', array( $this, 'add' ), 25 );

		/**
		 * set form handler
		 */
        add_action('after_setup_theme' , [$this , 'handler'] , 5  );


		/**
		 * create constant theme option -alex extra core
		 */
        $this ->initAlexExtraCoreOptionConstant();


	}

	public function add(){

//		$hook_suffix
		self::$hook_suffix = add_menu_page(
					'Alex Extra Core Настройки', // тайтл страницы
					'Alex Extra Core', // текст ссылки в меню
					'manage_options',
					'alex-extra-core',
					array( $this, 'display' ),
					'dashicons-images-alt2',
					20
				);
		// используем хук admin_print_scripts-{$hook_suffix} для вывода скриптов только на нашей странице
//		add_action( 'admin_print_scripts-' . $hook_suffix, array( $this, 'script' ) );

	}

	public function display(){
//		echo '<div class="wrap"><h2>' . get_admin_page_title() . '</h2></div>';
		// можем использовать функцию get_admin_page_title(), чтобы динамически вывести "Настройки слайдера"
		require_once AlexExtraCorePluginTemplateDir . 'admin/admin-page-plugin-template.php';
	}


	public function handler(){
		if(is_admin()){
			if(!isset($_POST['submit'])){
				return false;
			}

			$type_of_form_id = 'admin_form_id';

			if(!isset($_POST[$type_of_form_id]) || empty($_POST[$type_of_form_id])){
				return false;
			}

			$admin_form_id = $_POST[$type_of_form_id];


			$this->getFormHandler($admin_form_id );
		}

	}




	private function getFormHandler($admin_form_id ){

		//security
		if( Helper::issetCheckFormSecurity($admin_form_id) ){


// data
		$plugin_settings = Helper::getAlexExtraCoreOptions();


		if(!$plugin_settings || empty($plugin_settings) || gettype($plugin_settings) !== 'array'    ){
			$plugin_settings = [];
			Helper::updateAlexExtraCoreOptions( $plugin_settings );
		}

			$fields = Helper::getFormDataBy($admin_form_id);

		foreach ($fields as $field){
			$plugin_settings[ $field['name']] = $field['value'] ;
		}

			// set data
				if(Helper::updateAlexExtraCoreOptions($plugin_settings)){
					Helper::addAdminNotice('success');
				}

			}

				// =============================
	}



	public function initAlexExtraCoreOptionConstant(){

		add_action('after_setup_theme' , function (){

			$options = get_alex_extra_core_options();
			if($options){
				define('AlexExtraCoreOptions' , $options);
			}

		}, 7);

	}


	public static function getHookSuffix(){
		return self::$hook_suffix;
	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}