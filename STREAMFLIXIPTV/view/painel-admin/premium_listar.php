<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/premium_listar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';
?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Planos Premium</h6>
                <small>Total de planos <?php echo count($premium_listar);?></small>
            </div>
        </div>
 

        <div class="card"> 
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="w-100 table border table-hover" id="dataTable">
                        <div class="table-responsive">
                        <thead>
                            <tr>
                            <th>Telas</th>
                            <th>Dias De Acesso</th>
                            <th>Preço</th>
                            <th>Ação</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php foreach($premium_listar as $item):?>
                                <tr> 
                                    <td><?php echo $item['premium_telas'];?></td>
                                    <td><?php echo $item['premium_dias'];?></td>
                                    <td>R$ <?php echo number_format($item['premium_preco'],2,',','.');?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="<?php echo BASE_ADMIN.'premium/editar/'.$item['premium_id'];?>" class="btn btn-sm btn-three">
                                                <i class="far fa-pencil"></i>Editar
                                            </a> 
                                            <button data-bs-toggle="modal" data-bs-target="#modal-excluir" class="btn btn-sm btn-two btn-excluir"
                                                    data-id="<?php echo $item['premium_id'];?>"
                                                    data-telas="<?php echo $item['premium_telas'];?>"
                                                    data-dias="<?php echo $item['premium_dias'];?>">
                                                    <i class="far fa-trash"></i>Excluir
                                            </button>
                                        </div>
                                    </td> 
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        </div>
</div>
 

<div class="modal" tabindex="-1" id="modal-excluir" data-bs-backdrop="static">
    <form id="premium-excluir">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Excluir Plano Premium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Tem certeza que deseja excluir o plano premium ?</p>
                <p class="text-excluir mb-0"></p>
                <p class="text-excluir-dois"></p>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="premium-excluir">
                <input type="hidden" name="premium_id" value="">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-two"><i class="far fa-trash"></i>Excluir</button>
            </div>
            </div>
        </div>
    </form>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    $("#dataTable").on("click", ".btn-excluir", function(){
        $("input[name=premium_id]").val($(this).attr("data-id"));
        var  telas = $(this).attr("data-telas") == 1 ? $(this).attr("data-telas") + " Tela " : $(this).attr("data-telas") + " Telas ";
        var dias = $(this).attr("data-dias") == 1 ? $(this).attr("data-dias") + " Dia " : $(this).attr("data-dias") + " Dias ";
        $(".text-excluir-dois").html(telas + dias);
    })
    controller_submit_form("#premium-excluir", "painel-admin/premium.php");
</script>

</body>
</html>