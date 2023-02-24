<?php
//alex-common-email-form form_id=   --shortcode
global $email_common_form_id;
global $email_common_form_slug;

$email_common_form_id_name = 'email_common_form_id_name';
$email_common_form_slug_name = 'email_common_form_slug_name';

    $error = [];
    $success = false;
    $is_error = false;


    if(isset($_POST[ $email_common_form_id_name] )
       && $_POST[ $email_common_form_id_name] === $email_common_form_id ){

	    if(  isset($_POST[ 'form_error'] ) && count($_POST[ 'form_error']) > 0 ){
		    $error = $_POST['form_error'];
		    $is_error = true;
	    }elseif( isset($_POST[ 'form_success'] ) && $_POST[ 'form_success'] === true   ){
		    $success =  true ;

	    }else{
		    $is_error = true;
		    $error['send_mail'] = true;
        }

    }

    $fields = alex_extra_core_get_settings()[$email_common_form_slug]['fields'];


?>
<form method="POST" class="email-form <?php  echo $email_common_form_slug; ?>" id="<?php echo $email_common_form_id  ; ?>"  action=" <?php echo   site_url()  . esc_html($_SERVER['REQUEST_URI'] ) ; ?>">
    <div class="form-inner">
        <h3>Написать нам</h3>
	    <?php echo   isset($success) && $success === true ? "<span class='success-message'>Сообщение отправленно успешно.</span>"  : '' ;
	     echo   $is_error && isset($error['send_mail']) && $error['send_mail'] === true ? "<span class='error-message'>Ошибка отправки Email.</span>"  : '' ;
          alex_create_common_email_form_fields($fields , $is_error , $error);
             ?>
        <input type="hidden" name="<?php echo $email_common_form_id_name  ?>" value="<?php echo $email_common_form_id ; ?>" />
        <input type="hidden" name="<?php echo $email_common_form_slug_name  ;  ?>" value="<?php  echo $email_common_form_slug ; ?>"   />
        <?php  wp_nonce_field( $email_common_form_id .'_action' ,  $email_common_form_id . '_name' , true , true );  ?>
        <input name="submit" type="submit" value="Отправить" />
    </div>
</form>