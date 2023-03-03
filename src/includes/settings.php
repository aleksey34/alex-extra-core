<?php
/**
 * Function for create form in admin and front
 *
 * @param $args
 *
 * @return mixed|string
 * /
/**
 * function create form in admin and front/  echo or return
 * use -where you want  -require $args
 */
//with example $args
function alex_extra_core_get_settings(){
// input hidden - fields -- requires  structure !! important array in array - 1 name 2 type- see example

	return  [
		//admin plugin form
		'alex_admin_page_form_id' =>
			[
			'is_admin' => true,
			'echo' => true ,
			'before' => '<div class="form" id="alex_admin_page_form_id_wrap"">
                            <form id="alex_admin_page_form_id" method="post" action="'. esc_html(  site_url()  .$_SERVER['REQUEST_URI'] ) .'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
			'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                 	<input type="hidden"  name="admin_form_id" value="alex_admin_page_form_id"  />
                                    <input type="submit" name="submit" id="alex_admin_page_form_id_submit" class="button button-primary" value="Сохранить изменения">
                                </p>
                              </form>
						  </div>',
			'fields' =>[
//			'event_title' => [
//				'type'              => 'text',
//				'label'             => 'Заголовок мероприятия',
//				'description'       => 'Это поле обязательное. Укажите заголовок мероприятия',
//				// 'placeholder'       => '',
//				'required'          => true,
//			],
//			'event_topics' => [
//				'type'              => 'multiselect',
//				'label'             => 'Категория мероприятия',
//				'options'           => $this->getCustomTerms('topics'),
//				// 'imput_class'       => ['alex-js-multiselect test tedt'],
//				'class'  => ['alex-js-multiselect'],
//				'description' => 'Выберите нужную категорию'
//			],
				// 'event_hashtags' => [
				// 'type'              => 'multiselect',
				// 'label'             => 'Теги мероприятия',
				// 'options'           => $this->getCustomTerms('hashtags'),
				// // 'imput_class'       => ['alex-js-multiselect'],
				// 'class'  => ['alex-js-multiselect']
				// 'description' => 'Укажите нужную метку'
				// ],
//			'event_hashtags' => [
//				'type'              => 'text',
//				'label'             => 'Теги мероприятия',
//				'description' => 'Укажите нужную метку в формате #вашаМетка'
//			],
//			'event_descriptions' => [
//				'type'              => 'wysiwyg_editor',
//				'label'             => 'Описание мероприятия',
//				// 'options'           => [],
//				'description' => 'Напишите что-то о мероприятии',
//				'custom_attributes' => [
//					'wpautop'       => 1,
//					'media_buttons' => 0, // default 1
//					'textarea_name' => 'event_descriptions', //нужно указывать!
//					'textarea_rows' => 20,
//					'tabindex'      => null,
//					'editor_css'    => '',
//					'editor_class'  => '',
//					'teeny'         => 0,
//					'dfw'           => 0,
//					'tinymce'       => 1 , //false , //1,
//					'quicktags'     => 1,
//					'drag_drop_upload' => false
//				]
//
//			],
//			'event_thumbnail' => [
//				'type'              => 'file',
//				'label'             => 'Миниатюра мероприятия',
//			],
//			'event_date' => [
//				'type'              => 'datepicker',
//				'label'             => 'Дата мероприятия',
//			],
//			'event_location' => [
//				'type'              => 'text',
//				'label'             => 'Место мероприятия',
//			],
				'devmode' => [
					'type'              => 'checkbox',
					'label'             => 'Режим разработки',
					'description'       => 'Включить режим разработки. Сайт будет недоступен для незалогинненых пользователей.',
					// 'placeholder'       => '',
					'required'          => false,
//					'default'           => 1  // require 1 ONLY for checkbox !!!!! do not set here!!!
				],
				'prohibition_edit_file' => [
					'type'              => 'checkbox',
					'label'             => 'Доступ к редактрованию кода из админ панели',
					'description'       => 'Включить или выключить эту возможность',
					// 'placeholder'       => '',
					'required'          => false,
//					'default'           => 1  // require 1 ONLY for checkbox !!!!! do not set here!!!
				] ,
				'develop_tab_section_enable' => [
					'type'              => 'checkbox',
					'label'             => 'Доступ к табу разработки',
					'description'       => 'Включить или выключить таб',
					// 'placeholder'       => '',
					'required'          => false,
//					'default'           => 1  // require 1 ONLY for checkbox !!!!! do not set here!!!
				] ,

			]
		],
		'alex_parser_url_form_id' =>
			[
			'is_admin' => true,
			'echo' => true ,
			'before' => '<div class="form" id="alex_parser_url_form_id_wrap"">
                            <form id="alex_parser_url_form_id" method="post" action="'.  esc_html(site_url()  . esc_html($_SERVER['REQUEST_URI'] ) ) .'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
			'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                    <input type="hidden"  name="admin_form_id" value="alex_parser_url_form_id"  />
                                    <input type="submit" name="submit" id="alex_parser_url_form_id_submit" class="button button-primary" value="Сохранить настроки">
                                </p>
                              </form>
						  </div>',
			'fields' =>[
				'parser_url' => [
					'type'              => 'text',
					'label'             => 'Url странцы для парсинга',
					// 'placeholder'       => '',
					'required'          => true,
				],
			]
		],
		'alex_start_parser_form_id' =>
			[
			'is_admin' => true,
			'echo' => true ,
			'before' => '<div class="form" id="alex_start_parser_form_id_wrap"">
                            <form id="alex_start_parser_form_id" method="post" action="'. site_url()  . esc_html($_SERVER['REQUEST_URI'] )  .'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
			'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                 	<input type="hidden"  name="develop_form_id" value="alex_start_parser_form_id"  />
                                    <input type="submit" name="submit" id="alex_start_parser_form_id_submit" class="button button-primary" value="Начать парсинг">
                                </p>
                              </form>
						  </div>',
			'fields' =>[]
		],
		'alex_create_materials_form_id'=>
			[
				'is_admin' => true,
				'echo' => true ,
				'before' => '<div class="form" id="alex_create_materials_form_id_wrap"">
                            <form id="alex_create_materials_form_id" method="post" action="'. site_url()  . esc_html($_SERVER['REQUEST_URI'] )  .'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
				'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                    <input type="hidden"  name="alex_create_materials_form_id_name" value="alex_create_materials_form_id"  />
                                    <input type="submit" name="submit" id="alex_create_materials_form_id_submit" class="button button-primary" value="Начать создание материалов">
                               		 <img style="display: none;margin-top: 8px; -webkit-user-select: none;background-color: hsl(0, 0%, 90%);" src="' . site_url() .'/wp-content/plugins/alex-extra-core/assets/img/ajax-loader.gif">                       
                                </p>
                              </form>
						  </div>',
				'fields' =>[]
			],
		'alex_remove_materials_form_id'=>
			[
				'is_admin' => true,
				'echo' => true ,
				'before' => '<div class="form" id="alex_remove_materials_form_id_wrap"">
                            <form id="alex_remove_materials_form_id" method="post" action="'. site_url()  . esc_html($_SERVER['REQUEST_URI'] )   .'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
				'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                    <input type="hidden"  name="alex_remove_materials_form_id_name" value="alex_remove_materials_form_id"  />                                  
                                      <input type="submit" name="submit" id="alex_remove_materials_form_id_submit" class="button button-primary" value="Удаление материалов">
                                    <img style="display: none;margin-top: 8px; -webkit-user-select: none;background-color: hsl(0, 0%, 90%);" src="'. site_url() .'/wp-content/plugins/alex-extra-core/assets/img/ajax-loader.gif">                       
                                </p>
                              </form>
						  </div>',
				'fields' =>[]
			],
		'alex_enable_favorite_form_id'=>
			[
				'is_admin' => true,
				'echo' => true ,
				'before' => '<div class="form" id="alex_enable_favorite_form_id_wrap"">
	                            <form id="alex_enable_favorite_form_id" method="post" action="'. site_url()  . esc_html($_SERVER['REQUEST_URI'] )  .'">
	                                <table class="form-table" role="presentation">
	                                    <tbody>',
				'after' =>              '</tbody>
	                                 </table>
	                                 <p class="submit">'
//	                                    <input type="hidden"  name="fields"
//					                        value="' . 	\AlexExtraCore\App\Helper\Helper::doStringFromArrayForFormInput(
//											[
//												["enable_favorite", "checkbox"]
//											]) .'"  />
	                                    .'<input type="hidden"  name="admin_form_id" value="alex_enable_favorite_form_id"  />
	                                    <input type="submit" name="submit" id="alex_enable_favorite_form_id_submit" class="button button-primary" value="Сохранить именения">                       
	                                </p>
	                              </form>
							  </div>',
				'fields' =>[
					'enable_favorite' => [
						'type'              => 'checkbox',
						'label'             => 'Избранные материалы',
						'description'       =>  'Добавить фунционал избанных материалов',
						// 'placeholder'       => '',
						'required'          => false,
					]
				],
			],

		// front form
		'email_common_form_slug' =>  // значение id - динамическое  -    поэтому для определения полей нужен слаг
			[

				'fields' =>[
					'alex_user_name'=>
					[
						 'name' => 'alex_user_name',
						 'type'=>'text' ,
						 'required' =>true,
						 'placeholder' =>'Ваше имя',
						 'error_message' =>'Имя записано не правильно.'
					],
					'alex_email' =>
					[
						 'name' => 'alex_email',
						 'type'=>'email' ,
						 'required' =>true ,
						 'placeholder'=>'Ваш Email',
						'error_message' =>'Email запсан не верно.'
					],
					'alex_tel'=>
					[
						 'name' => 'alex_tel',
						 'type'=>'tel',
						 'required' =>true ,
						 'placeholder'=>'Ваш номер телефона',
						 'error_message' =>'Номер телефона запсан не верно.'
					],
					'alex_message' =>
					[
						'name' => 'alex_message',
						'type'=>'textarea',
						'placeholder' =>'Сообщение...',
						'attributes' => 'row=\'3\'',  // attributes name=\'value\'|name2=\'value\'|name3=\'value\'|value|value  use \' open and close if require
						'error_message' =>'Ошибка валидации.'
					]

			]
	],
		'email_common_single_material_form_slug' =>  // значение id - динамическое  -    поэтому для определения полей нужен слаг
			[
				'fields' =>[
					'alex_single_material_title'=>
					[
						 'name' => 'alex_single_material_title',
						 'type'=>'text' ,
						 'required' =>true,
						 'placeholder' =>'Название материала',
						 'error_message' =>'Название записано не правильно.',
						 'attributes'=>'class=\'single-material-cf-title-field\'|readonly'
					],
					'alex_user_name'=>
					[
						 'name' => 'alex_user_name',
						 'type'=>'text' ,
						 'required' =>true,
						 'placeholder' =>'Ваше имя',
						 'error_message' =>'Имя записано не правильно.'
					],
					'alex_email' =>
					[
						 'name' => 'alex_email',
						 'type'=>'email' ,
						 'required' =>true ,
						 'placeholder'=>'Ваш Email',
						'error_message' =>'Email запсан не верно.'
					],
					'alex_tel'=>
					[
						 'name' => 'alex_tel',
						 'type'=>'tel',
						 'required' =>true ,
						 'placeholder'=>'Ваш номер телефона',
						 'error_message' =>'Номер телефона запсан не верно.'
					],
					'alex_message' =>
					[
						'name' => 'alex_message',
						'type'=>'textarea',
						'placeholder' =>'Сообщение...',
						'attributes' => 'row=\'3\'',  // attributes name=\'value\'|name2=\'value\'|name3=\'value\'|value|value  use \' open and close if require
						'error_message' =>'Ошибка валидации.'
					]

			]
	],
		];
	}