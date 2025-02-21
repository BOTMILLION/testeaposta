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
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>datatables/datatables.css?site_cache=<?php echo SITE_CACHE;?>">
    <!-- PLUGINS --> 
    <!-- CSS --> 
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/global.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/button.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/form.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/modal.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/navbar.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/page.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/sidebar.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/table.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>user/user.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <!-- CSS -->
    <title><?php echo isset($page_title) ? $page_title . ' ' . SITE_NOME : SITE_NOME;?></title>
</head>
<body class="body-user-autenticar" style="background-image: url(<?php echo BASE_IMAGES_URL.'system/'.SITE_BACKGROUND_USER;?>); background-color: rgba(0, 0, 0, 0.8); background-blend-mode: overlay;min-height: 100vh; height:100vh;background-size: cover; background-repeat:no-repeat;">


<nav class="navbar navbar-one navbar-user fixed-top m-0">
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