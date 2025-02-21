<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/stream/stream_busca.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/navbar.php';
?>

<div class="page-content">
    <div class="container-fluid mb-3">

        <div class="card card-page-title">
            <div class="card-body">
                <h6>Busca</h6>
                <small><?php echo ucwords($busca);?></small>
                <small><?php echo  $stream_busca['stream_total'];?> Resultados</small>
            </div>
        </div>
 
        <div class="stream-list"> 
            <?php foreach($stream_busca['stream'] as $item):?>
                <?php if($item->stream_type == 'movie'):?>
                    <a href="<?php echo BASE_STREAM.'movie/'.$item->stream_id;?>" class="item">
                        <img src="<?php echo $item->stream_icon;?>" class="img-fluid">  
                    </a>
                <?php elseif($item->stream_type == 'series'):?>
                    <a href="<?php echo BASE_STREAM.'series/'.$item->series_id;?>/0" class="item">
                        <img src="<?php echo $item->cover;?>" class="img-fluid">  
                    </a>         
                <?php elseif($item->stream_type == 'live'):?>
                    <a href="<?php echo BASE_STREAM.'live/'.$item->stream_id;?>" class="item">
                        <img src="<?php echo $item->stream_icon;?>" class="img-fluid">  
                    </a>
                <?php endif;?>    
            <?php endforeach;?> 
        </div>

        <div class="d-flex pt-3 pb-3">
            <?php if($total_paginas > 1):?>
                <a href="<?php echo BASE_STREAM.$_GET['stream_type'].'/categoria/'.$_GET['category_id'].'/pagina/'.$_GET['pagina'] - 1;?>" class="btn btn-one me-auto"><i class="far fa-arrow-left me-2"></i>Página Anterior</a>
            <?php endif;?>
            <?php if($_GET['pagina'] < $total_paginas):?>
                <a href="<?php echo BASE_STREAM.$_GET['stream_type'].'/categoria/'.$_GET['category_id'].'/pagina/'.$_GET['pagina'] + 1;?>" class="btn btn-one ms-auto">Próxima Página<i class="far fa-arrow-right ms-2"></i></a>
            <?php endif;?>
        </div>

 
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/footer.php';?>
