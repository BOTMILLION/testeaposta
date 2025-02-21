<?php 
function stream_lista_cad($stream_lista_stream, $stream_lista_type, $stream_lista_perfil, $stream_lista_user){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO stream_lista SET 
                            stream_lista_stream = (:stream_lista_stream),
                            stream_lista_type = (:stream_lista_type),
                            stream_lista_perfil = (:stream_lista_perfil),
                            stream_lista_user = (:stream_lista_user)");
    $cad->bindValue(":stream_lista_stream", $stream_lista_stream);
    $cad->bindValue(":stream_lista_type", $stream_lista_type);                    
    $cad->bindValue(":stream_lista_perfil", $stream_lista_perfil);
    $cad->bindValue(":stream_lista_user", $stream_lista_user);
    if($cad->execute()){
        return true;
    }
}

function stream_lista_get($stream_lista_stream, $stream_lista_type, $stream_lista_perfil, $stream_lista_user){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM stream_lista WHERE 
                        stream_lista_stream = (:stream_lista_stream) AND
                        stream_lista_type = (:stream_lista_type) AND 
                        stream_lista_perfil = (:stream_lista_perfil) AND
                        stream_lista_user = (:stream_lista_user) LIMIT 1");
    $v->bindValue(":stream_lista_stream", $stream_lista_stream);
    $v->bindValue(":stream_lista_type", $stream_lista_type);                    
    $v->bindValue(":stream_lista_perfil", $stream_lista_perfil);
    $v->bindValue(":stream_lista_user", $stream_lista_user);
    $v->execute();
    return $v->fetch();
}

function stream_lista_listar($stream_lista_perfil, $stream_lista_user){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM stream_lista WHERE 
                        stream_lista_perfil = (:stream_lista_perfil) AND
                        stream_lista_user = (:stream_lista_user) 
                        ORDER BY stream_lista_id DESC");
    $v->bindValue(":stream_lista_perfil", $stream_lista_perfil);
    $v->bindValue(":stream_lista_user", $stream_lista_user);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                    
    return $res;
}

function stream_lista_excluir($stream_lista_stream, $stream_lista_type,$stream_lista_perfil, $stream_lista_user){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_lista WHERE 
                          stream_lista_stream = (:stream_lista_stream) AND 
                          stream_lista_type = (:stream_lista_type) AND 
                          stream_lista_perfil = (:stream_lista_perfil) AND
                          stream_lista_user = (:stream_lista_user) ");
    $del->bindValue(":stream_lista_stream", $stream_lista_stream);
    $del->bindValue(":stream_lista_type", $stream_lista_type);
    $del->bindValue(":stream_lista_perfil", $stream_lista_perfil);
    $del->bindValue(":stream_lista_user", $stream_lista_user);
    if($del->execute()){
        return true;
    }
}

function stream_lista_excluir_todos($stream_lista_user){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_lista WHERE 
                          stream_lista_user = (:stream_lista_user)");
    $del->bindValue(":stream_lista_user", $stream_lista_user);
    $del->execute();
}

function stream_lista_excluir_all(){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM stream_lista");
    $del->execute();
}

