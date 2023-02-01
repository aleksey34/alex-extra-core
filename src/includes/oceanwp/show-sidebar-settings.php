<?php
/**
 * Remove  sidebar for material post type
 * do like post!!
 */

//if(is_plugin_active('alex-extra-core/alex-extra-core.php')){
if(!function_exists('oceanwp_post_layout')){
	function oceanwp_post_layout() {

		// Define variables
		$class = 'right-sidebar';
		$meta  = get_post_meta( oceanwp_post_id(), 'ocean_post_layout', true );

		// Check meta first to override and return (prevents filters from overriding meta)
		if ( $meta ) {
			return $meta;
		}

		// Singular Page
		if ( is_page() ) {

			// Landing template
			if ( is_page_template( 'templates/landing.php' ) ) {
				$class = 'full-width';
			}

			// Attachment
			elseif ( is_attachment() ) {
				$class = 'full-width';
			}

			// All other pages
			else {
				$class = get_theme_mod( 'ocean_page_single_layout', 'right-sidebar' );
			}
		}

		// Home
		elseif ( is_home()
		         || is_category()
		         || is_tag()
		         || is_date()
		         || is_author() ) {
			$class = get_theme_mod( 'ocean_blog_archives_layout', 'right-sidebar' );
		}

		// Singular Post
		elseif ( is_singular( ['post','material'] ) ) { // my change
//		elseif ( is_singular( 'post' ) ) {
			$class = get_theme_mod( 'ocean_blog_single_layout', 'right-sidebar' );
		}

		// Library and Elementor template
		elseif ( is_singular( 'oceanwp_library' )
		         || is_singular( 'elementor_library' ) ) {
			$class = 'full-width';
		}

		// Search
		elseif ( is_search() ) {
			$class = get_theme_mod( 'ocean_search_layout', 'right-sidebar' );
		}

		// 404 page
		elseif ( is_404() ) {
			$class = get_theme_mod( 'ocean_error_page_layout', 'full-width' );
		}

		// All else
		else {
			$class = 'right-sidebar';
		}

		// Class should never be empty
		if ( empty( $class ) ) {
			$class = 'right-sidebar';
		}

		// Apply filters and return
		return apply_filters( 'ocean_post_layout_class', $class );

	}
}