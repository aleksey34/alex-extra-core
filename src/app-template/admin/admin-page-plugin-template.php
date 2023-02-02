<?php
/**
 * Page of admin menu for this plugin
 *
 * // можем использовать функцию get_admin_page_title(), чтобы динамически вывести "Настройки слайдера"
 */

//form handler is here


?>
<div class="wrapper">
	<div class="wrap"><h2><?php echo  get_admin_page_title() ; ?></h2></div>
	<p>
		На этой странице находятся настроки плагина Alex-Extra-Core и они будут изментся по мере необходимости.
	</p>
	<?php  alex_get_form( alex_extra_core_get_forms_settings() ,'alex_admin_page_form_id');  ?>
</div>