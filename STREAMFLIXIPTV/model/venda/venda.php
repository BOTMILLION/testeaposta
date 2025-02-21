<?php 
function venda_titulo_stream_premium($premium_telas, $premium_dias){

    $venda_item_one = $premium_telas == 1 ? $premium_telas .  ' Tela ' : $premium_telas . ' Telas ';
    $venda_item_two = $premium_dias == 1 ? $premium_dias .  ' Dia ' : $premium_dias . ' Dias ';
    return $venda_item_one . ' ' . $venda_item_two;

}
function venda_cadastrar($venda_item_titulo, $venda_item_tipo, $venda_item_id, $venda_item_preco, 
                         $venda_item_quantidade, $venda_total, $venda_user_id, $venda_user_email, $venda_vendedor){
    global $pdo;
    
    $venda_data_criacao     = date("Y-m-d H:i:s");
    $venda_data_atualizacao = NULL;
    $venda_status           = "pending";
    $venda_numero_transacao = 0;                          
    $venda_concluida = 0;

    $cad= $pdo->prepare("INSERT INTO venda SET 
                          venda_item_titulo = (:venda_item_titulo),
                          venda_item_tipo = (:venda_item_tipo),
                          venda_item_id = (:venda_item_id),
                          venda_item_preco = (:venda_item_preco),
                          venda_total = (:venda_total),
                          venda_item_quantidade = (:venda_item_quantidade),
                          venda_user_id = (:venda_user_id),
                          venda_user_email = (:venda_user_email),
                          venda_vendedor = (:venda_vendedor),
                          venda_status = (:venda_status),
                          venda_numero_transacao = (:venda_numero_transacao),
                          venda_data_criacao = (:venda_data_criacao),
                          venda_data_atualizacao = (:venda_data_atualizacao),
                          venda_concluida = (:venda_concluida)");
    $cad->bindValue(":venda_item_titulo", $venda_item_titulo);
    $cad->bindValue(":venda_item_tipo", $venda_item_tipo);
    $cad->bindValue(":venda_item_id", $venda_item_id);
    $cad->bindValue(":venda_item_preco", $venda_item_preco);
    $cad->bindValue(":venda_total", $venda_total);
    $cad->bindValue(":venda_item_quantidade", $venda_item_quantidade);
    $cad->bindValue(":venda_user_id", $venda_user_id);
    $cad->bindValue(":venda_user_email", $venda_user_email);
    $cad->bindValue(":venda_vendedor", $venda_vendedor);
    $cad->bindValue(":venda_status", $venda_status);
    $cad->bindValue(":venda_numero_transacao", $venda_numero_transacao);
    $cad->bindValue(":venda_data_criacao", $venda_data_criacao);
    $cad->bindValue(":venda_data_atualizacao", $venda_data_atualizacao);
    $cad->bindValue(":venda_concluida", $venda_concluida);
    if($cad->execute()){
        return $pdo->lastInsertId();
    }               
    return null;       
    
}

function venda_atualizar($venda_id, $venda_numero_transacao, $venda_status, $venda_user_id, $venda_user_email){
    global $pdo;
    $venda_data_atualizacao = date("Y-m-d H:i:s");      

    $up = $pdo->prepare("UPDATE venda SET 
                         venda_numero_transacao = (:venda_numero_transacao),
                         venda_status = (:venda_status),
                         venda_data_atualizacao = (:venda_data_atualizacao) WHERE 
                         venda_id = (:venda_id) AND 
                         venda_user_id = (:venda_user_id) AND 
                         venda_user_email = (:venda_user_email) LIMIT 1");
    $up->bindValue(":venda_numero_transacao", $venda_numero_transacao);
    $up->bindValue(":venda_status", $venda_status);
    $up->bindValue(":venda_data_atualizacao", $venda_data_atualizacao);
    $up->bindValue(":venda_id", $venda_id);
    $up->bindValue(":venda_user_id", $venda_user_id);
    $up->bindValue(":venda_user_email", $venda_user_email);
    if($up->execute()){
        return true;
    }
}

function venda_concluida($venda_id, $venda_numero_transacao, $venda_user_id, $venda_user_email, $venda_vendedor){
    global $pdo;
    $up = $pdo->prepare("UPDATE venda SET 
                         venda_concluida = 1 WHERE 
                         venda_concluida = 0 AND
                         venda_id = (:venda_id) AND 
                         venda_numero_transacao = (:venda_numero_transacao) AND 
                         venda_user_id = (:venda_user_id) AND 
                         venda_user_email = (:venda_user_email) AND 
                         venda_vendedor = (:venda_vendedor)");
    $up->bindValue(":venda_id", $venda_id);    
    $up->bindValue(":venda_numero_transacao", $venda_numero_transacao);    
    $up->bindValue(":venda_user_id", $venda_user_id);    
    $up->bindValue(":venda_user_email", $venda_user_email);    
    $up->bindValue(":venda_vendedor", $venda_vendedor);    
    if($up->execute()){
        return true;
    }                 
}

function venda_atualizar_por_item_id($venda_item_id, $venda_numero_transacao, $venda_status, $venda_user_id, $venda_user_email){
    global $pdo;
    $venda_data_atualizacao = date("Y-m-d H:i:s");      

    $up = $pdo->prepare("UPDATE venda SET 
                         venda_numero_transacao = (:venda_numero_transacao),
                         venda_status = (:venda_status),
                         venda_data_atualizacao = (:venda_data_atualizacao) WHERE 
                         venda_item_id = (:venda_item_id) AND 
                         venda_user_id = (:venda_user_id) AND 
                         venda_user_email = (:venda_user_email)");
    $up->bindValue(":venda_numero_transacao", $venda_numero_transacao);
    $up->bindValue(":venda_status", $venda_status);
    $up->bindValue(":venda_data_atualizacao", $venda_data_atualizacao);
    $up->bindValue(":venda_item_id", $venda_item_id);
    $up->bindValue(":venda_user_id", $venda_user_id);
    $up->bindValue(":venda_user_email", $venda_user_email);
    if($up->execute()){
        return true;
    }
}

function get_venda_por_venda_item_id($venda_item_id, $venda_user_id, $venda_user_email){
    global $pdo;
    if(!empty($venda_user_id) && !empty($venda_user_email)){

        $v = $pdo->prepare("SELECT * FROM venda WHERE 
                            venda_item_id = (:venda_item_id) AND 
                            venda_user_id = (:venda_user_id) AND 
                            venda_user_email = (:venda_user_email) LIMIT 1");
        $v->bindValue(":venda_item_id", $venda_item_id);
        $v->bindValue(":venda_user_id", $venda_user_id);
        $v->bindValue(":venda_user_email", $venda_user_email);                    

    }else{
        $v = $pdo->prepare("SELECT * FROM venda WHERE venda_id = (:venda_id)");    
        $v->bindValue(":venda_item_id", $venda_item_id);
    }
    
    $v->execute();
    return $v->fetch();
}

function venda_get($venda_id, $venda_user_id, $venda_user_email){
    global $pdo;
    if(!empty($venda_user_id) && !empty($venda_user_email)){

        $v = $pdo->prepare("SELECT * FROM venda WHERE 
                            venda_id = (:venda_id) AND 
                            venda_user_id = (:venda_user_id) AND 
                            venda_user_email = (:venda_user_email) LIMIT 1");
        $v->bindValue(":venda_id", $venda_id);
        $v->bindValue(":venda_user_id", $venda_user_id);
        $v->bindValue(":venda_user_email", $venda_user_email);                    

    }else{
        $v = $pdo->prepare("SELECT * FROM venda WHERE venda_id = (:venda_id)");    
        $v->bindValue(":venda_id", $venda_id);
    }
    
    $v->execute();
    return $v->fetch();
} 

function user_compras_listar($venda_user_id, $venda_user_email){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM venda WHERE 
                        venda_user_id = (:venda_user_id) AND 
                        venda_user_email = (:venda_user_email) ORDER BY venda_id DESC");
    $v->bindValue(":venda_user_id", $venda_user_id);
    $v->bindValue(":venda_user_email", $venda_user_email);                    
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function vendas_total($venda_vendedor, $venda_status){

    $total = 0;
    if(count(venda_listar($venda_vendedor, $venda_status)) > 0){ 
        foreach(venda_listar($venda_vendedor, $venda_status) as $item){

            $total += $item['venda_total'];
        }
    }
    return 'R$ ' . number_format($total, 2, ',', '.');
}        

function venda_listar($venda_vendedor, $venda_status){
    global $pdo;
    $res = array();
    if(!empty($venda_status)){
        $v = $pdo->prepare("SELECT * FROM venda WHERE venda_vendedor = (:venda_vendedor) AND venda_status = (:venda_status) ORDER BY venda_id DESC");
        $v->bindValue(":venda_vendedor", $venda_vendedor);
        $v->bindValue(":venda_status", $venda_status);
    }else{
        $v = $pdo->prepare("SELECT * FROM venda WHERE venda_vendedor = (:venda_vendedor) ORDER BY venda_id DESC");
        $v->bindValue(":venda_vendedor", $venda_vendedor);
    }
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function get_vendas_filtro_tempo($dia, $mes, $ano, $venda_item_tipo, $filtro, $venda_vendedor){
    global $pdo;
    if($filtro == 'hoje'){
        $v = $pdo->prepare("SELECT * FROM venda WHERE 
                            venda_status = 'approved' AND
                            venda_vendedor = (:venda_vendedor) AND 
                            venda_item_tipo = (:venda_item_tipo) AND 
                            DAY(venda_data_atualizacao) = (:dia) AND 
                            MONTH(venda_data_criacao) = (:mes) AND 
                            YEAR(venda_data_criacao) = (:ano)");
        $v->bindValue(":dia", $dia);                    
        $v->bindValue(":venda_vendedor", $venda_vendedor);
        $v->bindValue(":venda_item_tipo", $venda_item_tipo);     
        $v->bindValue(":mes", $mes);
        $v->bindValue(":ano", $ano);

    }else{
        $v = $pdo->prepare("SELECT * FROM venda WHERE 
                        venda_status = 'approved' AND
                        venda_vendedor = (:venda_vendedor) AND 
                        venda_item_tipo = (:venda_item_tipo) AND 
                        MONTH(venda_data_criacao) = (:mes) AND 
                        YEAR(venda_data_criacao) = (:ano)");
        $v->bindValue(":venda_vendedor", $venda_vendedor);
        $v->bindValue(":venda_item_tipo", $venda_item_tipo);     
        $v->bindValue(":mes", $mes);
        $v->bindValue(":ano", $ano);                
    }
    
    $v->execute(); 
    if($v->rowCount() > 0){
        $total = 0;
        foreach($v->fetchAll() as $item){
            $total += $item['venda_total'];
        }
        return number_format($total,2,",",".");
    }
    return '0,00';
}             