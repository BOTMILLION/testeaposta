<?php 
function recuperar_senha_cadastrar($recuperar_user_id, $recuperar_email, $recuperar_hash, $recuperar_data){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO user_recuperar_senha SET 
                          recuperar_user_id = (:recuperar_user_id),
                          recuperar_email = (:recuperar_email),
                          recuperar_hash = (:recuperar_hash),
                          recuperar_data = (:recuperar_data)");
    $cad->bindValue(":recuperar_user_id", $recuperar_user_id);
    $cad->bindValue(":recuperar_email", $recuperar_email);
    $cad->bindValue(":recuperar_hash", $recuperar_hash);
    $cad->bindValue(":recuperar_data", $recuperar_data);          
    if($cad->execute()){
        return true;
    }             
}

function recuperar_senha_limpar($recuperar_user_id, $recuperar_email){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM user_recuperar_senha WHERE 
                          recuperar_user_id = (:recuperar_user_id) AND 
                          recuperar_email = (:recuperar_email)");
    $del->bindValue(":recuperar_user_id", $recuperar_user_id);
    $del->bindValue(":recuperar_email", $recuperar_email);     
    $del->execute();                 
}

function recuperar_senha_get_por_hash($recuperar_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user_recuperar_senha WHERE 
                        recuperar_hash = (:recuperar_hash) AND 
                        recuperar_data > NOW() ");
    $v->bindValue(":recuperar_hash", $recuperar_hash);    
    $v->execute();
    return $v->fetch();                
}