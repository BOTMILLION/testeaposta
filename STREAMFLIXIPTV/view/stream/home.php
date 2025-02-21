<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/stream/home.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/navbar.php';
?>
<div class="page-content">

    <?php if(count($stream_assistindo_cache) > 0):?>
        <div class="container-fluid mb-2"> 
            <div class="splide-lista">  
                <div class="splide splide_home">
                    <div class="splide-title">
                        <h5><i class="far fa-clock me-2"></i>Continuar Assistindo</h5>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">

                        <?php foreach($stream_assistindo_cache as  $con_assis):?>
                            <?php if($con_assis->stream_type == 'series'):?>
                            
                                <a href="<?php echo BASE_STREAM.'series/'.$con_assis->series_id.'/'.$con_assis->stream_assistindo_stream;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->cover;?>" class="img-fluid">  
                                </a>

                            <?php endif;?> 

                            <?php if($con_assis->stream_type == 'movie'):?>

                                <a href="<?php echo BASE_STREAM.'movie/'.$con_assis->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->stream_icon;?>" class="img-fluid">  
                                </a>

                            <?php endif;?> 

                            <?php if($con_assis->stream_type == 'live'):?>
                            
                                <a href="<?php echo BASE_STREAM.'live/'.$con_assis->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->stream_icon;?>" class="img-fluid">  
                                </a>

                            <?php endif;?>    

                        <?php endforeach;?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

    <?php if(count($stream_minha_lista) > 0):?>
        <div class="container-fluid mb-2"> 
            <div class="splide-lista">  
                <div class="splide splide_home">
                    <div class="splide-title">
                        <h5><i class="far fa-heart me-2"></i>Minha Lista</h5>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">

                        <?php foreach($stream_minha_lista as  $con_assis):?>
                            <?php if($con_assis->stream_type == 'series'):?>
                            
                                <a href="<?php echo BASE_STREAM.'series/'.$con_assis->series_id.'/';?>0" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->cover;?>" class="img-fluid">  
                                </a>

                            <?php endif;?> 

                            <?php if($con_assis->stream_type == 'movie'):?>

                                <a href="<?php echo BASE_STREAM.'movie/'.$con_assis->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->stream_icon;?>" class="img-fluid">  
                                </a>

                            <?php endif;?> 

                            <?php if($con_assis->stream_type == 'live'):?>
                            
                                <a href="<?php echo BASE_STREAM.'live/'.$con_assis->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $con_assis->stream_icon;?>" class="img-fluid">  
                                </a>

                            <?php endif;?>    

                        <?php endforeach;?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

    <div class="container-fluid mb-2"> 

        <?php foreach(get_stream_category_home('vod_categories', $stream_cache_get) as $a_fil):?>
            <?php $a_fil_total =  get_stream_by_category_home("movie", $a_fil->category_id, 1, 20)['stream'];?>
            <?php if(count($a_fil_total) >= 10):?>
            <div class="splide-lista">  
                <div class="splide splide_home">
                    <div class="splide-title">
                        <h5><a href="<?php echo BASE_STREAM.'movie/categoria/'.$a_fil->category_id;?>/pagina/1"><i class="far fa-plus me-2"></i>Filmes <?php echo stream_categorie_title($a_fil->category_name);?></a></h5>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php foreach($a_fil_total as  $m_mov):?>
                                
                                <a href="<?php echo BASE_STREAM.'movie/'.$m_mov->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $m_mov->stream_icon;?>" class="img-fluid">  
                                </a>
 
                            <?php endforeach;?>

                        </ul>
                    </div>
                </div>
            </div>
        <?php endif;?>         
        <?php endforeach;?>    

    </div>


    <div class="container-fluid mb-2"> 

        <?php foreach(get_stream_category_home('series_categories', $stream_cache_get) as $b_fil):?>
            <?php $b_fil_count_total = get_stream_by_category_home("series", $b_fil->category_id, 1, 20)['stream'];?>
            <?php if(count($b_fil_count_total) >= 10):?>
            <div class="splide-lista">  
                <div class="splide splide_home">
                    <div class="splide-title">
                        <h5><a href="<?php echo BASE_STREAM.'series/categoria/'.$b_fil->category_id;?>/pagina/1"><i class="far fa-plus me-2"></i>Séries <?php echo stream_categorie_title($b_fil->category_name);?></a></h5>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php foreach($b_fil_count_total as  $s_ser):?>
                                
                                <a href="<?php echo BASE_STREAM.'series/'.$s_ser->series_id;?>/0" class="splide__slide splide-item-image">
                                    <img src="<?php echo $s_ser->cover;?>" class="img-fluid">  
                                </a>
 
                            <?php endforeach;?>

                        </ul>
                    </div>
                </div>
            </div>
        <?php endif;?>                        
        <?php endforeach;?>    

    </div>

    <div class="container-fluid mb-2"> 

        <?php foreach(get_stream_category_home('live_categories',$stream_cache_get) as $c_fil):?>
            <?php $c_fil_count_total = get_stream_by_category_home("live", $c_fil->category_id, 1, 20)['stream'];?>
            <?php if(count($c_fil_count_total) >= 10):?>
            <div class="splide-lista">  
                <div class="splide splide_home">
                    <div class="splide-title">
                        <h5><a href="<?php echo BASE_STREAM.'live/categoria/'.$c_fil->category_id;?>/pagina/1"><i class="far fa-plus me-2"></i>Ao Vivo <?php echo stream_categorie_title($c_fil->category_name);?></a></h5>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php foreach($c_fil_count_total as  $c_can):?>
                                
                                <a href="<?php echo BASE_STREAM.'live/'.$c_can->stream_id;?>" class="splide__slide splide-item-image">
                                    <img src="<?php echo $c_can->stream_icon;?>" class="img-fluid" style="max-height:60px;margin:auto;min-height:60px;margin-top:10px; padding: 5px;padding-left:10px;padding-right:10px;">  
                                    <div class="mt-2" style="padding:5px">
                                        <small><?php echo stream_live_title($c_can->name);?></small>
                                    </div>
                                </a>
 
                            <?php endforeach;?>

                        </ul>
                    </div>
                </div>
            </div>
        <?php endif;?>                        
        <?php endforeach;?>    

    </div>

    
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view/stream/footer.php';?>
