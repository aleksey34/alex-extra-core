<?php
namespace AlexExtraCore\App\Admin\Email\EmailForm;
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

		add_action('after_setup_theme' , function (){
			$type_of_form_id = 'email_form_id';


			if(!isset($_POST[$type_of_form_id]) || empty($_POST[$type_of_form_id])){
				return ;
			}
			$email_form_id = $_POST[$type_of_form_id];


			if(!Helper::issetCheckFormSecurity($email_form_id) ){
				return;
			}

			// handler here - validation -- send email-------------------
			// validation
			if(!isset($_POST['fields']) || empty($_POST['fields'])){
				return ;
			}

			$fields = Helper::doArrayFromStringForFormInput($_POST['fields']);


			$data = [];
			foreach ($fields as $field){

				// check validation
				if($field[1] === 'text' ){ // text
//validate
					$_POST[$field[0].'_error'] = 'no valid';
				}elseif('checkbox'  === $field[1] ){  //checkbox
//validate
					$_POST[$field[0].'_error'] = 'no valid';
				} // add others types if it requires

				if(!empty($_POST[$field[0]]) ) {
					$data[$field[0]] = $_POST[$field[0]];
				}else{
					if('text' === $field[1]){
						$data[$field[0]] = '';
					}elseif('checkbox' === $field[1] ){
						$data[$field[0]]  = false;
					}else{ // add others types if it requires
						$_POST[$field[0].'_error'] = 'no valid';
					}
				}
			}
			alex_var_dump($data);

//send email here






// ===============end send email
		});



	}






	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}