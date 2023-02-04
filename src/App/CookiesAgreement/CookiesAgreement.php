<?php
namespace AlexExtraCore\App\CookiesAgreement;

class CookiesAgreement {

	private static $instance;

	public function __construct (){

		/**
		 *
		 * init cookies agreement
		 */

		 $this->init();



	}



	private function init(){

		/**
		 *
		 */
		add_action('wp_footer' , [$this , 'addNotice'] , 100 );

	}

	public  function addNotice(){

        require_once AlexExtraCorePluginTemplateDir  . 'front/cookies-agreement.php';

    }



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}