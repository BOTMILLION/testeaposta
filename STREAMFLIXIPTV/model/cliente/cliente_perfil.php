<?php 
function cliente_perfil_gerar($cliente_perfil_apelido, $cliente_user_id, $cliente_perfil_avatar, $cliente_perfil_hash){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO cliente_perfil SET 
                          cliente_perfil_apelido = (:cliente_perfil_apelido),
                          cliente_user_id = (:cliente_user_id),
                          cliente_perfil_avatar = (:cliente_perfil_avatar),
                          cliente_perfil_hash = (:cliente_perfil_hash),
                          cliente_perfil_online = NULL");
    $cad->bindValue(":cliente_perfil_apelido", $cliente_perfil_apelido);
    $cad->bindValue(":cliente_user_id", $cliente_user_id);      
    $cad->bindValue(":cliente_perfil_avatar", $cliente_perfil_avatar);
    $cad->bindValue(":cliente_perfil_hash", $cliente_perfil_hash);
    if($cad->execute()){
        return true;
    }   
}

function cliente_perfil_hash_update($cliente_user_id, $cliente_perfil_id, $cliente_perfil_hash){
    global $pdo;
    $up = $pdo->prepare("UPDATE cliente_perfil SET 
                         cliente_perfil_hash = (:cliente_perfil_hash) WHERE 
                         cliente_user_id = (:cliente_user_id) AND
                         cliente_perfil_id = (:cliente_perfil_id)");
    $up->bindValue(":cliente_perfil_hash", $cliente_perfil_hash);
    $up->bindValue(":cliente_user_id", $cliente_user_id);                     
    $up->bindValue(":cliente_perfil_id", $cliente_perfil_id);
    if($up->execute()){
        return true;
    }
}

function cliente_perfil_apelido_update($cliente_user_id, $cliente_perfil_id, $cliente_perfil_apelido){
    global $pdo;
    $up = $pdo->prepare("UPDATE cliente_perfil SET 
                         cliente_perfil_apelido = (:cliente_perfil_apelido) WHERE 
                         cliente_user_id = (:cliente_user_id) AND
                         cliente_perfil_id = (:cliente_perfil_id)");
    $up->bindValue(":cliente_perfil_apelido", $cliente_perfil_apelido);
    $up->bindValue(":cliente_user_id", $cliente_user_id);                     
    $up->bindValue(":cliente_perfil_id", $cliente_perfil_id);
    if($up->execute()){
        return true;
    }
}

function cliente_perfil_por_hash($cliente_user_id, $cliente_perfil_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM cliente_perfil WHERE 
                        cliente_user_id = (:cliente_user_id) AND 
                        cliente_perfil_hash = (:cliente_perfil_hash) LIMIT 1");
    $v->bindValue(":cliente_user_id", $cliente_user_id);
    $v->bindValue(":cliente_perfil_hash", $cliente_perfil_hash);      
    $v->execute();
    return $v->fetch();              
}

function cliente_perfil_listar($cliente_user_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM cliente_perfil WHERE 
                        cliente_user_id = (:cliente_user_id) ORDER BY cliente_perfil_apelido * 1, cliente_perfil_apelido  ASC");
    $v->bindValue(":cliente_user_id", $cliente_user_id);   
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;          
}

function cliente_perfil_contar($cliente_user_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM cliente_perfil WHERE 
                        cliente_user_id = (:cliente_user_id)");
    $v->bindValue(":cliente_user_id", $cliente_user_id);   
    $v->execute();
    return $v->rowCount();    
}

function cliente_perfil_excluir_todos($cliente_user_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM cliente_perfil WHERE cliente_user_id = (:cliente_user_id)");
    $del->bindValue(":cliente_user_id", $cliente_user_id);
    $del->execute();
}

function cliente_perfil_excluir_limite($cliente_user_id, $limite){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM cliente_perfil WHERE 
                          cliente_user_id = (:cliente_user_id) ORDER BY cliente_perfil_id DESC LIMIT " . $limite);
    $del->bindValue(":cliente_user_id", $cliente_user_id); 
    $del->execute();                     
}

function cliente_perfil_avatar_gerar(){
    $avatar = array(
            "avatar-1.png",
            "avatar-2.png",
            "avatar-3.png",
            "avatar-4.png",
            "avatar-5.png",
            "avatar-6.png",
            "avatar-7.png",
            "avatar-8.png",
            "avatar-9.png",
            "avatar-10.png",
    );
    return $avatar[rand(0,9)];

}

function cliente_perfil_change($premium_telas, $cliente_user_id){
    
    $cliente_perfil_change = false;
    $cliente_perfil_contar = cliente_perfil_contar($cliente_user_id);

    
    if($cliente_perfil_contar != $premium_telas){

        if($cliente_perfil_contar > $premium_telas){

            $limite = $cliente_perfil_contar - $premium_telas;
            
            cliente_perfil_excluir_limite($cliente_user_id, $limite);
            $cliente_perfil_change = true;
        }else{

            $gerar = $premium_telas - $cliente_perfil_contar;
            for($a= 1; $a <= $gerar; $a++){
                $next = cliente_perfil_contar($cliente_user_id);
                $next = ($next + 1);
                cliente_perfil_gerar("Perfil ".$next, $cliente_user_id, cliente_perfil_avatar_gerar(), gerar_hash());
            }

            $cliente_perfil_change = true;

        }

          
    }

    return $cliente_perfil_change;

}