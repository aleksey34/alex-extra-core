<?php
namespace AlexExtraCore\App\Shortcode\Inc;

/**
 * Class EmailForm
 * @package AlexExtraCore\App\Shortcode\Inc
 * create shortcode for email form
 */

class EmailForm{

	private static $instance;

	public function __construct(){
		$this->init();

	}


	public function init(){

		$this->commonForm();

		$this->singleMaterialModalWindowForm();

	}

	private function commonForm(){

		add_shortcode('alex-common-email-form', [$this , 'getFerraraCommonEmailFormHtml']);


	}

	public function getFerraraCommonEmailFormHtml($attr){


		if(isset($attr['form_id']) && !empty($attr['form_id'])){
			global $email_form_id;
			$email_form_id = $attr['form_id'];
			require alex_exra_core_template_dir('email/form-template/common-form.php');
			unset($email_form_id);
		}else{
			alex_var_dump('не устанолен id для формы' , false);
		}

	}


	private function singleMaterialModalWindowForm(){
			add_shortcode('ferrara-modal-form', [$this , 'getSingleMaterialModalWindowFormHtml']);
	}

	public function getSingleMaterialModalWindowFormHtml($attr) {
		if(isset($attr['form_id']) && !empty($attr['form_id'])){
			global $email_form_id;
			$email_form_id = $attr['form_id'];
		require alex_exra_core_template_dir( 'email/form-template/single-material-modal-form.php' );
			unset($email_form_id);
		}else{
			alex_var_dump('не устанолен id для формы' , false);
		}
	}





		public static function instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;
	}


}



//add_shortcode('daikin_custom_logo', 'daikin_custom_logo_shortcode');
//
//function daikin_custom_logo_shortcode($atts)
//{
//    if (is_front_page()) {
//        $logo = '<div class="daikin-custom-logo">
//                    <a class="logo">
//                        <span>Daikin</span>
//                        <span>Official service</span>
//                    </a>
//                </div>';
//    } else {
//        $logo = '<div class="daikin-custom-logo">
//                    <a  href="' . home_url() . '" class="logo">
//                        <span>Daikin</span>
//                        <span>Official service</span>
//                    </a>
//                </div>';
//    }
//
//
//    return $logo;
//}







/*
add_shortcode( 'prosthesis_category_products',  'alex_category_products' );

function alex_category_products( $atts ){

    $columns =$atts['columns'] ;
    $limit =$atts['limit'] ;
    $category =$atts['category'] ;
    
    $columns =isset($columns) && !empty($columns) ? $columns : '4' ;
    $limit =isset($limit) && !empty($limit) ? $limit : '4';
    $category =isset($category) && !empty($category) ? $category : '' ;
    $category_link =  get_term_link($category, 'product_cat') ;

    return '<div class="category-products__wrapper">'
                .
                do_shortcode("[products limit=\"$limit\" columns=\"$columns\" category=\"$category\"]")
                .
                "<div class='category-products__button-wrap'>
                     <a href=\"$category_link\" class='category-products__btn'>Смотреть все</a>
                </div>
            </div>";
}
*/


/**
 * short code -- btn for page product  -- learn price
 */
/*
add_shortcode( 'custom_learn_price', 'alex_custom_modal_learn_price_btn_shortcode' );

function alex_custom_modal_learn_price_btn_shortcode( $atts ){
    if(is_product()) {
        $html = '';

        $href = $atts['btn_href'];
        $btn_class =  $atts['btn_class'];
        $btn_title =  $atts['title'];

        global $product;
        $price = $product->price;
        $product_name = $product->name  ;

        if(isset($href) && isset($btn_class)  && empty($price)  ) {

            $html = $html . '<a href="'.$href.'" class="'.$btn_class.' omw-open-modal" >'.$btn_title.'</a>';


            $html =   $html . '<style>
                .omw-open-modal.'.$btn_class.'{
                  background-color: #91e542;
                }
                .omw-open-modal.'.$btn_class.':hover{
                background-color: #77d61e;
                }
                </style>';
            $html = $html . '<script>
        window.onload= (function (){   
        var btn = jQuery(".'.$btn_class.'");
        
        btn.on("click" , function(){ 
        jQuery(".learn-price-form .order_product_modal_title input")
             .attr("readonly" , "true")
             .val("' .$product_name .'");
        })

        })();
                </script>';

            return $html;
        }
    }
}

*/





///   //add_shortcode( 'main_custom_logo',  'alex_custom_logo_shortcode' );
////
////function alex_custom_logo_shortcode( $atts ){
////    if(is_front_page()){
////        $logo = '<div class="logo-wrapper">
////                    <a class="logo">
////                        <img src="'.get_stylesheet_directory_uri().'/img/logo.png" alt="logo">
////                    </a>
////                </div>';
////    }else{
////        $logo = '<div class="logo-wrapper">
////                    <a  href="'.home_url().'" class="logo">
////                       <img src="'.get_stylesheet_directory_uri().'/img/logo.png" alt="logo">
////                    </a>
////                </div>';
////    }
////
////
////
////    return $logo;
////}


