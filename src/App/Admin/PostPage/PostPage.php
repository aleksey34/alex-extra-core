<?php
namespace AlexExtraCore\App\Admin\PostPage;


use AlexExtraCore\App\Admin\PostPage\Ajax\AjaxCreateMaterial;
use AlexExtraCore\App\Admin\PostPage\Ajax\AjaxRemoveMaterial;
use AlexExtraCore\App\Admin\PostPage\CreateMaterial\CreateMaterial;
use AlexExtraCore\App\Admin\PostPage\RemoveMaterial\RemoveMaterial;


class PostPage {

	private static $instance;

	public function __construct (){
		$this->init();
	}

	private function init(){
		$isAjax = false;
//		$isAjax = true;
		if(is_admin()){
			if($isAjax){
				AjaxCreateMaterial::instance();

				AjaxRemoveMaterial::instance();

			}else{
				// if without Ajax !!!
				CreateMaterial::instance();

				// without Ajax only
				RemoveMaterial::instance();
			}

		}

	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}