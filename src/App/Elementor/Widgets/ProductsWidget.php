<?php
namespace AlexExtraCore\App\Elementor\Widgets;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class ProductsWidget extends \Elementor\Widget_Base {

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
		return 'alex_custom_products';
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
		return __( 'Products', 'plugin-name' );
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
		return 'eicon-code';
	}

	public function get_keywords() {
		return [ 'custom', 'product' ];
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
			'number_products_section',
			[
				'label' => __( 'Content', 'elementor-custom-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

//		$this->add_control(
//			'url',
//			[
//				'label' => __( 'URL to embed', 'elementor-custom-extension' ),
//				'type' => \Elementor\Controls_Manager::TEXT,
//				'input_type' => 'text',
//				'placeholder' => __( '', 'elementor-custom-extension' ),
//			]
//		);

		$this->add_control(
			'count_products',
			[
				'label' => __( 'Products per widget', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'row_count_products',
			[
				'label' => __( 'Products per row', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();

//		$this->start_controls_section(
//			'number_columns_section',
//			[
//				'label' => __( 'Content', 'plugin-name' ),
//				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
//			]
//		);
//
//		$this->add_control(
//			'url',
//			[
//				'label' => __( 'URL to embed', 'plugin-name' ),
//				'type' => \Elementor\Controls_Manager::TEXT,
//				'input_type' => 'text',
//				'placeholder' => __( '', 'plugin-name' ),
//			]
//		);
//
//		$this->end_controls_section();
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

		$settings = $this->get_settings_for_display();

	//	global	$products_per_page_widget ;
		$products_per_page_widget = strtr($settings['count_products'] , '' , '');

	//	global  $products_per_row_widget;
        $products_per_row_widget =   strtr($settings['row_count_products'] , '' , '');


		echo '<div class="products-widget">';

		// working!!!!  this is show products with custom structure
	//	require_once( __DIR__ . '../../template-parts/front-page-products.php' );// product_category  category="vstrechi-seminary"

		echo  $products_per_page_widget .  $products_per_row_widget;
	echo "this is test";
		// if there is no woocommentce??
//       echo do_shortcode('[product  per_page="'.$products_per_page_widget.'" columns="'.$products_per_row_widget.'" orderby="default" order="desc" operator="in"]');

		echo '</div>';
	}

}