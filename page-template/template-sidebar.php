<?php
/**
 * Template Name: Page with sidebar
 */
get_header();
$sidebar_position = '';
$sidebar_position  = $redux_alex_theme_options['opt-button-set-sidebar-position'];
?>
<main id="primary" class="site-main" style="margin: 0 auto; display:flex;justify-content:center;max-width: 1400px;">
<?php
if('left' === $sidebar_position){
	get_sidebar();
}
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'content' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
if('right' === $sidebar_position){
	get_sidebar();
}
	?>
</main><!--#main-->
<?php

//get_sidebar();
get_footer();