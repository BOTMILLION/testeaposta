<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/servidor_iptv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Servidor Iptv</h6>
                <small>Preencha os campos com as informações do seu servidor.</small>
                <small>O sistema vai buscar novos conteúdos a cada 24 horas.</small>
            </div>
        </div>

        <div class="card">
        <div class="card-body">
            <form id="site-iptv" autocomplete="off">

                <div class="form-group">
                    <label>Host (url)</label>
                    <div class="input-group">
                        <input type="text" name="servidor_iptv_host" class="form-control" value="<?php echo $servidor_iptv['servidor_iptv_host']; ?>">
                        <span class="input-group-text"><i class="far fa-network-wired"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Usuário</label>
                    <div class="input-group">
                        <input type="text" name="servidor_iptv_usuario" class="form-control" value="<?php echo $servidor_iptv['servidor_iptv_usuario']; ?>">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                </div>
            
    
                <div class="form-group">
                    <label>Senha</label> 
                    <div class="input-group">
                        <input type="password" name="servidor_iptv_senha" class="form-control input-senha-um" value="<?php echo  $servidor_iptv['servidor_iptv_senha'];?>">
                        <span class="input-group-text ver-senha-um"><i class="far fa-eye"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Caso o conteúdo da lista seja de um servidor diferente, do atual. Selecione esta opção para remover conteúdo de continuar assistindo e os favoritos dos usuários.</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="remover_conteudo" id="remover_conteudo" value="remover_conteudo">
                        <label class="form-check-label" for="remover_conteudo">
                            Remover Conteúdo Dos Usuários (Listas e continuar assistindo)
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="acao" value="editar-servidor-iptv">
                    <button type="submit" class="btn btn-one"><i class="fas fa-check"></i>Salvar</button>
                </div>

            </form>
        </div>
    </div>



    </div>
</div>
 

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>


<script>
    controller_submit_form("#site-iptv", "painel-admin/servidor_iptv.php");
</script>

</body>
</html>