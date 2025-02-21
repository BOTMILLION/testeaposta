<?php 
function stream_assistindo_cad($stream_assistindo_time, $stream_assistindo_stream, $stream_assistindo_type, $stream_assistindo_episodio, $stream_assistindo_perfil, $stream_assistindo_user){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO stream_assistindo SET 
                          stream_assistindo_time = (:stream_assistindo_time),
                          stream_assistindo_stream = (:stream_assistindo_stream),
                          stream_assistindo_type = (:stream_assistindo_type),
                          stream_assistindo_episodio = (:stream_assistindo_episodio),
                          stream_assistindo_perfil = (:stream_assistindo_perfil),
                          stream_assistindo_user = (:stream_assistindo_user)");
    $cad->bindValue(":stream_assistindo_stream", $stream_assistindo_stream);
    $cad->bindValue(":stream_assistindo_type", $stream_assistindo_type);
    $cad->bindValue(":stream_assistindo_episodio", $stream_assistindo_episodio);
    $cad->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
    $cad->bindValue(":stream_assistindo_time", $stream_assistindo_time);
    $cad->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    if($cad->execute()){
        return true;
    }                
}

function stream_assistindo_del($stream_assistindo_stream, $stream_assistindo_type, $stream_assistindo_perfil, $stream_assistindo_user){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_assistindo WHERE
                          stream_assistindo_stream = (:stream_assistindo_stream) AND
                          stream_assistindo_type = (:stream_assistindo_type) AND
                          stream_assistindo_perfil = (:stream_assistindo_perfil) AND
                          stream_assistindo_user = (:stream_assistindo_user) ORDER BY stream_assistindo_id ASC LIMIT 1");
    $del->bindValue(":stream_assistindo_stream", $stream_assistindo_stream);
    $del->bindValue(":stream_assistindo_type", $stream_assistindo_type);
    $del->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
    $del->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    if($del->execute()){
        return true;
    }                             
}

function stream_assistindo_del_perfil($stream_assistindo_perfil, $stream_assistindo_user, $limite){
    global $pdo;
    if(empty($limite)){
        $del = $pdo->prepare("DELETE FROM stream_assistindo WHERE
                              stream_assistindo_perfil = (:stream_assistindo_perfil) AND
                              stream_assistindo_user = (:stream_assistindo_user)");
        $del->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
        $del->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    }else{
        $del = $pdo->prepare("DELETE FROM stream_assistindo WHERE
                              stream_assistindo_perfil = (:stream_assistindo_perfil) AND
                              stream_assistindo_user = (:stream_assistindo_user) ORDER BY stream_assistindo_id ASC LIMIT " . $limite);
        $del->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
        $del->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    }
    if($del->execute()){
        return true;
    }                             
}

function stream_assistindo_del_user($stream_assistindo_user){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_assistindo WHERE
                          stream_assistindo_user = (:stream_assistindo_user)");
    $del->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    if($del->execute()){
        return true;
    }                             
}

function stream_assistindo_get($stream_assistindo_stream, $stream_assistindo_episodio, $stream_assistindo_type, $stream_assistindo_perfil, $stream_assistindo_user){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM stream_assistindo WHERE
                        stream_assistindo_stream = (:stream_assistindo_stream) AND 
                        stream_assistindo_episodio = (:stream_assistindo_episodio) AND
                        stream_assistindo_type = (:stream_assistindo_type) AND
                        stream_assistindo_perfil = (:stream_assistindo_perfil) AND
                        stream_assistindo_user = (:stream_assistindo_user) LIMIT 1");
    $v->bindValue(":stream_assistindo_stream", $stream_assistindo_stream);
    $v->bindValue(":stream_assistindo_episodio", $stream_assistindo_episodio);
    $v->bindValue(":stream_assistindo_type", $stream_assistindo_type);
    $v->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
    $v->bindValue(":stream_assistindo_user", $stream_assistindo_user);
    $v->execute();
    return $v->fetch();                   
}

function stream_assistindo_listar($stream_assistindo_perfil, $stream_assistindo_user){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM stream_assistindo WHERE 
                        stream_assistindo_perfil = (:stream_assistindo_perfil) AND 
                        stream_assistindo_user = (:stream_assistindo_user) ORDER BY stream_assistindo_id DESC");
    $v->bindValue(":stream_assistindo_perfil", $stream_assistindo_perfil);
    $v->bindValue(":stream_assistindo_user", $stream_assistindo_user);   
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                 
    return $res;

}

function stream_assistindo_del_all(){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_assistindo");
    $del->execute();
}