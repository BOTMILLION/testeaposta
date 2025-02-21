<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/administrador_listar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Administrador</h6>
                <small>Listando Administradores</small>
            </div>
        </div>


        <div class="card"> 
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="w-100 table border table-hover" id="dataTable">
                        <div class="table-responsive">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Online</th>
                                <th>Perfil</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php foreach($administradores as $item):?>
                                <tr> 
                                    <td><?php echo $item['user_nome'];?></td>
                                    <td><?php echo $item['user_email'];?></td> 
                                    <td><?php echo user_is_online($item['user_online']) ? '<span class="text-warning">Online</span>' :   user_is_offline($item['user_online']);?></td>
                                    <td><a href="<?php echo BASE_ADMIN.'administrador/perfil/'.$item['user_id'];?>" class="btn btn-one btn-sm"><i class="far fa-user"></i>Perfil</a></td>
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