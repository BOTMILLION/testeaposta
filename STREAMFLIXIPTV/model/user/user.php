<?php 
function user_verificar_email_existe($user_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_email = (:user_email)");
    $v->bindValue(":user_email", $user_email);
    $v->execute();
    return $v->rowCount();                    
}

function user_cadastro($user_nome, $user_email, $user_senha, $user_tipo, $user_whatsapp=NULL){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO user SET 
                          user_nome = (:user_nome), 
                          user_email = (:user_email),
                          user_senha = (:user_senha),
                          user_tipo = (:user_tipo),
                          user_whatsapp = (:user_whatsapp)");
    $cad->bindValue(":user_nome", $user_nome);
    $cad->bindValue(":user_email", $user_email);
    $cad->bindValue(":user_senha", $user_senha);
    $cad->bindValue(":user_tipo", $user_tipo);    
    $cad->bindValue(":user_whatsapp", $user_whatsapp);    
    if($cad->execute()){
        return true;
    }                
}

function user_get_por_email_senha($user_email, $user_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_email = (:user_email) AND 
                        user_senha = (:user_senha) LIMIT 1");
    $v->bindValue(":user_email", $user_email);
    $v->bindValue(":user_senha", $user_senha);         
    $v->execute();
    return $v->fetch();         
}

function user_get_por_email_e_id($user_id, $user_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_email = (:user_email) AND 
                        user_id = (:user_id) LIMIT 1");
    $v->bindValue(":user_email", $user_email);
    $v->bindValue(":user_id", $user_id);         
    $v->execute();
    return $v->fetch();         
}

function user_get_por_email($user_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_email = (:user_email) LIMIT 1");
    $v->bindValue(":user_email", $user_email);       
    $v->execute();
    return $v->fetch();         
}

function user_get_por_id($user_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_id = (:user_id) LIMIT 1");
    $v->bindValue(":user_id", $user_id);       
    $v->execute();
    return $v->fetch();         
}

function user_count($user_tipo){
    global $pdo;
    $v = $pdo->prepare("SELECT user_id, user_tipo FROM user WHERE user_tipo = (:user_tipo)");
    $v->bindValue("user_tipo", $user_tipo);
    $v->execute();
    return $v->rowCount();
}

function user_alterar_senha($user_id, $user_email, $user_senha){
    global $pdo;
    $up = $pdo->prepare("UPDATE user SET 
                        user_senha = (:user_senha) WHERE
                        user_id = (:user_id) AND 
                        user_email = (:user_email) LIMIT 1");
    $up->bindValue(":user_senha", $user_senha);     
    $up->bindValue(":user_id", $user_id);     
    $up->bindValue(":user_email", $user_email);      
    if($up->execute()){
        return true;
    }              
}
 
function user_listar($user_tipo){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_tipo = (:user_tipo)");
    $v->bindValue("user_tipo", $user_tipo);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                    
    return $res; 
}

function user_contar($user_tipo){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE 
                        user_tipo = (:user_tipo)");
    $v->bindValue("user_tipo", $user_tipo);
    $v->execute();
    return $v->rowCount();
}

function user_excluir($user_id, $user_email, $user_tipo){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM user WHERE 
                          user_id = (:user_id) AND 
                          user_email = (:user_email) AND 
                          user_tipo = (:user_tipo) LIMIT 1");
    $del->bindValue(":user_id", $user_id);
    $del->bindValue(":user_email", $user_email);
    $del->bindValue(":user_tipo", $user_tipo);
    if($del->execute()){
        return true;
    }
}

function user_editar_perfil($user_nome, $user_whatsapp, $user_telegram, $user_id, $user_email, $user_tipo){
    global $pdo;
    $up = $pdo->prepare("UPDATE user SET 
                        user_nome = (:user_nome),
                        user_whatsapp = (:user_whatsapp),
                        user_telegram = (:user_telegram) WHERE 
                        user_id = (:user_id) AND 
                        user_email = (:user_email) AND 
                        user_tipo = (:user_tipo) LIMIT 1");
    $up->bindValue(":user_nome", $user_nome);
    $up->bindValue(":user_whatsapp", $user_whatsapp);
    $up->bindValue(":user_telegram", $user_telegram);
    $up->bindValue(":user_id", $user_id);
    $up->bindValue(":user_email", $user_email);
    $up->bindValue(":user_tipo", $user_tipo);     
    if($up->execute()){
        return true;
    }               
}

function user_online_update($user_id, $user_email, $user_tipo){
    global $pdo;
    $up = $pdo->prepare("UPDATE user SET 
                         user_online = DATE_ADD(NOW(), INTERVAL 2 MINUTE) WHERE 
                         user_id = (:user_id) AND 
                         user_email = (:user_email) AND 
                         user_tipo = (:user_tipo)");
    $up->bindValue(":user_id", $user_id);
    $up->bindValue(":user_email", $user_email);                     
    $up->bindValue(":user_tipo", $user_tipo);
    if($up->execute()){
        return true;
    }
}

function user_online_total($user_tipo){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM user WHERE user_tipo = (:user_tipo) AND user_online > NOW()");
    $v->bindValue(":user_tipo", $user_tipo);
    $v->execute();
    return $v->rowCount();
}

function user_is_online($user_online){
    if($user_online > date("Y-m-d H:i:s")){
        return true;
    }
}
function user_is_offline($user_online){
    if(!empty($user_online)){
        if(date("Y-m-d",strtotime($user_online)) == date("Y-m-d")){
            return date("H:i",strtotime($user_online));
        }else{
            return date("d/m/Y H:i",strtotime($user_online));
        }
        
    }else{
        return 'N/A';
    }
}