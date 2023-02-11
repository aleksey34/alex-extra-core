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
//		add_filter( 'wp_image_editors', 'change_graphic_lib' );
//		function change_graphic_lib($array) {
//			return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
//		}
//alex_var_dump(  (new \wpdb()) ->base_prefix);
		RemovePostPage::instance();

		CreatePostPage::instance();

	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
