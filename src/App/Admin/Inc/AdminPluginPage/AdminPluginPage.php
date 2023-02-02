<?php
namespace AlexExtraCore\App\Admin\Inc\AdminPluginPage;


class AdminPluginPage{

	private static $instance;

	function __construct(){

		$this->init();

	}

	public function init(){
		add_action( 'admin_menu', array( $this, 'add' ), 25 );

        add_action('admin_init' , [$this , 'handler']  );
//        add_action('admin_head' , [$this , 'handler']  );
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
		// check security
		if( !alex_check_real_value($_POST)
			|| !alex_check_real_value($_POST['alex_admin_page_form_id_name']) ){
			return ;
		}

		if(!wp_verify_nonce(  $_POST['alex_admin_page_form_id_name'] , 'alex_admin_page_form_id_action')){
			return;
		}
		// end check security


		if(alex_check_real_value($_POST['_wp_http_referer']) ){
		$back_url = site_url() . $_POST['_wp_http_referer'];
		}else{
			$back_url = admin_url();
		}

		// get data from db -- theme options

		$plugin_settings = get_alex_extra_core_options();

		if(!$plugin_settings){
			update_alex_extra_core_options([]);
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

		if(!update_alex_extra_core_options($plugin_settings)){
			// error DB ?
			wp_redirect($back_url , '302' );

		}
//		else{
//			$plugin_settings = get_alex_extra_core_options();
//		}
//		alex_var_dump($plugin_settings);
// =================================
	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}