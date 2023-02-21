<?php
namespace AlexExtraCore\App\Email\EmailForm;


use AlexExtraCore\App\Helper\Helper;

/**
 * allow using SVG img
 */

class EmailForm {

	private static $instance;

	public function __construct() {

			$this->init();

	}

	private function init() {

		$this->formHandler();
	}

	private function formHandler(){
		add_action('init' , function (){

			if(!isset($_POST['submit']) ) {
				return;
			}


			$email_common_form_slug_name = 'email_common_form_slug_name';
			$email_common_form_id_name= 'email_common_form_id_name';

			if(isset($_POST[$email_common_form_id_name]) && !empty($_POST[$email_common_form_id_name]) && Helper::issetCheckFormSecurity(esc_html($_POST[$email_common_form_id_name]) ) ) :

				// check hidden input
				if( isset($_POST['not_clever1'])
				    || !isset($_POST['not_clever2'])
				    || ( isset($_POST['not_clever2'])  &&  $_POST['not_clever2']  !== ''   )
					||  !isset($_POST['not_clever3'])
					|| ( isset($_POST['not_clever3'] ) &&  $_POST['not_clever3'] !== 'right' )  ){
				return ;
			}



				// handler here - validation -- send email-------------------
				// validation
				$email_common_form_slug = esc_html($_POST[$email_common_form_slug_name]  ) ;
				if(!isset($email_common_form_slug)  || empty($email_common_form_slug)  ){

					return;
				}

				$fields	= Helper::getFormDataBy($email_common_form_slug);


				$error = $this->validate($fields);

				if(count($error)  < 1 ){

					$data = $this->getData($fields);
					$this->prepareEmail();
					if($this->sendEmail($data)){
						$_POST['form_success'] = true;
						return ;
					}else{
						$error['send_mail'] = true;
					}
				}

				$_POST['form_error'] = $error;

			endif;

		} );
	}

	private function  sendEmail( $data , $to= ''  , $subject = '' , $message = ''  ,$headers= [] , $attachments= false  ){

		if(!isset($to) || empty($to)   ){
			// email -olga.vlad@inbox.ru - for testing /-- remove after test!!
			$to = [ get_bloginfo('admin_email' ) ]  ;// = email
//			$to = [ bloginfo('admin_email') , 'olga.vlad@inbox.ru' ]  ;// = email
			$to = [  'olga.vlad@inbox.ru' ]  ;// = email
		}


		if(!isset($subject)  || empty($subject) ){
			$subject = 'New message.';
			$subject = "=?UTF-8?B?Заявка с сайта?=";
//			$subject = "=?UTF-8?B?".base64_encode("Заявка с сайта")."?=";
			$subject = esc_html("Новое сообщение!");
//			$subject = '=?utf-8?B?'.base64_encode('Новое сообщение!').'?=';
//			$subject = base64_encode('Новое сообщение!');
		}

		if(!isset($message)   || empty($message) ){
			global $common_email_fields;
			$common_email_fields = $data;
			ob_start();
			require  AlexExtraCorePluginTemplateDir . 'email/email-template/common-form-email-template.php';
			$message = ob_get_clean();
			unset($common_email_fields);
		}


		$headers = array(

			'From: Ferrara Design Workshop Site <' . get_bloginfo('admin_email' ) . '>',
			'Content-type: text/html; charset=utf-8',

//			'Content-Transfer-Encoding: 16bit'
//			'Content-Transfer-Encoding: 8bit'
//
//			'cc: John Q Codex <jqc@wordpress.org>',
//			'cc: John2 Codex <j2qc@wordpress.org>',
//			'bcc: iluvwp@wordpress.org', // тут можно использовать только простой email адрес
		);

		return wp_mail( $to ,  $subject , $message , $headers  );
	}

	private function prepareEmail(){


		/**
		 * Function for `pre_wp_mail` filter-hook.
		 *
		 * @param null|bool $return Short-circuit return value.
		 * @param array     $atts   Array of the `wp_mail()` arguments.
		 *
		 * @return null|bool
		 */
//		add_filter( 'pre_wp_mail',		function ( $return, $atts ){
////          alex_var_dump($return, false);
////          alex_var_dump($atts, false);
//			// filter...
//			return $atts['subject'] = 'test test test';
//		} , 10, 2 );



//		add_filter( 'wp_mail_charset', function ( $content_type ) {
//			return 'utf-8';
//		} );



//		add_filter( 'wp_mail_from', function ($email_address){
//			return network_site_url();
////			return 'xxx@yyy.com';
//			// получим заголовок: WordPress <xxx@yyy.com>
//		} );



		add_filter( 'wp_mail_from_name', function($from_name){
			return 'Ferrara Design Workshop'; // тут можно указать свою почту: asd@asd.ru
		} );
// получим заголовок: XXX <wordpress@yoursite.com>


		// use html in email message
		// Сбросим content-type, чтобы избежать возможного конфликта
//		remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
//		add_filter( 'wp_mail_content_type', function( $content_type ){
//			return "text/html";
//		} );


	}

    private function validate($fields){
	    $error = [];
	    foreach ($fields as $field) {

		    $name =  $field['name'] ;
		    $type =  $field['type'] ;
		    $value =  $field['value'];


		    // check validation

		    if($type === 'text' || $type === 'textarea' ){ // text

		    }elseif('checkbox'  === $type ){  //checkbox

		    }elseif($type === 'tel'){
		    	if(Helper::validateFormPhoneNumber($value) !== 1){
				    $error[$name] = true;
			    }

		    }elseif( $type ===  'email' ){
					if(!is_email( $value ) ){
					$error[$name] = true;
					}
		    } // add others types if it requires for validate

		    if($name === 'user_name'){
			    if(!Helper::validateFormUserName($value)){
				    $error[$name] = true;
			    }
		    }

	    }
	   return $error;
    }


    private function  getData($fields){
		$data =[];
	    foreach ($fields as $field){
		    $name =  $field['name'] ;
		    $type =  $field['type'] ;
		    $value =  $field['value'];


		    if( isset($value) && !empty($value) ) {
			    $data[$name] = $value  ;
		    }else{
			    if('text' === $type ){
				    $data[$name] = '';
			    }elseif('checkbox' === $type ){
				    $data[$name]  = false;
			    }elseif('tel' === $type ){
				    $data[$name]  = '';
			    }elseif('email' === $type){
				    $data[$name]  = '';
			    }
			    else{ // add others types if it requires

				   alex_var_dump('this type is unknown');
			    }
		    }
	    }
	    return $data;
    }


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}

}