<?php
/**
 * Ferrara Custom Header Logo
 * full screen and mobile
 * this function using 3 word for logo !!!!
 *
 * название масива из 3 слов по имени сайта
 * если будет 2 слова то 3е добавиться
 * то есть Мастерская ferrara design  -  если ferrara design  то - слово - Мастерская  добавится
 */
function alex_custom_logo(){
	$name = get_bloginfo( 'name' );
	$href = !is_front_page() ? ' href="'. home_url() . '" '  : '' ;
	$front_page_classes = is_front_page() ? ' front-page-logo' : '';

	$words = explode(  ' ', $name );

	ob_start();
	echo  '<div class="ferrara-header-logo' . esc_attr($front_page_classes) .'">';
	echo '<a  '. $href  . '>';

	if( 2  == count( $words ) ){
		array_unshift($words , 'Мастерская');
	}

	foreach ($words as $word){
		echo  '<span>'. $word .'</span>';
	}

	echo '</a></div>';
	return  ob_get_clean();
}