<?php
/**
 * Page of admin menu for this plugin
 *
 * // можем использовать функцию get_admin_page_title(), чтобы динамически вывести "Настройки слайдера"
 */

//form handler is here

//alex_var_dump(AlexExtraCoreOptions);
//alex_var_dump(AlexExtraCoreOptions , false);
?>
<div class="wrapper">
	<div class="wrap"><h2><?php echo  get_admin_page_title() ; ?></h2></div>
	<h3>
		На этой странице находятся настройки плагина Alex-Extra-Core.
	</h3>
	<?php  alex_get_form( alex_extra_core_get_forms_settings() ,'alex_admin_page_form_id');  ?>
    <br/><br><br><br>
    <?php if(defined('AlexExtraCoreOptions')
             && '1'  === AlexExtraCoreOptions['parser_section_enable']) : ?>
    <h4>
        Секция парсинга сайтов, создание постов, страниц, материалов и тд.
    </h4>
    <br/><br/>

	    <?php  alex_get_form( alex_extra_core_get_forms_settings() ,'alex_parser_form_id');  ?>
<br>
        <p>
            Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
        </p>
         <?php  alex_get_form(alex_extra_core_get_forms_settings() , 'alex_start_parser_form_id') ?>
    <br/><br/>
    <h5>
        Создание постов, материалов, страниц из данных полученых парсингом и тд.
    </h5>
    <p>
        Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
    </p>
    <?php alex_get_form( alex_extra_core_get_forms_settings() , 'alex_start_create_posts_form_id')  ?>

<br/>
        <p>
            Удаление всех постов.<br/> Удаление всех Материалов - со всеми изображениями которые к ним прикрепленны.<br/>
            Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
        </p>
    <?php alex_get_form( alex_extra_core_get_forms_settings() , 'alex_delete_posts_form_id')  ?>

    <?php endif;  ?>
</div>