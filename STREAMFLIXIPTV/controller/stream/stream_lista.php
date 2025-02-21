<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(isset($_POST['acao']) && $_POST['acao'] == 'stream_lista'){
    
    if(!isset($_POST['stream_lista_stream']) OR !intval($_POST['stream_lista_stream']) OR 
       !isset($_POST['stream_lista_type']) OR empty($_POST['stream_lista_type']) OR 
       $_POST['stream_lista_type'] != 'movie' && $_POST['stream_lista_type'] != 'live' && $_POST['stream_lista_type'] != 'series'){
        exit;
    }
    
    $stream_lista_get = stream_lista_get($_POST['stream_lista_stream'], $_POST['stream_lista_type'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);

    if(empty($stream_lista_get)){
       
        if(stream_lista_cad($_POST['stream_lista_stream'], $_POST['stream_lista_type'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id'])){
            die_success("adicionado");
        }
    }else{
        if(stream_lista_excluir($_POST['stream_lista_stream'], $_POST['stream_lista_type'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id'])){
            die_success("removido");
        }
    }
    

}