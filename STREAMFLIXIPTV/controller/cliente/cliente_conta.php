<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(!isset($_POST['acao']) OR empty($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if($_POST['acao'] == 'cliente-editar-perfil'){
    if(!isset($_POST['cliente_perfil_apelido']) OR empty($_POST['cliente_perfil_apelido'])){
        die_error("Informe o apelido do perfil.");
    }
    $cliente_perfil_apelido = valida_apelido($_POST['cliente_perfil_apelido']) ? trim(ucwords($_POST['cliente_perfil_apelido'])) : die_error("O apelido é inválido.");

    if(!cliente_perfil_apelido_update($cliente['user_id'], $cliente_perfil['cliente_perfil_id'], $cliente_perfil_apelido)){
        die_error("Não foi possível salvar.");
    }
    die_success_reload("Informações salvas.");
}



if($_POST['acao'] == 'cliente-editar-conta'){
    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_whatsapp']) OR !isset($_POST['user_telegram'])){
        die_error("Preencha todos os campos.");
    }

    $user_nome          = valida_nome($_POST['user_nome']) ? trim(ucwords($_POST['user_nome'])) : die_error("O nome é inválido.");
    $user_whatsapp      = !empty($_POST['user_whatsapp']) ? (valida_whatsapp_telegram($_POST['user_whatsapp'])  ? $_POST['user_whatsapp'] : die_error("O número do whatsapp é inválido.")) : NULL;
    $user_telegram      = !empty($_POST['user_telegram']) ? (valida_whatsapp_telegram($_POST['user_telegram'])  ? $_POST['user_telegram'] : die_error("O número do telegram é inválido.")) : NULL;

    if(!user_editar_perfil($user_nome, $user_whatsapp, $user_telegram, $cliente['user_id'], $cliente['user_email'], "cliente")){
        die_error("Não foi possível salvar.");
    }
    die_success_reload("Informações salvas.");

}


if($_POST['acao'] == 'cliente-alterar-senha'){

    if(!isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_senha_nova']) OR empty($_POST['user_senha_nova']) OR 
       !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma'])){
        die_error("Preencha todos os campos.");
    }

    $user_senha   = empty(user_get_por_email_senha($cliente['user_email'], hash_senha($_POST['user_senha']))) ? die_error("A senha atual está incorreta.") : '';

    if($_POST['user_senha_nova'] != $_POST['user_senha_confirma']){
        die_error("As senhas não estão iguais.");
    }

    $user_senha_nova = !valida_senha($_POST['user_senha_nova']) ? die_error("A senha deve conter mais de 5 caractéres.") : hash_senha($_POST['user_senha_nova']);

    if(!user_alterar_senha($cliente['user_id'], $cliente['user_email'], $user_senha_nova)){
        die_error("Não foi possível alterar a senha.");
    }
    excluir_sessao($cliente['user_id'], $cliente['user_email']);
    setcookie("cliente", "", -1 , "/");
    die_success_redirect("Sua senha foi alterada. Acesse a sua conta novamente.", BASE_USER.'login');
}