<div class="sidebar-one">
    <div class="top"> 
        <div class="avatar">
            <a href="<?php echo BASE_ADMIN;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_AVATAR;?>"></a>
        </div>
        <div class="info">
            <small class="text-center">Administrador</small>
            <small><?php echo $admin['user_nome'];?></small>
        </div>
    </div>
    <div class="content" id="accordion-group">
      <ul class="list-group child-one list-group-flush">

          <!-- ITEM --> 
          <a href="<?php echo BASE_ADMIN;?>" class="list-group-item"><i class="far fa-home"></i>Início</a>
          
          <!-- ITEM --> 
          <div class="accordion accordion-flush" id="accordion-cli"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-cli" aria-expanded="false" aria-controls="collapse-cli">
                          <div class="icon"><i class="far fa-users-class"></i></div>
                          <div class="title">Clientes</div>
                      </div>
                  </div>
                  <div id="collapse-cli" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                              <a href="<?php echo BASE_ADMIN;?>cliente/listar" class="list-group-item">Listar Clientes</a>
                              <a href="<?php echo BASE_ADMIN;?>cliente/adicionar" class="list-group-item">Adicionar Cliente</a>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>


          <!-- ITEM --> 
          <div class="accordion accordion-flush" id="accordion-adms"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-adms" aria-expanded="false" aria-controls="collapse-adms">
                          <div class="icon"><i class="far fa-user-shield"></i></div>
                          <div class="title">Administradores</div>
                      </div>
                  </div>
                  <div id="collapse-adms" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                              <a href="<?php echo BASE_ADMIN;?>administrador/listar" class="list-group-item">Listar Administradores</a>
                              <a href="<?php echo BASE_ADMIN;?>administrador/adicionar" class="list-group-item">Adicionar Administrador</a>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>

          <!-- ITEM -->
          <div class="accordion accordion-flush" id="accordion-premi"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-premi" aria-expanded="false" aria-controls="collapse-premi">
                          <div class="icon"><i class="far fa-crown"></i></div>
                          <div class="title">Planos Premium</div>
                      </div>
                  </div>
                  <div id="collapse-premi" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                              <a href="<?php echo BASE_ADMIN;?>premium/adicionar" class="list-group-item">Adicionar Plano</a>
                              <a href="<?php echo BASE_ADMIN;?>premium/listar" class="list-group-item">Listar Planos</a>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>

          <!-- ITEM -->
          <div class="accordion accordion-flush" id="accordion-ven"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ven" aria-expanded="false" aria-controls="collapse-ven">
                          <div class="icon"><i class="far fa-sack-dollar"></i></div>
                          <div class="title">Vendas</div>
                      </div>
                  </div>
                  <div id="collapse-ven" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                              <a href="<?php echo BASE_ADMIN;?>venda/premium/listar" class="list-group-item">Vendas Acesso Premium</a>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>


          <!-- ITEM --> 
          <div class="accordion accordion-flush" id="accordion-conf"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-conf" aria-expanded="false" aria-controls="collapse-conf">
                          <div class="icon"><i class="far fa-cog"></i></div>
                          <div class="title">Configurações</div>
                      </div>
                  </div>
                  <div id="collapse-conf" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                                <a href="<?php echo BASE_ADMIN;?>servidor-iptv" class="list-group-item">Servidor Iptv</a>
                                <a href="<?php echo BASE_ADMIN;?>site/perfil" class="list-group-item">Perfil Site</a>
                                <a href="<?php echo BASE_ADMIN;?>site/imagens" class="list-group-item">Imagens Site</a>
                                <a href="<?php echo BASE_ADMIN;?>site/smtp" class="list-group-item">Email Site</a>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <!-- ITEM -->

          <!-- ITEM --> 
          <a href="<?php echo BASE_STREAM;?>" target="_blank" class="list-group-item"><i class="far fa-external-link"></i>Ver Site</a>

          <!-- ITEM --> 
          <a href="<?php echo BASE_ADMIN;?>encerrar-sessao" class="list-group-item"><i class="far fa-power-off"></i>Encerrar Sessão</a>
          
      </ul>
    </div>
</div>

<nav class="navbar navbar-one fixed-top">
  <div class="container-fluid">
    <div class="items">
        <a href="<?php echo BASE_ADMIN;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">
                <a href="<?php echo BASE_ADMIN;?>" class="btn btn-one open-sidebar-one me-2"><i class="far fa-home m-0"></i></a>
            </li>
            <li class="list-group-item hide">
                <button class="btn btn-one open-sidebar-one" type="button"><i class="far fa-bars open-sidebar-left-icon m-0"></i></button>
            </li>
        </ul>
    </div>
  </div> 
</nav>   


 