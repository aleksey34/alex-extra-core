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
        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/test-block' );


    /**
    *todo list init
    */
        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/todo-list' );


    /**
     *Slick Slider v1
     */
    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-v1' );

    /**
     *Slick Slider  v2
     * base on slick-slider v1
     */
    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-v2' );



    /**
     *Slick Slider advanced - to base on default block - Image
     */
    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-advanced' );

    /**
     *Slick Slider dynamic - to base on default block - Gallery
     */
    register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/slick-slider-dynamic' );




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
