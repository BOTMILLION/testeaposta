<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php'; 
if(isset($_COOKIE['cliente']) && !empty($_COOKIE['cliente']) && !empty(get_user_por_hash_sessao($_COOKIE['cliente']))){
    die(header("Location:".BASE_STREAM));
}