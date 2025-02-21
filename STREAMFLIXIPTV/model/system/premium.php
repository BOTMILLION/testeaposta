<?php 
function premium_adicionar($premium_telas, $premium_dias, $premium_preco, $premium_revendedor){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO premium SET 
                          premium_telas = (:premium_telas),
                          premium_dias = (:premium_dias),
                          premium_preco = (:premium_preco),
                          premium_revendedor = (:premium_revendedor)");
    $cad->bindValue(":premium_telas", $premium_telas);
    $cad->bindValue(":premium_dias", $premium_dias);                      
    $cad->bindValue(":premium_preco", $premium_preco);
    $cad->bindValue(":premium_revendedor", $premium_revendedor);
    if($cad->execute()){
        return true;
    }
}

function premium_editar($premium_telas, $premium_dias, $premium_preco, $premium_revendedor, $premium_id){
    global $pdo;
    $edt = $pdo->prepare("UPDATE premium SET 
                          premium_telas = (:premium_telas),
                          premium_dias = (:premium_dias),
                          premium_preco = (:premium_preco) WHERE 
                          premium_revendedor = (:premium_revendedor) AND 
                          premium_id = (:premium_id)");
    $edt->bindValue(":premium_telas", $premium_telas);
    $edt->bindValue(":premium_dias", $premium_dias);                      
    $edt->bindValue(":premium_preco", $premium_preco);
    $edt->bindValue(":premium_revendedor", $premium_revendedor);
    $edt->bindValue(":premium_id", $premium_id);
    if($edt->execute()){
        return true;
    }
}

function premium_listar($premium_revendedor){
    global $pdo;
    $res = array();
    
    $v = $pdo->prepare("SELECT * FROM premium WHERE premium_revendedor = (:premium_revendedor)");
    $v->bindValue(":premium_revendedor", $premium_revendedor);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function premium_get($premium_revendedor, $premium_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM premium WHERE 
                        premium_revendedor = (:premium_revendedor) AND 
                        premium_id = (:premium_id) LIMIT 1");
    $v->bindValue(":premium_revendedor", $premium_revendedor);
    $v->bindValue(":premium_id", $premium_id);
    $v->execute();
    return $v->fetch();                    
}

function premium_get_por_id($premium_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM premium WHERE 
                        premium_id = (:premium_id) LIMIT 1");
    $v->bindValue(":premium_id", $premium_id);
    $v->execute();
    return $v->fetch();                    
}

function premium_excluir($premium_revendedor, $premium_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM premium WHERE 
                          premium_revendedor = (:premium_revendedor) AND 
                          premium_id = (:premium_id)");
    $del->bindValue(":premium_revendedor", $premium_revendedor);
    $del->bindValue(":premium_id", $premium_id);
    if($del->execute()){
        return true;
    }                
}

