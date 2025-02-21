<?php
function mercadopago_checkout($title, $unit_price, $quantity, $external_reference, $email, $name, $token, $notification_url){

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "back_urls": {
                "success": "'.BASE_CLIENTE.'pagamentos",
                "pending": "'.BASE_CLIENTE.'pagamentos",
                "failure": "'.BASE_CLIENTE.'pagamentos"
            },
            "external_reference": "' . $external_reference . '",    
            "notification_url": "'.$notification_url.'",
            "auto_return": "approved",
            "payer": {
                "first_name": '.$name.',
                "last_name": '.$name.',
                "email": '.$email.',
            },
            "items": [
                {
                "title": "'.$title.'",
                "description": "'.$title.'",
                "picture_url": "'.BASE_IMAGES_URL.'system/'.SITE_LOGO.'",
                "category_id": "car_electronics",
                "quantity": '.$quantity.',
                "currency_id": "BRL",
                "unit_price": ' . $unit_price . '
                }
            ],
            }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $obj = json_decode($response);

    if (isset($obj->id)) {
        if ($obj->id != NULL) {

            if (isset($card)) {
                $preference_id = $obj->id;
            } else {

                $link_externo = $obj->init_point;
                $external_reference = $obj->external_reference;

                return $link_externo;

            }
        }
    }

    return null;

 
}


function mercadopago_buscar_pagamento($id){

    $curl = curl_init();
        
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array( 
        'Content-Type: application/json',
        'Authorization: Bearer '. SITE_TOKEN_MP
        ),
    )); 

    $response = curl_exec($curl);
    curl_close($curl);

    $payment = json_decode($response);

    if(isset($payment->id)){
        return $payment;
    }
    return null;
}

function mercadopago_tradutor($status){
    $res = array(
        "status" => array(
            "approved" => "<span class='text-green'>Aprovado</span>", 
            "in_process" => "<span class='text-warning'>Pendente</span>", 
            "pending" => "<span class='text-warning'>Pendente</span>", 
            "rejected" => "<span class='text-danger'>Rejeitado</span>", 
            "refunded" => "<span class='text-primary'>Devolvido</span>",
            "cancelled" => "<span class='text-primary'>Cancelado</span>"
        ),
    );
    if(!empty($status)){
        return $res["status"][$status];
    }
}