<?php
namespace AlexExtraCore\App\Admin\ExportImport;


//use AlexExtraCore\App\Admin\DownloadData\DownloadMaterialData\DownloadMaterialData;

class ExportImport{

	private static $instance;

	public function __construct(){

		$this->init();

	}


	public function init(){

		/**
		 * do not required init ?
		 */
//		DownloadMaterialData::instance();

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}