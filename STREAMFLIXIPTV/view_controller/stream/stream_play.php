<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';
if(!isset($_GET['stream_type']) OR $_GET['stream_type'] != 'movie' && $_GET['stream_type'] != 'series' && $_GET['stream_type'] != 'live' OR $_GET['stream_type'] == 'series' && !isset($_GET['episodio'])){
    die(header("Location:".BASE_STREAM));
  }
  
  if(!$cliente_is_premium){
      die(header("Location:".BASE_STREAM.'premium'));
  }
  
  $movie  = $_GET['stream_type'] == 'movie' ?  (!empty(stream_get_movie($_GET['stream_id'])['data']) ? stream_get_movie($_GET['stream_id'])['data'] : die(header("Location:".BASE_STREAM))) : NULL;
  $live   = $_GET['stream_type'] == 'live' ? (!empty(stream_get_live($_GET['stream_id'])['data']) ? stream_get_live($_GET['stream_id'])['data'] : die(header("Location:".BASE_STREAM))) : NULL;
  $series   = $_GET['stream_type'] == 'series' ? (!empty(stream_get_serie($_GET['stream_id'])['data']) ? stream_get_serie($_GET['stream_id'])['data'] : die(header("Location:".BASE_STREAM))) : NULL;
  
  if($series){
    $episodios  = stream_get_serie_episodios($_GET['stream_id']);
    $episodio   = stream_get_serie_episodio($_GET['stream_id'], $_GET['episodio']);
  }
  
  $stream_lista_get = stream_lista_get($_GET['stream_id'],$_GET['stream_type'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);