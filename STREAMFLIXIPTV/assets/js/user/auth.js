$(document).ready(function(){
    
    controller_submit_form("#form-cadastro", "user/cadastro.php");
    controller_submit_form("#form-login", "user/login.php");
    controller_submit_form("#form-recuperar-senha", "user/recuperar_senha.php");
    controller_submit_form("#form-alterar-senha", "user/alterar_senha.php");

}); 