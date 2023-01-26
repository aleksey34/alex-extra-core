<?php
namespace AlexExtraCore\App\Admin\Inc;

/**
 * Remove WP.org logo and links from toolbar
 *
 * @param $wp_admin_bar object Standard WP Admin Bar object
 */
class IconAdminMenuRemove {

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
		add_action( 'admin_bar_menu', [$this , 'pss_remove_wp_logo'], 999 );


		add_action( 'wp_before_admin_bar_render', [$this , 'wps_admin_bar' ] );


	}


	public function pss_remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}
//как дополнение, можно убрать упоминание wordpress во всем что установлено или планируется установить, на будущее:


//убираем везде лого wordpress
	function wps_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('about');
		$wp_admin_bar->remove_menu('wporg');
		$wp_admin_bar->remove_menu('documentation');
		$wp_admin_bar->remove_menu('support-forums');
		$wp_admin_bar->remove_menu('feedback');
		$wp_admin_bar->remove_menu('view-site');
	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}