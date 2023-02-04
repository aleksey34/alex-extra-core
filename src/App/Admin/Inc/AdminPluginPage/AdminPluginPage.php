<?php
namespace AlexExtraCore\App\Admin\Inc\AdminPluginPage;


use AlexExtraCore\App\Helper\Helper;

class AdminPluginPage{

	private static $instance;

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

		$hook_suffix = add_menu_page(
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

			// check security
				if( !Helper::issetCheckFormSecurity('alex_admin_page_form_id') ){
					return;
				}
			// end check security

			if( isset($_POST['_wp_http_referer'] )  ){
			$back_url = site_url() . $_POST['_wp_http_referer'];
			}else{
				$back_url = admin_url();
			}

			// get data from db -- theme options

			$plugin_settings = get_alex_extra_core_options();

			if(!$plugin_settings){
				Helper::updateAlexExtraCoreOptions( [] );
			}


			if( isset($_POST['prohibition_edit_file'])  && $_POST['prohibition_edit_file'] == '1'  ){
				$plugin_settings['prohibition_edit_file'] = '1';
			}else{
				$plugin_settings['prohibition_edit_file'] = false;
			}

			if( isset($_POST['devmode']) && $_POST['devmode'] == '1' ){
				$plugin_settings['devmode'] = '1';
			}else{
				$plugin_settings['devmode'] = false;
			}

			if( isset($_POST['parser_section_enable']) && $_POST['parser_section_enable'] == '1' ){
				$plugin_settings['parser_section_enable'] = '1';
			}else{
				$plugin_settings['parser_section_enable'] = false;
			}

			if(Helper::updateAlexExtraCoreOptions($plugin_settings)){
				Helper::addAdminNotice('success');
			}
	// =================================

		}

	}

	public function initAlexExtraCoreOptionConstant(){

		add_action('after_setup_theme' , function (){

			$options = get_alex_extra_core_options();
			if($options){
				define('AlexExtraCoreOptions' , $options);
			}

		}, 7);

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}