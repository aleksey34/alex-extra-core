<?php
namespace AlexExtraCore\App\Admin\PostPage\Ajax;


use AlexExtraCore\App\Admin\AdminPluginPage\AdminPluginPage;
use AlexExtraCore\App\Admin\PostPage\RemoveMaterial\RemoveMaterial;

class AjaxRemoveMaterial {

	private static $instance;

	public function __construct (){

		$this->init();

	}

	private function init(){

		// add js for remove all materials for ajax
        $this->addRemoveMaterialsJs();


		add_action( 'wp_ajax_alex-remove-materials', [$this , 'AjaxRemoveMaterialsCallback'] );

	}


	public function AjaxRemoveMaterialsCallback(){

		ob_start();
		(new RemoveMaterial())->startRemove();
		$error = ob_get_clean();
		if($error){
			wp_send_json_error(   ['result'=> $error]  );
		}else{
			wp_send_json_success(  [ "result" => "success" ] , 200  ) ;
		}


		wp_die();
	}


	private function addRemoveMaterialsJs(){
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

                let AlexExtraCoreNonceName = 'alex_extra_core_nonce_name';

                let ajaxurl = '/wp-admin/admin-ajax.php';

                let alexRemoveMaterialsFormId = 'alex_remove_materials_form_id';

                let alexRemoveMaterialsForm = jQuery(`#${alexRemoveMaterialsFormId}`);

                if(alexRemoveMaterialsForm.length >= 1 ){


                    alexRemoveMaterialsForm.on('submit' , (e)=> {
                            e.preventDefault();

                             let nonce = alexRemoveMaterialsForm.find(`input[name=${AlexExtraCoreNonceName}`).val();

                            let alexRemoveMaterialsSubmit = alexRemoveMaterialsForm.find('input[type=submit]');
                            let  alexRemoveMaterialsLoader   = alexRemoveMaterialsSubmit.next('img').css('display' , 'block');

                            let data = {
                                action: 'alex-remove-materials',
                                alex_remove_materials_form_id_name: alexRemoveMaterialsFormId,
                                payload: {},
                            }
                            data[AlexExtraCoreNonceName]  = nonce;
                            data[`${alexRemoveMaterialsFormId}_name`]  = alexRemoveMaterialsFormId;


                            jQuery.post( ajaxurl, data, function( response ){
                                alexRemoveMaterialsLoader.css('display' , 'none');
                                if( response && response.data  && response.data.result ){
                                    if(response.data.result  === 'success' ){
                                        alexRemoveMaterialsSubmit.after(' <span style=\'padding-left: 10px;color: green;\'> Посты удалены успешно</span>')
                                    }else{
                                        alexRemoveMaterialsSubmit.after(` <span  style=\'padding-left: 10px;color:red;\'> Произошла неизвестная ошибка. <br/>
                                           ${response.data.result} </span>`);
                                    }
                                }else{
                                    alexRemoveMaterialsSubmit.after(` <span  style=\'padding-left: 10px;color: red;\'> Ошибка удаления.  </span>`);
                                }

                            } );
                        }
                    )
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