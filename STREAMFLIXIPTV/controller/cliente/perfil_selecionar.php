<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(!isset($_POST['acao'])){
    die_error("Não foi possível selecionar o perfil.");
}

if($_POST['acao'] == 'perfil-selecionar'){
    if(!isset($_POST['perfil-selecionar-id']) OR !intval($_POST['perfil-selecionar-id'])){
        die_error("Não foi possível selecionar o perfil.");
    }
    $cliente_perfil_hash = gerar_hash();
    if(!cliente_perfil_hash_update($cliente['user_id'], $_POST['perfil-selecionar-id'], $cliente_perfil_hash)){
        die_error("Não foi possível selecionar o perfil.");
    }

    setcookie("cliente_perfil", $cliente_perfil_hash, strtotime("+ 365 days"), "/");
    die_url(BASE_STREAM);
} 


if($_POST['acao'] == 'perfil-verificar'){
   
    if(!$cliente_perfil){
        die_selecionar_perfil(BASE_CLIENTE.'perfil-selecionar');
    }
}