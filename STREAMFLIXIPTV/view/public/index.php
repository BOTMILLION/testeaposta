<?php require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/public/index.php';?>

<!doctype html>
<html lang="PT-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="<?php echo SITE_DESCRICAO;?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS;?>">
    <link rel="icon" href="<?php echo BASE_IMAGES_URL.'system/'.SITE_FAVICON;?>">
    <!-- PLUGINS --> 
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>bootstrap/css/bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>splide/splide.min.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <!-- PLUGINS --> 
    <!-- CSS --> 
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/global.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/navbar.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/button.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>public/public.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <!-- CSS -->
    <title><?php echo isset($page_title) ? $page_title . ' ' . SITE_NOME : SITE_NOME;?></title>
</head>
<body class="body" style="background-image: url(<?php echo BASE_IMAGES_URL.'system/'.SITE_BACKGROUND_PUBLIC;?>); background-color: rgba(0, 0, 0, 0.8); background-blend-mode: overlay;min-height: 100vh; height:100vh;background-size: cover; background-repeat:no-repeat;">
 
<nav class="navbar navbar-one navbar-public fixed-top m-0">
  <div class="container">
    <div class="items">
        <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>"></a>
        <ul class="list-group list-group-horizontal">
          <a href="<?php echo BASE_USER;?>login" class="list-group-item pe-3 fw-bold"><i class="fas fa-user-shield me-1"></i>Login</a>
          <a href="<?php echo BASE_USER;?>cadastro" class="list-group-item pe-0 fw-bold"><i class="fas fa-user-plus me-1"></i>Cadastro</a>
        </ul>
    </div>
  </div> 
</nav>      
 

<div class="container">
    <div class="section-0">
        <h1 class="mb-3">Filmes, Novelas, Séries, Canais Sem Limites!</h1>
        <p class="mb-0">Quer assistir ?</p>
        <p class="mb-0">Acesse ou crie a sua conta agora mesmo.</p>
    </div>
</div>

<div class="container pb-3">
    <div class="section-1">
        <h1 class="text-center mb-3">Nossos Planos</h1>
        <div class="splide premium_home">
            <div class="splide__track" style="border-radius: 5px;">
                <ul class="splide__list">
            
                        <?php foreach(premium_listar(0) as $item):?>
                        <div class="premium-item splide__slide">
                            <div class="top-circle">
                                <h4>R$ <?php echo number_format($item['premium_preco'], 2, ',', '.');?></h4>
                            </div>
                            <h5 class="tela"><?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . " Tela " : $item['premium_telas'] . " Telas " ;?></h5>
                            <ul class="list-group">
                                <li class="list-group-item">Assista em <?php echo $item['premium_dias'] == 1 ? $item['premium_dias'] . " Dia Acesso Premium " : $item['premium_dias'] . " Dias Acesso Premium " ;?></li>
                                <li class="list-group-item">Assista em <?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . " Dispositivo " : $item['premium_telas'] . " Dispositivos ";?></li>
                                <li class="list-group-item">Canais Filmes Séries Ilimitados</li>
                                <li class="list-group-item">Qualidade HD, FULL HD, 4K</li>
                            </ul>
                            <div class="footer">
                                <a href="<?php echo BASE_USER;?>login" class="btn btn-one btn-comprar" data-id="<?php echo $item['premium_id'];?>"><i class="far fa-shopping-bag me-2"></i>Comece agora mesmo</a>
                            </div>
                        </div>
                        <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div> 



<script src="<?php echo BASE_PLUGINS;?>bootstrap/js/bootstrap.bundle.min.js?site_cache=<?php echo SITE_CACHE;?>"></script>
<script src="<?php echo BASE_PLUGINS;?>jquery/jquery.js?site_cache=<?php echo SITE_CACHE;?>"></script>
<script src="<?php echo BASE_PLUGINS;?>splide/splide.min.js?site_cache=<?php echo SITE_CACHE;?>"></script>
<script src="<?php echo BASE_PLUGINS;?>splide/splide-public.js?site_cache=<?php echo SITE_CACHE;?>"></script>

</body>
</html>