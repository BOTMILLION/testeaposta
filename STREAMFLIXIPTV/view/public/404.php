<?php  require_once $_SERVER['DOCUMENT_ROOT'].'/view_controller/public/404.php'; ?>
<!doctype html>
<html lang="PT-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo BASE_IMAGES_URL.'system/'.SITE_FAVICON;?>">
    <!-- PLUGINS --> 
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>bootstrap/css/bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <!-- PLUGINS --> 
    <!-- CSS --> 
    <link rel="stylesheet" href="<?php echo BASE_CSS;?>global/global.css?site_cache=<?php echo SITE_CACHE;?>"/>
    <!-- CSS -->
    <title><?php echo SITE_NOME;?> 404</title>
</head>
<body class="body" style="background-image: url(<?php echo BASE_IMAGES_URL.'system/'.SITE_BACKGROUND_PUBLIC;?>); background-color: rgba(0, 0, 0, 0.8); background-blend-mode: overlay; min-height: 100vh; height:100vh;background-size: cover; background-repeat:no-repeat;">

<div class="container">
    <div class="d-flex justify-content-center align-items-center flex-column w-100 vh-100">
        <div class="card w-100" style="max-width: 500px;">
            <div class="card-body text-center" style="background-color: rgb(41,46,57);">
                <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo BASE_IMAGES_URL.'system/'.SITE_LOGO;?>" style="max-height: 50px;"></a>
                <h1 class="fw-bold">404</h1>
                <h4 class="pb-2 fw-bold">A página não existe.</h4>
                <a href="<?php echo SITE_URL;?>"><i class="far fa-home me-2"></i>Retornar a página inicial</a>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_PLUGINS;?>bootstrap/js/bootstrap.bundle.min.js?site_cache=<?php echo SITE_CACHE;?>"></script>
</body>
</html>