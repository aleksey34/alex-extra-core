<?php
namespace  Carbon_Fields;


//use Carbon_Fields\Container;
//use Carbon_Fields\Field;
use Carbon_Fields\Inc\MetaboxFields;
use Carbon_Fields\Inc\ThemeOption;


class CarbonFieldsInit{

	private static $instance;

	public function __construct(){

		add_action( 'carbon_fields_register_fields', [$this, 'crb_register_custom_fields'] );

		add_action( 'after_setup_theme', [$this , 'crb_load' ] );

	}


	public function crb_register_custom_fields() {

		MetaboxFields::instance();
		ThemeOption::instance();

	}


	public function crb_load() {
		require_once( AlexExtraCorePluginDIR . '/vendor/autoload.php' );
		\Carbon_Fields\Carbon_Fields::boot();

	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}
}