<?php
global $common_email_fields;

?>
<div class="wrapper">
    <div>
        <span>Имя отправителя:</span>
        <span><?php esc_html_e($common_email_fields['alex_user_name']);  ?></span>
    </div>
    <div>
        <span>Email отправителя:</span>
        <span><?php esc_html_e($common_email_fields['alex_email']);  ?></span>
    </div>
    <div>
        <span>Номер телефона отправителя:</span>
        <span><?php esc_html_e($common_email_fields['alex_tel']);  ?></span>
    </div>
    <div>
        <span>Сообщение:</span>
        <span><?php esc_html_e($common_email_fields['alex_message']);  ?></span>
    </div>
<?php if(isset($common_email_fields['alex_single_material_title'])
         && !empty($common_email_fields['alex_single_material_title']) ) : ?>
    <div>
        <span>Тема:</span>
        <span><?php esc_html_e($common_email_fields['alex_single_material_title']);  ?></span>
    </div>
    <?php   endif; ?>
</div>