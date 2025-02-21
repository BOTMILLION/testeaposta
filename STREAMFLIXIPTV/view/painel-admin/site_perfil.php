<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/site_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>


<div class="page-content">
    <div class="container-fluid">


        <div class="card card-page-title">
            <div class="card-body">
                <h6>Site Perfil</h6>
                <small>Editar Informações Do Site.</small>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <form id="site-perfil" autocomplete="off">

                    <div class="form-group">
                        <label>Nome</label>
                        <div class="input-group">
                            <input type="text" name="site_nome" class="form-control" value="<?php echo !empty(SITE_NOME) ? SITE_NOME : ''; ?>">
                            <span class="input-group-text"><i class="far fa-globe"></i></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label>Descrição</label> 
                        <div class="input-group">
                            <textarea class="form-control" name="site_descricao" rows="3"><?php echo !empty(SITE_DESCRICAO) ? SITE_DESCRICAO : '';?></textarea>
                            <span class="input-group-text"><i class="far fa-comment"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keywords (Cada frase separada por vírgula)</label>
                        <div class="input-group">
                            <input type="text" name="site_keywords" class="form-control" value="<?php echo !empty(SITE_KEYWORDS) ? SITE_KEYWORDS : ''; ?>">
                            <span class="input-group-text"><i class="far fa-window-frame"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Whatsapp</label>
                        <div class="input-group">
                            <input type="text" name="site_whatsapp" class="form-control whatsapp_telegram" value="<?php echo !empty(SITE_WHATSAPP) ? SITE_WHATSAPP : ''; ?>">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Telegram</label>
                        <div class="input-group">
                            <input type="text" name="site_telegram" class="form-control whatsapp_telegram" value="<?php echo !empty(SITE_TELEGRAM) ? SITE_TELEGRAM : ''; ?>">
                            <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Token Mercado Pago</label>
                        <div class="input-group">
                            <input type="password" name="site_token_mp" class="form-control input-senha-um" value="<?php echo !empty(SITE_TOKEN_MP) ? SITE_TOKEN_MP : ''; ?>">
                            <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                        </div>
                    </div>
       
                    <div class="form-group">
                        <label>Cache</label>
                        <div class="input-group">
                            <input type="text" name="site_cache" class="form-control" value="<?php echo !empty(SITE_CACHE) ? SITE_CACHE : ''; ?>" 
                                    placeholder="Número maior que zero. Mude para recarregar o cache do site.">
                            <span class="input-group-text"><i class="fas fa-random"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="acao" value="site-perfil">
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