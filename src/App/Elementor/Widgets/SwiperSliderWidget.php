<?php
namespace AlexExtraCore\App\Elementor\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 *
 * для работы нужно добавить - js lib and js init!
 * стили уже подключены вместе с elementor
 */
class SwiperSliderWidget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'alex-swiper-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Alex Swiper Slider', 'alex-theme' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-push';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'carousel', 'slider' ];
	}

	/**
	 * Scripts
	 */
	public function get_script_depends() {
		wp_register_script( 'swiper', AlexExtraCorePluginURI . '/assets/libs/swiper/v8/swiper.min.js' , ['jquery'] , '8.4.5' , true );
//		return parent::get_script_depends(); // TODO: Change the autogenerated stub

		return [ 'swiper' ];
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
	 * Register image carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => esc_html__( 'Image Carousel', 'elementor' ),
			]
		);

		$this->add_control(
			'carousel',
			[
				'label' => esc_html__( 'Add Images', 'elementor' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);


		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => esc_html__( 'Slides to Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					             '' => esc_html__( 'Default', 'elementor' ),
				             ] + $slides_to_show,
				'frontend_available' => true,
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}}' => '--e-image-carousel-slides-to-show: {{VALUE}}',
				],
			]
		);


//		$this->add_responsive_control(
//			'slides_to_scroll',
//			[
//				'label' => esc_html__( 'Slides to Scroll', 'elementor' ),
//				'type' => \Elementor\Controls_Manager::SELECT,
//				'options' => [
//					             '' => esc_html__( 'Default', 'elementor' ),
//				             ] + $slides_to_show,
//				'frontend_available' => true,
//				'render_type' => 'template'
//			]
//		);


		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => esc_html__( 'Slides to Scroll', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'elementor' ),
				'options' => [
					             '' => esc_html__( 'Default', 'elementor' ),
				             ] + $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'image_stretch',
			[
				'label' => esc_html__( 'Image Stretch', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__( 'No', 'elementor' ),
					'yes' => esc_html__( 'Yes', 'elementor' ),
				],
			]
		);


		$this->add_control(
			'slider_direction',
			[
				'label' => esc_html__( 'Slides direction  -vertical or horizontal', 'alex-theme' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'horizontal' => esc_html__( 'Горизонтальное', 'alex-theme' ),
					'vertical'=>esc_html__( 'Вертикальное', 'alex-theme' )
				] ,
				'frontend_available' => true,
				'render_type' => 'template',
//				'selectors' => [
//					'{{WRAPPER}}' => '--e-image-carousel-slides-to-show: {{VALUE}}',
//				],
			]
		);



		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Navigation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => esc_html__( 'Arrows and Dots', 'elementor' ),
					'arrows' => esc_html__( 'Arrows', 'elementor' ),
					'dots' => esc_html__( 'Dots', 'elementor' ),
					'none' => esc_html__( 'None', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label' => esc_html__( 'Previous Arrow Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon' => 'eicon-chevron-left',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-regular' => [
						'arrow-alt-circle-left',
						'caret-square-left',
					],
					'fa-solid' => [
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					],
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'navigation',
							'operator' => '=',
							'value' => 'both',
						],
						[
							'name' => 'navigation',
							'operator' => '=',
							'value' => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'navigation_next_icon',
			[
				'label' => esc_html__( 'Next Arrow Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon' => 'eicon-chevron-right',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-regular' => [
						'arrow-alt-circle-right',
						'caret-square-right',
					],
					'fa-solid' => [
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					],
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'navigation',
							'operator' => '=',
							'value' => 'both',
						],
						[
							'name' => 'navigation',
							'operator' => '=',
							'value' => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'elementor' ),
					'file' => esc_html__( 'Media File', 'elementor' ),
					'custom' => esc_html__( 'Custom URL', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__( 'Lightbox', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'elementor' ),
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no' => esc_html__( 'No', 'elementor' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type',
			[
				'label' => esc_html__( 'Caption', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'None', 'elementor' ),
					'title' => esc_html__( 'Title', 'elementor' ),
					'caption' => esc_html__( 'Caption', 'elementor' ),
					'description' => esc_html__( 'Description', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'traditional',
				'options' => [
					'traditional' => esc_html__( 'traditional', 'elementor' ),
					'flip' => esc_html__( 'flip', 'elementor' ),
					'cube' => esc_html__( 'cube', 'elementor' ),
					'fade' => esc_html__( 'fade', 'elementor' ),
					'cards' => esc_html__( 'cards', 'elementor' ),
					'creative' => esc_html__( 'creative', 'elementor' ),

				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'elementor' ),
			]
		);

		$this->add_control(
			'lazyload',
			[
				'label' => esc_html__( 'Lazyload', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no' => esc_html__( 'No', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on Hover', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no' => esc_html__( 'No', 'elementor' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label' => esc_html__( 'Pause on Interaction', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no' => esc_html__( 'No', 'elementor' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'infinite',
			[
				'label' => esc_html__( 'Infinite Loop', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no' => esc_html__( 'No', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => esc_html__( 'Effect', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => esc_html__( 'Slide', 'elementor' ),
					'fade' => esc_html__( 'Fade', 'elementor' ),
				],
				'condition' => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Animation Speed', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => esc_html__( 'Direction', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => esc_html__( 'Left', 'elementor' ),
					'rtl' => esc_html__( 'Right', 'elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => esc_html__( 'Navigation', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => esc_html__( 'Arrows', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => esc_html__( 'Position', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => esc_html__( 'Inside', 'elementor' ),
					'outside' => esc_html__( 'Outside', 'elementor' ),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => esc_html__( 'Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => esc_html__( 'Pagination', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => esc_html__( 'Position', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'outside' => esc_html__( 'Outside', 'elementor' ),
					'inside' => esc_html__( 'Inside', 'elementor' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => esc_html__( 'Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_inactive_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					// The opacity property will override the default inactive dot color which is opacity 0.2.
					'{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}}; opacity: 1',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Active Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gallery_vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Start', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'End', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'slides_to_show!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper' => 'display: flex; align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
					'custom' => esc_html__( 'Custom', 'elementor' ),
				],
				'default' => '',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Image Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'condition' => [
					'image_spacing' => 'custom',
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
				'render_type' => 'none',
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => esc_html__( 'Caption', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'caption_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_shadow',
				'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$lazyload = 'yes' === $settings['lazyload'];

		if ( empty( $settings['carousel'] ) ) {
			return;
		}

		$slides_to_show = $settings['slides_to_show'];
		$slides_to_scroll = $settings['slides_to_scroll'];

		$slides_infinite = $settings['infinite'];
		$slides_view = $settings['view'];
		$slider_direction = $settings['slider_direction'] ?  $settings['slider_direction'] : 'horizontal'  ;

		$swiper_settings  = [];
		$swiper_settings['slides_to_show'] = $settings['slides_to_show'] ? $settings['slides_to_show'] : 1; ;
		$swiper_settings['slides_to_scroll'] = $settings['slides_to_scroll'] ?  $settings['slides_to_scroll'] : 1  ;
		$swiper_settings['infinite'] = $settings['infinite']  ;
		$swiper_settings['view'] = $settings['view']  ;
		$swiper_settings['slider_direction'] = $settings['slider_direction'] ?  $settings['slider_direction'] : 'horizontal'   ;



		$slides = [];

		foreach ( $settings['carousel'] as $index => $attachment ) {
			$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );

			if ( ! $image_url && isset( $attachment['url'] ) ) {
				$image_url = $attachment['url'];
			}

			if ( $lazyload ) {
				$image_html = '<img class="swiper-slide-image swiper-lazy" data-src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $attachment ) ) . '" />';
			} else {
				$image_html = '<img class="swiper-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $attachment ) ) . '" />';
			}

			$link_tag = '';

			$link = $this->get_link_url( $attachment, $settings );

			if ( $link ) {
				$link_key = 'link_' . $index;

				$this->add_lightbox_data_attributes( $link_key, $attachment['id'], $settings['open_lightbox'], $this->get_id() );

				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					$this->add_render_attribute( $link_key, [
						'class' => 'elementor-clickable',
					] );
				}

				$this->add_link_attributes( $link_key, $link );

				$link_tag = '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
			}

			$image_caption = $this->get_image_caption( $attachment );

			$slide_html = '<div class="swiper-slide">' . $link_tag . '<figure class="swiper-slide-inner">' . $image_html;

			if ( $lazyload ) {
				$slide_html .= '<div class="swiper-lazy-preloader"></div>';
			}

			if ( ! empty( $image_caption ) ) {
				$slide_html .= '<figcaption class="elementor-image-carousel-caption">' . wp_kses_post( $image_caption ) . '</figcaption>';
			}

			$slide_html .= '</figure>';

			if ( $link ) {
				$slide_html .= '</a>';
			}

			$slide_html .= '</div>';

			$slides[] = $slide_html;

		}

		if ( empty( $slides ) ) {
			return;
		}

		$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';

		$this->add_render_attribute( [
			'carousel' => [
				'class' => 'elementor-image-carousel swiper-wrapper',
			],
			'carousel-wrapper' => [
				'class' => 'elementor-image-carousel-wrapper ' . $swiper_class,
				'dir' => $settings['direction'],
			],
		] );

		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		if ( 'yes' === $settings['image_stretch'] ) {
			$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
		}

		$slides_count = count( $settings['carousel'] );

		// setting for js and html
		$alex_swiper_wrapper_id  = 'alexElementorSwiper' .   (string)rand(  1 ,  100000) ;


		?>
		<div id="<? echo esc_attr($alex_swiper_wrapper_id); ?>" <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
			<div  <?php $this->print_render_attribute_string( 'carousel' ); ?>>
				<?php // PHPCS - $slides contains the slides content, all the relevent content is escaped above. ?>
				<?php echo implode( '', $slides ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php if ( 1 < $slides_count ) : ?>
				<?php if ( $show_dots ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( $show_arrows ) : ?>
					<div class="elementor-swiper-button elementor-swiper-button-prev">
						<?php $this->render_swiper_button( 'previous' ); ?>
						<span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button elementor-swiper-button-next">
						<?php $this->render_swiper_button( 'next' ); ?>
						<span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'elementor' ); ?></span>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php

		$this->getStyle($alex_swiper_wrapper_id , $slider_direction );



	    $this->getJs($alex_swiper_wrapper_id , $swiper_settings );

	}

	/**
	 * Retrieve image carousel link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $attachment
	 * @param object $instance
	 *
	 * @return array|string|false An array/string containing the attachment URL, or false if no link.
	 */
	private function get_link_url( $attachment, $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment['id'] ),
		];
	}

	/**
	 * Retrieve image carousel caption.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param array $attachment
	 *
	 * @return string The caption of the image.
	 */
	private function get_image_caption( $attachment ) {
		$caption_type = $this->get_settings_for_display( 'caption_type' );

		if ( empty( $caption_type ) ) {
			return '';
		}

		$attachment_post = get_post( $attachment['id'] );

		if ( 'caption' === $caption_type ) {
			return $attachment_post->post_excerpt;
		}

		if ( 'title' === $caption_type ) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}

	private function render_swiper_button( $type ) {
		$direction = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings_for_display( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value' => 'eicon-chevron-' . $direction,
			];
		}

		\Elementor\Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}



	private function getJs(  $wrapper_id , $swiper_settings = []){ ?>
<script>
    jQuery(function (){
        if(Swiper){

            let alexSwiperSettings = {
                // Optional parameters
                // $swiper_settings['slides_to_show'] = $settings['slides_to_show']  ;
                // $swiper_settings['slides_to_scroll'] = $settings['slides_to_scroll']  ;
                // $swiper_settings['infinite'] = $settings['infinite']  ;
                // $swiper_settings['view'] = $settings['view']  ;
                // $swiper_settings['slider_direction'] = $settings['slider_direction'] ?  $settings['slider_direction'] : 'horizontal'   ;

                // paginationClickable: true,

                // autoplayDisableOnInteraction: false,


                // pagination: {
                //     el: ".swiper-pagination",
                //     clickable: true,
                // },

                // effect: 'cards',
                // cardsEffect: {
                //     // ...
                // },

                // effect: 'cube',
                // cubeEffect: {
                //     shadow: true, slideShadows: false, shadowOffset: 20, shadowScale: 0.94, },

                // ???? what is it?
                // zoom: {
                //     maxRatio: 5,
                // },

                // effect: 'creative',
                // creativeEffect: {
                //     prev: {
                //         // will set `translateZ(-400px)` on previous slides
                //         translate: [0, 0, -400],
                //     },
                //     next: {
                //         // will set `translateX(100%)` on next slides
                //         translate: ['100%', 0, 0],
                //     },
                // },

                // effect: 'fade',
                // fadeEffect: {
                //     crossFade: true
                // },

                // effect: 'flip',
                // flipEffect: {
                //     slideShadows: false,
                // },

                //? what is it??
                // effect: 'coverflow',
                // coverflowEffect: {
                //     rotate: 30,
                //     slideShadows: false,
                // },


                // speed: 400,
                // spaceBetween: 100,

                // loop: true,
                // draggable: true,

                // If we need pagination
                pagination: {
                    el: '#<?php echo esc_attr($wrapper_id) ; ?> .swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '#<?php echo esc_attr($wrapper_id) ; ?>  .elementor-swiper-button.elementor-swiper-button-next',
                    prevEl: '#<?php echo esc_attr($wrapper_id) ; ?> .elementor-swiper-button.elementor-swiper-button-prev',
                }

                // And if we need scrollbar
                // scrollbar: {
                //     el: '.swiper-scrollbar',
                //     draggable: true,
                // },
            };

            alexSwiperSettings['slidesPerView'] = <?php echo  $swiper_settings['slides_to_show'] ? $swiper_settings['slides_to_show'] : 1  ?>;
            alexSwiperSettings['spaceBetween'] = 100  ;
            alexSwiperSettings['autoplay'] = 3000  ;

	        <?php    if($swiper_settings['view'] !== 'traditional'): ?>
            alexSwiperSettings['effect'] = <?php   echo '"' . $swiper_settings['view'] . '";' ;   ?>;
	        <?php   endif;?>

	        <?php    if( $swiper_settings['infinite'] === 'Yes'): ?>
            alexSwiperSettings['loop']= true;
	        <?php   endif; ?>

            <?php    if( $swiper_settings['slider_direction'] === 'vertical'): ?>
            alexSwiperSettings['direction'] = <?php   echo '"' . "vertical" . '";' ;   ?>;//'vertical', //horizontal
	        <?php   endif; ?>

            const swiper = new Swiper('#<?php echo esc_attr($wrapper_id) ; ?>', alexSwiperSettings);
        }
    })
</script>

<?php
	}

	private function getStyle($wrapper_id , $slider_direction = 'horizontal') {
    if('vertical'=== $slider_direction):
		?>
        <style>
            #<?php  echo $wrapper_id ; ?>{

                }
               #<?php  echo $wrapper_id ; ?>  .swiper-wrapper{
                display: flex;
                flex-direction: column;
                align-items: center;
                height:300px;
                max-height: 300px;
                min-height: 300px;

            }
            #<?php  echo $wrapper_id ; ?>  .swiper-wrapper .swiper-slide {
                                               width: 300px;
                                               height: 300px;
                                               max-height: 300px;
                                               min-height: 300px;

                                           }
        </style>
    <?php
    endif;
        }


}