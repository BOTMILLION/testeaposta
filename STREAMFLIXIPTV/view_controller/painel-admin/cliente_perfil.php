<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';
$page_title = "Cliente Perfil";
if(!isset($_GET['user_id']) OR !intval($_GET['user_id']) OR empty(user_get_por_id($_GET['user_id'])) OR user_get_por_id($_GET['user_id'])['user_tipo'] != 'cliente'){
    die(header("Location:".BASE_ADMIN.'cliente/listar'));
}
$cliente = user_get_por_id($_GET['user_id']);
$cliente_premium_get = cliente_premium_get($cliente['user_id']);