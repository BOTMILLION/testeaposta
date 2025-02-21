<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(isset($_POST['acao']) && $_POST['acao'] == 'stream_assistindo_cad'){
    if(isset($_POST['stream_assistindo_type']) && !empty($_POST['stream_assistindo_type']) && 
       isset($_POST['stream_assistindo_stream']) && intval($_POST['stream_assistindo_stream']) && 
       isset($_POST['stream_assistindo_time']) && intval($_POST['stream_assistindo_time']) && 
       isset($_POST['stream_assistindo_episodio']) && is_numeric($_POST['stream_assistindo_episodio'])){

   
        $stream_assistindo_get = stream_assistindo_get($_POST['stream_assistindo_stream'], $_POST['stream_assistindo_type'], $_POST['stream_assistindo_episodio'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);

        if(!empty($stream_assistindo_get)){
            stream_assistindo_del($_POST['stream_assistindo_stream'], $_POST['stream_assistindo_type'], $_POST['stream_assistindo_episodio'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);
        }
        
        stream_assistindo_del($_POST['stream_assistindo_stream'], $_POST['stream_assistindo_type'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);
        stream_assistindo_cad($_POST['stream_assistindo_time'], $_POST['stream_assistindo_stream'], $_POST['stream_assistindo_type'], $_POST['stream_assistindo_episodio'], $cliente_perfil['cliente_perfil_id'], $cliente['user_id']);

        $stream_assistindo_total = count(stream_assistindo_listar($cliente_perfil['cliente_perfil_id'], $cliente['user_id']));
        
        if($stream_assistindo_total > 20){
            $limite =  $stream_assistindo_total - 20;
            stream_assistindo_del_perfil($cliente_perfil['cliente_perfil_id'], $cliente['user_id'], $limite);
        }

    }
} 