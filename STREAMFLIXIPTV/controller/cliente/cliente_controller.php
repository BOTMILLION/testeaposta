<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_COOKIE['cliente']) OR empty($_COOKIE['cliente']) OR empty(get_user_por_hash_sessao($_COOKIE['cliente']))){
    setcookie("cliente", "", -1, "/"); 
    if(isset($_GET['ajax'])){
        die_login(BASE_USER.'login');
    }
    die(header("Location:".BASE_USER.'login'));
}

$sessao             = get_user_por_hash_sessao($_COOKIE['cliente']);
$user               = user_get_por_email_e_id($sessao['sessao_user_id'], $sessao['sessao_user_email']);

if(empty($user) OR $user['user_tipo'] != 'cliente'){
    setcookie("cliente", "", -1 , "/");
    if(isset($_GET['ajax'])){
        die_login(BASE_USER.'login');
    }
    die(header("Location:".BASE_USER.'login'));
}

$cliente = $user;
$cliente_logado = true;

$cliente_premium    = cliente_premium_get($user['user_id']);
$cliente_is_premium = cliente_is_premium($user['user_id']);
cliente_premium_verificar($user['user_id']);


$cliente_perfil = array();
$cliente_perfil_hash = NULL;

if(isset($_COOKIE['cliente_perfil']) && !empty($_COOKIE['cliente_perfil']) && !empty(cliente_perfil_por_hash($cliente['user_id'], $_COOKIE['cliente_perfil']))){
    
    $cliente_perfil = cliente_perfil_por_hash($cliente['user_id'], $_COOKIE['cliente_perfil']);
    $cliente_perfil_hash = $cliente_perfil['cliente_perfil_hash'];

}

if(!$cliente_perfil){ 
    setcookie("cliente_perfil", "", -1, "");
    if($_SERVER['PHP_SELF'] != '/view/cliente/perfil_selecionar.php' && $_SERVER['PHP_SELF'] != '/controller/cliente/perfil_selecionar.php'){
        if(isset($_GET['ajax'])){
            die_url(BASE_CLIENTE.'perfil-selecionar');
        }
        die(header("Location:".BASE_CLIENTE.'perfil-selecionar'));
    }
}