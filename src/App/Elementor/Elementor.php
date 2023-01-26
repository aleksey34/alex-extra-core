<?php
namespace AlexExtraCore\App\Elementor;

/**
 * WARNING - USE DEV MODE ONLY
 *
 * при включении этого режима -
 * сайт работает только для админа
 *
 * зайти можно только по ссылке {domain}/wp-login.php
 */

class Elementor {

	private static $instance;

	public function __construct (){



	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
