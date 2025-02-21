<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_POST['acao']) OR empty($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'alterar-senha'){ 


    if(!isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
        !isset($_POST['user_confirma_senha']) OR empty($_POST['user_confirma_senha']) OR 
        !isset($_POST['recuperar_hash']) OR empty($_POST['recuperar_hash'])){
            die_error("Preencha todos os campos.");
    }

    $recuperar  = !empty(recuperar_senha_get_por_hash($_POST['recuperar_hash'])) ?  recuperar_senha_get_por_hash($_POST['recuperar_hash']) : die_error_redirect("O link é inválido ou expirou. Solicite um novo link.", BASE_USER.'recuperar-senha');
    $user       = !empty(user_get_por_email_e_id($recuperar['recuperar_user_id'], $recuperar['recuperar_email'])) ? user_get_por_email_e_id($recuperar['recuperar_user_id'], $recuperar['recuperar_email']) : die_error_redirect("Sua conta não existe. Crie uma conta.", BASE_USER.'cadastro');

    $confirma_senha     = $_POST['user_senha'] != $_POST['user_confirma_senha'] ? die_error("As senhas não estão iguais.")  : null;
    $user_senha         = !valida_senha($_POST['user_senha']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha']);
 

    if(!user_alterar_senha($user['user_id'], $user['user_email'], $user_senha)){
        die_error("Não foi possível alterar sua senha. Tente mais tarde.");
    }
    
    recuperar_senha_limpar($user['user_id'], $user['user_email']);
    die_success_redirect_after_confirm("Sua senha foi alterada. Acesse a sua conta.", BASE_USER.'login');

}
