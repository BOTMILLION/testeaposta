<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';
$page_title = "Administrador Perfil";
if(!isset($_GET['user_id']) OR !intval($_GET['user_id']) OR empty(user_get_por_id($_GET['user_id'])) OR user_get_por_id($_GET['user_id'])['user_tipo'] != 'admin'){
    die(header("Location:".BASE_ADMIN.'administrador/listar'));
}
$administrador = user_get_por_id($_GET['user_id']);