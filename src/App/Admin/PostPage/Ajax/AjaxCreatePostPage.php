<?php
namespace AlexExtraCore\App\Admin\PostPage\Ajax;


use AlexExtraCore\App\Admin\PostPage\CreatePostPage\CreatePostPage;
use AlexExtraCore\App\Admin\PostPage\RemovePostPage\RemovePostPage;

class AjaxCreatePostPage {

	private static $instance;


	public function __construct (){

		$this->init();

	}

	private function init(){
		// add js for create post for ajax
		$this->addCreatePostPageJs();


		add_action( 'wp_ajax_alex-create-post-page', [$this , 'AjaxCreatePostPageCallback'] );


	}

	public function AjaxCreatePostPageCallback(){
    ob_start();
        (new CreatePostPage())->startCreatePosts();
        echo 'success';
        $error = ob_get_clean();
        if($error){
            wp_send_json_error(   ['result'=> $error]  );
        }else{
	        wp_send_json_success(  [ "result" => "success"] , 200  ) ;
        }


        wp_die();
	}

	private function addCreatePostPageJs(){

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

                let is_first = true;
                let offset = 0;


                let alexCreatePostsFormId = 'alex_start_create_posts_form_id';

                let alexCreatePostsForm = jQuery(`#${alexCreatePostsFormId}`);
                if(alexCreatePostsForm.length >= 1 ){

                    alexCreatePostsForm.on('submit' , (e)=>{
                        e.preventDefault();


                        let alexCreatePostsFormNonceName =  `${alexCreatePostsFormId}_name`;
                        let nonce = alexCreatePostsForm.find(`#${alexCreatePostsFormNonceName}`).val();


                        let alexCreatePostsSubmit = alexCreatePostsForm.find('input[type=submit]');
                        let resultMessage   = alexCreatePostsSubmit.next('span');
                        if(resultMessage.length){
                            resultMessage.remove();
                        }
                        let  alexCreatePostsLoader   = alexCreatePostsSubmit.next('img').css('display' , 'block');


                        if(is_first){
                            is_first = false;
                        }else{
                            offset = offset + 3;
                        }

                        let data = {
                            action: 'alex-create-post-page',
                            payload: {
                                offset
                            },
                            // alex_start_create_posts_form_id_name : nonce
                        }
                        data[alexCreatePostsFormNonceName] = nonce;

                        jQuery.post( ajaxurl, data, function( response ){

                            alexCreatePostsLoader.css('display' , 'none');

                            if( response && response.data  && response.data.result ){
                                if(response.data.result  === 'success' ){
                                    alexCreatePostsSubmit.after(' <span style=\'padding-left: 10px;color: green;\'> Посты загрузились успешно</span>')
                                }else{
                                    alexCreatePostsSubmit.after(` <span  style=\'padding-left: 10px;color: red;\'> Произошла неизвестная ошибка. <br/>
                              ${response.data.result} </span>`);
                                }
                            }else {
                                alexCreatePostsSubmit.after(` <span  style=\'padding-left: 10px;color: red;\'> Произошла ошибка.</span>`);
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