<?php
/**
 * deactivate script style for gallery in single post
 *
 * add slick slider script style
 *
 * activate slick slider
 *
 */

add_action("wp_enqueue_scripts" , function (){
	if(is_single()  && 'gallery' === get_post_format()){
		// deregister owp depend
		wp_deregister_script( 'ow-flickity'  );
		wp_deregister_script( 'oceanwp-slider' );

		//register - enqueue script style - for slick slider
        wp_enqueue_script('slick' , AlexExtraCorePluginURI . 'assets/libs/slick-1.8.1/slick/slick.min.js' , ['jquery'] , null  ,  true  );
        wp_enqueue_style('slick' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick.css'  );
        wp_enqueue_style('slick-theme' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick-theme.css'  );
	}
} , 100);

add_action('wp_footer' , function (){
	if(is_single()  && 'gallery' === get_post_format()) :
	?>
	<script>
        jQuery(document).ready(function(){
            const topBlock = jQuery('.single.single-format-gallery   .thumbnail .gallery-format');
            if(topBlock && topBlock.length){

                const downBlock =
                    topBlock
                        .clone()
                        .removeClass('gallery-format')
                        .addClass('slick-nav')
                        .insertAfter(topBlock);

                topBlock.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    asNavFor: '.slick-nav'
                });
                downBlock.slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.gallery-format',
                    dots: true,
                    arrows: false,
                    centerMode: true,
                    focusOnSelect: true
                });
            }
        });
	</script>
<?php
    endif;
} , 100);
