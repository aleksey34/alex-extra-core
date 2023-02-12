<?php
namespace AlexExtraCore\App\Admin\PostPage;



use AlexExtraCore\App\Admin\PostPage\Ajax\AjaxCreatePostPage;
use AlexExtraCore\App\Admin\PostPage\Ajax\AjaxRemovePostPage;
use AlexExtraCore\App\Admin\PostPage\CreatePostPage\CreatePostPage;
use AlexExtraCore\App\Admin\PostPage\RemovePostPage\RemovePostPage;


class PostPage {

	private static $instance;


	public function __construct (){

		$this->init();


	}

	private function init(){
		$isAjax = true;
		if(is_admin()){
			if($isAjax){
				AjaxCreatePostPage::instance();

				AjaxRemovePostPage::instance();
			}else{
				// if without Ajax !!!
				CreatePostPage::instance();

				// without Ajax only
				RemovePostPage::instance();
			}
//			RemovePostPage::instance();// temp only




		}

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
