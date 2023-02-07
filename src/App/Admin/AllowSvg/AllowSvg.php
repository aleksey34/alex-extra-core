<?php
namespace AlexExtraCore\App\Admin\AllowSvg;
/**
 * allow using SVG img
 */

class AllowSvg {

	private static $instance;

	public function __construct() {

		/**
		 * init
		 */
//		if(is_admin() && current_user_can('manage_options') ) {

//		if(is_admin() && is_login() ) {
//
//			$this->init();
//		}

	}


	private function init() {

		/**
		 *
		 */


			/**
			 * # Добавляет SVG в список разрешенных для загрузки файлов.
			 */
			$this->allowSvgDownload();

			/**
			 * # Исправление MIME типа для SVG файлов.
			 */
			$this->fixMINESvgType();


			/**
			 * # Формирует данные для отображения SVG как изображения в медиабиблиотеке.
			 */
			$this->doDataShowSVGAsImgInMediaLibrary();



	}


	private function allowSvgDownload(){

// Проверить!!!


		/**
		 * # Добавляет SVG в список разрешенных для загрузки файлов.
		 * check current_user_can -- here!! into callback of hook!
		 */
		//	add_filter( 'upload_mimes', 'svg_upload_allow' );
	    add_filter( 'upload_mimes', function ( $mimes ) {
		    if(current_user_can('manage_options') ){
			    $mimes['svg'] = 'image/svg+xml';
			    // end check
		    }
	        // check

			return $mimes;
		} );



	}

	private function fixMINESvgType(){

		/**
		 * # Исправление MIME типа для SVG файлов.
		 */
		//	add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
		add_filter( 'wp_check_filetype_and_ext',function ( $data, $file, $filename, $mimes, $real_mime = '' ){

			// WP 5.1 +
			if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
				$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
			}
			else {
				$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
			}

			// mime тип был обнулен, поправим его
			// а также проверим право пользователя
			if( $dosvg ){

				// разрешим
				if( current_user_can('manage_options') ){

					$data['ext']  = 'svg';
					$data['type'] = 'image/svg+xml';
				}
				// запретим
				else {
					$data['ext']  = false;
					$data['type'] = false;
				}

			}

			return $data;
		} , 10, 5 );


	}

	private function doDataShowSVGAsImgInMediaLibrary(){

		/**
		 * # Формирует данные для отображения SVG как изображения в медиабиблиотеке.
		 */
//	add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );
		add_filter( 'wp_prepare_attachment_for_js', function ( $response ) {

			if ( $response['mime'] === 'image/svg+xml' ) {

				// С выводом названия файла
				$response['image'] = [
					'src' => $response['url'],
				];
			}

			return $response;
		} );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}