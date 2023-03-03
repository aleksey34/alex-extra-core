<?php
namespace AlexExtraCore\App\Admin\PostPage\RemoveMaterial;



use AlexExtraCore\App\Helper\Helper;

class RemoveMaterial {

	private static $instance;

	private static $postType= 'material';



	public function __construct (){

		$this->init();
	}

	private function init(){

		add_action('admin_init' , [$this , 'startRemove']);
//		add_action('after_setup_theme' , [$this , 'startRemoveAllPosts']);

	}

	private function  removeAttachments(){
		// delete attachments
		add_action( 'before_delete_post', function ($post_id){
			$post = get_post( $post_id );

			// проверим тип записи для которых нужно удалять вложение
			if( in_array($post->post_type, [self::$postType]) ){
				$attachments = get_children( array( 'post_type'=>'attachment', 'post_parent'=>$post_id ) );
				if( $attachments ){
					foreach( $attachments as $attachment ) wp_delete_attachment( $attachment->ID , true );
				}
			}
		} );
	}

	private function removeMeta(){
		add_action( 'admin_init', function (){

			add_action( 'delete_post', function ($post_id){
//				добавить провеку на удаляемый тип post_type
				// проверим тип записи для которых нужно удалять вложение
				$post = get_post( $post_id );
				if( in_array($post->post_type, [self::$postType]) ){

					global $wpdb;

					//универсально . если изменен префикс таблиц
					global $table_prefix;

					$sql = 'DELETE FROM %s'.'postmeta WHERE post_id = %d';

					$sql = $wpdb->prepare( $sql, $table_prefix , $post_id );

					$wpdb->query( $sql );

				}

			}, 10 );

		} );


	}

	private  function  removeMediaAndMeta(){

		// delete attachments
		$this->removeAttachments();

		// delete postmeta
		$this->removeMeta();

	}

	private function removePost($post_id){
		// remove post here-- with attachments and force or not
		wp_delete_post($post_id, true);
	}

	public function startRemove(){

		if(!isset($_POST['submit'])){
			return;
		}

		// check security
		if (  !isset($_POST['alex_remove_materials_form_id_name']) ||
		      $_POST['alex_remove_materials_form_id_name'] !== 'alex_remove_materials_form_id'  ||
		      ! Helper::issetCheckFormSecurity( ) ) {
			return;
		}

		// end check security

		set_time_limit(0); // require - for timeout limit
		// remove material
		$ids = $this->getAllPostIdsByPostType(self::$postType);

		$this->removeMediaAndMeta(); // do not require post_id

		foreach ($ids as $id){

			$this->removePost($id );
		}

		// end remove

	}

	private function  getAllPostIdsByPostType($postType= 'post'){

		global $wpdb;
		//универсально . если изменен префикс таблиц
		global $table_prefix;

		//$wpdb->hide_errors(); // if it requires

		$ids = [];

		$query = 'SELECT ID FROM ' . $table_prefix . 'posts WHERE post_type = "'. $postType .'"';
//		$query = $wpdb ->prepare($query);
		$data  = $wpdb->get_results($query, ARRAY_A);
		if(!isset($data) && empty($data)  ){
			$data = [];
		}
		foreach ($data as $id){
			$ids[] = $id['ID'];
		}

		return $ids;
	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
