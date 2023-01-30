<?php
namespace AlexExtraCore\App\Elementor\Widgets;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class ModalWindowWidget extends \Elementor\Widget_Base {


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
		return 'alex_modal_window';
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
		return __( 'Modal Window', 'elementor-custom-extension' );
	}

	public function get_keywords() {
		return [ 'modal', 'window' ];
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
		return 'eicon-form-horizontal';
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

	    // section modal window=================================
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Modal Window Content', 'elementor-custom-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// content modal window
		$this->add_control(
			'popup_content',
			[
				'label' => __( 'Content', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				//'input_type' => 'text',
				'placeholder' => __( 'Content', 'elementor-custom-extension' ),
			]
		);


//content modal window  background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background Content Modal Window', 'elementor-custom-extension' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementor-modal-window-block',
			]
		);

		
		$this->end_controls_section();
// end section modal window======================================

// section -btn=================================================
		$this->start_controls_section(
			'btn_section',
			[
				'label' => __( 'Settings button', 'elementor-custom-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// title btn for trigger
		$this->add_control(
			'popup_btn',
			[
				'label' => __( 'Button title', 'elementor-custom-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Button Title', 'elementor-custom-extension' ),
			]
		);


		$this->end_controls_section();
// end section btn ==========================================

// section  background for active modal window
		$this->start_controls_section(
			'background_active_modal_window_section',
			[
				'label' => __( 'Settings Background', 'elementor-custom-extension' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		// active modal window background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_modal_window',
				'label' => __( 'Background', 'elementor-custom-extension' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER_BACKGROUND}} .elementor-modal-window-background.elementor-modal-window-background__show',
			]
		);




		$this->end_controls_section();
// end section background for active modal window

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(){

		$settings = $this->get_settings_for_display();

		// getting data from controls
        $content = substr($settings['popup_content'], 0 );

       // $content = $settings['popup-content'];
		//$content = wp_oembed_get( $settings['popup_content'] );

		$btn_trigger_popup_title = wp_oembed_get( $settings['popup_btn'] );


		if(is_admin()):
            echo '<label style="font-weight:  bold; background-color: #000;color: #fff;">Check to show in admin:</label><br/>' ;
            echo '<input class="switch_show_modal_window_content" type="checkbox" checked/>';
        endif;

		// content modal window//
		echo '<div class="elementor-modal-window-block"> ';
        echo "<div class=''>".$content."</div>";
		echo '</div>';


		//btn modal - trigger
		echo '<div class="custom-widget-popup-button">';
		echo "<button  class='btn-elementor-modal-window-trigger'>";
		echo  ( $btn_trigger_popup_title ) ? $btn_trigger_popup_title : $settings['popup_btn'] ;
		echo "</button>";
		echo '</div>';


		// background  for modal active
		echo '<div class="elementor-modal-window-background"></div>';
		?>


		<script>
			window.onload = function () {

			 if(jQuery(".elementor-editor-active").length > 0){return false;}

			 let btnTrigger = jQuery(".elementor-page .btn-elementor-modal-window-trigger");
			 if(btnTrigger.length === 0) {return false;}


			 let btnTriggerWrapper =  btnTrigger.parent() ;
			 let modalWindow = btnTriggerWrapper.prev() ;
			 let modalBackground = btnTriggerWrapper.next();


			// modalWindow.appendTo(jQuery("body"));

			  let handlerClickTriggerOrBackground  = function(){
                 modalWindow.toggleClass("modal-window-toggle-show");
                 modalBackground.toggleClass('elementor-modal-window-background__show');
			 };


			 btnTrigger.on('click' , handlerClickTriggerOrBackground );

			 modalBackground.on('click' , handlerClickTriggerOrBackground);

            };


		</script>

		<style>
            <?php
          //  switch show in admin only
            if(is_admin()) : ?>
            .switch_show_modal_window_content:checked + .elementor-modal-window-block {
                display: block !important;
            }
            .switch_show_modal_window_content + .elementor-modal-window-block {
                display: none !important;
            }
            <?php endif;  ?>

            /*trigger btn style*/
            .btn-elementor-modal-window-trigger{
                cursor:  pointer;
                /*padding: 0;*/
                /*border-style: none;*/
                transition: all 0.5s;
                color: #fff;
                background-color: #007bff;
                display: block;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                font-family: inherit;

                margin: 0 auto;

            }
            .btn-elementor-modal-window-trigger:hover{
                transition: all 0.7s ;
                border-color: #007bff;
                color: lavender;
                background-color: #312aff;

            }


			/*modal window content this is only front - modal window -- show*/
			body:not(.elementor-editor-active)  .elementor-modal-window-block.modal-window-toggle-show{
				opacity: 1 ;
				top: 50px ;
                bottom: 10vh ;
                transition: top 0.7s ;
                /*this rule - only if it shows - video*/
                height: 0 !important;
			}

			/*modal window content this is only front  modal window  -- hidden*/
			body:not(.elementor-editor-active)  .elementor-modal-window-block{
				display: block ;
				opacity:0.4 ;
				position:  fixed ;
                z-index: 999999 ;
				transform: translateX( -50%) ;
				left: 50% ;
                width: 300px ;
                /*height: 250px;*/
                /*this rule - only if it shows - video*/
                height: 0 !important;
				transition: top 0.7s ;
				top: -200vh ;
			}


			/*background active window  background -- hidden*/
			body:not(.elementor-editor-active) .elementor-modal-window-background{
                display: block;
                opacity: 0;
				position: fixed;
                z-index: 99999;
                transition: opacity 0.7s , top 0.1s 0.7S ;
                left:50%;
                transform: translate(-50% , -50%);
                top: -110vh;
                width: 100vw;
                height: 100vh;
			}
            /*background active window  background -- show*/
			body:not(.elementor-editor-active)  .elementor-modal-window-background.elementor-modal-window-background__show{
				opacity: 1;
				transition: opacity 0.7s;
                top:50%;
			}

		</style>
<?php
	}
}
