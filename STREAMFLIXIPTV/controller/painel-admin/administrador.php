<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';


if(!isset($_POST['acao']) OR empty($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'admin-editar-perfil'){

    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_whatsapp']) OR !isset($_POST['user_telegram'])){
        die_error("Preencha todos os campos.");
    }

    $user_nome      = valida_nome($_POST['user_nome']) ? trim(ucwords($_POST['user_nome'])) : die_error("O nome é inválido.");
    $user_whatsapp  = NULL;
    $user_telegram  = NULL;

    if(!empty($_POST['user_whatsapp'])){
        if(!valida_whatsapp_telegram($_POST['user_whatsapp'])){
            die_error("O número do whatsapp é inválido.");
        }
        $user_whatsapp = $_POST['user_whatsapp'];
    }

    if(!empty($_POST['user_telegram'])){
        if(!valida_whatsapp_telegram($_POST['user_telegram'])){
            die_error("O número do telegram é inválido.");
        }
        $user_telegram = $_POST['user_telegram'];
    }

    if(!user_editar_perfil($user_nome, $user_whatsapp, $user_telegram, $admin['user_id'], $admin['user_email'], $admin['user_tipo'])){
        die_error("Não foi possível editar.");
    }

    die_success_reload("O seu perfil foi editado.");

}

if($_POST['acao'] == 'admin-alterar-senha'){

    if(!isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_senha_nova']) OR empty($_POST['user_senha_nova']) OR 
       !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma'])){
        die_error("Preencha todos os campos.");
    }

    $user_senha   = empty(user_get_por_email_senha($admin['user_email'], hash_senha($_POST['user_senha']))) ? die_error("A senha atual está incorreta.") : '';

    if($_POST['user_senha_nova'] != $_POST['user_senha_confirma']){
        die_error("As senhas não estão iguais.");
    }

    $user_senha_nova = !valida_senha($_POST['user_senha_nova']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha_nova']);

    if(!user_alterar_senha($admin['user_id'], $admin['user_email'], $user_senha_nova)){
        die_error("Não foi possível alterar a senha.");
    }
    excluir_sessao($admin['user_id'], $admin['user_email']);
    setcookie("admin", "", -1 , "/");
    die_success_redirect("Sua senha foi alterada. Acesse a sua conta novamente.", BASE_USER.'login');
    
}

if($_POST['acao'] == 'adicionar-administrador'){

    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
       !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma']) OR 
       !isset($_POST['user_whatsapp']) OR !isset($_POST['user_telegram'])){
        die_error("Preencha todos os campos.");
    }

    $user_nome     = valida_nome($_POST['user_nome']) ? trim(ucwords($_POST['user_nome'])) : die_error("O nome é inválido.");
    $user_email    = valida_email($_POST['user_email']) ? trim(strtolower($_POST['user_email'])) : die_error("O email é inválido.");
    $user_whatsapp = NULL;
    $user_telegram = NULL; 

    if(user_verificar_email_existe($user_email) > 0){
        die_error("O email já está cadastrado.");
    }

    if(!empty($_POST['user_whatsapp'])){
        if(!valida_whatsapp_telegram($_POST['user_whatsapp'])){
            die_error("O número do whatsapp é inválido.");
        }
        $user_whatsapp = $_POST['user_whatsapp'];
    }

    if(!empty($_POST['user_telegram'])){
        if(!valida_whatsapp_telegram($_POST['user_telegram'])){
            die_error("O número do telegram é inválido.");
        }
        $user_telegram = $_POST['user_telegram'];
    }

    if($_POST['user_senha'] != $_POST['user_senha_confirma']){
        die_error("As senhas não estão iguais.");
    }

    $user_senha = !valida_senha($_POST['user_senha']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha']);

    if(!user_cadastro($user_nome, $user_email, $user_senha, "admin", $user_whatsapp, $user_telegram)){
        die_error("Não foi possível adicionar.");
    }

    die_success_redirect("O administrador foi adicionado.", BASE_ADMIN.'administrador/listar');

}

if($_POST['acao'] == 'excluir-administrador'){
    if(!isset($_POST['user_id']) OR !intval($_POST['user_id']) OR empty(user_get_por_id($_POST['user_id']))){
        die_error("Administrador Não Encontrado.");
    }

    $ex = user_get_por_id($_POST['user_id']);

    if($ex['user_id'] == $admin['user_id']){
        die_error("Não é possível excluir sua própria conta.");
    }

    if($ex['user_tipo'] != 'admin'){
        die_error("O usuário não é um administrador.");
    }

    if(!user_excluir($ex['user_id'], $ex['user_email'], $ex['user_tipo'])){
        die_error("Não foi possível excluir.");
    }

    excluir_sessao($ex['user_id'], $ex['user_email']);
    die_success_reload("O administrador foi excluído.");

}