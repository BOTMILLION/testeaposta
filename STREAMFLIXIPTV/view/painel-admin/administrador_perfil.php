<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/administrador_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Administrador Perfil</h6>
                <small>Informações conta administrador.</small>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <p class="mb-0">Nome</p>
                <small><?php echo $administrador['user_nome'];?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Email</p>
                <small><?php echo $administrador['user_email'];?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Whatsapp</p>
                <small><?php echo !empty($administrador['user_whatsapp']) ? $administrador['user_whatsapp'] : 'N/A';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Telegram</p>
                <small><?php echo !empty($administrador['user_telegram']) ? $administrador['user_telegram'] : 'N/A';?></small>
            </li>
            <li class="list-group-item">
                <p class="mb-0">Data Cadastro</p>
                <small><?php echo date("d/m/Y",strtotime($administrador['user_data']));?></small>
            </li>
    </ul>

    <div class="buttons-perfil-group">
        <?php if($administrador['user_id'] == $admin['user_id']):?>

            <button data-bs-toggle="modal" data-bs-target="#modal-perfil" class="btn btn-one me-2"><i class="far fa-user-edit"></i>Editar Perfil</button>
            <button data-bs-toggle="modal" data-bs-target="#modal-senha" class="btn btn-three me-2"><i class="far fa-key"></i>Alterar Senha</button>

        <?php else:?>    
            <button class="btn btn-two me-2"data-bs-toggle="modal" data-bs-target="#modal-excluir"><i class="far fa-trash"></i>Excluir Administrador</button>
        <?php endif;?>    
    </div>


    </div>
</div>


<div class="modal" tabindex="-1" id="modal-perfil" data-bs-backdrop="static">
    <form id="form-perfil">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <div class="input-group">
                            <input type="text" name="user_nome" class="form-control" required value="<?php echo $administrador['user_nome'];?>">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Whatsapp (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_whatsapp" class="form-control whatsapp_telegram" value="<?php echo $administrador['user_whatsapp'];?>">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Telegram (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_telegram" class="form-control whatsapp_telegram" value="<?php echo $administrador['user_telegram'];?>">
                            <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="admin-editar-perfil">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-one btn-sm"><i class="far fa-check"></i>Salvar</button>
            </div>
            </div>
        </div>
    </form>
</div>


<div class="modal" tabindex="-1" id="modal-senha" data-bs-backdrop="static">
    <form id="form-senha">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Alterar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Senha Atual</label>
                    <div class="input-group">
                        <input type="password" name="user_senha" class="form-control input-senha-um" required>
                        <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="user_senha_nova" class="form-control input-senha-dois" required>
                        <span class="input-group-text ver-senha-dois"><i class="far fa-eye"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Senha</label> 
                    <div class="input-group">
                        <input type="password" name="user_senha_confirma" class="form-control input-senha-tres" required>
                        <span class="input-group-text ver-senha-tres"><i class="far fa-eye"></i></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="admin-alterar-senha">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-three btn-sm"><i class="far fa-check"></i>Alterar Senha</button>
            </div>
            </div>
        </div>
    </form>
</div>
 


<div class="modal" tabindex="-1" id="modal-excluir" data-bs-backdrop="static">
    <form id="form-excluir">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Excluir Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Tem certeza que deseja excluir o administrador ?</p>
                <p class="text-excluir mb-0"><?php echo $administrador['user_nome'];?></p>
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="excluir-administrador">
                <input type="hidden" name="user_id" value="<?php echo $administrador['user_id'];?>">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-two btn-sm"><i class="far fa-trash"></i>Excluir</button>
            </div>
            </div>
        </div>
    </form>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    controller_submit_form("#form-excluir", "painel-admin/administrador.php");
    controller_submit_form("#form-perfil", "painel-admin/administrador.php");
    controller_submit_form("#form-senha", "painel-admin/administrador.php");
</script>

</body>
</html>