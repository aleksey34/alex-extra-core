<?php
if(!defined('ABSPATH')){
    exit();
}

add_action('after_setup_theme' , function (){
    if( class_exists('OCEANWP_Theme_Class') ){


        if(!defined("ABSPATH")) exit;
        /**
         * add custom el before menu
         */
        add_action('ocean_after_site_title' , function (){
            echo do_shortcode("[daikin_custom_logo]");
        } , 5);

        /**
         * add background , title , button  in the front page header -- ONLY!!
         */
//do_action( 'ocean_top_bar' )
//do_action( 'ocean_header' )
//do_action( 'ocean_before_main' )

        add_action('ocean_top_bar' , function (){
            if(is_front_page()){
                echo "<div id='daikin-custom-header-front-page' class='daikin-custom-header-front-page'>";
            }

        }, 3);
        add_action('ocean_before_main' , function (){
            if(is_front_page()){
                echo do_shortcode('[oceanwp_library id="379"]');
            }

        }, 100);
        add_action('ocean_before_main' , function (){
            if(is_front_page()){
                echo "</div>";
            }

        }, 100);


// if need in menu
//add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );

//function your_custom_menu_item ( $items, $args ) {
//
//    if ($args->theme_location == 'main_menu') {
//
//        $items = '<li class="">
//'.do_shortcode("[daikin_custom_logo]").'
//</li>'.$items;
//
//    }
//
//    return $items;
//
//}
//});


    }
} , 100);