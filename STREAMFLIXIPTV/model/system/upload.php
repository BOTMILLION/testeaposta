<?php 
/*
  ============================== UPLOAD DE IMAGEM =================================
*/
function upload_imagem($array_image){
    
    $imgTmp   = $array_image['tmp_name'];
    $imgName  = $array_image['name'];
    $imgSize  = $array_image['size'];
    $imgType  = $array_image['type'];
    $imgErro  = $array_image['error'];
    $formato  = array("image/jpeg", "image/png") ;

    if($formato[0] == "image/jpeg"){
       $extensao = "jpg";
    }
    if($formato[1] == "image/png"){
       $extensao = "png";
    }
 
    $tamanho_permitido  = 5000000;

    if($imgSize > $tamanho_permitido){
         die_error("A imagem não pode ultrapassar o limite de 5 megas.");
    }
    if(!in_array($imgType, $formato)){
         die_error("Envie a  imagem no formato png ou jpg.");
    }
    if($imgErro != 0){
         die_error("Houve um erro com o envio da imagem.");
    } 

    $imgMd5Name = md5(md5(time().rand(0,999).$imgName)).'.'.$extensao;

    $res = array("name" => $imgMd5Name, "tmp_name" => $imgTmp);
    return $res;

}

function upload_arquivo($array){
    
  $tmp      = $array['tmp_name'];
  $name     = $array['name'];
  $size     = $array['size'];
  $type     = $array['type'];
  $error    = $array['error'];

  $extensao = explode(".", $name);
  $extensao = end($extensao);

  $array_permitido = array("application/pdf");

  if(in_array($extensao, $array_permitido)){
    die_error("O formato de arquivo .".$extensao." não é permitido.");
  }

  $tamanho_permitido  = 100000000;

  if($size > $tamanho_permitido){
       die_error("O tamanho máximo permitido de arquivos é 100 megas.");
  }

  if($error != 0){
       die_error("Houve um erro com o envio do arquivo.");
  } 

  $arquivo_name = md5(md5(time().rand(0,999).$name.$size.$type)).'.'.$extensao;

  $res = array("name" => $arquivo_name, "tmp_name" => $tmp);
  return $res;

}