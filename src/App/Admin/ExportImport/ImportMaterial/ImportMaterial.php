<?php
namespace AlexExtraCore\App\Admin\ExportImport\ImportMaterial;


use AlexExtraCore\App\Helper\Helper;

class ImportMaterial{

	private static $instance;

	private static $storage_dir = __DIR__ . '/storage/';


	private static $img_original_dir = __DIR__ . '/storage/img/';

	private static $img_temp_dir = __DIR__ . '/storage/img-temp/';


	public function __construct(){

		$this->init();

	}


	public function init(){

	}

	public static function getImgTempDir(){
		return static::$img_temp_dir;
	}

	public static function getImgOriginalDir(){
		return static::$img_original_dir;
	}



	public  static function getData(){
		$materials =  Helper::read(static::$storage_dir . 'all_product_data_uniq_with_local_img.txt');

		$temp = [];

		foreach ($materials as $material){
			$material['thumbnail'] =  static::$img_temp_dir . $material['thumbnail']  ;
			$temp_gal= [];
			foreach ($material['gallery']   as $src){
				$temp_gal[] =  static::$img_temp_dir . $src;
			}
			$material['gallery'] = $temp_gal;

			$temp[] = $material;
		}

		return $temp;
	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}