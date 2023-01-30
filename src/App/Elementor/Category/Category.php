<?php


namespace AlexExtraCore\App\Elementor\Category;



class Category {

	private static $instance;

	public function __construct() {

		/**
		 *
		 */
		$this->init();


	}


	/**
	 * Create custom widget category
	 */
	public function init(){

		// register custom widget category and check  exists or not

		// with this check(if... - no work
//		if(class_exists("Elementor_Custom_Extension")){

		// Work!!
			add_action( 'elementor/elements/categories_registered', function ($elements_manager){

				$elements_manager->add_category(
					'alex-extra-core-category',
					[
						'title' => __( 'Alex Extra Core Widgets', 'elementor-custom-extension' ),
						'icon' => 'fa fa-plug',
					]
				);

			} );

//		}

	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}




