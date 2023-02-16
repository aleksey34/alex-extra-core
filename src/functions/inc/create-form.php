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

/**
 * @param $settings
 * @param $form_id
 *
 * @return false|string
 */
function alex_get_form(  $settings , $form_id){
    $args = $settings[$form_id];
	$fields = $args['fields'];
	$is_admin = $args['is_admin'];
ob_start();
		echo $args['before'] ? $args['before'] : '<form id="'.$form_id.'">';

	   wp_nonce_field($form_id . '_action' ,  $form_id . '_name' , true , true );

	foreach ($fields  as $key => $field){

	    if(isset($_POST[$key]) && !empty($_POST[$key])   ){
		    $value  = $_POST[$key] ;
        }elseif( defined("AlexExtraCoreOptions")  && !empty(AlexExtraCoreOptions ) &&  !empty(AlexExtraCoreOptions[$key]) && AlexExtraCoreOptions[$key]  !== false ){
		    $value  = AlexExtraCoreOptions[$key] ;
        }else{
	        $value = '';
        }
                // $_POST[$key]
		        alexGetFormFields($key , $field , $value, $is_admin );

	}

	echo    $args['after'] ? $args['after'] : '</form>';

$html = ob_get_clean();

	if($args['echo'] ){

		echo $html;

	}else{

		return $html;

	}
}


/**
 * function created form field
 */
/**
 * @param $key
 * @param $args
 * @param null $value
 *
 * @param bool $is_admin
 *
 * @return string
 */
function alexGetFormFields($key , $args , $value = null , $is_admin = true){
	// func for create form
	$defaults = array(
		'type'              => 'text',
		'label'             => '',
		'description'       => '',
		'placeholder'       => '',
		'maxlength'         => false,
		'required'          => false,
		'autocomplete'      => false,
		'id'                => $key,
		'class'             => array(),
		'label_class'       => array(),
		'input_class'       => array(),
		 'return'            => false,  // do not change- require-- echo ONLY - handler ob_start !
		'options'           => array(),
		'custom_attributes' => array(),
		'validate'          => array(),
		'default'           => '',
		'autofocus'         => '',
		'priority'          => '',
	);

	$args = wp_parse_args( $args, $defaults );
//	$args = apply_filters( 'afp_form_field_args', $args, $key, $value );

	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
		$required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'afp' ) . '">*</abbr>';
	} else {
		$required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'afp' ) . ')</span>';
	}

	if ( is_string( $args['label_class'] ) ) {
		$args['label_class'] = array( $args['label_class'] );
	}

	if ( is_null( $value ) ) {
		$value = $args['default'];
	}

	// Custom attribute handling.
	$custom_attributes         = array();
	$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

	if ( $args['maxlength'] ) {
		$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
	}

	if ( ! empty( $args['autocomplete'] ) ) {
		$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
	}

	if ( true === $args['autofocus'] ) {
		$args['custom_attributes']['autofocus'] = 'autofocus';
	}

	if ( $args['description'] ) {
		$args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
	}

	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	}

	if ( ! empty( $args['validate'] ) ) {
		foreach ( $args['validate'] as $validate ) {
			$args['class'][] = 'validate-' . $validate;
		}
	}

	$field           = '';
	$label_id        = $args['id'];
	$sort            = $args['priority'] ? $args['priority'] : '';
	$field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</p>';

	switch ( $args['type'] ) {
		case 'textarea':
			$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) .
			          '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) .
			          ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

			break;
		case 'checkbox':
			$checked =  isset($_POST[esc_attr($key)]  ) && !empty($_POST[esc_attr($key)] ) ? 'checked' : '';
			if(defined('AlexExtraCoreOptions') &&  isset($key) && !empty($key) && !empty(AlexExtraCoreOptions[$key]) && '1' == AlexExtraCoreOptions[$key] ){
			    $checked  = 'checked';
            }
			if($is_admin){
				$field = '<tr>
			                    <th scope="row">'. esc_attr($args["label"]) .'</th>
			                    <td>
			                        <fieldset>
			                            <legend class="screen-reader-text">
			                                <span>'. esc_attr($args["label"]) .'</span>
			                            </legend>
			                            <label for="' . esc_attr( $args["id"] ) . '">
			                                <input name="'.esc_attr($key).'" '.
				                                   $checked . '
			                                       type="'.esc_attr( $args["type"] ).'"
		                                       id="' . esc_attr( $args["id"] ) . '"
		                                       value="1"/>
		                                '. esc_attr($args["description"]) .'
			                            </label>
			                        </fieldset>
			                    </td>
		                    </tr>';
			}else{
				$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) .
				         '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';
			}

			break;
		case 'text':
		case 'password':
		case 'datetime':
		case 'datetime-local':
		case 'date':
		case 'month':
		case 'time':
		case 'week':
		case 'number':
		case 'email':
		case 'url':
		case 'file':
		case 'tel':
		    if($is_admin){

		        $field .= '<tr>
                                <th scope="row"><label for="' . esc_attr( $args['id'] ) . '">'. esc_attr($args['label']).'</label></th>
                                <td>
                                    <input placeholder="' . esc_attr( $args['placeholder'] ) . '" name="'. esc_attr( $key ) .'" type="' . esc_attr( $args['type'] ) . '" id="' . esc_attr( $args['id'] ) . '" value="'.   esc_attr( $value )  .'" class="regular-text">
                                    </td>
                            </tr>';

            }else{
			    $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) .
			              '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' .
			              implode( ' ', $custom_attributes ) . ' />';
            }


			break;
		case 'datepicker':

			$field .= '<input type="tex" class="datepicker ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' .
			          esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' .
			          implode( ' ', $custom_attributes ) . ' />';

			break;
		case 'select':
			$field   = '';
			$options = '';

			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( '' === $option_key ) {
						// If we have a blank option, select2 needs a placeholder.
						if ( empty( $args['placeholder'] ) ) {
							$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'afp' );
						}
						$custom_attributes[] = 'data-allow_clear="true"';
					}
					$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
				}

				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .
				          '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
			}

			break;
		case 'multiselect':
			$field   = '';
			$options = '';

			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( '' === $option_key ) {
						if ( empty( $args['placeholder'] ) ) {
							$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'afp' );
						}
						$custom_attributes[] = 'data-allow_clear="true"';
					}
					$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
				}

				$field .= '<select multiple name="' . esc_attr( $key ) . '[]" id="' . esc_attr( $args['id'] ) . '" class="multiselect ' .
				          esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' .
				          esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
			}
			$field .= "
				<script type=\"text/javascript\">
				document.addEventListener(\"DOMContentLoaded\", function() {
					var multiselect2 =jQuery('.alex-js-multiselect [multiple]');
					multiselect2.css('width','100%');
					if(multiselect2.length){
					    multiselect2.select2();
					}
				});
				</script>";

			break;
		case 'radio':
			$label_id .= '_' . current( array_keys( $args['options'] ) );

			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) .
					          '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) .
					          '"' . checked( $value, $option_key, false ) . ' />';
					$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' .
					          $option_text . '</label>';
				}
			}

			break;
		case 'wysiwyg_editor' :
			wp_localize_script(
				'alex-plugin-custom-create-posts-js',
				// 'afcp-script',
				'field_editor',
				[
					'key' => esc_attr( $key ),
				]
			);

			ob_start();
			wp_editor(
				esc_textarea( $value ),
				esc_attr( $key ),
				[
					'wpautop'          => $args['custom_attributes']['wpautop'],
					'media_buttons'    => $args['custom_attributes']['media_buttons'],
					'textarea_name'    => $key,
					'textarea_rows'    => $args['custom_attributes']['textarea_rows'],
					'tabindex'         => $args['custom_attributes']['tabindex'],
					'editor_css'       => $args['custom_attributes']['editor_css'],
					'editor_class'     => $args['custom_attributes']['editor_class'],
					'teeny'            => $args['custom_attributes']['teeny'],
					'dfw'              => $args['custom_attributes']['dfw'],
					'tinymce'          => $args['custom_attributes']['tinymce'],
					'quicktags'        => $args['custom_attributes']['quicktags'],
					'drag_drop_upload' => $args['custom_attributes']['drag_drop_upload'],
				]
			);
			$editor = ob_get_clean();
			// wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );


			?>
			<div
				class="<?php echo esc_attr( implode( ' ', $args['class'] ) ); ?>"
				id="<?php echo esc_attr( $args['id'] ) . '_field'; ?>"
				style="margin: 0 0 20px;">
				<?php if ( ! empty( $args['label'] ) ) : ?>
					<label>
						<?php echo $args['label']; ?>
						<?php if ( ! empty( $args['required'] ) ) : ?>
							<abbr class="required" title="Обязательное">*</abbr>
						<?php endif; ?>
					</label>
				<?php endif; ?>
				<?php echo $editor; ?>

			</div>
			<script type="text/javascript">

                document.addEventListener("DOMContentLoaded", function() {
                    // code...


                    // jQuery(
                    // 	function($){


                    jQuery(document).on('tinymce-editor-setup',
                        function(e , ed){
                            console.log('SETUP', field_editor.key , ed);
                            // console.log(ed['iframe#event_descriptions_ifr']);


// 		window.tinyMCE.triggerSave()
// let content = jQuery('#editor_id').val()
                            // get content - works
                            let iframe = window.tinyMCE.get('event_descriptions')
                            let content = iframe.getContent();
                            console.log(iframe , content);
                            // window.tinyMCE.on('click',()=>{alert(333333)})
                            const jQueryIframe = jQuery(iframe);
                            console.log(jQueryIframe)
                            jQueryIframe.on('NodeChange', function(){
                                alert('keydown')
                            })

// 		jQuery(document).on('tinymce-editor-change',function(){
// alert(33333333333333333333333333)
// 		});
                            //	window.tinyMCE.get('event_descriptions').triggerSave()
// $(window.tinyMCE.get('event_descriptions')).triggerSave();


                            // do not work!!!
                            ed.on("NodeChange" , function(e){
                                console.log('ONCHANGE');
                                jQuery('#' + field_editor.key)
                                    .html(wp.editor.getContent(field_editor.key));
                            })
                        });

// 		});

                });
			</script>

			<?php
			break;
	}

	if ( ! empty( $field ) ) {
		$field_html = '';

		if ( $args['label'] && 'checkbox' !== $args['type'] ) {
			$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required .
			               '</label>';
		}

		$field_html .= '<span class="afp-input-wrapper">' . $field;

		if($args['type'] !=='checkbox' && !$is_admin){

			if ( $args['description'] ) {
				$field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
			}
		}


		$field_html .= '</span>';

		$container_class = esc_attr( implode( ' ', $args['class'] ) );
		$container_id    = esc_attr( $args['id'] ) . '_field';
		$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
	}

	if ( ! $args['return'] ) {
		echo $field; // WPCS: XSS ok.
	}

	return $field;




}