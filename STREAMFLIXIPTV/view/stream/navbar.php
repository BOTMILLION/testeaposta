<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/stream/navbar.php';?>
<div class="sidebar-one">
    <div class="top"> 
        <div class="avatar">
            <a href="<?php echo BASE_STREAM;?>"><img src="<?php echo BASE_IMAGES_URL.'avatar-perfil/'.$cliente_perfil['cliente_perfil_avatar'];?>"></a>
        </div>
        <div class="info">
            <small><?php echo $cliente_perfil['cliente_perfil_apelido'];?></small>
            <?php if($cliente_is_premium):?>
                <small class="text-green">Premium Ativo</small>
            <?php else:?>    
                <small class="text-red">Premium Inativo</small>
            <?php endif;?>
        </div>
        <form id="form-public-busca" class="form-public-busca" autocomplete="off"> 
            <div class="form-group">
                <div class="input-group"> 
                    <input type="text" class="form-control" name="input-public-busca" placeholder="Buscar...">
                    <span type="submit" class="input-group-text cursor-pointer" id="submit-public-busca"><i class="far fa-search"></i></span>
                </div>
            </div>
        </form>  
    </div>
    <div class="content" id="accordion-group">
      <ul class="list-group child-one list-group-flush">
          <!-- ITEM --> 
          <a href="<?php echo BASE_STREAM;?>" class="list-group-item"><i class="far fa-home"></i>Início</a>

          <!-- ITEM --> 
          <div class="accordion accordion-flush" id="accordion-fil"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-fil" aria-expanded="false" aria-controls="collapse-fil">
                          <div class="icon"><i class="far fa-video"></i></div>
                          <div class="title">Filmes</div>
                      </div>
                  </div>
                  <div id="collapse-fil" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body"> 
                          <ul class="list-group child-two list-group-flush">
                              
                              <?php foreach($movie_categories as $nav_fil):?>  
                                <?php $n_fil_name = strtolower(str_replace('|', '',$nav_fil->category_name));?>
                                <?php 
                                    if(isset($_GET['category_id']) && $_GET['category_id'] == $nav_fil->category_id){
                                            $category_page_title = stream_categorie_title($n_fil_name);
                                    }
                                ?>
                                <a href="<?php echo BASE_STREAM.'movie/categoria/'.$nav_fil->category_id;?>/pagina/1" class="list-group-item">
                                    <?php echo stream_categorie_title($n_fil_name);?>
                                </a>
                              <?php endforeach;?>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>


          <!-- ITEM --> 
          <div class="accordion accordion-flush" id="accordion-ser"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ser" aria-expanded="false" aria-controls="collapse-ser">
                          <div class="icon"><i class="far fa-video"></i></div>
                          <div class="title">Séries</div>
                      </div>
                  </div>
                  <div id="collapse-ser" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                            <?php foreach($series_categories as $nav_ser):?>  
                                <?php $n_ser_name = strtolower(str_replace('|', '',$nav_ser->category_name));?>
                                <?php 
                                    if(isset($_GET['category_id']) && $_GET['category_id'] == $nav_ser->category_id){
                                            $category_page_title =  stream_categorie_title($n_ser_name);
                                    }
                                ?>
                                <a href="<?php echo BASE_STREAM.'series/categoria/'.$nav_ser->category_id;?>/pagina/1" class="list-group-item">
                                    <?php echo stream_categorie_title($n_ser_name);?>
                                </a>
                            <?php endforeach;?>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          
          <!-- ITEM -->
          <div class="accordion accordion-flush" id="accordion-can"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-can" aria-expanded="false" aria-controls="collapse-can">
                          <div class="icon"><i class="far fa-video"></i></div>
                          <div class="title">Tv Ao Vivo</div>
                      </div>
                  </div>
                  <div id="collapse-can" class="accordion-collapse collapse" data-bs-parent="#accordion-group">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                            <?php foreach($live_categories as $nav_can):?>  
                                <?php $n_can_name = strtolower(str_replace('|', '',$nav_can->category_name));?>
                                <?php 
                                    if(isset($_GET['category_id']) && $_GET['category_id'] == $nav_can->category_id){
                                            $category_page_title = stream_categorie_title($n_can_name);
                                    }
                                ?>
                                <a href="<?php echo BASE_STREAM.'live/categoria/'.$nav_can->category_id;?>/pagina/1" class="list-group-item">
                                    <?php echo stream_categorie_title($n_can_name);?>
                                </a>
                            <?php endforeach;?>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>

          <!-- ITEM --> 
          <a href="<?php echo BASE_STREAM.'premium';?>" class="list-group-item"><i class="far fa-crown"></i>Planos Premium</a>

          <!-- ITEM --> 
          <a href="<?php echo BASE_CLIENTE.'perfil-selecionar';?>" class="list-group-item"><i class="far fa-exchange-alt"></i>Trocar Perfil</a>

          <!-- ITEM --> 
          <a href="<?php echo BASE_CLIENTE;?>" class="list-group-item"><i class="far fa-user-circle"></i>Minha Conta</a>

          <!-- ITEM --> 
          <a href="<?php echo BASE_CLIENTE.'encerrar-sessao';?>" class="list-group-item"><i class="far fa-power-off"></i>Encerrar Sessão</a>
          
          
      </ul>
    </div>
    <div class="footer">
        <div class="footer-items">
            <div class="text-center">
                
            </div>
        </div> 
    </div>
</div>


<nav class="navbar navbar-one fixed-top">
  <div class="container-fluid">
    <div class="items">
        <a href="<?php echo BASE_STREAM;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item hide">
                <button class="btn btn-one open-sidebar-one" type="button"><i class="far fa-bars open-sidebar-left-icon m-0"></i></button>
            </li>
        </ul>
    </div>
  </div> 
</nav>   