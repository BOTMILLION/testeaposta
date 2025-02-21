<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'login'){

    if(!isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
       !isset($_POST['user_senha']) OR empty($_POST['user_senha'])){
        die_error("Preencha todos os campos.");
    }  

    $user_email         = strip_tags(addslashes(trim(strtolower($_POST['user_email'])))); 
    $user_email         = valida_email($user_email) ? $user_email : die_error("O email é inválido.");

    $user_senha         = !valida_senha($_POST['user_senha']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha']);


    if(empty(user_get_por_email_senha($user_email, $user_senha))){
        die_error("Email ou senha incorretos.");
    }

    $user           = user_get_por_email_senha($user_email, $user_senha);
    $sessao_hash    = gerar_hash();

    if(!cadastrar_sessao($sessao_hash, $user['user_id'], $user_email, $user['user_tipo'])){
        die_error("Não foi possível iniciar sessao.");
    }

    if($user['user_tipo'] == 'cliente'){
        setcookie("cliente", $sessao_hash, strtotime("+ 90 days"), "/"); 
        die_url(BASE_CLIENTE.'perfil-selecionar');
    }

    if($user['user_tipo'] == 'admin'){
        setcookie("admin", $sessao_hash, strtotime("+ 30 days"), "/"); 
        die_url(BASE_ADMIN);
    }
    

    
} 