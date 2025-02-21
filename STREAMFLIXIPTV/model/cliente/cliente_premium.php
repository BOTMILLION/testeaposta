<?php 
function cliente_premium_get($cliente_premium_user_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM cliente_premium WHERE 
                        cliente_premium_user_id = (:cliente_premium_user_id) LIMIT 1");
    $v->bindValue(":cliente_premium_user_id", $cliente_premium_user_id);
    $v->execute();
    return $v->fetch();                    
}

function cliente_premium_excluir($cliente_premium_user_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM cliente_premium WHERE cliente_premium_user_id = (:cliente_premium_user_id)");
    $del->bindValue(":cliente_premium_user_id", $cliente_premium_user_id);
    if($del->execute()){
        return true;
    } 
}

function cliente_premium_excluir_penultimo($cliente_premium_user_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM cliente_premium WHERE cliente_premium_user_id = (:cliente_premium_user_id) ORDER BY cliente_premium_id ASC LIMIT 1");
    $del->bindValue(":cliente_premium_user_id", $cliente_premium_user_id);
    if($del->execute()){
        return true;
    }
}

function cliente_premium_adicionar($cliente_premium_data, $cliente_premium_user_id){
    global $pdo;

    $cliente_premium =  cliente_premium_get($cliente_premium_user_id);

    if(!empty($cliente_premium)){
        $cliente_premium_data = date("Y-m-d H:i:s", strtotime($cliente_premium['cliente_premium_data'] . " + " . $cliente_premium_data . " days"));
        cliente_premium_excluir_penultimo($cliente_premium_user_id);
    }else{
        $cliente_premium_data = date("Y-m-d H:i:s", strtotime("+ " . $cliente_premium_data . " days"));
    }

    $cad = $pdo->prepare("INSERT INTO cliente_premium SET 
                          cliente_premium_data = (:cliente_premium_data),
                          cliente_premium_user_id = (:cliente_premium_user_id)");
    $cad->bindValue(":cliente_premium_data", $cliente_premium_data);
    $cad->bindValue(":cliente_premium_user_id", $cliente_premium_user_id);
    if($cad->execute()){
        return true;
    }                      
}

function cliente_is_premium($cliente_premium_user_id){

    $cliente_premium = cliente_premium_get($cliente_premium_user_id);
    if(!empty($cliente_premium) && date("Y-m-d H:i:s") < $cliente_premium['cliente_premium_data']){
        return true;
    }

}

function cliente_premium_verificar($cliente_premium_user_id){

    $cliente_premium = cliente_premium_get($cliente_premium_user_id);
    if(!empty($cliente_premium) && date("Y-m-d H:i:s") >= $cliente_premium['cliente_premium_data']){
        cliente_premium_excluir($cliente_premium_user_id);
    }
}

function cliente_premium_contar(){
    global $pdo;
    $v = $pdo->prepare("SELECT cliente_premium_id FROM cliente_premium");
    $v->execute();
    return $v->rowCount();
}