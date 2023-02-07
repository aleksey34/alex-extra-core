<?php
namespace AlexExtraCore\App\Admin\PostPage;



use AlexExtraCore\App\Helper\Helper;

class PostPage {

	private static $instance;

	public function __construct (){
//alex_var_dump(444);
//		$this->init();
	}

	private function init(){

		add_action('after_setup_theme' , [$this , 'startCreatePosts']);

	}

	private function getSettings(){

		return [
				'post_status' => 'publish',
				'post_author' => 1,
				'post_category' => [1],
				"post_type"     => 'material'
		];

	}

	private function getData(){

		return [];
	}

	private function uploadMedia($url , $post_id ){

		// Для примера возьмём картинку с моего же блога, которая была залита вне структуры wordpress
//		$url = 'http://sergeivl.ru/public/img/svlJForm.png';

// Прикрепим к ранее сохранённому посту
//$post_id = 3061;
		$description = "Картинка для обложки";

// Установим данные файла
		$file_array = array();
		$tmp = download_url($url);

// Получаем имя файла
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
		$file_array['name'] = basename($matches[0]);
		$file_array['tmp_name'] = $tmp;

// загружаем файл
		$media_id = media_handle_sideload( $file_array, $post_id, $description);

// Проверяем на наличие ошибок
		if( is_wp_error($media_id) ) {
			@unlink($file_array['tmp_name']);
			echo $media_id->get_error_messages();
		}

// Удаляем временный файл
		@unlink( $file_array['tmp_name'] );

		return $media_id;

	}

	public function createPost($settings , $data){
		// post -material
//		require_once(dirname(__FILE__) . '/wp-load.php'); //?? what is it????
		$post_data = $settings;
		$post_data['post_title'] = $data['title'];
		$post_data['post_content'] = $data['content'];





// Вставляем запись в базу данных
		$post_id = wp_insert_post($post_data, true);

// Задаём значение для дополнительного поля:
// В одном из моих блогов есть дополнительное поле rating (числовое).
// Его мы и зададим. Для примера, выставим значение 80
		update_post_meta($post_id , 'rating', 80);
// Второе поле - строковое - postscriptum




// create media and set to post
		$media_id = $this->uploadMedia('url' , $post_id );
		// Файл сохранён и добавлен в медиатеку WP. Теперь назначаем его в качестве облож
		set_post_thumbnail($post_id, $media_id);
// ======================================================================


	}

	public function startCreatePosts(){
		if(is_admin()){

			// check security
			if ( ! Helper::issetCheckFormSecurity( 'alex_start_create_posts_form_id' ) ) {
				return;
			}
			// end check security
// start after push button=== start creating

				alex_var_dump('security check');


				$this->createPost($this->getSettings() , $this->getData());


//=============end creating =======================================
		}
	}




	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
