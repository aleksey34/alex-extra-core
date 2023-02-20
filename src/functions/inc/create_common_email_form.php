<?php
/**
 * @param $fields
 * @param $is_error
 * @param $error
 * function for show fields of common forms for email
 */
function alex_create_common_email_form_fields($fields , $is_error , $error){
    if($is_error === true){
        $is_first = true;
    }else{
        $is_first =false;
    }


	foreach ($fields as $key => $field) :
		echo   isset($error[$key]) && $error[$key]  === true ? "<span class='error-validation-message'>" .  $field['error_message']  ."</span>"  : '' ;
		if($field['type']  === 'text' || $field['type']  === 'tel' || $field['type']  === 'email' ) :
			?>
			<input name="<?php echo $key ; ?>"
                   <?php echo  $is_first=== true ? "data-error=1"  :  ''; $is_first = false;  ?>
			       value="<?php echo $is_error === true  ?  $_POST[ $key ] : '' ; ?>"
				<?php echo  $field['required'] === true ? 'required' : '' ;  ?>
				   type="<?php echo $field['type']  ; ?>"
				<?php echo isset($field['attributes'])
					? str_replace( '|' , ' ' ,   $field['attributes']  )
					: '' ; ?>
				   placeholder="<?php  echo $field['placeholder'] ; ?>">
		<?php   elseif($field['type']  === 'textarea')  :   ?>
			<textarea name="<?php echo $key ; ?>"
			          placeholder="<?php  echo $field['placeholder'] ; ?>"
				<?php echo isset($field['attributes'])
					? str_replace( '|' , ' ' ,   $field['attributes']  )
					: '' ; ?>   ><?php echo $is_error === true ?  $_POST[$key] : ''   ;  ?></textarea>
		<?php   elseif($field['type']  === 'checkbox')  :
			echo '';
		else  :
			echo '';
		endif;
	endforeach; ?>
    <div class="not_clever_field" >
        <input value="1" type="checkbox" name="not_clever1" />
        <input value="" type="text" name="not_clever2" />
        <input value="right" type="text" name="not_clever3" />
    </div>
    <label>Согласие на отправку персональных данных
        <input  <?php echo $is_error === true ?  'checked' : ''   ;  ?> value="1" type="checkbox" required name="agreement_use_personal_data"  />
    </label>
<?php
}