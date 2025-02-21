<?php 
/*
  ============================== MENSAGENS DE RESPOSTA AJAX =================================
*/

  /* SUCCESS */  
  function die_success($msg=""){
    $data = array("status" => "success", "msg" => $msg);
    die(json_encode($data));
  }
  function die_success_reload($msg){
    $data = array("status" => "success_reload", "msg" => $msg);
    die(json_encode($data));
  }
  function die_success_redirect($msg, $url){
  $data = array("status" => "success_redirect", "msg" => $msg, "url" => $url);
  die(json_encode($data));
  }

  function die_success_redirect_after_confirm($msg, $url){
    $data = array("status" => "redirect_after_confirm", "msg" => $msg, "url" => $url);
    die(json_encode($data));
  }
  
  
  /* ERROR */
  function die_error($msg){
     $data = array("status" => "error", "msg" => $msg);
     die(json_encode($data));
  }
  
  function die_error_reload($msg){
    $data = array("status" => "error_reload", "msg" => $msg);
    die(json_encode($data));
  } 
  
  function die_error_redirect($msg, $url){
    $data = array("status" => "error_redirect", "msg" => $msg, "url" => $url);
    die(json_encode($data));
  }

  /* RECARREGAR A PÁGINA */
  function die_reload(){ 
    $data = array("status" => "reload");
    die(json_encode($data));
  }
  /* REDIRECIONAR PARA UMA URL */
  function die_url($url){
    $data = array("status" => "redirect_url", "url" => $url);
    die(json_encode($data));
  }
  function die_download($url){
    $data = array("status" => "download", "url" => $url);
    die(json_encode($data));
  }

  /* REDIRECIONAR PARA LOGIN */
  function die_login($url){
    $data = array("status" => "login", "url" => $url);
    die(json_encode($data));
  }

  function die_selecionar_perfil($url){
    $data = array("status" => "perfil", "url" => $url);
    die(json_encode($data));
  }