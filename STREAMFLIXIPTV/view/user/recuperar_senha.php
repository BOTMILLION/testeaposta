<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/user/recuperar_senha.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/header.php';
?>
<div class="container">
    <div class="div-user-autenticar">

        <div class="card">
            <div class="card-body">
                <div class="card-top">
                    <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
                    <h4 class="text-center mb-0">Recuperar Senha</h4>
                    <small>Um link com instruções será enviado para o seu email.</small>
                </div>
                <form id="form-recuperar-senha" autocomplete="off">
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <input type="text" name="user_email" class="form-control" required>
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="acao" value="recuperar-senha">
                        <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Enviar Email</button>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo BASE_USER.'login';?>">Acessar minha conta</a>
                        <a href="<?php echo BASE_USER;?>cadastro">Criar uma conta</a>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/user/footer.php';?>

</body>
</html>