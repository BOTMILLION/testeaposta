<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/administrador_adicionar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Administrador</h6>
                <small>Adicionar Novo Administrador</small>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="form-administrador" autocomplete="off">
                    
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <div class="input-group">
                            <input type="text" name="user_nome" class="form-control">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <input type="text" name="user_email" class="form-control">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <div class="input-group">
                            <input type="password" name="user_senha" class="form-control input-senha-um">
                            <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <div class="input-group">
                            <input type="password" name="user_senha_confirma" class="form-control input-senha-dois">
                            <span class="input-group-text ver-senha-dois"><i class="far fa-eye"></i></span>
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
                        <label>Telegram (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_telegram" class="form-control whatsapp_telegram">
                            <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                        </div>
                    </div> 

                    <div class="form-group">
                        <input type="hidden" name="acao" value="adicionar-administrador">
                        <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Adicionar</button>
                    </div>

                </form>
            </div> 
        </div>


    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>

<script>
    controller_submit_form("#form-administrador", "painel-admin/administrador.php");
</script>

</body>
</html>