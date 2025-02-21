<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_COOKIE['admin']) OR empty($_COOKIE['admin']) OR empty(get_user_por_hash_sessao($_COOKIE['admin']))){
    setcookie("admin", "", -1, "/"); 
    if(isset($_GET['ajax'])){
        die_login(BASE_USER.'login');
    }
    die(header("Location:".BASE_USER.'login'));
}


$sessao = get_user_por_hash_sessao($_COOKIE['admin']);
$user   = user_get_por_email_e_id($sessao['sessao_user_id'], $sessao['sessao_user_email']);

 
if(empty($user) OR $user['user_tipo'] != 'admin'){
    setcookie("admin", "", -1 , "/");
    if(isset($_GET['ajax'])){
        die_login(BASE_USER.'login');
    }
    die(header("Location:".BASE_USER.'login'));
}

$admin = $user;

$servidor_iptv = servidor_iptv_get();