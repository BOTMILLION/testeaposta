<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

$ex = explode('/', $_SERVER['REQUEST_URI'])[1];

$vendedor = $ex;

$body   = json_decode(file_get_contents('php://input'));

if(isset($body->data->id)){     

    $id      = $body->data->id;

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
        
        
        $venda_id = $payment->external_reference;

        $venda = venda_get($venda_id, "", "");

        venda_atualizar($venda_id, $payment->id, $payment->status, $venda['venda_user_id'], $venda['venda_user_email']);
        
        if($payment->status == "approved"){

            if($venda['venda_status'] != 'approved'){ 

                $user = get_user($venda['venda_user_id'], $venda['venda_user_email']);
                $plano_premium = get_plano_premium_por_id($venda['venda_item_id'], $vendedor); 
                $premium_data  = premium_free_gerar_data($user['user_premium'], $plano_premium['premium_dias_acesso']);                        
                premium_free_ativar_premium($venda['venda_user_id'], $venda['venda_user_email'], $premium_data, $venda['venda_item_id']);
                premium_free_gerar_telas($venda['venda_user_id'], $venda['venda_user_email'], $plano_premium['premium_telas']);   

                if(intval($vendedor)){
                    $revendedor = public_get_revendedor($vendedor);
                    public_remover_creditos_revendedor($revendedor['revendedor_id'], $revendedor['revendedor_email'], $revendedor_creditos - $plano_premium['premium_consumo_creditos_revendedor']);
                }

            }
        
        }else if($payment->status != "in_process" OR $payment->status != "pending"){

            
        }elseif($payment->status == "rejected" OR $payment->status == 'refunded' OR $payment->status == 'cancelled'){
           
           


        }


        
    }
}

