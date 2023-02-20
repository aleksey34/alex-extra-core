<?php
namespace AlexExtraCore\App\Shortcode\Inc;

/**
 * Class EmailForm
 * @package AlexExtraCore\App\Shortcode\Inc
 * create shortcode for email form
 */

class EmailForm{

	private static $instance;

	public function __construct(){
		$this->init();

	}


	public function init(){

		$this->getAlexCommonEmailForm();

		$this->getFerraraSingleMaterialModalWindowForm();

	}

	private function getAlexCommonEmailForm(){

		add_shortcode('alex-common-email-form', [$this , 'getAlexCommonEmailFormHtml']);


	}

	public function getAlexCommonEmailFormHtml($attr){


		if(isset($attr['form_id']) && !empty($attr['form_id'])){
			global $email_common_form_id;
			$email_common_form_id = $attr['form_id'];

			global $email_common_form_slug;
			$email_common_form_slug = 'email_common_form_slug';

			require alex_exra_core_template_dir('email/form-template/common-form.php');
			unset($email_common_form_id);
			unset($email_common_form_slug);
		}else{
			alex_var_dump('не устанолен id для формы' , false);
		}

	}


	private function getFerraraSingleMaterialModalWindowForm(){
			add_shortcode('ferrara-modal-email-form', [$this , 'getFerraraSingleMaterialModalWindowFormHtml']);
	}

	public function getFerraraSingleMaterialModalWindowFormHtml($attr) {
		if(isset($attr['form_id']) && !empty($attr['form_id'])){
			global $email_common_form_id;
			$email_common_form_id = esc_html($attr['form_id']);

			global $email_common_form_slug;
			$email_common_form_slug = 'email_common_single_material_form_slug';

			require alex_exra_core_template_dir('email/form-template/common-form.php');
			unset($email_common_form_id);
			unset($email_common_form_slug);
		}else{
			alex_var_dump('не устанолен id для формы' , false);
		}
	}





		public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}


}