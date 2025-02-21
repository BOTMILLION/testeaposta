<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_GET['recuperar_hash']) OR empty($_GET['recuperar_hash']) OR !verifica_hash_md5($_GET['recuperar_hash']) OR empty(recuperar_senha_get_por_hash($_GET['recuperar_hash']))){
    die(header("Location:".BASE_USER.'recuperar-senha'));
}
$recuperar  = recuperar_senha_get_por_hash($_GET['recuperar_hash']);

$page_title = 'Alterar Senha';