<?php
/**
 * logo function
 * logo - retina  and mobile logo
 * require download Logo img for work!
 */



// change img to html  -- img require!
add_filter( 'get_custom_logo', function ($html){
/**
 * Ferrara Custom Header Logo
 * full screen and mobile
 */

if(!empty($html)){
	$html = get_bloginfo( 'name' );
	$href = !is_front_page() ? ' href="'. home_url() . '" '  : '' ;
	$last_child_classes = is_front_page() ? ' front-page-logo' : '';

	$words = explode(  ' ', $html );

ob_start();
	echo  '<div class="ferrara-header-logo' . esc_attr($last_child_classes) .'">';
	echo '<a  '. $href  . '>';

	foreach ($words as $word){
		echo  '<span>'. $word .'</span>';
	}

	echo '</a></div>';
	return  ob_get_clean();
}else{
	return '';
	}
} );