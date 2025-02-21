
<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/user/cadastro.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/header.php';
?>
<div class="container">
    <div class="div-user-autenticar">

        <div class="card">
            <div class="card-body">
                <div class="card-top">
                    <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
                    <h4 class="text-center">Crie a sua conta grátis</h4>
                </div>
                <form id="form-cadastro" autocomplete="off">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <div class="input-group">
                            <input type="text" name="user_nome" class="form-control" required>
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <input type="text" name="user_email" class="form-control" required>
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>Whatsapp (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_whatsapp" class="form-control whatsapp_telegram">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>Senha</label>
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
                        <input type="hidden" name="acao" value="cadastro">
                        <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Criar Conta</button>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo BASE_USER.'login';?>">Acessar minha conta</a>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/footer.php';?>

</body>
</html>