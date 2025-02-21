<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/premium_adicionar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Planos Premium</h6>
                <small>Adicionar novo plano.</small>
            </div>
        </div>


        <div class="card">
        <div class="card-body">
            <form id="premium-adicionar" autocomplete="off">

                <div class="form-group">
                    <label>Quantidade de telas</label>
                    <div class="input-group">
                        <input type="text" name="premium_telas" class="form-control number_two">
                        <span class="input-group-text"><i class="far fa-tv-retro"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dias de acesso</label>
                    <div class="input-group">
                        <input type="text" name="premium_dias" class="form-control number_three">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
    
                <div class="form-group">
                    <label>Preço</label> 
                    <div class="input-group">
                        <input type="text" name="premium_preco" class="form-control preco">
                        <span class="input-group-text"><i class="far fa-usd-circle"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="acao" value="premium-adicionar">
                    <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Salvar</button>
                </div>

            </form>
        </div>
    </div>



    </div>
</div>
 

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    controller_submit_form("#premium-adicionar", "painel-admin/premium.php");
</script>

</body>
</html>