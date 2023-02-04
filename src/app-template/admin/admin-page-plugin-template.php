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
        Парсинг сайтов.
    </h4>

	    <?php  alex_get_form( alex_extra_core_get_forms_settings() ,'alex_parser_form_id');  ?>
<br>
        <p>
            Не наживайте на кнопку и закрройте доступ в эту секцию если вы не знаете точно что делаете!
        </p>
         <?php  alex_get_form(alex_extra_core_get_forms_settings() , 'alex_start_parser_form_id') ?>
    <?php endif;  ?>
</div>