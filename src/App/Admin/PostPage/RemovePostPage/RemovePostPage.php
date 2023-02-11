<?php
namespace AlexExtraCore\App\Admin\PostPage\RemovePostPage;



use AlexExtraCore\App\Helper\Helper;

class RemovePostPage {

	private static $instance;

	private static $postType= 'material';



	public function __construct (){

		$this->init();
	}

	private function init(){

		add_action('admin_init' , [$this , 'startRemoveAllPosts']);
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

			add_action( 'delete_post', function ($pid){
				global $wpdb;

				$sql = $wpdb->prepare( 'DELETE FROM wp_postmeta WHERE post_id = %d', $pid );

				$wpdb->query( $sql );
			}, 10 );

		} );


	}

	private  function  removeMediaAndMeta(){

		// delete attachments
		$this->removeAttachments();

		// delete postmeta
		$this->removeMeta();








		// remove meta / remove img and other info about post by post ID
//		$data  = get_post_meta($post_id , $metaKey , true );
//		if(empty($data)){
//			// remove attachment of post
//			wp_delete_attachment($post_id , true );
//			return false;
//		}




//		$data = unserialize( $data );
//
//		if(isset($data['thumbnail']) && !empty($data['thumbnail'])){
//			$thumb_id = $data['thumbnail'];
//			//remove thumbnail here
//			$meta         = wp_get_attachment_metadata( $thumb_id );
//			$backup_sizes = get_post_meta( $thumb_id, '_wp_attachment_backup_sizes', true );
//			$file         = get_attached_file( $thumb_id );
//
//			wp_delete_attachment_files( $thumb_id, $meta, $backup_sizes, $file );
//		}



//		if(isset($data['gallery']) && !empty($data['gallery'])){
//			$gallery_ids = $data['gallery'];
//			//remove gallery here
//			foreach ($gallery_ids as $img_id){
//				$meta         = wp_get_attachment_metadata( $img_id );
//				$backup_sizes = get_post_meta( $img_id, '_wp_attachment_backup_sizes', true );
//				$file         = get_attached_file( $img_id );
//
//				wp_delete_attachment_files( $img_id, $meta, $backup_sizes, $file );
//			}
//		}

		// remove attachment of post

//		wp_delete_attachment($post_id , true );


//		delete_post_meta($post_id , $metaKey);

	}

	public function removePost($post_id){
		// remove post here-- with attachments and force or not
		wp_delete_post($post_id, true);
	}

	public function startRemoveAllPosts(){

		// check security
		if ( ! Helper::issetCheckFormSecurity( 'alex_delete_posts_form_id' ) ) {
			return;
		}
		// end check security
		// remove material

		$ids = $this->getAllPostIdsByPostType(self::$postType);

		foreach ($ids as $id){
			$this->removeMediaAndMeta();
			$this->removePost($id );
		}

		// end remove


	}

	private function  getAllPostIdsByPostType($postType= 'post'){

		$args = array('posts_per_page' => -1, 'post_type' => $postType);

		$posts = get_posts($args);

		$ids = [];
		if ($posts) :
			foreach ($posts as $post) :
				setup_postdata($post);
				$ids[] = $post->ID;
			endforeach;
			wp_reset_postdata();
		endif;
		return $ids;
	}



	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
