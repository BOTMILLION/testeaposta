<?php 
if(isset($_POST['acao']) && $_POST['acao'] == 'user_online_cad'){
    
    if($_POST['user_tipo'] != 'admin' && $_POST['user_tipo'] != 'cliente'){
        exit;
    }

    if($_POST['user_tipo'] == 'cliente'){
        require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php'; 
    }

    if($_POST['user_tipo'] == 'admin'){ 
        require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';  
    }
    
    if($user['user_online'] < date("Y-m-d H:i:s",strtotime("+ 30 seconds"))){
        user_online_update($user['user_id'], $user['user_email'], $user['user_tipo']);
    }

} 