<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(!isset($_POST['acao']) OR $_POST['acao'] != 'checkout-premium'){
    die_error("Não foi possível continuar a compra.");
}

$token = SITE_TOKEN_MP;
$noti = SITE_URL.'/mercadopago/checkout/stream_premium/0';
$venda_vendedor = 0;
    
if($_POST['acao'] == 'checkout-premium'){

    if(!isset($_POST['premium_id']) OR !intval($_POST['premium_id']) OR empty(premium_get_por_id($_POST['premium_id']))){
        die_error("Não foi possível continuar a compra. 1");
    }
 
    $premium = premium_get_por_id($_POST['premium_id']);

    if(empty($token)){
        die_error("Não foi possível processar a compra. 2");   
    }    
    
    $venda_item_titulo = venda_titulo_stream_premium($premium['premium_telas'], $premium['premium_dias']);

    if(!venda_cadastrar($venda_item_titulo, "premium", $premium['premium_id'], $premium['premium_preco'], 
                        1, $premium['premium_preco'], $user['user_id'], $user['user_email'], $venda_vendedor)){
        die_error("Não foi possível continuar a compra. 3");
    }

    $external_reference = $pdo->lastInsertId();  
    
    $init_point = mercadopago_checkout(SITE_NOME . ' ' . $venda_item_titulo, floatval($premium['premium_preco']), 1, $external_reference, $user['user_email'], $user['user_nome'], $token, $noti);

    if(empty($init_point)){
        die_error("Não foi possível continuar a compra. 4");
    }

    die_url($init_point);
}