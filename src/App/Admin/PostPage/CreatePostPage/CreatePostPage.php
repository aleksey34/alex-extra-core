<?php
namespace AlexExtraCore\App\Admin\PostPage\CreatePostPage;



use AlexExtraCore\App\Helper\Helper;

class CreatePostPage {

	private static $instance;

	private static $dataPath = AlexExtraCorePluginDIR . 'data/materials/all-product-data.txt';

	private static $postType= 'material';



	public function __construct (){

		$this->init();


	}

	private function init(){

		add_action('admin_init' , [$this , 'startCreatePosts']);
//		add_action('after_setup_theme' , [$this , 'startCreatePosts']);

		// add  gallery
		$this->preparePost();

	}

	private function preparePost(){
		// add Gallery , price and button require
		add_filter('the_content', function ($content){
// maybe do single and archive deferent - single - content and archive -after-title  -- here!!
			if(get_post_type() === 'material'){

				// set gallery here - data from meta
				$html = '';
				$meta = get_post_meta(get_the_ID() , AlexMaterialMetaKey , true);
				$meta = unserialize($meta);

				if(isset($meta)
				   && !empty($meta) ){
					if(isset($meta['gallery'])
					   &&  !empty($meta['gallery'])
					   && gettype($meta['gallery'])  === 'array' ){

						$html = $html . '<figure class="is-layout-flex wp-block-gallery-3 wp-block-gallery has-nested-images columns-default is-cropped">';

						$gallery = $meta['gallery'];
						foreach ($gallery as $id){
							$html = $html . '<figure class="wp-block-image size-large">';
							$html  = $html . wp_get_attachment_image(  $id );
							$html = $html . '</figure>';
						}

						$html = $html . '</figure>';
					}
				}


				$content  = $content . $html;
			}


			return $content  ;
		});


	}


	public function createPost($settings , $data){
		// post -material
		require_once( ABSPATH  . '/wp-load.php');

		$post_data = $settings;
		$post_data['post_title'] = $data['title'];


		$price = intval($data['price'])  ;
		$html ='<div class="is-layout-flex wp-container-6 wp-block-columns">
					<div class="is-layout-flow wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%">
						<h4>стоимость  '. $price  .' рублей за квадратный метр.</h4>
					</div>
					<div class="is-layout-flow wp-block-column" style="flex-basis:66.66%">
						<div class="is-layout-flex wp-block-buttons">
							<div class="wp-block-button has-custom-font-size omw-open-modal is-style-fill has-medium-font-size"><a class="wp-block-button__link has-pale-cyan-blue-color has-text-color wp-element-button" href="#omw-862" style="border-radius:5px">Оставить заявку</a></div>
						</div>
					</div>
				</div>';


		$post_data['post_content'] = $html . $data['content'];



// Вставляем запись в базу данных
		$post_id = wp_insert_post($post_data, true);



// Задаём значение для дополнительного поля:
// В одном из моих блогов есть дополнительное поле rating (числовое).
// Его мы и зададим. Для примера, выставим значение 80
//		update_post_meta($post_id , 'rating', 80);
// Второе поле - строковое - postscriptum
		$gallery = [];
		$value = [];
		foreach ($data['gallery'] as $url ) {
;
			$gallery[] = $this->uploadMedia($url , $post_id );
		}
		$value ['gallery'] = $gallery	;

		$value['price'] = $price;


// create media and set to post
		$thumbnail_id = $this->uploadMedia($data['thumbnail'] , $post_id );
		// Файл сохранён и добавлен в медиатеку WP. Теперь назначаем его в качестве облож
		set_post_thumbnail($post_id, $thumbnail_id);

		$value['thumbnail'] = $thumbnail_id;
		$value = serialize($value);
		update_post_meta($post_id , AlexMaterialMetaKey, $value);
// ======================================================================

	}

	public function startCreatePosts(){

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		// check security
		if ( ! Helper::issetCheckFormSecurity( 'alex_start_create_posts_form_id' ) ) {
			return;
		}
		// end check security
// start after push button=== start creating
		$start = 0;
		$offset = 5;
		$finish  = 25;
//		$last_index = count($this->getData());

		foreach ($this->getData() as $data ){
			if( $start >= $offset && $start < $finish){
				$this->createPost($this->getSettings() , $data);
			}
			if($start>=$offset && !$start%5){
				sleep(rand(25 , 30));
			}

//			sleep(rand(1,3)); // need or not?

			$start++;
		}


//=============end creating =======================================

	}




	private function uploadMedia($url , $post_id= 0 ){
// if post_id = 0  -- load without post

		// Для примера возьмём картинку с моего же блога, которая была залита вне структуры wordpress
//		$url = 'http://sergeivl.ru/public/img/svlJForm.png';

// Прикрепим к ранее сохранённому посту
//$post_id = 3061;
		$description = "Изображение материала";

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
//			echo $media_id->get_error_messages( ); // do error / what  does it do?
		}

// Удаляем временный файл
		@unlink( $file_array['tmp_name'] );

		return $media_id;

	}

	private function getData(){
		return Helper::read(static::$dataPath);
	}

	private function getSettings(){
		return [
			'post_status' => 'publish',
			'post_author' => 1,
			'post_category' => [1],
			"post_type"     => self::$postType
		];
	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
