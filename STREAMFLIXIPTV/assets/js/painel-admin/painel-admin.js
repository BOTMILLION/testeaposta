$(document).ready(function(){

    $('.form__textarea').each(function () {
        CKEDITOR.replace($(this).prop('id'),{
            extraPlugins: 'codesnippet',
            height: 400,
            filebrowserUploadUrl: SITE_URL + '/controller/admin/ckeditor_uploads.php',
            filebrowserUploadMethod: 'form',
        });
    }); 

    user_online_cad("admin");

});