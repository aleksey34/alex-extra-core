<?php
namespace AlexExtraCore\App\Admin\Inc;

/**
 * Изменение текста в подвале админ-панели
 **/
class AdminFooter {

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
		add_filter('admin_footer_text', [$this , 'alex_footer_admin_callback']);


	}

	public function alex_footer_admin_callback () {

		echo     '<div style="position: absolute;padding-bottom: 1rem;">'.
		         '<h3  style="margin: 0 0 0.5rem 0;padding-top: 2rem;">Сайт разработан: Aleksey</h3>'.
		         '<p><b>Email:</b> <a href="mailto:aleksey3400@yandex.ru" target="_blank"> aleksey3400@yandex.ru</a></p>'.
		         '<p><b>Номер телефона:</b> <a href="tel:+79951164367" target="_blank"> Aleksey tel +79951164367</a></p>'.
		         '<p><b>WhatsApp:</b> <a href="https://wa.me/79951164367" target="_blank"> Aleksey WhatsApp +79951164367</a></p>'.
		         '<p><b>Skype:</b><a href="skype:aleksey34">aleksey34</a></p>'.
		         '</div></div>';
	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}




