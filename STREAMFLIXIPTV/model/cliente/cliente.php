<?php 
function cliente_listar($user_revendedor){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_tipo = 'cliente' AND 
                        user_revendedor = (:user_revendedor)");
    $v->bindValue("user_revendedor", $user_revendedor);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                    
    return $res; 
}