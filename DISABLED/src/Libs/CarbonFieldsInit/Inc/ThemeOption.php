<?php
namespace  Carbon_Fields\Inc;


use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ThemeOption {

	private static $instance;

	public function __construct (){

		$this->setOptions();

	}


	private function setOptions(){

		Container::make( 'theme_options', __( 'Theme Options' ) )
//	->set_icon("dashicons-admin-generic")
                 ->set_icon("dashicons-carrot")
		         ->add_tab( __( "Header" , "mind" ), array(
//		Field::make( 'image', 'mind_header_logo_image', __( 'Logo Image' , "mind" ) ),
//		Field::make( 'text', 'mind_site_name', __( 'Site Name' , "mind" ) ),
//		Field::make( 'text', 'mind_site_desc', __( 'Site Description' , "mind" ) ),
//
//		Field::make( 'color', 'mind_header_background_color', __( 'Header Background Color' , "mind" ) )
//			->set_width(40),
//		Field::make( 'image', 'mind_header_background_img', __( 'Header Background Image' , "mind" ) )
//			->set_width(40),
//		Field::make( 'checkbox', 'mind_header_background_repeat', __( 'Background repeat or not ?' , "mind" ) )
//			->set_width(20),


			         Field::make( 'text', 'crb_first_phone_for_href', __( 'Первый телефон для ссылки-формат +7.... ' ) )
			              ->set_default_value( '+74993903775' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_first_phone', __( 'Первый телефон для показа' ) )
			              ->set_default_value( '8 (499) 390-37-75' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_second_phone_for_href', __( 'Второй телефон для ссылки-формат +7.... ' ) )
			              ->set_default_value( '+79262701720' )
			              ->set_width( 50 ),
			         Field::make( 'text', 'crb_second_phone', __( 'Второй телефон для показа' ) )
			              ->set_default_value( '8 (926) 270-17-20' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_third_phone', __( 'Телефон для иконки-формат +7.... ' ) )
			              ->set_default_value( '+79262701720' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_telegram_name', __( 'Имя в телеграм без  @' ) )
			              ->set_default_value( 'daikinsevices' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_whatsapp_phone', __( 'Телефон для Whatsapp-формат +7.... ' ) )
			              ->set_default_value( '+79262701720' )
			              ->set_width( 50 ),

			         Field::make( 'text', 'crb_call_href', __( 'Ссылка для кнопки -вызвать специалиста' ) )
			              ->set_default_value( 'https://daikin.ru' )
			              ->set_width( 50 ),

		         ) )
		         ->add_tab( __( 'Footer' , "mind" ), array(
//		Field::make( 'text', 'crb_first_phone', __( 'Notification Email' ) ),
//		Field::make( 'text', 'crb_second_phone', __( 'Phone Number' ) ),
//        Field::make( 'text', 'crb_third_phone', __( 'Phone Number' ) ),
//        Field::make( 'text', 'crb_telegram_url', __( 'Phone Number' ) ),
//        Field::make( 'text', 'crb_whatsapp_phone', __( 'Phone Number' ) ),
		         ) );


	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}


// example

//Container::make( 'theme_options', __( 'Theme Options' ) )
//         ->add_fields( array(
//	         Field::make( 'text', 'crb_text', 'Text Field' ),
//         ) );



//$basic_options_container = Container::make( 'theme_options', __( 'Basic Options' ) )
//                                    ->add_fields( array(
//	                                    Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script' ) ),
//	                                    Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script' ) ),
//                                    ) );

// Add second options page under 'Basic Options'
//Container::make( 'theme_options', __( 'Social Links' ) )
//         ->set_page_parent( $basic_options_container ) // reference to a top level container
//         ->add_fields( array(
//		Field::make( 'text', 'crb_facebook_link', __( 'Facebook Link' ) ),
//		Field::make( 'text', 'crb_twitter_link', __( 'Twitter Link' ) ),
//	) );

// Add third options page under "Appearance"
//Container::make( 'theme_options', __( 'Customize Background' ) )
//         ->set_page_parent( 'themes.php' ) // identificator of the "Appearance" admin section
//         ->add_fields( array(
//		Field::make( 'color', 'crb_background_color', __( 'Background Color' ) ),
//		Field::make( 'image', 'crb_background_image', __( 'Background Image' ) ),
//	) );