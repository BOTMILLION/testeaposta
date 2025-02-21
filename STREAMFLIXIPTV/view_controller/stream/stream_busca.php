<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';
if(!isset($_GET['stream_busca']) OR empty($_GET['stream_busca']) OR !isset($_GET['pagina']) OR !intval($_GET['pagina'])){
    die(header("Location:".BASE_STREAM));
}


$busca  = str_replace('-', ' ', $_GET['stream_busca']);
$stream_busca = stream_busca($busca, $_GET['pagina']);
$total_paginas = round($stream_busca['stream_total'] / SITE_PAGINACAO);

if($_GET['pagina'] > $total_paginas && $total_paginas > 0){
    die(header("Location:".BASE_STREAM.'busca/'.$_GET['stream_busca'].'/pagina/'. 1));
}