<?php
/**
 * set field for contact form of modal window
 * this script setting Title!!! in form field
 *
 * modal window -contact form - set field - title
 */
add_action('wp_footer' , function ( ){
	if( is_single() &&  get_post_type(get_the_ID()) === 'material' ){
        alex_extra_core_require_once_template_dir('front/contact-form-fill-field-title-material.php');
	}
}, 100);