<?php
namespace AlexExtraCore\App\Gutenberg\Inc\Api;


/**
 * вывод мета нужен планин и включение через хук - смотрите предидущию версую
* этого решения ( пример: плагин acf to rest api  и хук включения этой настроки)
 */
class RestPrepareDynamic{

	private static $instance;

    public function __construct(){

        $this -> prepareEventRest();
    }

    private function prepareEventRest(){
        // rest_prepare_(post_type) // hook for prepare

       /**
		 * Function for `rest_prepare_(post_type)` filter-hook.
		 *
		 * @param WP_REST_Response $response The response object.
		 * @param WP_Post          $post     Post object.
		 * @param WP_REST_Request  $request  Request object.
		 *
		 * @return WP_REST_Response
		 */
        add_filter( 'rest_prepare_post', function ( $response, $post, $request ){

           $response ->data['featured_media_uri'] = wp_get_attachment_image_url($response ->data['featured_media']) ;  ///( $attachment_id:integer, $size:string|array, $icon:boolean ) ;

           $response ->data['author_name'] = get_the_author_meta('display_name' , $response ->data['author']) ;  ///( $attachment_id:integer, $size:string|array, $icon:boolean ) ;

           $tag_ids =$response ->data['tags'];
           $tags_data = [];
           for($i=0; $i < count($tag_ids); $i++){
                $tags_data[] = get_term($tag_ids[$i] );
           }

           $response ->data['tags_data'] = $tags_data;


           $cat_ids = $response->data['categories'];
           $categories_data = [];
           for($i = 0; $i < count($cat_ids); $i++){
            $categories_data [] = get_term($cat_ids[$i]);
           }

           $response -> data['cats_data'] = $categories_data;

           if($response -> data['comment_status'] ===  'open'){

            $response->data['comment_data'] = get_comment_count( $post->ID );
           }


           return $response;

        }, 10, 3 );

    }

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
