<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/site_smtp.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>


<div class="page-content">
    <div class="container-fluid">


        <div class="card card-page-title">
            <div class="card-body">
                <h6>Site Smtp</h6>
                <small>Informe os dados do seu servidor de envio de email.</small>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <form id="site-perfil" autocomplete="off">

                <div class="form-group">
                    <label>Usuário</label>
                    <div class="input-group">
                        <input type="text" name="smtp_user" class="form-control" value="<?php echo !empty($res['smtp_user']) ? $res['smtp_user'] : ''; ?>">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                </div>
            
    
                <div class="form-group">
                    <label>Senha</label> 
                    <div class="input-group">
                        <input type="password" name="smtp_senha" class="form-control input-senha-um" value="<?php echo !empty($res['smtp_senha']) ? $res['smtp_senha'] : '';?>">
                        <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Porta</label>
                    <div class="input-group">
                        <input type="text" name="smtp_porta" class="form-control" value="<?php echo !empty($res['smtp_porta']) ? $res['smtp_porta'] : ''; ?>">
                        <span class="input-group-text"><i class="far fa-window-frame"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <input type="text" name="smtp_email" class="form-control" value="<?php echo !empty($res['smtp_email']) ? $res['smtp_email'] : ''; ?>">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Host</label>
                    <div class="input-group">
                        <input type="text" name="smtp_host" class="form-control" value="<?php echo !empty($res['smtp_host']) ? $res['smtp_host'] : ''; ?>">
                        <span class="input-group-text"><i class="far fa-globe-americas"></i></span>
                    </div>
                </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="acao" value="site-smtp">
                        <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Salvar</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>




<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>

<script>
    controller_submit_form("#site-perfil", "painel-admin/site_perfil.php");
</script>

</body>
</html>