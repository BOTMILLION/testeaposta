<?php 
/*
  ============================== GERAR / VERIFICAR HASH MD5 =================================
*/

function gerar_hash(){
    $a = md5(time().rand(1000,10000).uniqid());
    $b = md5(time().rand(1000,10000).uniqid());
    return md5(md5($a . $b));
}

function hash_senha($senha){
    return md5(md5($senha));
}

function verifica_hash_md5($hash){
    if(!preg_match("/^[0-9a-zA-Z]*$/", $hash) OR strlen($hash) != 32){
         return false;
    } 
    return true;
}