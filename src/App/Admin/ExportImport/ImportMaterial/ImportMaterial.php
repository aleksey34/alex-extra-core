<?php
namespace AlexExtraCore\App\Admin\ExportImport\ImportMaterial;


use AlexExtraCore\App\Helper\Helper;

class ImportMaterial{

	private static $instance;

	private static $storage_dir = __DIR__ . '/storage/';

	public function __construct(){

		$this->init();

	}


	public function init(){

	}


	public  static function getData(){
		$materials =  Helper::read(static::$storage_dir . 'all_product_data_uniq_with_local_img.txt');

//		http://ferrara-design-workshop/wp-content/plugins/alex-extra-core/src/App/Admin/ExportImport/ImportMaterial/storage/img/veneziano_1_o-680x680.jpg
		$temp = [];
		$imgUrl = AlexExtraCorePluginURI . '/src/App/Admin/ExportImport/ImportMaterial/storage/img/'  ;
		$imgDir = static::$storage_dir . 'img/'  ;
		foreach ($materials as $material){
			$material['thumbnail'] =  $imgDir . $material['thumbnail']  ;
			$temp_gal= [];
			foreach ($material['gallery']   as $src){
				$temp_gal[] =  $imgDir  . $src;
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