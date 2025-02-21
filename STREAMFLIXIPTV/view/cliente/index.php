<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/cliente/index.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid pb-3">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Minha Conta</h6>
                <small>Alterar Senha, Editar Perfil, Editar Conta</small>
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
                <small><?php echo !empty($cliente_premium) ? date("d/m/Y H:i:s",strtotime($cliente_premium['cliente_premium_data'])) : 'N/A';?></small>
            </li> 
            <li class="list-group-item">
                <p class="mb-0">Perfis</p>
                <small><?php echo cliente_perfil_contar($cliente['user_id']);?></small>
            </li>
    </ul>

    <div class="buttons-perfil-group">
        <button data-bs-toggle="modal" data-bs-target="#modal-perfil" class="btn btn-one me-2"><i class="far fa-pencil"></i>Editar Perfil</button>
        <button data-bs-toggle="modal" data-bs-target="#modal-conta" class="btn btn-two me-2"><i class="far fa-cog"></i>Editar Conta</button>
        <button data-bs-toggle="modal" data-bs-target="#modal-senha" class="btn btn-three me-2"><i class="far fa-key"></i>Alterar Senha</button>
        <a href="<?php echo BASE_CLIENTE.'pagamentos';?>" class="btn btn-five"><i class="far fa-dollar-sign"></i>Meus Pagamentos</a>
    </div>


    </div>
</div>


<div class="modal" tabindex="-1" id="modal-perfil" data-bs-backdrop="static">
    <form id="cliente-perfil" autocomplete="off">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Apelido</label>
                        <div class="input-group">
                            <input type="text" name="cliente_perfil_apelido" class="form-control" required value="<?php echo $cliente_perfil['cliente_perfil_apelido'];?>">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                    </div>

            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="cliente-editar-perfil">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-one btn-sm"><i class="far fa-check"></i>Salvar</button>
            </div>
            </div>
        </div>
    </form>
</div>


<div class="modal" tabindex="-1" id="modal-conta" data-bs-backdrop="static">
    <form id="cliente-conta" autocomplete="off">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Editar Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <div class="input-group">
                            <input type="text" name="user_nome" class="form-control" required value="<?php echo $cliente['user_nome'];?>">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Whatsapp (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_whatsapp" class="form-control whatsapp_telegram" value="<?php echo $cliente['user_whatsapp'];?>">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>Telegram (opcional)</label>
                        <div class="input-group">
                            <input type="text" name="user_telegram" class="form-control whatsapp_telegram" value="<?php echo $cliente['user_telegram'];?>">
                            <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                        </div>
                    </div> 
    
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="cliente-editar-conta">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-two btn-sm"><i class="far fa-check"></i>Editar Conta</button>
            </div>
            </div>
        </div>
    </form>
</div>


<div class="modal" tabindex="-1" id="modal-senha" data-bs-backdrop="static">
    <form id="cliente-senha" autocomplete="off">
        <div class="modal-dialog">
            <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Alterar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="text-center d-block mb-2">Atenção todos os perfis serão desconectados.</label>
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
                <input type="hidden" name="acao" value="cliente-alterar-senha">
                <button type="button" class="btn btn-sm btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-three btn-sm"><i class="far fa-check"></i>Alterar Senha</button>
            </div>
            </div>
        </div>
    </form>
</div>
 


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/cliente/footer.php';?>

<script>
    controller_submit_form("#cliente-perfil", "cliente/cliente_conta.php");
    controller_submit_form("#cliente-conta", "cliente/cliente_conta.php");
    controller_submit_form("#cliente-senha", "cliente/cliente_conta.php");
</script>