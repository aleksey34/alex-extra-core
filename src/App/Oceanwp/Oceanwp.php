<?php
namespace AlexExtraCore\App\Oceanwp;

class Oceanwp {

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
