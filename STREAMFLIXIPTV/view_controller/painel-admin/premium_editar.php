<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';
  
if(!isset($_GET['premium_id']) OR !intval($_GET['premium_id']) OR empty(premium_get(0,$_GET['premium_id']))){
    die(header("Location:".BASE_ADMIN.'premium/listar'));
}

$premium = premium_get(0,$_GET['premium_id']);

$page_title = "Planos Premium Editar";