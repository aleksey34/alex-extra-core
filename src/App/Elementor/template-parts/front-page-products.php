<?php  if(!defined("ABSPATH")) exit; ?>
<section id="frontPageProducts" class="page-section section page-section__products">
	<div class="page-container">

		<ul class="list-unstyled products front-page-products-list  container">
			<?php
		global 	  $products_per_page_widget  ;
			if(!isset( $products_per_page_widget) || empty( $products_per_page_widget || (int)$products_per_page_widget < 1 || (int) $products_per_page_widget > 12 )) {
				$products_per_page_widget = 3;
			}


		global  $products_per_row_widget;
			if(!isset($products_per_row_widget) || empty($products_per_row_widget || (int)$products_per_row_widget < 1 || (int)$products_per_row_widget > 6)) {
				$products_per_row_widget = 3;
			}

			$products_data = new WP_Query(
				array(
					'posts_per_page' =>  $products_per_page_widget,
					'post_type' => 'product' ,
					//	'product_cat' => 'vstrechi-seminary'
				)
            );
			// get_wd($products_seminar);
			if($products_data->have_posts()):
               ?>
               <li class="row justify-content-around">
            <?php
				while($products_data->have_posts()) : $products_data->the_post();
					?>
					<?php   global  $product; ?>
                    <div class="d-block widget-product-wrapper col-12 col-lg-<?php echo floor(12 / $products_per_row_widget) ;  ?>">
<!--                    <div class="d-block widget-product-wrapper col-12 col-lg---><?php //echo 12 / $products_per_row_widget ;  ?><!--">-->
                        <h4><a href="<?php the_permalink();  ?>">
		                        <?php the_title();  ?>
                            </a>
                        </h4>
                        <div class="widget-thumnail-wrapper">
                            <?php $thumbnail_url =   get_the_post_thumbnail_url();
                            if($thumbnail_url) :
                            ?>
                            <a href="<?php  echo $thumbnail_url ?>">
	                            <?php   woocommerce_template_loop_product_thumbnail();  ?>
                            </a>
                            <?php  else : ?>
                                <span>
		                            <?php   woocommerce_template_loop_product_thumbnail();  ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="widget-product-categories">
                            <?php
                           echo  wc_get_product_category_list($product->id , ',');
                            ?>
                        </div>

                        <a href="<?php the_permalink();  ?>" class="widget-short-description d-block" style="max-width: 100%;">
                            <?php echo  get_the_excerpt() ;?>
                        </a>
                        <div class="cart-block">
                            <?php  woocommerce_simple_add_to_cart();
                            woocommerce_template_single_add_to_cart();
                            ?>
                        </div>

                    </div>

				<?php endwhile;
			endif;
			?>
            </li>

            <?php
			wp_reset_query();
			//wp_reset_postdata();
			?>
		</ul>
	</div>
</section>