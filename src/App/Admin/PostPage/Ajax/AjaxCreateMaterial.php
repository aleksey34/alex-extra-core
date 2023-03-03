<?php
namespace AlexExtraCore\App\Admin\PostPage\Ajax;


use AlexExtraCore\App\Admin\AdminPluginPage\AdminPluginPage;
use AlexExtraCore\App\Admin\PostPage\CreateMaterial\CreateMaterial;


class AjaxCreateMaterial {

	private static $instance;


	public function __construct (){

		$this->init();

	}

	private function init(){
		// add js for create materials for ajax
		$this->addCreateMaterialsJs();

		add_action( 'wp_ajax_alex-create-materials', [$this , 'AjaxCreateMaterialsCallback'] );

	}

	public function AjaxCreateMaterialsCallback(){
    ob_start();
        (new CreateMaterial())->startCreate();
        echo 'success';
        $error = ob_get_clean();
        if($error){
            wp_send_json_error(   ['result'=> $error]  );
        }else{
	        wp_send_json_success(  [ "result" => "success"] , 200  ) ;
        }


        wp_die();
	}

	private function addCreateMaterialsJs(){

	   if(isset($_GET['page']) && $_GET['page'] === 'alex-extra-core' ):


		add_action('admin_footer' , function (){
		    $this->getJs();
		}, 100);

	   endif;

	}

	private function getJs(){
	    ?>
        <script>
            jQuery(function (){

                let ajaxurl = '/wp-admin/admin-ajax.php';

                let AlexExtraCoreNonceName = 'alex_extra_core_nonce_name';


                let alexCreateMaterialsFormId = 'alex_create_materials_form_id';

                let alexCreateMaterialsForm = jQuery(`#${alexCreateMaterialsFormId}`);
                if(alexCreateMaterialsForm.length >= 1 ){

                    alexCreateMaterialsForm.on('submit' , (e)=>{
                        e.preventDefault();

                        let nonce = alexCreateMaterialsForm.find(`input[name=${AlexExtraCoreNonceName}`).val();

                        let alexCreateMaterialsSubmit = alexCreateMaterialsForm.find('input[type=submit]');
                        let resultMessage   = alexCreateMaterialsSubmit.next('span');
                        if(resultMessage.length){
                            resultMessage.remove();
                        }
                        let  alexCreateMaterialsLoader   = alexCreateMaterialsSubmit.next('img').css('display' , 'block');



                        let data = {
                            action: 'alex-create-materials',
                            payload: {
                            },
                        }
                        data[AlexExtraCoreNonceName] = nonce;
                        data[`${alexCreateMaterialsFormId}_name`] = alexCreateMaterialsFormId;


                        jQuery.post( ajaxurl, data, function( response ){

                            alexCreateMaterialsLoader.css('display' , 'none');

                            if( response && response.data  && response.data.result ){
                                if(response.data.result  === 'success' ){
                                    alexCreateMaterialsSubmit.after(' <span style=\'padding-left: 10px;color: green;\'> Посты загрузились успешно</span>')
                                }else{
                                    alexCreateMaterialsSubmit.after(` <span  style=\'padding-left: 10px;color: red;\'> Произошла неизвестная ошибка. <br/>
                              ${response.data.result} </span>`);
                                }
                            }else {
                                alexCreateMaterialsSubmit.after(` <span  style=\'padding-left: 10px;color: red;\'> Произошла ошибка.</span>`);
                            }

                        } );

                    });
                }
            })
        </script>
        <?php
	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}