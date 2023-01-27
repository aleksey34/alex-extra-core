<?php
namespace AlexExtraCore\App\Admin\Inc\AdminPluginPage;


class AdminPluginPage{

	private static $instance;

	function __construct(){

		$this->init();

	}

	public function init(){
		add_action( 'admin_menu', array( $this, 'add' ), 25 );
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

//	function script(){
//		echo '<script>alert(\'test\')</script>';
//	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}