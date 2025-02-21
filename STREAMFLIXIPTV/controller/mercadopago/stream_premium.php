<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
$request    = explode('/',$_SERVER['REQUEST_URI']);
$vendedor   = $request[4];


$body   = json_decode(file_get_contents('php://input'));

if(isset($body->data->id)){

    $id      = $body->data->id;
    $curl = curl_init();

    $mercadopago = !empty(mercadopago_buscar_pagamento($id)) ? mercadopago_buscar_pagamento($id) : exit;

    $venda_id = $mercadopago->external_reference;

    $venda = !empty(venda_get($venda_id, "", "")) ? venda_get($venda_id, "", "") : exit;

    venda_atualizar($venda_id, $mercadopago->id, $mercadopago->status, $venda['venda_user_id'], $venda['venda_user_email']);
    $venda = !empty(venda_get($venda_id, "", "")) ? venda_get($venda_id, "", "") : exit;
    if($mercadopago->status == "approved" && $venda['venda_concluida'] == 0){

        $cliente                    = !empty(user_get_por_email_e_id($venda['venda_user_id'], $venda['venda_user_email'])) ? user_get_por_email_e_id($venda['venda_user_id'], $venda['venda_user_email']) : exit;
        $premium                    = !empty(premium_get($vendedor, $venda['venda_item_id'])) ? premium_get($vendedor, $venda['venda_item_id']) : exit;
        $cliente_premium_adicionar  = cliente_premium_adicionar($premium['premium_dias'], $cliente['user_id']) ? true : exit;
        $cliente_perfil_change      = cliente_perfil_change($premium['premium_telas'], $cliente['user_id']);

        venda_concluida($venda_id, $mercadopago->id, $venda['venda_user_id'], $venda['venda_user_email'], $vendedor);

    }

}
