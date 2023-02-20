<?php
namespace AlexExtraCore\App\FavoritePost;

use AlexExtraCore\App\FavoritePost\Inc\FavoriteScriptStyle;

class FavoritePost{

	private static $instance;

	public function __construct(){

		$this -> init();
	}

	private function init(){


		add_action('after_setup_theme' , function(){
			if(defined('AlexExtraCoreOptions')
			   && !empty(AlexExtraCoreOptions['enable_favorite'] )
			   &&    1 === AlexExtraCoreOptions['enable_favorite']  ) :
				FavoriteScriptStyle::instance();


				$this->setIconToThumbnail();
				$this->setButtonIconToPageBody();


				$this->prepareQueryForFavorite();


				$this->setFavoriteTitle();

			  endif;
        });



	}

	private function setFavoriteTitle(){

	    // change title in head <title>.... title of browser
	    add_filter('pre_get_document_title' , function ( $title){
	       if($this->is_favorite()
              && get_post_type()
                 === 'material' && is_archive() ){
	           return  'Избранное';
           }else{
		       return $title;
           }
        }, 80 );


		// title for page - material archive
		add_filter('post_type_archive_title' , function ( $post_type_name, $post_type){;
	       if($this->is_favorite()
              && $post_type === 'material' && is_archive() ){
	           return  'Избранное';
           }else{
		       return $post_type_name;
           }

		}, 80 , 2 );


    }

	private function is_favorite(){

	    if(isset($_GET['page'])
           &&  'favorite' === $_GET['page']
           && isset($_GET['post_ids'])
           && !empty($_GET['post_ids'])  ){
	        return true;
        }else{
	        return false;
        }
    }

	private function prepareQueryForFavorite(){

		add_action( 'pre_get_posts', function ($query){
		    if($this->is_favorite()){

			    if($query->is_archive   &&  'material' === $query->get('post_type') ){
				    $posts_ids  = explode( '-' , $_GET['post_ids'])  ;

			    $query->set( 'posts_per_page', -1 );
				$query->set('post__in' , $posts_ids);

                }

            }

        } );

    }


	private function setButtonIconToPageBody(){

		add_action('wp_footer' , function (){
			?>
			<a href="/material?page=favorite&post_ids=" title="Вы еще не ничего не выбрали"   class="alex-favorite-btn-wrapper" >
	          <svg  viewBox="0 0 38 32"  xmlns="http://www.w3.org/2000/svg" class="to-favorites svg-prepared" data-paletteid="106" data-interiorusagetitleen="&amp;#x421;hildren&amp;#x27;s rooms" data-interiorusagetitleru="&amp;#x414;&amp;#x435;&amp;#x442;&amp;#x441;&amp;#x43A;&amp;#x438;&amp;#x435; &amp;#x43A;&amp;#x43E;&amp;#x43C;&amp;#x43D;&amp;#x430;&amp;#x442;&amp;#x44B;" data-interiorid="166">
				  <path d="M37.6048 11.8754C38.6789 1.44182 25.431 -4.89296 18.9869 4.79692C10.3925 -5.26507 -0.348825 2.56049 0.366975 11.8755C0.366867 21.1903 18.9856 32 18.9856 32C21.4924 30.8805 36.889 20.819 37.6048 11.8754Z" fill="white"></path>
			  </svg>
			</a>
			<?php
		});


	}

	private function setIconToThumbnail(){

		add_filter('post_thumbnail_html' ,
			function ( $html, $post_id, $post_thumbnail_id, $size, $attr){
				if( get_post_type($post_id) === 'material' ){
					$html =
						'<div class="alex-favorite-thumbnail-wrapper">'.
						$html .
						'<span title="добавить в избранные"   class="alex-favorite-icon-wrapper" data-material_id="' . $post_id . '" >      
							          <svg  viewBox="0 0 38 32"  xmlns="http://www.w3.org/2000/svg" class="to-favorites svg-prepared" data-paletteid="106" data-interiorusagetitleen="&amp;#x421;hildren&amp;#x27;s rooms" data-interiorusagetitleru="&amp;#x414;&amp;#x435;&amp;#x442;&amp;#x441;&amp;#x43A;&amp;#x438;&amp;#x435; &amp;#x43A;&amp;#x43E;&amp;#x43C;&amp;#x43D;&amp;#x430;&amp;#x442;&amp;#x44B;" data-interiorid="166">
										  <path d="M37.6048 11.8754C38.6789 1.44182 25.431 -4.89296 18.9869 4.79692C10.3925 -5.26507 -0.348825 2.56049 0.366975 11.8755C0.366867 21.1903 18.9856 32 18.9856 32C21.4924 30.8805 36.889 20.819 37.6048 11.8754Z" fill="white"></path>
									  </svg> 
							    </span>'.
						'</div>';
					return $html;
				}else{
					return $html;
				}
			} , 10, 5
		);

	}

	public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}


}