<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/site_imagens.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>


<div class="page-content">
    <div class="container-fluid">


        <div class="card card-page-title">
            <div class="card-body">
                <h6>Site Perfil</h6>
                <small>Editar Imagens Do Site Formatos (.png .jpg .jpeg).</small>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <form id="site-perfil" autocomplete="off">

                    <div class="form-group">
                        <label>Logo Do Site</label>
                        <div class="input-group">
                            <input type="file" name="site_logo" class="form-control" accept="image/png, image/jpeg">
                            <span class="input-group-text"><i class="far fa-image"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Favicon Do Site</label>
                        <div class="input-group">
                            <input type="file" name="site_favicon" class="form-control" accept="image/png, image/jpeg">
                            <span class="input-group-text"><i class="far fa-image"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Avatar Do Site</label>
                        <div class="input-group">
                            <input type="file" name="site_avatar" class="form-control" accept="image/png, image/jpeg">
                            <span class="input-group-text"><i class="far fa-image"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Background User (Login, Cadastro, Recuperar Senha)</label>
                        <div class="input-group">
                            <input type="file" name="site_background_user" class="form-control" accept="image/png, image/jpeg">
                            <span class="input-group-text"><i class="far fa-image"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Background Public (Página Inicial, 404)</label>
                        <div class="input-group">
                            <input type="file" name="site_background_public" class="form-control" accept="image/png, image/jpeg">
                            <span class="input-group-text"><i class="far fa-image"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="acao" value="site-imagens">
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