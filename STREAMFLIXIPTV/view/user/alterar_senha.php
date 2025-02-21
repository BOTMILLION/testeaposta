<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/user/alterar_senha.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/header.php';
?>



<div class="container">
    <div class="div-user-autenticar">

        <div class="card">
            <div class="card-body">
                <div class="card-top">
                    <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
                    <h4 class="text-center">Alterar Senha</h4>
                    <small><?php echo $recuperar['recuperar_email'];?></small>
                </div>
                <form id="form-alterar-senha" autocomplete="off"> 
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <div class="input-group">
                            <input type="password" name="user_senha" class="form-control input-senha-um" required>
                            <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>  
                        <div class="input-group">
                            <input type="password" name="user_confirma_senha" class="form-control input-senha-dois" required>
                            <span class="input-group-text ver-senha-dois"><i class="far fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="acao" value="alterar-senha"> 
                        <input type="hidden" name="recuperar_hash" value="<?php echo $_GET['recuperar_hash'];?>">
                        <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Alterar Senha</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/footer.php';?>



</body>
</html>

