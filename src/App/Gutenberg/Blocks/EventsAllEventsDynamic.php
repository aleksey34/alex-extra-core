<?php
namespace AlexExtraCore\App\Gutenberg\Blocks;


class EventsAllEventsDynamic{

	private static $instance;

    public function __construct(){

        add_action( 'init', [$this , 'eventsAllEvents'] );

    }

    public function  eventsAllEvents(){


        register_block_type( AlexExtraCorePluginDIR . '/src/App/Gutenberg/build/dynamic-events-block',
        [
            'render_callback' => [$this , "gutenbergBlockRenderCallback"],
            // 'attributes'      => [   //--- need or not / work without this data
            //     'quantity' => [
            //         'type'    => 'number',
            //         'default' => 2,
            //     ],

            // ], //==================
        ]

        );

    }


    public function gutenbergBlockRenderCallback( $attributes, $content ) {

		$args = [
			'posts_per_page' => $attributes['quantity'],
			'post_status'    => 'publish',
            'post_type' => 'post'
			// 'order'          => $attributes['order'],
		];




        $events = get_posts( $args ); // or any others query - data etc - what you want!

        $html ='<div class="event-posts-block blog-entries entries clr" >';

    if($events):
          foreach($events as $event) :
           $categories = get_the_terms( $event, 'category' );
           $tags = get_the_terms( $event, 'post_tag' );

      $html = '';

      $html .= '<article  class="large-entry blog-entry clr">
                    <div class="blog-entry-inner clr">
                        <div class="thumbnail">
                            <a href="'.get_permalink( $event).'"  >
                                <img src="'. get_the_post_thumbnail_url( $event ).'"  alt="'.$event->post_title.'"  />
                            </a>

                        </div>
                        <header>
                            <h2 class="blog-entry-header">'.get_the_title($event).'</h2>
                            <ul class="meta obem-default clr" >
                                <li class="meta-author"></li>
                                <li class="meta-time"></li>';

                 if( (gettype($tags) == 'array' ) && (count($tags)  >  0 )) {

                    $html .='<li class="meta-tag">
                                    <span>Tags:</span> ';

                     foreach($tags as $tag){

                        $html .=
                                 '<div>
                                    <a href="'.get_tag_link( $tag ).'">
                                    '.$tag ->name.'
                                    </a>
                                  </div>';

                     }

                     $html .='</li>';

                 }

                                if( (gettype($categories) ==  'array') && count($categories) > 0 ) {

                    $html .=   '<li class="meta-cat">

                                    <span>Categories:</span>';

                                foreach($categories as $cat){

                                    $html .='<div>
                                        <a href="'.get_category_link( $cat ).'">'.$cat->name.'</a>
                                    </div>';

                                }

                    $html .=    '</li>';

                                }



                        $html .='<li>
                                    <span>Comments:</span>
                                    <span>'.get_comments_number( $event ).'</span>
                                </li>
                            </ul>
                        </header>
                        <div>'.$event->post_excerpt.'</div>
                        <div class="blog-entry-readmore">
                            <a href="'.get_permalink( $event ).'" class="btn button">Read more...</a>
                        </div>
                    </div>
                </article> ';

                // wp_reset_postdata(  ) ;
          endforeach;

        endif;

        $html .=  '</div> ';


        return $html;
	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}

}
