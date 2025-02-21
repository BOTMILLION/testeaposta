<?php
function site_perfil_editar($site_nome, $site_descricao, $site_keywords, $site_whatsapp, $site_telegram, $site_token_mp, $site_cache){
    global $pdo;
    $up = $pdo->prepare("UPDATE site_perfil SET 
                         site_nome = (:site_nome),
                         site_descricao = (:site_descricao),
                         site_keywords = (:site_keywords),
                         site_whatsapp = (:site_whatsapp),
                         site_telegram = (:site_telegram),
                         site_token_mp = (:site_token_mp),
                         site_cache = (:site_cache)");
    $up->bindValue(":site_nome", $site_nome);
    $up->bindValue(":site_descricao", $site_descricao);
    $up->bindValue(":site_keywords", $site_keywords);
    $up->bindValue(":site_whatsapp", $site_whatsapp);
    $up->bindValue(":site_telegram", $site_telegram);
    $up->bindValue(":site_token_mp", $site_token_mp);
    $up->bindValue(":site_cache", $site_cache);
    if($up->execute()){
        return true;
    }                
}

function site_perfil_images($imagem, $imagem_tipo){
    global $pdo;
    if($imagem_tipo == 'site_logo'){
        $up = $pdo->prepare("UPDATE site_perfil SET site_logo = (:imagem)");
        
    }else if($imagem_tipo == 'site_favicon'){
        $up = $pdo->prepare("UPDATE site_perfil SET site_favicon = (:imagem)");
    }else if($imagem_tipo == 'site_avatar'){
        $up = $pdo->prepare("UPDATE site_perfil SET site_avatar = (:imagem)");
    }else if($imagem_tipo == 'site_background_user'){
        $up = $pdo->prepare("UPDATE site_perfil SET site_background_user = (:imagem)");
    }else if($imagem_tipo == 'site_background_public'){
        $up = $pdo->prepare("UPDATE site_perfil SET site_background_public = (:imagem)");       
    }else{
        return false;
    }
    $up->bindValue("imagem", $imagem);
    if($up->execute()){
        return true;
    }
}
     
function site_perfil(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM site_perfil LIMIT 1");
    $v->execute();
    if($v->rowCount() > 0){
        $res =  $v->fetch();
    }else{
        $res = ["site_nome" => "", "site_descricao" => "", "site_keywords" => "", "site_logo" => "", "site_favicon" => "",
                "site_avatar" => "", "site_token_mp" => "", "site_whatsapp" => "", "site_telegram" => "", "site_cache" => "", "site_token_mp" => ""];

    }
    return $res;
}


define("SITE_NOME", site_perfil()['site_nome']); 
define("SITE_DESCRICAO", site_perfil()['site_descricao']);
define("SITE_KEYWORDS", site_perfil()['site_keywords']);
define("SITE_LOGO", site_perfil()['site_logo']); 
define("SITE_FAVICON", site_perfil()['site_favicon']); 
define("SITE_AVATAR", site_perfil()['site_avatar']); 
define("SITE_BACKGROUND_USER", site_perfil()['site_background_user']);
define("SITE_BACKGROUND_PUBLIC", site_perfil()['site_background_public']);
define("SITE_TOKEN_MP", site_perfil()['site_token_mp']);
define("SITE_WHATSAPP", site_perfil()['site_whatsapp']);
define("SITE_TELEGRAM", site_perfil()['site_telegram']);
define("SITE_CACHE", site_perfil()['site_cache']);
define("SITE_COPYRIGHT", "© " . date("Y") . " " . SITE_NOME);