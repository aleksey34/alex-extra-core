<?php
//alex-common-email-form form_id=   --shortcode
global $email_form_id;

// только такая структура  1 - имя 2 - тип  ВАЖНО!
$fields_arr= [
        [ 'name' ,'text'],
        ['email' , 'email'],
        [ 'tel' , 'tel'],
        ['message' , 'text'],
];

$fields =  \AlexExtraCore\App\Helper\Helper::doStringFromArrayForFormInput($fields_arr);
?>
<form method="POST" class="email-form" id="<?php echo $email_form_id  ; ?>"  action=" <?php echo  site_url()  .$_SERVER['REQUEST_URI'] ; ?>">
    <div class="form-inner">
        <h3>Написать нам</h3>
        <input name="name" required type="text" placeholder="Ваше имя">
        <input name="email" required type="email" placeholder="Ваш Email">
        <input name="tel" required type="tel" placeholder="Ваш номер телефона">
        <textarea name="message" placeholder="Сообщение..." rows="3"></textarea>
        <input type="hidden" name="email_form_id" value="<?php echo $email_form_id ; ?>" />
        <input type="hidden" name="fields" value="<?php  echo $fields ; ?>"   />
        <?php  wp_nonce_field( $email_form_id .'_action' ,  $email_form_id . '_name' , true , true );  ?>
        <label>Согласие на отправку персональных данных
            <input value="1" type="checkbox" required name="agreement_use_personal_data"  />
        </label>
        <input name="submit" type="submit" value="Отправить">
    </div>
</form>
<style>
    .email-form {
        position: relative;
        max-width: 400px;
        margin: 50px auto 0;
        background: #fff;
        border-radius: 5px;
        border: 1px solid #ddd;
    }


    .form-inner {
        padding: 50px;
    }
    .form-inner input, .form-inner textarea {
        display: block;
        width: 100%;
        padding: 0 20px;
        margin-bottom: 10px;
        background-color: #fff;
        border-radius: 5px;
        line-height: 40px;
        border: 1px solid #eee;
        /*border-width: 0;*/
        /*border-radius: 5px;*/
        font-family: 'Roboto', sans-serif;
    }
    .email-form .form-inner input{
        border: none;
        border-bottom: 1px solid #eee;
        border-radius: 0;
        background-color: #fff;
    }
    .email-form .form-inner input[name=agreement_use_personal_data]{
        border-radius: 0;
        display: inline-block;
        padding: 0;
        width: 15px;
        height: 15px;
        border: 1px solid #555;

    }


    .form-inner input[type="submit"] {
        margin-top: 30px;
        background-color:#471616;
        border-bottom: 4px solid #d87d56;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
    }
    .form-inner input[type="submit"]:hover{
        transition: all 0.3s ease-in-out;
        background-color: #3A3C3C;
    }

    .form-inner textarea {
        resize: none;
    }
    .form-inner h3 {
        margin-top: 0;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        font-size: 24px;
        color: #707981;
    }
</style>