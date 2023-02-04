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
			return	alex_custom_logo();
		}else{
			return '';
			}
	}
);