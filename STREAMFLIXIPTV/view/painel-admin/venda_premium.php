<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/venda_premium.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';
?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Vendas Acesso Premium</h6>
                <small>Total de vendas <?php echo count($vendas);?></small>
            </div>
        </div>


        <div class="card"> 
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="w-100 table border table-hover" id="dataTable">
                        <div class="table-responsive">
                        <thead>
                            <tr>
                                <th>Venda</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>N° Transação</th>
                                <th>Email</th>
                                <th>Criada</th>
                                <th>Atualizada</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php foreach($vendas as $item):?>
                                <tr> 
                                    <td><?php echo $item['venda_item_titulo'];?></td>
                                    <td>R$ <?php echo number_format($item['venda_item_preco'],2,',','.');?></td>
                                    <td><?php echo mercadopago_tradutor($item['venda_status']);?></td>
                                    <td><?php echo $item['venda_numero_transacao'];?></td>
                                    <td><?php echo $item['venda_user_email'];?></td>
                                    <td><?php echo date("d/m/Y H:i:s", strtotime($item['venda_data_criacao']));?></td>
                                    <td><?php echo !empty($item['venda_data_atualizacao']) ? date("d/m/Y H:i:s", strtotime($item['venda_data_criacao'])) : "N/A";?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>



</body>
</html>