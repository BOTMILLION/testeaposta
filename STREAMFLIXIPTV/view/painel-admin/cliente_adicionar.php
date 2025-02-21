<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/cliente_adicionar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Cliente</h6>
                <small>Adicionar novo cliente.</small>
            </div>
        </div>


        <div class="card">
        <div class="card-body">
            <form id="cliente-adicionar" autocomplete="off">

                <div class="form-group">
                    <label>Nome</label>
                    <div class="input-group">
                        <input type="text" name="user_nome" class="form-control">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <input type="text" name="user_email" class="form-control">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                </div>
    
                <div class="form-group">
                    <label>Whatsapp (opcional)</label>
                    <div class="input-group">
                        <input type="text" name="user_whatsapp" class="form-control whatsapp_telegram">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <div class="input-group">
                        <input type="password" name="user_senha" class="form-control input-senha-um" required>
                        <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <div class="input-group">
                        <input type="password" name="user_senha_confirma" class="form-control input-senha-dois" required>
                        <span class="input-group-text ver-senha-dois"><i class="far fa-eye"></i></span>
                    </div>
                    <div class="text-end">
                        <small class="gerar-senha cursor-pointer">Gerar Senha</small>
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
                    </select>
                </div>

                <div class="form-group">
                    <input type="hidden" name="acao" value="cliente-adicionar">
                    <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Adicionar</button>
                </div>
 
            </form>
        </div>
    </div>



    </div>
</div>
 

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    controller_submit_form("#cliente-adicionar", "painel-admin/cliente.php");
</script>

</body>
</html>