<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/cliente/perfil_selecionar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/header.php';
?>
   
<nav class="navbar navbar-one fixed-top m-0">
  <div class="container">
    <div class="items">
        <a href="<?php echo BASE_STREAM;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">
                <a href="<?php echo BASE_CLIENTE.'encerrar-sessao';?>" class="btn btn-one"><i class="far fa-power-off m-0"></i></a>
            </li>
        </ul>
    </div>
  </div> 
</nav>   


<div class="container mb-3">
    <div class="perfil-selecionar">
        <h4 class="text-center mb-4">Quem está assistindo ?</h4>
        <div class="box">
            <?php foreach(cliente_perfil_listar($cliente['user_id']) as $key => $pf):?>
                <button class="perfil-selecionar-item" data-id="<?php echo $pf['cliente_perfil_id'];?>">
                    <img src="<?php echo BASE_IMAGES_URL.'avatar-perfil/'.$pf['cliente_perfil_avatar'];?>">
                    <small class="text-break"><?php echo $pf['cliente_perfil_apelido'];?></small>
                </button>
            <?php endforeach;?>    
        </div>
    </div> 
</div>


<form id="perfil-selecionar-form">
    <input type="hidden" name="acao" value="perfil-selecionar">
    <input type="hidden" name="perfil-selecionar-id" value=""> 
</form>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/footer.php';?>
