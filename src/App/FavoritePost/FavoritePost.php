<?php
namespace AlexExtraCore\App\FavoritePost;

use AlexExtraCore\App\FavoritePost\Inc\FavoriteScriptStyle;

class FavoritePost{

	private static $instance;

	public function __construct(){

		$this -> init();
	}

	private function init(){

		FavoriteScriptStyle::instance();

	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}


}