<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';

$clientes = cliente_listar(0);

$page_title = "Clientes";