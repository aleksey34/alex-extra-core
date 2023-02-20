<?php
/**
 * set field for contact form of modal window
 * this script setting Title!!! in form field
 *
 * modal window -contact form - set field - title
 */
add_action('wp_footer' , function ( ){
	if( is_single() &&  get_post_type(get_the_ID()) === 'material' ){
       ?>
		<script type="text/javascript">
            (function (){
                const modalButton = document.querySelectorAll('.omw-open-modal a')[0];
                if(modalButton){
                    modalButton.addEventListener('click' , function (){
                        alert('this is modal again email error');
                    })
                }
                const singleMaterialCfTitleField = document.querySelectorAll('.single-material  .single-material-cf-title-field' );

                if(singleMaterialCfTitleField.length){
                    const materialTitleText  = document.querySelectorAll('.single-material .page-header-title')[0].innerHTML;
                    if(materialTitleText){
                        singleMaterialCfTitleField[0].value = materialTitleText;
                        // singleMaterialCfTitleField[0].setAttribute("readonly", "readonly");
                        const isError = singleMaterialCfTitleField[0].getAttribute('data-error');
                        if(isError === '1' && modalButton){
                            modalButton.click();
                        }
                    }
                }
            })();
		</script>
<?php
	}
}, 100);