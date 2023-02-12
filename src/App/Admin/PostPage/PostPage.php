<?php
namespace AlexExtraCore\App\Admin\PostPage;



use AlexExtraCore\App\Admin\PostPage\CreatePostPage\CreatePostPage;
use AlexExtraCore\App\Admin\PostPage\RemovePostPage\RemovePostPage;


class PostPage {

	private static $instance;

	private static $dataPath = AlexExtraCorePluginDIR . 'data/materials/all-product-data.txt';

	private static $postType= 'material';



	public function __construct (){

		$this->init();


	}

	private function init(){

		if(is_admin()){
			RemovePostPage::instance();

			CreatePostPage::instance();
		}

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
