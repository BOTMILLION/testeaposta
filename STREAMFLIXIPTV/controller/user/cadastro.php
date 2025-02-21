<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'cadastro'){

    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
       !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_confirma_senha']) OR empty($_POST['user_confirma_senha']) OR 
       !isset($_POST['user_whatsapp'])){
        die_error("Preencha todos os campos.");
    }
    
    $user_nome          = valida_nome($_POST['user_nome']) ? strip_tags(trim(addslashes(ucwords($_POST['user_nome'])))) : die_error("O nome é inválido.");

    $user_email         = strip_tags(addslashes(trim(strtolower($_POST['user_email']))));
    $user_email         = valida_email($user_email) ? $user_email : die_error("O email é inválido.");

    $confirma_senha     = $_POST['user_senha'] != $_POST['user_confirma_senha'] ? die_error("As senhas não estão iguais.")  : null;
    $user_senha         = !valida_senha($_POST['user_senha']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha']);

    $user_whatsapp      = !empty($_POST['user_whatsapp']) ? (valida_whatsapp_telegram($_POST['user_whatsapp'])  ? $_POST['user_whatsapp'] : die_error("O número do whatsapp é inválido.")) : NULL;


    if(user_verificar_email_existe($user_email) > 0){
        die_error("O email já está cadastrado.");
    }

    if(!user_cadastro($user_nome, $user_email, $user_senha, "cliente", $user_whatsapp)){
        die_error("Não foi possível criar sua conta no momento.");
    }

    $user_id     = $pdo->lastInsertId();
    $sessao_hash = gerar_hash();
    $cliente_perfil_hash = gerar_hash();

    if(!cadastrar_sessao($sessao_hash, $user_id, $user_email, "cliente")){
        die_success_redirect("Sua conta foi criada. Acesse a sua conta.", BASE_USER.'login');
    }
     
    cliente_perfil_gerar("Perfil 1", $user_id, cliente_perfil_avatar_gerar(), $cliente_perfil_hash);
    $cliente_perfil = cliente_perfil_por_hash($user_id, $cliente_perfil_hash);

    setcookie("cliente", $sessao_hash, strtotime("+ 365 days"), "/"); 
    setcookie("cliente_perfil", $cliente_perfil_hash, strtotime("+ 365 days"), "/"); 
    die_success_redirect("Sua conta foi criada.", BASE_STREAM);

} 