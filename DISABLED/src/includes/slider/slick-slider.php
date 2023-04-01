<?php
/**
 * deactivate script style for gallery in single post
 *
 * add slick slider script style
 *
 * activate slick slider
 *
 * init  for ocean wp  gallery -to slick slider and
 * gutenberg slick slider
 */

add_action("wp_enqueue_scripts" , function (){
//	if(is_single()  && 'gallery' === get_post_format()){
    // oceanWp
	if(true){  // for gutenberg blocks
		// deregister
		wp_deregister_script( 'ow-flickity'  );
		wp_deregister_script( 'oceanwp-slider' );

		//register - enqueue script style - for slick slider

        // can include in common js file -- scripts.js
        wp_enqueue_script('slick' , AlexExtraCorePluginURI . 'assets/libs/slick-1.8.1/slick/slick.min.js' , ['jquery'] , null  ,  true  );


        wp_enqueue_style('slick' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick.css'  );
        wp_enqueue_style('slick-theme' ,AlexExtraCorePluginURI .  'assets/libs/slick-1.8.1/slick/slick-theme.css'  );
	}
} , 100);

add_action('wp_footer' , function (){
	if(true) :  // it works for gutenberg too
//	if(is_single()  && 'gallery' === get_post_format()) :
    // for oceanwp - gallery post format
	?>
	<script>
        jQuery(document).ready(function(){
            const topBlock = jQuery('.single.single-format-gallery   .thumbnail .gallery-format');
            if(topBlock && topBlock.length && topBlock.slick){

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

            // for gutenberg!
            const gutenbergTopBlock = jQuery('.alex-gutenberg-slick-slider .slider-img');
            const gutenbergDownBlock = jQuery('.alex-gutenberg-slick-slider .slider-nav');

            if(gutenbergTopBlock &&
                gutenbergTopBlock.length
                && gutenbergTopBlock.slick
                && gutenbergDownBlock
                && gutenbergDownBlock.length
                && gutenbergDownBlock.slick){
                gutenbergTopBlock.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    asNavFor: '.slider-nav'
                });
                gutenbergDownBlock.slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slider-img',
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
