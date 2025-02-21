<?php 
function servidor_iptv_adicionar($servidor_iptv_host, $servidor_iptv_usuario, $servidor_iptv_senha){
    global $pdo;
    
    $del = $pdo->prepare("DELETE FROM servidor_iptv");
    $del->execute();

    $cad = $pdo->prepare("INSERT INTO servidor_iptv SET 
                          servidor_iptv_host = (:servidor_iptv_host),
                          servidor_iptv_usuario = (:servidor_iptv_usuario),
                          servidor_iptv_senha = (:servidor_iptv_senha)");
    $cad->bindValue(":servidor_iptv_host", $servidor_iptv_host);
    $cad->bindValue(":servidor_iptv_usuario", $servidor_iptv_usuario);
    $cad->bindValue(":servidor_iptv_senha", $servidor_iptv_senha);  
    if($cad->execute()){
        return true;
    }                  
}

function servidor_iptv_get(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM servidor_iptv LIMIT 1");               
    $v->execute();
    if($v->rowCount() > 0){
        return $v->fetch();
    }
    return array("servidor_iptv_host" => "", "servidor_iptv_usuario" => "", "servidor_iptv_senha" => "");
}
function servidor_iptv_contar(){
    global $pdo;
    $v = $pdo->prepare("SELECT servidor_iptv_id FROM servidor_iptv");               
    $v->execute();
    return $v->rowCount();
}

define("SERVIDOR_IPTV_HOST", servidor_iptv_get()['servidor_iptv_host']);
define("SERVIDOR_IPTV_USUARIO", servidor_iptv_get()['servidor_iptv_usuario']);
define("SERVIDOR_IPTV_SENHA", servidor_iptv_get()['servidor_iptv_senha']);

define("SERVIDOR_IPTV_URL", SERVIDOR_IPTV_HOST.'player_api.php?username='.SERVIDOR_IPTV_USUARIO.'&password='.SERVIDOR_IPTV_SENHA.'&action=');