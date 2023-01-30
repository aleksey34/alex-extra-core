<script type="text/javascript">
    (function (){
        const singleMaterialCfTitleField = document.querySelectorAll('.single-material .wpforms-field-container  .single-material-cf-title-field input' );
        if(singleMaterialCfTitleField.length){
            const materialTitleText  = document.querySelectorAll('.single-material .page-header-title')[0].innerHTML;
            if(materialTitleText){
                singleMaterialCfTitleField[0].value = materialTitleText;
                singleMaterialCfTitleField[0].setAttribute("readonly", "readonly");
            }
        }
    })();
</script>