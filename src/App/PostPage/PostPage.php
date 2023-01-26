<?php
namespace AlexExtraCore\App\PostPage;

class PostPage {

	private static $instance;

	public function __construct (){

		$this->createPostPage($this->getSettings());

	}

	private function getSettings(){

		return [

		];

	}

	private function createPostPage($settings){


	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
