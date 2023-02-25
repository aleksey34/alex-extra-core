<?php
/**
 * Page of admin menu for this plugin
 *
 * // можем использовать функцию get_admin_page_title(), чтобы динамически вывести "Настройки слайдера"
 */
?>
<div class="wrapper">
    <div class="wrap"><h2><?php echo  get_admin_page_title() ; ?></h2></div>
    <h3>
        На этой странице находятся настройки плагина Alex-Extra-Core.
    </h3>

    <div class="mytabs">
        <input type="radio" name="mytab-button" id="tab_common_settings" value="" checked>
        <label for="tab_common_settings">Общие настрйки</label>

        <input type="radio" name="mytab-button" id="tab_secure_settings" value="" >
        <label for="tab_secure_settings">Настройки безопастности</label>

        <input type="radio" name="mytab-button" id="tab_enable_functionality" value="">
        <label for="tab_enable_functionality">Включение фунционала</label>

	    <?php
        if(defined('AlexExtraCoreOptions') && !empty(AlexExtraCoreOptions['develop_tab_section_enable'])
	             && 1  === AlexExtraCoreOptions['develop_tab_section_enable']) : ?>
        <input type="radio" name="mytab-button" id="tap_development" value="">
        <label for="tap_development">Разработка</label>
        <?php endif; ?>


        <div id="common_settings_content">
	        <?php    ?>
        </div>

        <div id="secure_settings_content">
		    <?php  alex_get_form( alex_extra_core_get_settings() ,'alex_admin_page_form_id');  ?>
        </div>

        <div id="enable_functionality_content">
            <h4>Избранные посты</h4>
            <p>
                Включить или выклчить возможноть отмечать избранные посты(материалы)
            </p>
            <?php alex_get_form( alex_extra_core_get_settings() , 'alex_enable_favorite_form_id')  ?>
        </div>

	    <?php if(defined('AlexExtraCoreOptions') && !empty(AlexExtraCoreOptions['develop_tab_section_enable'])
	             &&  1  === AlexExtraCoreOptions['develop_tab_section_enable']) : ?>
        <div id="development_content">
            <h4>
                Секция для разработки -  создание постов, страниц, материалов и тд.
            </h4>
            <br/><br/>
		    <?php
            alex_get_form( alex_extra_core_get_settings() ,'alex_parser_url_form_id');  ?>
            <br>
            <p>
                Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
            </p>
		    <?php  alex_get_form(alex_extra_core_get_settings() , 'alex_start_parser_form_id') ?>
            <br/><br/>
            <h5>
                Создание постов, материалов, страниц из данных полученых парсингом и тд.
            </h5>
            <p>
                Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
            </p>
		    <?php alex_get_form(  alex_extra_core_get_settings() , 'alex_create_posts_form_id')  ?>
            <br/>
            <p>
                Удаление всех постов.<br/> Удаление всех Материалов - со всеми изображениями которые к ним прикрепленны.<br/>
                Не наживайте на кнопки, не вводите данные  и закрройте доступ в эту секцию если вы не знаете точно что делаете!
            </p>
		    <?php alex_get_form( alex_extra_core_get_settings() , 'alex_remove_posts_form_id')  ?>
        </div>
	    <?php endif; ?>

    </div>
</div>


<style>
    .mytabs {
        font-size: 0;
    }
    .mytabs>input[type="radio"] {
        display: none;
    }

    .mytabs>div {
        display: none;
        border: 2px solid #e5e5e5;
        padding: 12px 20px;
        font-size: 18px;
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    #tab_common_settings:checked~#common_settings_content,
    #tab_secure_settings:checked~#secure_settings_content,
    #tap_development:checked~#development_content,
    #tab_enable_functionality:checked~#enable_functionality_content {
        display: block;
        opacity: 1;
        transition: all 0.3s ease-in-out;

    }

    .mytabs>label {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: #f4f4f4;
        border: 2px solid #e5e5e5;
        padding: 4px 10px;
        font-size: 18px;
        line-height: 1.7;
        transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out;
        cursor: pointer;
        position: relative;
        top: 2px;
        border-radius: 5px;
    }

    .mytabs>label:not(:first-of-type) {
        border-left: none;
    }

    .mytabs>input[type="radio"]:checked+label {
        transition: all 0.3s ease-in-out;
        background-color: #555;
        color: #ddd;
        border-radius: 5px;
        border-bottom: 1px solid #eee;

    }
</style>