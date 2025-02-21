<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/cliente/pagamentos.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid pb-3">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Pagamentos</h6>
                <small>Resumo de todos os seus pagamentos.</small>
            </div>
        </div>
        <?php foreach($pagamentos as $item):?>
        <ul class="list-group mb-3">
            <li class="list-group-item">
                <p class="mb-0">Status</p>
                <small><?php echo mercadopago_tradutor($item['venda_status']);?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Plano</p>
                <small><?php echo $item['venda_item_titulo'];?> R$ <?php echo number_format($item['venda_total'],2,',','.');?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Código da Compra</p>
                <small><?php echo $item['venda_numero_transacao'];?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Data Início</p>
                <small><?php echo !empty($item['venda_data_criacao']) ? date("d/m/Y H:i:s", strtotime($item['venda_data_criacao'])) : 'N/A';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Data Atualização</p>
                <small><?php echo !empty($item['venda_data_atualizacao']) ? date("d/m/Y H:i:s", strtotime($item['venda_data_atualizacao'])) : 'N/A';?></small>
            </li>
        </ul>
        <?php endforeach;?>


    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/footer.php';?>