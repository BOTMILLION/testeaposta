<?php 
function valida_nome($input){
    if(preg_match("/^[A-Za-zà-ÿ-Á-Ÿ ]*$/", $input)){
    	return true;
    }
}
function valida_apelido($input){
    if(preg_match("/^[0-9A-Za-zà-ÿ-Á-Ÿ ]*$/", $input)){
    	return true;
    }
}

function valida_whatsapp_telegram($input){
    $input = str_replace('-', '', $input);
    $input = str_replace('(', '', $input);
    $input = str_replace(')', '', $input);
    $input = str_replace('+', '', $input);
    $input = str_replace(' ', '', $input);
	
    if(preg_match("/^[0-9]*$/", $input) && strlen($input) == 13){
      return true;
    }

} 

function valida_email($input){
	if(filter_var($input, FILTER_VALIDATE_EMAIL)){
		return true;
	}
}

function valida_senha($senha){
	if(strlen($senha) >= 6){
        return true;
	}
}

function valida_preco($input){
    if(preg_match("/^[0-9.,]*$/", $input)){
	    return true;
	}
}

function whatsapp_telegram_limpar($whatsapp_telegram){
    $whatsapp_telegram = str_replace('-', '', $whatsapp_telegram);
    $whatsapp_telegram = str_replace('(', '', $whatsapp_telegram);
    $whatsapp_telegram = str_replace(')', '', $whatsapp_telegram);
    $whatsapp_telegram = str_replace('+', '', $whatsapp_telegram);
    $whatsapp_telegram = str_replace(' ', '', $whatsapp_telegram);
    return $whatsapp_telegram;
}