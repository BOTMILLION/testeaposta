<?php 
function cadastrar_sessao($sessao_hash, $sessao_user_id, $sessao_user_email, $sessao_tipo){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO user_sessao SET 
                          sessao_hash = (:sessao_hash),
                          sessao_user_id = (:sessao_user_id),
                          sessao_user_email = (:sessao_user_email),
                          sessao_tipo = (:sessao_tipo)");
    $cad->bindValue(":sessao_hash", $sessao_hash);
    $cad->bindValue(":sessao_user_id", $sessao_user_id);                      
    $cad->bindValue(":sessao_user_email", $sessao_user_email);
    $cad->bindValue(":sessao_tipo", $sessao_tipo);
    if($cad->execute()){
        return true; 
    }
} 

function get_sessao($sessao_hash, $sessao_user_id, $sessao_user_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user_sessao WHERE 
                          sessao_hash = (:sessao_hash) AND
                          sessao_user_id = (:sessao_user_id) AND
                          sessao_user_email = (:sessao_user_email) LIMIT 1");
    $v->bindValue(":sessao_hash", $sessao_hash);
    $v->bindValue(":sessao_user_id", $sessao_user_id);                      
    $v->bindValue(":sessao_user_email", $sessao_user_email);
    $v->execute();
    return $v->fetch();

}

function excluir_sessao($sessao_user_id, $sessao_user_email){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM user_sessao WHERE 
                          sessao_user_id = (:sessao_user_id) AND
                          sessao_user_email = (:sessao_user_email)");
    $del->bindValue(":sessao_user_id", $sessao_user_id);
    $del->bindValue(":sessao_user_email", $sessao_user_email);  
    $del->execute();                    
}

function excluir_sessao_por_hash($sessao_user_id, $sessao_user_email, $sessao_hash){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM user_sessao WHERE 
                          sessao_hash = (:sessao_hash) AND   
                          sessao_user_id = (:sessao_user_id) AND
                          sessao_user_email = (:sessao_user_email)");
    $del->bindValue(":sessao_hash", $sessao_hash);                        
    $del->bindValue(":sessao_user_id", $sessao_user_id);
    $del->bindValue(":sessao_user_email", $sessao_user_email);  
    $del->execute();                    
}

function get_user_por_hash_sessao($sessao_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user_sessao WHERE 
                        sessao_hash = (:sessao_hash) LIMIT 1");
    $v->bindValue(":sessao_hash", $sessao_hash);   
    $v->execute();
    return $v->fetch();              
}