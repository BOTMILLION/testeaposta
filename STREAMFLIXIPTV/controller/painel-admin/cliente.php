<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';

if(!isset($_POST['acao'])){
    die_error("Não é possível processar a solicitação no momento.");
}


if($_POST['acao'] == 'cliente-adicionar'){
    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
       !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma']) OR 
       !isset($_POST['premium']) OR !intval($_POST['premium']) OR 
       !isset($_POST['user_whatsapp'])){
            die_error("Preencha todos os campos.");
       }

       $user_nome           = trim(ucwords($_POST['user_nome']));
       $user_email          = filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) ? trim(strtolower($_POST['user_email'])) : die_error("O email é inválido.");
       $user_email          = user_verificar_email_existe($user_email) > 0 ? die_error("O email já está cadastrado") : $user_email;
       $user_whatsapp       = !empty($_POST['user_whatsapp']) ? (valida_whatsapp_telegram($_POST['user_whatsapp'])  ? $_POST['user_whatsapp'] : die_error("O whatsapp é inválido")) : NULL;
       $user_senha          = valida_senha($_POST['user_senha'])  ? hash_senha($_POST['user_senha']) : die_error("A senha deve conter 6 ou mais caractéres.");
       $user_senha_confirma = $_POST['user_senha'] != $_POST['user_senha_confirma']  ? die_error("As senhas não estão iguais.") : NULL;

       $premium = !empty(premium_get(0, $_POST['premium'])) ? premium_get(0, $_POST['premium']) : die_error("O plano selecionado não existe.");

       
       if(!user_cadastro($user_nome, $user_email, $user_senha, "cliente", $user_whatsapp)){
            die_error("Não foi possível adicionar.");
       }

       $cliente_id = $pdo->lastInsertId();
       cliente_premium_adicionar($premium['premium_dias'], $cliente_id);

       $cliente_perfil_change      = cliente_perfil_change($premium['premium_telas'], $cliente_id);
       
       $venda_item_titulo = venda_titulo_stream_premium($premium['premium_telas'], $premium['premium_dias']);
       
       venda_cadastrar($venda_item_titulo, "premium", $premium['premium_id'], $premium['premium_preco'], 1, $premium['premium_preco'], $cliente_id, $user_email, 0);
       
       $venda_id = $pdo->lastInsertId();
       venda_atualizar($venda_id, 0, "approved", $cliente_id, $user_email);
       venda_concluida($venda_id, 0, $cliente_id, $user_email, 0);
       
       die_success_reload("O cliente foi adicionado.");

  }

if($_POST['acao'] == 'cliente-premium-editar'){
     if(!isset($_POST['user_id']) OR !intval($_POST['user_id'])){
          die_error("O cliente não foi encontrado.");
     }
     if(!isset($_POST['premium']) OR !is_numeric($_POST['premium'])){
          die_error("Selecione um plano premium. Ou Selecione remover acesso premium.");
     }

     $cliente = !empty(user_get_por_id($_POST['user_id'])) ? user_get_por_id($_POST['user_id']) : die_error("O cliente não foi encontrado.");

     if(intval($_POST['premium'])){
          $premium = !empty(premium_get(0, $_POST['premium'])) ? premium_get(0, $_POST['premium']) : die_error("O plano premium não foi encontrado.");
          
          cliente_premium_adicionar($premium['premium_dias'], $cliente['user_id']);
          $cliente_perfil_change  = cliente_perfil_change($premium['premium_telas'], $cliente['user_id']);

          $venda_item_titulo = venda_titulo_stream_premium($premium['premium_telas'], $premium['premium_dias']);
          
          venda_cadastrar($venda_item_titulo, "premium", $premium['premium_id'], $premium['premium_preco'], 1, $premium['premium_preco'], $cliente['user_id'], $cliente['user_email'], 0);
       
          $venda_id = $pdo->lastInsertId();
          venda_atualizar($venda_id, 0, "approved", $cliente['user_id'], $cliente['user_email']);
          venda_concluida($venda_id, 0, $cliente['user_id'], $cliente['user_email'], 0);

     }else{
          cliente_premium_excluir($cliente['user_id']);
     }

     die_success_reload("O premium do cliente foi editado.");
}

if($_POST['acao'] == 'cliente-excluir'){
     if(!isset($_POST['user_id']) OR !intval($_POST['user_id'])){
          die_error("O cliente não foi encontrado.");
     }

     $cliente = !empty(user_get_por_id($_POST['user_id'])) ? user_get_por_id($_POST['user_id']) : die_error("O cliente não foi encontrado.");

     if(!user_excluir($cliente['user_id'], $cliente['user_email'], $cliente['user_tipo'])){
          die_error("Não foi possível excluir.");
     }
     cliente_perfil_excluir_todos($cliente['user_id']);
     stream_assistindo_del_user($cliente['user_id']);
     stream_lista_excluir_todos($cliente['user_id']);
     
     die_success_redirect("O cliente foi excluído.", BASE_ADMIN.'cliente/listar');
}