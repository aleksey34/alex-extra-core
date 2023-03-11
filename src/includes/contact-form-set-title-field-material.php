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
                // set title of product in first input of form
                const singleMaterialCfTitleField = document.querySelectorAll('.single-material  .single-material-cf-title-field' );
                if(singleMaterialCfTitleField.length){
                    const materialTitleArr  = document.querySelectorAll('.single-material .page-header-title');
                    if(materialTitleArr){
                        const materialTitleText  = materialTitleArr[0].innerHTML;
                        if(materialTitleText){
                            singleMaterialCfTitleField[0].value = materialTitleText;
                        }
                    }
                }

                // return modal window if it has error
                const errorSpan =
                    document.querySelectorAll('.email-form  .error-message');
                if(errorSpan && errorSpan.length) {
                    const errorWindow = errorSpan[0].closest('.omw-modal');
                    if(errorWindow){
                        const linkArr = document.querySelectorAll('a');
                        let isFirst = true;
                        linkArr.forEach(function (link){
                            if(link.getAttribute('href')  === `#${errorWindow.id}`  && isFirst  ){
                                link.click();
                                isFirst = false;
                            }
                        })
                    }
                }

            })();
		</script>
<?php
	}
}, 110);