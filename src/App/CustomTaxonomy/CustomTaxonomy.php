<?php
namespace AlexExtraCore\App\CustomTaxonomy;


class CustomTaxonomy{

	private static $instance;

	public function __construct(){

		$this->init();

	}

	public function getArgs(){

		return [
			[
				'taxonomy'=>'material_category',
				'post_type'=>['material'],
				'settings'=> [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => 'Категории материала',
						'singular_name'     => 'Категория материала',
						'search_items'      => 'Искать категорию материала',
						'all_items'         => 'Все категории материала',
						'view_item '        => 'Смотреть категорию материала',
						'parent_item'       => 'Родительская категория материала',
						'parent_item_colon' => 'Родительская категория материала:',
						'edit_item'         => 'Редактировать категорию материала',
						'update_item'       => 'Обновить категорию материала',
						'add_new_item'      => 'Добавить новую категорию материала',
						'new_item_name'     => 'Новае имя категории материала',
						'menu_name'         => 'Категории материала',
						'back_to_items'     => '← Назад к категории материала',
					],
					'description'           => '', // описание таксономии
					'public'                => true,
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          => true , //false,

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => array(),
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => true, // добавить в REST API
					'rest_base'             => null, // $taxonomy
					// '_builtin'              => false,
					//'update_count_callback' => '_update_post_term_count',
				]
			
			],
			[
				'taxonomy'=>'brand',
				'post_type'=>['material'],
				'settings'=> [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => 'Бренды',
						'singular_name'     => 'Бренд',
						'search_items'      => 'Искать Бренды',
						'all_items'         => 'Все Бренды',
						'view_item '        => 'Смотреть Бренды',
						'parent_item'       => 'Родительский Бренд',
						'parent_item_colon' => 'Родительские Бренды:',
						'edit_item'         => 'Редактировать Бренд',
						'update_item'       => 'Обновить Бренд',
						'add_new_item'      => 'Добавить новый Бренд',
						'new_item_name'     => 'Имя нового Бренда',
						'menu_name'         => 'Бренды',
						'back_to_items'     => '← Назад к Брендам',
					],
					'description'           => '', // описание таксономии
					'public'                => true,
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          => true , // false,

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => array(),
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => true, // добавить в REST API
					'rest_base'             => null, // $taxonomy
					// '_builtin'              => false,
					//'update_count_callback' => '_update_post_term_count',
				]

			],
			[
				'taxonomy'=>'type_of_premises',
				'post_type'=>['material'],
				'settings'=> [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => 'Тип помещения',
						'singular_name'     => 'Тип помещения',
						'search_items'      => 'Искать тип помещения',
						'all_items'         => 'Все типы помещения',
						'view_item '        => 'Смотреть тип помещения',
						'parent_item'       => 'Родительский тип помещения',
						'parent_item_colon' => 'Родительские типы помещения:',
						'edit_item'         => 'Редактировать тип помещения',
						'update_item'       => 'Обновить тип помещения',
						'add_new_item'      => 'Добавить новый тип помещения',
						'new_item_name'     => 'Имя нового типа помещения',
						'menu_name'         => 'Типы помещений',
						'back_to_items'     => '← Назад к типам помещений',
					],
					'description'           => '', // описание таксономии
					'public'                => true,
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          => true , // false,

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => array(),
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => true, // добавить в REST API
					'rest_base'             => null, // $taxonomy
					// '_builtin'              => false,
					//'update_count_callback' => '_update_post_term_count',
				]

			],
			[
				'taxonomy'=>'hashtags',
				'post_type'=>['material'],
				'settings'=> [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => 'Тег',
						'singular_name'     => 'Тег',
						'search_items'      => 'Искать тег',
						'all_items'         => 'Все теги',
						'view_item '        => 'Смотреть тег',
						'parent_item'       => 'Родительский тег',
						'parent_item_colon' => 'Родительские теги:',
						'edit_item'         => 'Редактировать тег',
						'update_item'       => 'Обновить тег',
						'add_new_item'      => 'Добавить новый тег',
						'new_item_name'     => 'Имя нового тега',
						'menu_name'         => 'Теги',
						'back_to_items'     => '← Назад к тегам',
					],
					'description'           => '', // описание таксономии
					'public'                => true,
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          =>  false, // tag type

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => array(),
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => true, // добавить в REST API
					'rest_base'             => null, // $taxonomy
					// '_builtin'              => false,
					//'update_count_callback' => '_update_post_term_count',
				]

			],

		];
	}

	public  function  registerCustomTaxonomy(){
		$args_array = $this->getArgs();
		$default = [
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => [
				'name'              => 'Категории материала',
				'singular_name'     => 'Категория материала',
				'search_items'      => 'Search Категория материалаs',
				'all_items'         => 'Все категории материала',
				'view_item '        => 'View Категория материала',
				'parent_item'       => 'Parent Категория материала',
				'parent_item_colon' => 'Parent Категория материала:',
				'edit_item'         => 'Edit Категория материала',
				'update_item'       => 'Update Категория материала',
				'add_new_item'      => 'Add New Категория материала',
				'new_item_name'     => 'New Категория материала Name',
				'menu_name'         => 'Категория материала',
				'back_to_items'     => '← Назад к категории материала',
			],
			'description'           => '', // описание таксономии
			'public'                => true,
			// 'publicly_queryable'    => null, // равен аргументу public
			// 'show_in_nav_menus'     => true, // равен аргументу public
			// 'show_ui'               => true, // равен аргументу public
			// 'show_in_menu'          => true, // равен аргументу show_ui
			// 'show_tagcloud'         => true, // равен аргументу show_ui
			// 'show_in_quick_edit'    => null, // равен аргументу show_ui
			'hierarchical'          => false,

			'rewrite'               => true,
			//'query_var'             => $taxonomy, // название параметра запроса
			'capabilities'          => array(),
			'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
			'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
			'show_in_rest'          => null, // добавить в REST API
			'rest_base'             => null, // $taxonomy
			// '_builtin'              => false,
			//'update_count_callback' => '_update_post_term_count',
		];
		foreach ($args_array as $args){
			
			// список параметров: wp-kama.ru/function/get_taxonomy_labels
			register_taxonomy( $args['taxonomy'] , $args[ 'post_type' ], $args['settings'] );
			
		}
		
	}

	public function init(){

		add_action( 'init', [$this, 'registerCustomTaxonomy'] , 10 );

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return static::$instance;

	}


}