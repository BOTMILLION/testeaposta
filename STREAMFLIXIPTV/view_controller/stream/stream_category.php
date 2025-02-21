<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/cliente/cliente_controller.php';

if(!isset($_GET['stream_type']) OR !isset($_GET['category_id']) OR !isset($_GET['pagina']) OR !intval($_GET['category_id']) OR !intval($_GET['pagina']) OR
   $_GET['stream_type'] != 'movie' && $_GET['stream_type'] != 'series' && $_GET['stream_type'] != 'live'){
    die(header("Location:".BASE_STREAM));
}
$stream_type    = $_GET['stream_type'];
$category       = get_stream_by_category($stream_type, $_GET['category_id'], $_GET['pagina']);
$total_paginas = round($category['stream_total'] / SITE_PAGINACAO);

if($_GET['pagina'] > $total_paginas && $total_paginas > 0){
    die(header("Location:".BASE_STREAM.$_GET['stream_type'].'/categoria/'.$_GET['category_id'].'/pagina/'. 1));
}
$page_title = stream_type_tradutor($_GET['stream_type'], "plural");
$category_type = stream_type_tradutor($_GET['stream_type'], "plural");
