<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(isset($_GET['encerrar_sessao']) && !empty($_GET['encerrar_sessao'])){

     if($_GET['encerrar_sessao'] == 'admin' && isset($_COOKIE['admin']) && !empty($_COOKIE['admin']) && 
        !empty(get_user_por_hash_sessao($_COOKIE['admin']))){

          $sessao = get_user_por_hash_sessao($_COOKIE['admin']);
          if(!empty($sessao)){
               excluir_sessao_por_hash($sessao['sessao_user_id'], $sessao['sessao_user_email'], $sessao['sessao_hash']);
               setcookie("admin", "", -1, "/"); 
          }
          
     }

     if($_GET['encerrar_sessao'] == 'cliente' && isset($_COOKIE['cliente']) && !empty($_COOKIE['cliente']) && 
        !empty(get_user_por_hash_sessao($_COOKIE['cliente']))){

          $sessao = get_user_por_hash_sessao($_COOKIE['cliente']);
          if(!empty($sessao)){
               excluir_sessao_por_hash($sessao['sessao_user_id'], $sessao['sessao_user_email'], $sessao['sessao_hash']);
               setcookie("cliente", "", -1, "/"); 
               setcookie("cliente_perfil", "", -1, "/"); 
          }
          
     }

} 

die(header("Location:".BASE_USER.'login'));