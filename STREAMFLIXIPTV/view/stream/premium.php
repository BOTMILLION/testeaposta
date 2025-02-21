<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/stream/premium.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/navbar.php';
?>


<div class="page-content">
    <div class="container-fluid mb-5"> 

        <div class="card card-page-title">
            <div class="card-body">
                <h6>Planos Premium</h6>
                <small>Escolha o plano ideal para o seu perfil.</small>
            </div>
        </div>

        <div class="premium-box mb-3">
            <?php foreach(premium_listar(0) as $item):?>
            <div class="premium-item">
                <div class="top-circle">
                    <h4>R$ <?php echo number_format($item['premium_preco'], 2, ',', '.');?></h4>
                </div>
                <h5 class="tela"><?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . " Tela " : $item['premium_telas'] . " Telas " ;?></h5>
                <ul class="list-group">
                    <li class="list-group-item">Assista em <?php echo $item['premium_dias'] == 1 ? $item['premium_dias'] . " Dia Acesso Premium " : $item['premium_dias'] . " Dias Acesso Premium " ;?></li>
                    <li class="list-group-item">Assista em <?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . " Dispositivo " : $item['premium_telas'] . " Dispositivos ";?></li>
                    <li class="list-group-item">Filmes Ilimitados</li>
                    <li class="list-group-item">Séries Ilimitadas</li>
                    <li class="list-group-item">Canais Ilimitados</li>
                    <li class="list-group-item">Qualidade HD, FULL HD, 4K</li>
                    <li class="list-group-item">Pagamento feito em ambiente seguro</li>
                    <li class="list-group-item">Pix, Cartão Débito/Crédito, Paypal</li>
                    <li class="list-group-item">Comprar com o revendedor no whatsapp</li>
                </ul>
                <div class="footer">
                    <a class="btn btn-five btn-comprar" data-id="<?php echo $item['premium_id'];?>"><i class="far fa-shopping-bag me-2"></i>Comprar Com Mercado Pago</a>
                    <a class="btn btn-success" href="https://api.whatsapp.com/send?phone=<?php echo whatsapp_telegram_limpar(SITE_WHATSAPP);?>&text=*Comprar Acesso Premium:*%0A%0A<?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . " Tela" : $item['premium_telas'] . " Telas";?>%0A<?php echo $item['premium_dias'] == 1 ? $item['premium_dias'] . " Dia" : $item['premium_dias'] . " Dias" ;?>%0AR$ <?php echo number_format($item['premium_preco'], 2, ',', '.');?>%0A%0A*Meu Email:*%0A<?php echo $cliente['user_email'];?>%0A%0A*Site:*%0A<?php echo SITE_URL;?> " target="_blank"><i class="fab fa-whatsapp me-2"></i>Comprar No Whatsapp</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/footer.php';?>

<form id="form-checkout">
    <input type="hidden" name="acao" value="checkout-premium">
    <input type="hidden" name="premium_id" value="">
</form>

<script>
    $(".btn-comprar").on("click", function(){
        $("input[name=premium_id]").val($(this).attr("data-id"));
        $("#form-checkout").trigger("submit");   
    });
    controller_submit_form("#form-checkout", "mercadopago/stream_premium_checkout.php");
</script>