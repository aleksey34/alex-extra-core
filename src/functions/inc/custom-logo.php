<?php
/**
 * Ferrara Custom Header Logo
 * full screen and mobile
 * this function using 3 word for logo !!!!
 */
function alex_custom_logo(){
	$html = get_bloginfo( 'name' );
	$href = !is_front_page() ? ' href="'. home_url() . '" '  : '' ;
	$front_page_classes = is_front_page() ? ' front-page-logo' : '';

	$words = explode(  ' ', $html );

	ob_start();
	echo  '<div class="ferrara-header-logo' . esc_attr($front_page_classes) .'">';
	echo '<a  '. $href  . '>';

	foreach ($words as $word){
		echo  '<span>'. $word .'</span>';
	}

	echo '</a></div>';
	return  ob_get_clean();
}