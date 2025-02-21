<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/painel-admin/index.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/navbar.php';

?>

<div class="page-content">
    <div class="container-fluid">
   
        <div class="card card-page-title">
            <div class="card-body">
                <h6>Painel Administrador</h6>
                <small>Página Inicial</small>
            </div>
        </div>
        
        <div class="dashboard_page">
            <div class="box">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-users-class"></i>
                            <p>Clientes</p>
                        </div>
                        <div class="info">
                            <p>Total</p>
                            <h5><?php echo user_contar("cliente");?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-users-class"></i>
                            <p>Clientes</p>
                        </div>
                        <div class="info">
                            <div><p>Premium Inativo</p></div>
                            <h5><?php echo user_contar("cliente") - cliente_premium_contar();?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-users-class"></i>
                            <p>Clientes</p>
                        </div>
                        <div class="info">
                            <div><p>Premium Ativo</p></div>
                            <h5><?php echo cliente_premium_contar();?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-sack-dollar"></i>
                            <p>Vendas</p>
                        </div>
                        <div class="info">
                            <p>Hoje</p>
                            <h5>R$ <?php echo get_vendas_filtro_tempo(date("d"), date("m"), date("Y"), "premium", "hoje", 0);?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-sack-dollar"></i>
                            <p>Vendas</p>
                        </div>
                        <div class="info">
                            <div><p>Este Mês</p></div>
                            <h5>R$ <?php echo get_vendas_filtro_tempo("", date("m"), date("Y"), "premium", "este-mes", 0);?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-sack-dollar"></i>
                            <p>Vendas</p>
                        </div>
                        <div class="info">
                            <div><p>Mês Passado</p></div>
                            <h5>R$ <?php echo get_vendas_filtro_tempo("", date("m", strtotime("- 1 months")), date("Y", strtotime("- 1 months")), "premium", "este-mes", 0);?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-user-check"></i>
                            <p>Online</p>
                        </div>
                        <div class="info">
                            <p>Clientes</p>
                            <h5><?php echo user_online_total("cliente");?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-user-check"></i>
                            <p>Online</p>
                        </div>
                        <div class="info">
                            <div><p>Administradores</p></div>
                            <h5><?php echo user_online_total("admin");?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-user-times"></i>
                            <p>Offline</p>
                        </div>
                        <div class="info">
                            <div><p>Usuários Offline</p></div>
                            <h5><?php echo (user_count("cliente") + user_count("admin")) - (user_online_total("admin")) - user_online_total("cliente");?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-play"></i>
                            <p>N° Conteúdos</p>
                        </div>
                        <div class="info">
                            <p>Filmes</p>
                            <h5><?php echo stream_count_total("movie");?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-play"></i>
                            <p>N° Conteúdos</p>
                        </div>
                        <div class="info">
                            <div><p>Séries</p></div>
                            <h5><?php echo stream_count_total("series");?></h5>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="icon">
                            <i class="far fa-play"></i>
                            <p>N° Conteúdos</p>
                        </div>
                        <div class="info">
                            <div><p>Canais</p></div>
                            <h5><?php echo stream_count_total("live");?></h5>
                        </div>
                    </div>
                </div>
            </div>


        </div>
            
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/painel-admin/footer.php';?>



</body>
</html>