<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/cliente_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Cliente Perfil</h6>
                <small>Informações conta cliente.</small>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <p class="mb-0">Nome</p>
                <small><?php echo $cliente['user_nome'];?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Email</p>
                <small><?php echo $cliente['user_email'];?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Whatsapp</p>
                <small><?php echo !empty($cliente['user_whatsapp']) ? $cliente['user_whatsapp'] : 'N/A';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Data Cadastro</p>
                <small><?php echo date("d/m/Y",strtotime($cliente['user_data']));?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Premium</p>
                <small><?php echo cliente_is_premium($cliente['user_id']) ? '<span class="text-green">Ativado</span>' : '<span class="">Desativado</span>';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Premium Data</p>
                <small><?php echo !empty($cliente_premium_get) ? date("d/m/Y H:i:s",strtotime($cliente_premium_get['cliente_premium_data'])) : 'N/A';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Perfis</p>
                <small><?php echo cliente_perfil_contar($cliente['user_id']);?></small>
            </li>
    </ul>

    <div class="buttons-perfil-group">
        <button data-bs-toggle="modal" data-bs-target="#modal-premium" class="btn btn-one me-2"><i class="far fa-crown"></i>Editar Premium</a>
        <button class="btn btn-two me-2" data-bs-toggle="modal" data-bs-target="#modal-excluir"><i class="far fa-trash"></i>Excluir Cliente</button>
    </div>


    </div>
</div>
 
<div class="modal" tabindex="-1" id="modal-premium" data-bs-backdrop="static">
    <form id="cliente-premium">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Editar Premium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                        <label>Premium Status</label>
                        <div class="input-group">
                            <input type="text" class="form-control disabled" disabled 
                            value="<?php echo cliente_is_premium($cliente['user_id']) ? 'Ativado' : 'Desativado';?> <?php echo !empty($cliente_premium_get) ? date("d/m/Y H:i:s",strtotime($cliente_premium_get['cliente_premium_data'])) : '';?>">
                            <span class="input-group-text"><i class="far fa-crown"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Plano Premium</label>
                        <select class="form-select" name="premium">
                            <option selected disabled>Selecione uma opção</option>
                            <?php foreach(premium_listar(0) as $p):?>
                                <option value="<?php echo $p['premium_id'];?>">
                                    <?php echo $p['premium_telas'] == 1 ? $p['premium_telas'] . ' Tela ' : $p['premium_telas'] . ' Telas ';?>
                                    <?php echo $p['premium_dias'] == 1 ? $p['premium_dias'] . ' Dia ' : $p['premium_dias'] . ' Dias ';?> 
                                    R$ <?php echo number_format($p['premium_preco'], 2 , ',' , '.');?> 
                                </option>
                            <?php endforeach;?>    
                            <option value="0">Remover Premium</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="cliente-premium-editar">
                <input type="hidden" name="user_id" value="<?php echo $cliente['user_id'];?>">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-one btn-sm"><i class="far fa-check"></i>Salvar</button>
            </div>
            </div>
        </div>
    </form>
</div>

<div class="modal" tabindex="-1" id="modal-excluir" data-bs-backdrop="static">
    <form id="cliente-excluir">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Excluir Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Tem certeza que deseja excluir o cliente ?</p>
                <p class="text-excluir mb-0"><?php echo $cliente['user_nome'];?></p>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="cliente-excluir">
                <input type="hidden" name="user_id" value="<?php echo $cliente['user_id'];?>">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-two btn-sm"><i class="far fa-trash"></i>Excluir</button>
            </div>
            </div>
        </div>
    </form>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    controller_submit_form("#cliente-excluir", "painel-admin/cliente.php");
    controller_submit_form("#cliente-premium", "painel-admin/cliente.php");
</script>

</body>
</html>