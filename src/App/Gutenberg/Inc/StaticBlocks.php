<?php
namespace AlexExtraCore\App\Gutenberg\Inc;


class StaticBlocks {

	private static $instance;

   public function __construct(){
    // echo WP_PLUGIN_DIR   ;

    $this -> blocks_init();
    // add_action( 'init', [$this , 'alex_guten_block_plugin_init'] );

   }


    public function alexGutenbergBlockPluginStaticInit() {

    /**
    *test block init
    */
        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/test-block' );


    /**
    *todo list init
    */
        register_block_type( AlexExtraCorePluginDIR. '/src/App/Gutenberg/build/todo-list' );




    }
    public function blocks_init(){

       add_action( 'init', [$this , 'alexGutenbergBlockPluginStaticInit'] );

    }

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
