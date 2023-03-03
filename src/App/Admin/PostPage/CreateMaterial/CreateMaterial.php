<?php
namespace AlexExtraCore\App\Admin\PostPage\CreateMaterial;



use AlexExtraCore\App\Admin\ExportImport\ImportMaterial\ImportMaterial;
use AlexExtraCore\App\Helper\Helper;
use function Sodium\add;


class CreateMaterial {

	private static $instance;


	private static $postType= 'material';



	public function __construct (){

		$this->init();



	}

	private function init(){

		add_action('admin_init' , [$this , 'startCreate']);

	}
	

	private function getPriceHtml($price){

		if(isset($price) && !empty($price)){

			$price = intval($price)  ;

			return '<div class="is-layout-flex wp-container-6 wp-block-columns">
					<div class="is-layout-flow wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%">
						<h4>стоимость  '. $price  .' рублей за квадратный метр.</h4>
					</div>
					<div class="is-layout-flow wp-block-column" style="flex-basis:66.66%">
						<div class="is-layout-flex wp-block-buttons">
							<div class="wp-block-button has-custom-font-size omw-open-modal is-style-fill has-medium-font-size"><a class="wp-block-button__link has-pale-cyan-blue-color has-text-color wp-element-button" href="#omw-862" style="border-radius:5px">Оставить заявку</a></div>
						</div>
					</div>
				</div>';

		}else{
			return '';
		}

	}

	private function getGalleryHtml($gallery_ids){
		$html = '';

		if(isset($gallery_ids) &&  !empty($gallery_ids) && gettype($gallery_ids)  === 'array' ) {
			$html = $html . '<figure class="is-layout-flex wp-block-gallery-3 wp-block-gallery has-nested-images columns-default is-cropped">';
			foreach ($gallery_ids as $attachment_id){
				$html = $html . '<figure class="wp-block-image size-large">';
				$html  = $html . wp_get_attachment_image(  $attachment_id );
				$html = $html . '</figure>';
			}
			$html = $html . '</figure>';
			return $html;
		}else{
			return $html;
		}

	}

	private function getGalleryIdsUploadAttachments($gallery_ex_urls , $post_id = 0){
		// post_id = 0  . позже будет прикрепление к текущему посту. сейчас без  -- поэтому 0
		$gallery_ids = [];
		if(isset($gallery_ex_urls)
		   && !empty($gallery_ex_urls)
		   && gettype($gallery_ex_urls)  === 'array' ){
			foreach ($gallery_ex_urls as $url ) {
				$gallery_ids[] = $this->uploadMedia($url , $post_id );
			}
		}
		return $gallery_ids;

	}


	private function addAttachmentToPost($attachment_ids , $post_id){
		//------------------------------
// прикрпляет attachments  к посту
//		wp_update_post( [
//			'ID' => $attachment_id,
//			'post_parent' => $post_id
//		] );
// или так --
		global $wpdb;
		foreach ($attachment_ids as $attachment_id){
			$wpdb->update( $wpdb->posts, [ 'post_parent' => $post_id ], [ 'ID' => $attachment_id ] );
		}

		clean_post_cache( $post_id );
		//---------------------------------------
	}

	private function getTermsForPost($taxonomies = []){
		$result = [];
		foreach ($taxonomies  as $taxonomy =>$term_arr){
			$term_ids = [];
			if($taxonomy ===  'hashtags'){
				$term_ids = $term_arr;
			}else{
				foreach ($term_arr as $term){
					$term_data  = wp_create_term($term , $taxonomy );
					if(gettype($term_data) === 'array'){
						$term_ids[] = $term_data['term_id'];
					}elseif(gettype(intval($term_data) ) === 'integer'){
						$term_ids[] = $term_data;
					}
				}
			}
			$result[$taxonomy] = $term_ids;

		}
		return $result;
	}



	private function createPost($settings , $data){
		// post -material
		require_once( ABSPATH  . '/wp-load.php');



		$post_data = $settings;

		$post_data['post_title'] = $data['title'];


		// check for uniq
		if (  post_exists($post_data['post_title'] )  !== 0 ){
			return ;
		}


		// check taxonomy and term here , add term to posts
		// structure $date['taxonomies']=>[taxonomy_name1=>[term1_id , term2_id] ]
		// if exist term for taxonomy - add  if not exist -create term and add
		$tax_input = [];
		if(isset($data['taxonomies'])  && !empty($data['taxonomies'])  ){
			$tax_input = $this->getTermsForPost($data['taxonomies']);
		}
		$post_data['tax_input'] = $tax_input;


		$price_html = $this->getPriceHtml($data['price']);

		$gallery_ids = $this->getGalleryIdsUploadAttachments(  $data['gallery'] , 0);



		$html_gallery = $this->getGalleryHtml($gallery_ids);



		$html = $price_html . $data['content'];
		$html = $html . $html_gallery;
		$post_data['post_content'] = $html;



// Вставляем запись в базу данных
		$post_id = wp_insert_post($post_data, true);



		//------------------------------
// прикрпляет attachments  к посту
		$this->addAttachmentToPost($gallery_ids , $post_id);

	//---------------------------------------


// create media and set to post
		$thumbnail_id = $this->uploadMedia($data['thumbnail'] , $post_id );
		// Файл сохранён и добавлен в медиатеку WP. Теперь назначаем его в качестве облож
		set_post_thumbnail($post_id, $thumbnail_id);

// ======================================================================


	}

	/**
	 * может использоваться отдельно при ajax
	 */
	public function startCreate(){
		if(!isset($_POST['submit'])){
			return;
		}

		// check security
		if (  !isset($_POST['alex_create_materials_form_id_name']) ||
		      $_POST['alex_create_materials_form_id_name'] !== 'alex_create_materials_form_id'  ||
		      ! Helper::issetCheckFormSecurity( ) ) {
			return;
		}
		// end check security

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';


// start after push button=== start creating

		$postsData = ImportMaterial::getData();


		$count = count($postsData);
		$start = 0;

		$offset = 0;
		$finish  = 2;


		// without limit - 0   , any case - int seconds // work!! IMPORTANT !!!
		set_time_limit(0);
		//==============================================================

		// запомним текущее состояние (это пример, что так тоже можно делать)
		$was_suspended = wp_suspend_cache_addition();
// отключаем кэширование
		wp_suspend_cache_addition( true );

// ТУТ ВАШ КОД ИМПОРТА. Объектное кэширование здесь уже не работает

		Helper::cloneFolderWithFiles(ImportMaterial::getImgOriginalDir() , ImportMaterial::getImgTempDir());

		foreach ($postsData as $data ){
			if( $start >= $offset && $start < $finish){
				try {
					$this->createPost($this->getSettings() , $data);
				}catch (\Exception $exception){
//					$exception->getMessage();
					$start--;
				}
			}
			$start++;
		}

		Helper::removeDirWithFiles(ImportMaterial::getImgTempDir());

		// вернем прежнее состояние кэша обратно
		wp_suspend_cache_addition( $was_suspended );
//=============end creating =======================================
	}


	/**
	 * @param $url
	 * @param int $post_id
	 *
	 * @return int|\WP_Error
	 * кастомный способ загрузки из директории
	 * required for data or demo-data and others
	 */
	private function uploadMedia($img_path , $post_id= 0 ){
// if post_id = 0  -- load without post


		$description = "Изображение материала";

// Установим данные файла
		$file_array = array();
//		$tmp = download_url($url);

// Получаем имя файла
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $img_path, $matches );
		$file_array['name'] = basename($matches[0]);
		$file_array['tmp_name'] = $img_path;

// загружаем файл  - custom function / do not use wp func
		$media_id = media_handle_sideload( $file_array, $post_id, $description );

// Проверяем на наличие ошибок
		if( is_wp_error($media_id) ) {
			@unlink($file_array['tmp_name']); // файл не временный . не удаляем
			echo $media_id->get_error_messages( ); // do error / what  does it do?
		}

// Удаляем временный файл  // удаление ненужно - файл не временный
		@unlink( $file_array['tmp_name'] );
// Проблема!! все равно удаляются исходные изображения!!!!!!!!!!!!
		return $media_id;

	}



	/**
	 * @param $url
	 * @param int $post_id
	 *
	 * @return int|\WP_Error
	 * это стандартный способ загрузки по url
	 */
	private function uploadMediaByUrl($url , $post_id= 0 ){
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



	private function getSettings(){
		return [
			'post_status' => 'publish',
			'post_author' => 1,
			"post_type"     => self::$postType,

			'tax_input' => [],
		//	'taxonomies' => [], // structure = [$taxonomy_name1=>[term1 , term2 ....]  ]

		];
	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}