<?php
namespace AlexExtraCore\App\Admin\PostPage\Ajax;


use AlexExtraCore\App\Admin\PostPage\RemovePostPage\RemovePostPage;

class AjaxRemovePostPage {

	private static $instance;



	public function __construct (){

		$this->init();

	}

	private function init(){

		// add js for remove all posts for ajax
        $this->addRemovePostPageJs();


		add_action( 'wp_ajax_alex-remove-post-page', [$this , 'AjaxRemovePostPageCallback'] );

	}


	public function AjaxRemovePostPageCallback(){

		ob_start();
		(new RemovePostPage())->startRemoveAllPosts();
		$error = ob_get_clean();
		if($error){
			wp_send_json_error(   ['result'=> $error]  );
		}else{
			wp_send_json_success(  [ "result" => "success" ] , 200  ) ;
		}


		wp_die();
	}


	private function addRemovePostPageJs(){


		if(isset($_GET['page']) && $_GET['page'] === 'alex-extra-core' ):


			add_action('admin_footer' , function (){
				?>
                <script>
                    jQuery(function (){

                        let ajaxurl = '/wp-admin/admin-ajax.php';

                        let alexRemovePostsFormId = 'alex_remove_posts_form_id';

                        let alexRemovePostsForm = jQuery(`#${alexRemovePostsFormId}`);

                        if(alexRemovePostsForm.length >= 1 ){

                            alexRemovePostsForm.on('submit' , (e)=> {
                                e.preventDefault();

                                let alexRemovePostsFormNonceName =  `${alexRemovePostsFormId}_name`;
                                let nonce = alexRemovePostsForm.find(`#${alexRemovePostsFormNonceName}`).val();

                                let alexRemovePostsSubmit = alexRemovePostsForm.find('input[type=submit]');
                                let  alexRemovePostsLoader   = alexRemovePostsSubmit.next('img').css('display' , 'block');

                                let data = {
                                    action: 'alex-remove-post-page',
                                    payload: {},
                                    // alex_remove_posts_form_id_name : nonce
                                }
                                data[alexRemovePostsFormNonceName]  = nonce;


                                jQuery.post( ajaxurl, data, function( response ){
                                    alexRemovePostsLoader.css('display' , 'none');
                                    if( response && response.data  && response.data.result ){
                                        if(response.data.result  === 'success' ){

                                            alexRemovePostsSubmit.after(' <span style=\'padding-left: 10px;\'> Посты удалены успешно</span>')
                                        }else{
                                            alexRemovePostsSubmit.after(` <span  style=\'padding-left: 10px;\'> Произошла неизвестная ошибка. <br/>
                                           ${response.data.result} </span>`);
                                        }
                                    }else{
                                        alexRemovePostsSubmit.after(` <span  style=\'padding-left: 10px;\'> Ошибка удаления.  </span>`);
                                    }

                                } );

                                }
                            )

                        }

                    })
                </script>
				<?php
			}, 100);

		endif;




	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}