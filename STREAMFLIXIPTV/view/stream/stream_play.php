<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/stream/stream_play.php';  
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/navbar.php';
?>
<?php if($movie):?>
<div class="page-content">
    <div class="container-fluid container-player">
      <video id="videojs-player" class="video-js"></video>
    </div>
    <div class="container-fluid container-player-info pb-3">
        <div class="movie-tv-info">
            <h4 class="title mb-1"><?php echo isset($movie->info->name) ? $movie->info->name : '';?></h4>
            <div class="info-box">
              <div class="small-box">
                  <?php if(isset($movie->info->release_date)):?>
                    <small class="d-block">Ano <?php echo explode('-',$movie->info->release_date)[0];?></small>
                  <?php endif;?>
                  <?php if(isset($movie->info->duration)):?>
                    <small class="d-block">Tempo <?php echo stream_duration($movie->info->duration);?></small>
                  <?php endif;?>
              </div>
              <div>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" class="btn btn-one" id="stream_lista"><i class="far <?php echo $stream_lista_get ? 'fa-heart' : 'fa-plus' ;?>"></i>Minha Lista</button>
                  </div>
              </div>
            </div>
            <small class="d-block">Sinopse</small>
            <small class="d-block"><?php echo isset($movie->info->description) ? $movie->info->description : '';?></small>
        </div>
    </div>
</div>

<div id="stream-info" class="d-none" data-acao="movie_play" data-type="movie" data-image="<?php echo isset($movie->info->movie_image) ? $movie->info->movie_image : '';?>" data-id="<?php echo $_GET['stream_id'];?>" data-episodio="0"></div>

<?php endif;?>




<?php if($live):?>

  <div class="page-content">
    <div class="container-fluid container-player">
      <video id="videojs-player" class="video-js"></video>
    </div>
    <div class="container-fluid container-player-info pb-3">
        <div class="movie-tv-info">
            <h4 class="title mb-1"><?php echo isset($live->movie_data->name) ? $live->movie_data->name : '';?></h4>
            <div class="info-box">
              <div class="small-box">
                <small class="d-block">Transmissão ao vivo</small>  
              </div>
              <div>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                      <button type="button" class="btn btn-one" id="stream_lista"><i class="far <?php echo $stream_lista_get ? 'fa-heart' : 'fa-plus' ;?>"></i>Minha Lista</button>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div> 

<div id="stream-info" class="d-none" data-acao="live_play" data-type="live" data-image="<?php echo BASE_IMAGES_URL.'system/live.png';?>" data-id="<?php echo $_GET['stream_id'];?>" data-episodio="0"></div>


<?php endif;?>  



<?php if($series):?>


  <div class="page-content">
    <div class="container-fluid container-player">
      <video id="videojs-player" class="video-js"></video>
    </div>
    <div class="container-fluid container-player-info pb-3">
        <div class="d-flex pt-2">
            <?php if($_GET['episodio'] -1 > 0):?>
                <a href="<?php echo BASE_STREAM.'series/'.$_GET['stream_id'].'/'.($_GET['episodio']-1);?>" class="btn btn-sm btn-one me-auto"><i class="far fa-arrow-left me-2"></i>Anterior</a>
            <?php endif;?>
            <?php if($_GET['episodio'] < count($episodios['episodios']) -1):?>
                <a href="<?php echo BASE_STREAM.'series/'.$_GET['stream_id'].'/'.($_GET['episodio']+1);?>" class="btn btn-sm btn-one ms-auto">Próximo<i class="far fa-arrow-right ms-2"></i></a>
            <?php endif;?>
        </div>
        <div class="movie-tv-info">
            <h4 class="title mb-1"><?php echo isset($series->info->name) ? $series->info->name : '';?></h4>
            <div class="info-box"> 
              <div class="small-box">
                  <small class="d-block">Temporada <?php echo isset($episodio->season) ? $episodio->season : '';?> Episódio <?php echo isset($episodio->episode_num) ? $episodio->episode_num : '';?></small>
                  <?php if(isset($episodio->info->duration)):?>
                    <small class="d-block">Tempo <?php echo stream_duration($episodio->info->duration);?></small>
                  <?php endif;?>
                  <?php if(isset($series->info->releaseDate)):?>
                    <small class="d-block">Ano <?php echo explode('-',$series->info->releaseDate)[0];?></small>
                  <?php endif;?>
              </div>
              <div>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" class="btn btn-one" id="stream_lista"><i class="far <?php echo $stream_lista_get ? 'fa-heart' : 'fa-plus' ;?>"></i>Minha Lista</button>
                  </div>
              </div>
            </div>
            <small class="d-block">Sinopse</small>
            <small class="d-block"><?php echo isset($series->info->plot) ? $series->info->plot : '';?></small>  
        </div>
    </div>
 
    <div class="container-fluid container-player-temp pb-3">
    <div class="content" id="accordion-temp">
      <ul class="list-group child-one list-group-flush">

          
          <!-- ITEM -->
          <?php for($i=1; $i<= $episodios['temporadas']; $i++):?>
          <div class="accordion accordion-flush accordion-episodios" id="accordion-temp-<?php echo $i;?>"> 
              <div class="accordion-item border-0">
                  <div class="accordion-header">
                      <div class="accordion-button border-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-temp-<?php echo $i;?>" aria-expanded="false" 
                          aria-controls="collapse-temp-<?php echo $i;?>">
                          <div class="title">Temporada <?php echo $i;?></div>
                      </div>
                  </div>
                  <div id="collapse-temp-<?php echo $i;?>" class="accordion-collapse collapse" data-bs-parent="#accordion-temp">
                      <div class="accordion-body">
                          <ul class="list-group child-two list-group-flush">
                             <?php foreach($episodios['episodios'] as $key => $ep):?>
                                    <?php if($ep->season == $i):?>
                                    <a href="<?php echo BASE_STREAM.'series/'.$_GET['stream_id'].'/'.$key;?>" class="list-group-item">
                                        <small class="d-block">Episódio <?php echo $ep->episode_num;?></small>
                                        <small class="d-block"><?php echo stream_duration($ep->info->duration);?></small>
                                    </a>
                                    <?php endif;?>
                             <?php endforeach;?>   
                          </ul>
                      </div>
                  </div>
              </div> 
          </div>
          <?php endfor;?>   
          <!-- ITEM -->
          
          
      </ul>
    </div>
    </div>             



</div>


<div id="stream-info" class="d-none" data-acao="series_play" data-type="series" data-image="<?php echo $series->info->cover;?>" data-id="<?php echo $_GET['stream_id'];?>" data-episodio="<?php echo $_GET['episodio'];?>"></div>


<?php endif;?>  



<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/footer.php';?>
<script src="<?php echo BASE_JS;?>stream/stream_play.js"></script>
