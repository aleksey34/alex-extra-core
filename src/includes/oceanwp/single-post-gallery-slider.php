<?php
/**
 * deactivate script style for gallery in single post
 * add slick slider script style
 * in ScriptStyle class  in common script
 *
 * activate slick slider - here
 *
 */

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