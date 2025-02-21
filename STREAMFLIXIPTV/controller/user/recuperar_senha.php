<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'recuperar-senha'){

    if(!isset($_POST['user_email']) OR empty($_POST['user_email'])){
        die_error("Informe o seu email.");
    }   

    $user_email                 = !valida_email($_POST['user_email']) ? die_error("O email é inválido.") : strip_tags(addslashes(trim(strtolower($_POST['user_email']))));
    $user                       = user_get_por_email($user_email);

    if(empty($user)){
        die_error("O email não existe.");
    }
    
    $recuperar_hash             = gerar_hash();
    $recuperar_data             = date("Y-m-d H:i:s", strtotime("+ 60 minutes"));
    $recuperar_data_formatado   = date("d/m/Y H:i", strtotime($recuperar_data));

    recuperar_senha_limpar($user['user_id'], $user['user_email']);
    
    if(!recuperar_senha_cadastrar($user['user_id'], $user['user_email'], $recuperar_hash, $recuperar_data)){
        die_error("Não foi possível continuar. Tente mais tarde.");
    }

    $assunto_email  = 'Recuperar Senha';
    $mensagem_email = user_template_recuperar_senha($user['user_nome'],$recuperar_hash, $recuperar_data_formatado);

    if(!enviar_email($user['user_email'], $user['user_nome'],$assunto_email, $mensagem_email)){
        recuperar_senha_limpar($user['user_id'], $user['user_email']);
        die_error("Não foi possível enviar o email no momento.");   
    }

    die_success_redirect_after_confirm("Um email com instruções foi enviado.", BASE_USER.'login');

}