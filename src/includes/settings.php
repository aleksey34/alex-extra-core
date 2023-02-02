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
function alex_extra_core_get_forms_settings(){
// field nonce  name  form if  + _action or _name
	return [
		'alex_admin_page_form_id'
		=>	[
			'is_admin' => true,
			'echo' => true ,
			'before' => '<div class="form" id="alex_admin_page_form_id_wrap"">
                            <form id="alex_admin_page_form_id" method="post" action="'. site_url()  .$_SERVER['REQUEST_URI'].'">
                                <table class="form-table" role="presentation">
                                    <tbody>',
			'after' =>              '</tbody>
                                 </table>
                                 <p class="submit">
                                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения">
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
					'description'       => 'Выключить доступ к сайту. Сайт будет недоступен для незалогинненых пользователей.',
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
				]
			]
		]
	];
}


