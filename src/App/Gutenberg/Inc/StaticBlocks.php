<?php
namespace AlexExtraCore\App\Gutenberg\Inc;


class StaticBlocks {

	private static $instance;

   public function __construct(){
    // echo WP_PLUGIN_DIR   ;

    $this -> blocksInit();

   }


    public function blockStaticInit() {

    /**
    *test block init
    */
//        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/test-block' );


    /**
    *todo list init
    */
//        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/todo-list' );


    /**
     *Slick Slider v1
     */
//    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-v1' );

    /**
     *Slick Slider  v2
     * base on slick-slider v1
     */
//    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-v2' );

    /**
	     *Slick Slider  v3
	     * base on new solution and slick slider v2
	     */
    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-v3' );



    /**
     *Slick Slider advanced - to base on default block - Image
     */
//    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-advanced' );

    /**
     *Slick Slider advanced-v2 - - to base on default block - Gallery
     */
//    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-advanced-v2' );




    }
    public function blocksInit(){

       add_action( 'init', [$this , 'blockStaticInit'] );

    }

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
