<?php
namespace AlexExtraCore\App\Gutenberg;

use AlexExtraCore\App\Gutenberg\Blocks\EventsAllEventsDynamic;
use AlexExtraCore\App\Gutenberg\Blocks\SlickSliderFromDefaultGallery;
use AlexExtraCore\App\Gutenberg\Inc\Api\RestPrepareDynamic;
use AlexExtraCore\App\Gutenberg\Inc\CustomGutenbergCategory;
use AlexExtraCore\App\Gutenberg\Inc\StaticBlocks;

class Gutenberg {

	private static $instance;

	public function __construct (){

		/**
		 * init classes
		 */
		$this->init();

	}



	private function init(){

		/**
		 *  prepare rest api request
		 */
		RestPrepareDynamic::instance();


		/**
		 * init static blocks
		 */
		StaticBlocks::instance();


		/**
		 * create custom categories
		 * change slug category in block.json for set widget category
		 */
		CustomGutenbergCategory::instance();


		/**
		 * init block --  all-events  Dynamic block
		 * Create new class for new dynamic block and add here
		 */
		EventsAllEventsDynamic::instance();

		/**
		 * init block --  all-events  Dynamic block
		 * Create new class for new dynamic block and add here
		 */
		SlickSliderFromDefaultGallery::instance();

	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
