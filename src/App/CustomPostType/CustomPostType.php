<?php
namespace AlexExtraCore\App\CustomPostType;


class CustomPostType{

	private static $instance;

	public function __construct(){

		$this->init();

	}

	public function getArgs(){

		return [
			[
				'post_type_name'=>'material',
				'settings'=> [
					'label'  => null,
					'labels' => [
						'name'               => 'Материалы', // основное название для типа записи
						'singular_name'      => 'материал', // название для одной записи этого типа
						'add_new'            => 'Добавить материал', // для добавления новой записи
						'add_new_item'       => 'Добавление материала', // заголовка у вновь создаваемой записи в админ-панели.
						'edit_item'          => 'Редактирование материала', // для редактирования типа записи
						'new_item'           => 'Новый материал', // текст новой записи
						'view_item'          => 'Смотреть материал', // для просмотра записи этого типа.
						'search_items'       => 'Искать материал', // для поиска по этим типам записи
						'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
						'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
						'parent_item_colon'  => '', // для родителей (у древовидных типов)
						'menu_name'          => 'Материалы и работы', // название меню
					],
					'description'            => '',
					'public'                 => true,
					// 'publicly_queryable'  => null, // зависит от public
					// 'exclude_from_search' => null, // зависит от public
					// 'show_ui'             => null, // зависит от public
					// 'show_in_nav_menus'   => null, // зависит от public
					'show_in_menu'           => null, // показывать ли в меню админки
					// 'show_in_admin_bar'   => null, // зависит от show_in_menu
					'show_in_rest'        => true, // добавить в REST API. C WP 4.7
					'rest_base'           => null, // $post_type. C WP 4.7
					'menu_position'       => null,
					'menu_icon'           => null,
					//'capability_type'   => 'post',
					//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
					//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
					'hierarchical'        => false,
					'supports'            => [ 'title', 'editor','thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
					'taxonomies'          => [],
					'has_archive'         => true, // false
					'rewrite'             => true,
					'query_var'           => true,
				]

			],


		];
	}

	public  function  registerCustomPostType(){
		$args_array = $this->getArgs();
		$default =[
			'label'  => null,
			'labels' => [
				'name'               => '____', // основное название для типа записи
				'singular_name'      => '____', // название для одной записи этого типа
				'add_new'            => 'Добавить ____', // для добавления новой записи
				'add_new_item'       => 'Добавление ____', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование ____', // для редактирования типа записи
				'new_item'           => 'Новое ____', // текст новой записи
				'view_item'          => 'Смотреть ____', // для просмотра записи этого типа.
				'search_items'       => 'Искать ____', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => '____', // название меню
			],
			'description'            => '',
			'public'                 => true,
			// 'publicly_queryable'  => null, // зависит от public
			// 'exclude_from_search' => null, // зависит от public
			// 'show_ui'             => null, // зависит от public
			// 'show_in_nav_menus'   => null, // зависит от public
			'show_in_menu'           => null, // показывать ли в меню админки
			// 'show_in_admin_bar'   => null, // зависит от show_in_menu
			'show_in_rest'        => null, // добавить в REST API. C WP 4.7
			'rest_base'           => null, // $post_type. C WP 4.7
			'menu_position'       => null,
			'menu_icon'           => null,
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical'        => false,
			'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
			'taxonomies'          => [],
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		];
		foreach ($args_array as $args){

			// список параметров: wp-kama.ru/function/get_taxonomy_labels
			register_post_type( $args[ 'post_type_name' ], $args['settings'] );

		}
	}

	public function init(){

		add_action( 'init', [$this, 'registerCustomPostType'] , 20 );

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}



//function register_post_types(){
//
//	register_post_type( 'post_type_name', [
//		'label'  => null,
//		'labels' => [
//			'name'               => '____', // основное название для типа записи
//			'singular_name'      => '____', // название для одной записи этого типа
//			'add_new'            => 'Добавить ____', // для добавления новой записи
//			'add_new_item'       => 'Добавление ____', // заголовка у вновь создаваемой записи в админ-панели.
//			'edit_item'          => 'Редактирование ____', // для редактирования типа записи
//			'new_item'           => 'Новое ____', // текст новой записи
//			'view_item'          => 'Смотреть ____', // для просмотра записи этого типа.
//			'search_items'       => 'Искать ____', // для поиска по этим типам записи
//			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
//			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
//			'parent_item_colon'  => '', // для родителей (у древовидных типов)
//			'menu_name'          => '____', // название меню
//		],
//		'description'            => '',
//		'public'                 => true,
//		// 'publicly_queryable'  => null, // зависит от public
//		// 'exclude_from_search' => null, // зависит от public
//		// 'show_ui'             => null, // зависит от public
//		// 'show_in_nav_menus'   => null, // зависит от public
//		'show_in_menu'           => null, // показывать ли в меню админки
//		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
//		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
//		'rest_base'           => null, // $post_type. C WP 4.7
//		'menu_position'       => null,
//		'menu_icon'           => null,
//		//'capability_type'   => 'post',
//		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
//		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
//		'hierarchical'        => false,
//		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
//		'taxonomies'          => [],
//		'has_archive'         => false,
//		'rewrite'             => true,
//		'query_var'           => true,
//	] );
//
//}