<?php
namespace AlexExtraCore\App\Helper;

/**
*helper functions are here
 */

class Helper {

	private static $instance;

	public function __construct (){


	}

	public static function  issetCheckFormSecurity( $form_id){
		// check security
		if( empty($_POST) || !isset($_POST[ $form_id.'_name'])
		    || empty($_POST[$form_id.'_name']) ){

			return false;
		}

		if(!wp_verify_nonce(  $_POST[$form_id.'_name'] , $form_id.'_action')){
//			$this->addNotice('error'); // error
			Helper::addAdminNotice('error');
			return false;
		}

		return true;
		// end check security

	}

	public static function  getAlexExtraCoreOptions($notice_type='success' ){
		$result  = get_option( AlexExtraCorePluginOptionName );
		if( is_serialized( $result ) ) {
			$result = unserialize($result);
		}
		return $result;

	}

	public static function  updateAlexExtraCoreOptions($options ){
		$result = '';
		if( is_serialized( $options ) ) {
			$options =  maybe_serialize($options);
		}

		$result = update_option(AlexExtraCorePluginOptionName , $options );

		return $result;

	}

	public static function  addAdminNotice($notice_type='success' ){
		if('success' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php  esc_attr_e('Настройки обновлены!' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}elseif('error' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php  esc_attr_e('Неизвестная ошибка!' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}elseif('warning' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-warning  is-dismissible">
					<p><?php  esc_attr_e('Проверьте заполнение полей. Url обязательные поле' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
