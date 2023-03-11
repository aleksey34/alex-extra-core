<?php
/**
 * Template Name: About Template
 */
get_header();
?>
<main id="primary" class="site-main">
<?php
while ( have_posts() ) :
	the_post();

	require AlexExtraCorePluginDIR . 'page-template-part/content/about.php';

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
	?>
</main><!--#main-->
<?php
get_footer();
