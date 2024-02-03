<?php
namespace  Carbon_Fields\Inc;


use Carbon_Fields\Container;
use Carbon_Fields\Field;

class MetaboxFields {

	private static $instance;

	public function __construct (){

		$this->setMetabox();

	}

	private function setMetabox(){

//Container::make( 'post_meta', 'Custom Data' )
//         ->where( 'post_type', '=', 'post'  )
//         ->add_fields( array(
//	         Field::make( 'map', 'crb_location' )
//	              ->set_position( 37.423156, -122.084917, 14 ),
//	         Field::make( 'sidebar', 'crb_custom_sidebar' ),
//	         Field::make( 'image', 'crb_photo' ),
//         ));

		/**
		 *  page
		 */
		Container::make( 'post_meta', esc_html__("Intro Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
//		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_intro_section_title' ,esc_html__("Intro section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_intro_section_subtitle' ,esc_html__("Intro section - Subtitle", "mind") ),
			         Field::make( 'text', 'crb_front_page_intro_section_btn_title' ,esc_html__("Intro section - button title", "mind") ),
			         Field::make( 'image', 'crb_front_page_intro_section_video_link' ,esc_html__("Intro section - Video Link", "mind") )
			              ->set_value_type("url")
			              ->set_type( array( 'video' ) ),
			         Field::make( 'image', 'crb_front_page_intro_section_video_poster' ,esc_html__("Intro section - Poster for video", "mind") )
			              ->set_value_type("url")
			              ->set_type( array( 'image' ) ),
		         ));


		/**
		 * front page
		 */
		Container::make( 'post_meta', esc_html__("Intro Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_intro_section_title' ,esc_html__("Intro section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_intro_section_subtitle' ,esc_html__("Intro section - Subtitle", "mind") ),
			         Field::make( 'text', 'crb_front_page_intro_section_btn_title' ,esc_html__("Intro section - button title", "mind") ),
			         Field::make( 'image', 'crb_front_page_intro_section_video_link' ,esc_html__("Intro section - Video Link", "mind") )
				         ->set_value_type("url")
				         ->set_type( array( 'video' ) ),
			         Field::make( 'image', 'crb_front_page_intro_section_video_poster' ,esc_html__("Intro section - Poster for video", "mind") )
				         ->set_value_type("url")
				         ->set_type( array( 'image' ) ),
		         ));

		Container::make( 'post_meta', esc_html__("Benefit Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_benefit_section_title' ,esc_html__("Benefit section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_benefit_section_subtitle' ,esc_html__("Benefit section - Subtitle", "mind") ),
			         Field::make( 'complex', 'crb_front_page_benefit_section_benefit_block' ,esc_html__("Benefit section - blocks benefit", "mind") )
		                ->add_fields(array(
		                    Field::make('text' , 'title' , esc_html__('Title of benefit' , 'mind')) ,
			                Field::make('textarea' , 'content' , esc_html__('Content of benefit' , 'mind'))
				                ->set_rows( $rows = 5 ),
			                Field::make('image' , 'icon' , esc_html__('Icon of benefit' , 'mind') )
				                ->set_value_type("url"),
		                )),
		         ));

		Container::make( 'post_meta', esc_html__("News Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_news_section_title' ,esc_html__("News section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_news_section_subtitle' ,esc_html__("News section - Subtitle", "mind") ),
			         Field::make( 'text', 'crb_front_page_news_section_btn_title' ,esc_html__("News section - button title", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Posts Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_posts_section_title' ,esc_html__("Posts section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_posts_section_subtitle' ,esc_html__("Posts section - Subtitle", "mind") ),
			         Field::make( 'text', 'crb_front_page_posts_section_btn_title' ,esc_html__("Posts section - button title", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Teachers Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_teachers_section_title' ,esc_html__("Teachers section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_teachers_section_subtitle' ,esc_html__("Teachers section - Subtitle", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Testimonials Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_testimonials_section_title' ,esc_html__("Testimonials section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_testimonials_section_subtitle' ,esc_html__("Testimonials section - Subtitle", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Partners Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_partners_section_title' ,esc_html__("Partners section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_partners_section_subtitle' ,esc_html__("Partners section - Subtitle", "mind") ),
			         Field::make( 'complex', 'crb_front_page_partners_section_partners_block' ,esc_html__("Partners section - blocks partners", "mind") )
			              ->add_fields(array(
				           //   Field::make('text' , 'link' , esc_html__('Link of partner' , 'mind')) ,
				              Field::make('image' , 'icon' , esc_html__('Icon of partner' , 'mind') )
				                   ->set_value_type("url"),
			              )),
		         ));

		Container::make( 'post_meta', esc_html__("Products Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_products_section_title' ,esc_html__("Products section - Title", "mind") ),
			         Field::make( 'text', 'crb_front_page_products_section_subtitle' ,esc_html__("Products section - Subtitle", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Quotes Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'complex', 'crb_front_page_quotes_section_quotes_block' , esc_html__("Quotes section - blocks quotes", "mind") )
			              ->add_fields(array(
				              Field::make('image' , 'picture' , esc_html__('Picture for quote' , 'mind') )
				                   ->set_value_type("url"),
				              Field::make('textarea' , 'content' , esc_html__('Content of quote' , 'mind'))
					              ->set_rows( $rows = 5 ),
				              Field::make('text' , 'author' , esc_html__('Author of quote' , 'mind')) ,
			              )),
		         ));

		Container::make( 'post_meta', esc_html__("Books Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=', 'template-pages/front-page.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_books_section_books_count' ,esc_html__("Books section - Amount of books", "mind") ),
			         Field::make( 'text', 'crb_front_page_books_section_books_circulation' ,esc_html__("Books section - Circulation of books", "mind") ),
			         Field::make( 'text', 'crb_front_page_books_section_books_cities' ,esc_html__("Books section - Amount Cities", "mind") ),
		         ));

		Container::make( 'post_meta', esc_html__("Map Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=','template-pages/front-page.php' )
		         ->or_where( 'post_template', '=', 'template-pages/template-about.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_front_page_map_section_map_iframe' ,esc_html__("Map section - Map iframe", "mind") ),
		         ));


		/**
		 * fields for page Contact
		 */


		/**
		 * fields for page About us
		 */



		/**
		 * field for testimonials
		 */
		Container::make( 'post_meta', esc_html__("Testimonial Field", "mind")   )
		         ->where( 'post_type', '=', 'testimonials' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_testimonials_author' ,esc_html__("Footer Of Testimonials", "mind") ),
		         ));

		/**
		 * teachers
		 */
		Container::make( 'post_meta', esc_html__("Social Links", "mind")   )
		         ->where( 'post_type', '=', 'teachers' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_teachers_facebook_link' ,esc_html__("Facebook Link", "mind") ),
			         Field::make( 'text', 'crb_teachers_twitter_link' ,esc_html__("Twitter Link", "mind") ),
			         Field::make( 'text', 'crb_teachers_vk_link' ,esc_html__("VK Link", "mind") ),
			         Field::make( 'text', 'crb_teachers_instagram_link' ,esc_html__("Instagram Link", "mind") ),
			         Field::make( 'text', 'crb_teachers_youtube_link' ,esc_html__("Youtube Link", "mind") ),
		         ));

		/**
		 * Page About -- template-about.php
		 */
		Container::make( 'post_meta', esc_html__("Contact Form Shortcode Section", "mind")   )
		         ->where('post_type' , '=' , 'page')
		         ->where( 'post_template', '=','template-pages/template-about.php' )
		         ->add_fields( array(
			         Field::make( 'text', 'crb_about_page_contactform_shortcode' ,esc_html__("Contact Form Shortcode", "mind") ),
		         ));

	}

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}

