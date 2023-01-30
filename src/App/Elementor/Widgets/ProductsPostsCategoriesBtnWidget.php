<?php
namespace AlexExtraCore\App\Elementor\Widgets;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class ProductsPostsCategoriesBtnWidget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'alex_products_posts_categories_btn';
	}

	public function get_keywords() {
		return [ 'product', 'category' ];
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Post category buttons', 'elementor-custom-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'alex-extra-core-category' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'elementor-custom-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Content of the Modal Window', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'input_type' => 'url',
				'placeholder' => __( 'White it down', 'elementor-custom-extension' ),
			]
		);
		$this->add_control(
			'url',
			[
				'label' => __( 'Content of the Modal Window', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'input_type' => 'text',
				'placeholder' => __( 'White it down', 'elementor-custom-extension' ),
			]
		);

		$this->end_controls_section();




	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

	//	$settings = $this->get_settings_for_display();

	//	$html = wp_oembed_get( $settings['url'] );


		echo '<div class="oembed-elementor-widget">';

		if(is_single()) {
			$post_id        = get_the_ID();
			$categories_arr = wp_get_post_categories( $post_id );
			// output custom html btn  categories
			foreach ( $categories_arr as $category ) {
				?>
				<a class="btn btn-outline-success" href="<?php echo get_category_link( $category ); ?>">
					<?php echo get_the_category_by_ID( $category ); ?>
				</a>
				<?php
			}
		// this add list links
			//	echo 	get_the_category_list( ',' , '' , $post_id);

		}

      if(is_product()){
            global $product;
            $product_id = $product->id;
            $product_category_ids  = wc_get_product_cat_ids($product_id);

            // custom html , structure and style
            foreach($product_category_ids as $category_id){
                ?>
                <a href="<?php echo  get_category_link($category_id); ?>" class="btn btn-success">
                    <?php  echo  get_the_category_by_ID($category_id); ?>
                </a>
                <?php
            }



       // list categories - output  -- WORK!
         //  echo wc_get_product_category_list($product_id);
      }
		?>
<?php
		//echo ( $html ) ? $html : $settings['url'];
		echo '</div>';
	}

}