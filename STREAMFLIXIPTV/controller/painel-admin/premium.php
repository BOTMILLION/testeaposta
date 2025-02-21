<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';

if(!isset($_POST['acao'])){
    die_error("Não é possível processar a solicitação no momento.");
}


if($_POST['acao'] == 'premium-adicionar'){

    if(!isset($_POST['premium_telas']) OR !intval($_POST['premium_telas']) OR 
       !isset($_POST['premium_dias']) OR !intval($_POST['premium_dias']) OR 
       !isset($_POST['premium_preco']) OR empty($_POST['premium_preco'])){
        die_error("Preencha todos os campos.");
    }

    $premium_telas = $_POST['premium_telas'];
    $premium_dias  = $_POST['premium_dias'];
    $premium_preco = valida_preco($_POST['premium_preco']) ? $_POST['premium_preco'] : die_error("O preço é inválido");
    $premium_preco = str_replace('.', '', $premium_preco);
    $premium_preco = str_replace(',', '.', $premium_preco);

    if(!premium_adicionar($premium_telas, $premium_dias, $premium_preco, 0)){
        die_error("Não foi possível adicionar");
    }

    die_url(BASE_ADMIN.'premium/listar');

}



if($_POST['acao'] == 'premium-editar'){

    if(!isset($_POST['premium_telas']) OR !intval($_POST['premium_telas']) OR 
       !isset($_POST['premium_dias']) OR !intval($_POST['premium_dias']) OR 
       !isset($_POST['premium_preco']) OR empty($_POST['premium_preco']) OR 
       !isset($_POST['premium_id']) OR !intval($_POST['premium_id'])){
        die_error("Preencha todos os campos.");
    }

    if(empty(premium_get(0, $_POST['premium_id']))){
        die_error("O plano premium não foi encontrado.");
    }

    $premium_telas = $_POST['premium_telas'];
    $premium_dias  = $_POST['premium_dias'];
    $premium_preco = valida_preco($_POST['premium_preco']) ? $_POST['premium_preco'] : die_error("O preço é inválido");
    $premium_preco = str_replace('.', '', $premium_preco);
    $premium_preco = str_replace(',', '.', $premium_preco);

    if(!premium_editar($premium_telas, $premium_dias, $premium_preco, 0, $_POST['premium_id'])){
        die_error("Não foi possível editar");
    }

    die_url(BASE_ADMIN.'premium/listar');

}

if($_POST['acao'] == 'premium-excluir'){
    if(!isset($_POST['premium_id']) OR !intval($_POST['premium_id']) OR 
        empty(premium_get(0, $_POST['premium_id']))){
            die_error("O plano premium não foi encontrado.");     
    }

    if(!premium_excluir(0, $_POST['premium_id'])){
        die_error("Não foi possível excluir.");
    }

    die_reload();
}