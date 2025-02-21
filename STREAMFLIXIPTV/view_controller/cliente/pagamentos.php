<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';
$pagamentos = user_compras_listar($cliente['user_id'], $cliente['user_email']);