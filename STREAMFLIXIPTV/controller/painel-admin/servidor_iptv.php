<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';

if(!isset($_POST['acao'])){
    die_error("Não é possível processar a solicitação no momento.");
}

if($_POST['acao'] == 'editar-servidor-iptv'){
    if(!isset($_POST['servidor_iptv_host']) OR empty($_POST['servidor_iptv_host']) OR 
       !isset($_POST['servidor_iptv_usuario']) OR empty($_POST['servidor_iptv_usuario']) OR
       !isset($_POST['servidor_iptv_senha']) OR empty($_POST['servidor_iptv_senha'])){
        die_error("Preencha todos os campos.");
    }

    $servidor_iptv_host    = filter_var($_POST['servidor_iptv_host'], FILTER_VALIDATE_URL) ? strip_tags(addslashes(trim($_POST['servidor_iptv_host']))) : die_error("A url do host é inválida.");
    $servidor_iptv_host    = substr($servidor_iptv_host, strlen($servidor_iptv_host) -1, 1) != '/' ? $servidor_iptv_host.'/' : $servidor_iptv_host;
    $servidor_iptv_usuario = strip_tags(addslashes(trim($_POST['servidor_iptv_usuario'])));
    $servidor_iptv_senha   = strip_tags(addslashes(trim($_POST['servidor_iptv_senha'])));
    $servidor              = array("servidor_iptv_host" => $servidor_iptv_host, "servidor_iptv_usuario" => $servidor_iptv_usuario,"servidor_iptv_senha" => $servidor_iptv_senha);

    if(!servidor_iptv_adicionar($servidor_iptv_host, $servidor_iptv_usuario, $servidor_iptv_senha)){
        die_error("Não foi possível salvar.");
    }

    if(isset($_POST['remover_conteudo']) && !empty($_POST['remover_conteudo']) && $_POST['remover_conteudo'] == 'remover_conteudo'){
        stream_assistindo_del_all();
        stream_lista_excluir_all();   
    }

    stream_cache_remove();
    stream_cache_criar($servidor);
    
    die_success_reload("Informações salvas.");

}