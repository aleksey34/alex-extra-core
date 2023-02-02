<?php
namespace AlexExtraCore\App\DevMode;

/**
 * WARNING - USE DEV MODE ONLY
 *
 * при включении этого режима -
 * сайт работает только для админа
 *
 * зайти можно только по ссылке {domain}/wp-login.php
 */

class DevMode {

	private static $instance;

	public function __construct (){

	        $this->setDevMode();

	}

	private function setDevMode(){


// turn on  in  develop // need delete in production
		add_action('after_setup_theme' , function () {
//alex_var_dump(get_alex_extra_core_options()['devmode']);
			if(get_alex_extra_core_options()['devmode'] == '1') {

				// dev mode - ON - OFF
				if ( ! is_user_logged_in() && "/wp-login.php" !== $_SERVER['REQUEST_URI'] ) {

//    if(!is_user_logged_in() && "/wp-login/" !==  $_SERVER['REQUEST_URI'] ){
//        wp_safe_redirect( "http://daikin-official.loc/wp-admin" );
//        wp_redirect( "http://daikin-official.loc/wp-admin"  );
//        echo get_home_url() . '/wp-admin';
//        echo get_page_uri(get_current_blog_id());
//        echo get_queried_object_id();
//        echo '<br>';
//        echo get_page_uri(get_queried_object_id());
//        echo get_permalink(get_queried_object_id());
//echo $_SERVER['REQUEST_URI'];


					// for prod mode -- comment this line------------------------------------------
					require_once AlexExtraCorePluginTemplateDir . 'common/dev-mode-banner.php';
					wp_die( "Сайт в режиме разработки" );
					//============================================================================

				}

			}

		}, 100);


// end turn on develop


	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
