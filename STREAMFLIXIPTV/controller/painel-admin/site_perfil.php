<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/painel-admin/admin_controller.php';


if(!isset($_POST['acao']) OR empty($_POST['acao'])){
    die_error("Não foi possível concluir esta ação.");
}

if ($_POST['acao'] == 'site-smtp') {
    if ( 
        !isset($_POST['smtp_user']) OR 
        !isset($_POST['smtp_senha']) OR
        !isset($_POST['smtp_email']) OR
        !isset($_POST['smtp_porta']) OR
        !isset($_POST['smtp_host'])) {
        die_error("Preencha todos os campos.");
    }


    $smtp_user  = !empty($_POST['smtp_user'])   ? trim($_POST['smtp_user'])         : NULL;
    $smtp_senha = !empty($_POST['smtp_senha'])  ? $_POST['smtp_senha']              : NULL;
    $smtp_email = !empty($_POST['smtp_email'])  ? trim($_POST['smtp_email'])        : NULL;
    $smtp_porta = !empty($_POST['smtp_porta'])  ? trim($_POST['smtp_porta'])        : NULL;
    $smtp_host  = !empty($_POST['smtp_host'])   ? trim($_POST['smtp_host'])         : NULL;

    //ADICIONAR / EDITAR 
    if (!site_smtp_editar($smtp_user, $smtp_senha, $smtp_email, $smtp_porta, $smtp_host)) {
        die_error("Não foi possível salvar.");
    }

    die_success_reload("Informações salvas.");
}


if($_POST['acao'] == 'site-perfil') {
    if (!isset($_POST['site_nome']) OR empty($_POST['site_nome']) OR
        !isset($_POST['site_keywords']) OR empty($_POST['site_keywords']) OR
        !isset($_POST['site_descricao']) OR empty($_POST['site_descricao']) OR 
        !isset($_POST['site_whatsapp']) OR !isset($_POST['site_telegram']) OR
        !isset($_POST['site_cache']) OR !is_numeric($_POST['site_cache']) OR 
        !isset($_POST['site_token_mp']) OR empty($_POST['site_token_mp'])) {
        die_error("Preencha todos os campos.");
    }

    $site_nome               = trim(ucwords($_POST['site_nome']));
    $site_keywords           = trim($_POST['site_keywords']);
    $site_descricao          = trim($_POST['site_descricao']);
    $site_whatsapp           = !empty($_POST['site_whatsapp']) ? (valida_whatsapp_telegram($_POST['site_whatsapp']) ? $_POST['site_whatsapp']  : die_error("O número do whatsapp é inválido.")) : NULL;
    $site_telegram           = !empty($_POST['site_telegram']) ? (valida_whatsapp_telegram($_POST['site_telegram']) ? $_POST['site_telegram']  : die_error("O número do telegram é inválido.")) : NULL;
    $site_cache              = trim($_POST['site_cache']);
    $site_token_mp           = trim($_POST['site_token_mp']);


    if(!site_perfil_editar($site_nome, $site_descricao, $site_keywords, $site_whatsapp, $site_telegram, $site_token_mp, $site_cache)){
         die_error("Não foi possível salvar."); 
    }

    die_success_reload("Informações Salvas.");
}

if($_POST['acao'] == 'site-imagens'){

    $site_imagens = 0;

    if(isset($_FILES['site_logo']) && !empty($_FILES['site_logo']['tmp_name'])){

        $img = upload_imagem($_FILES['site_logo']);

        site_perfil_images($img['name'], "site_logo");

        if(is_dir(BASE_IMAGES_PATCH.'system/')){
            @move_uploaded_file($img['tmp_name'], BASE_IMAGES_PATCH.'system/'.$img['name']);
        }
        if(file_exists(BASE_IMAGES_PATCH.'system/'.SITE_LOGO)){
            @unlink(BASE_IMAGES_PATCH.'system/'.SITE_LOGO);
        }

        $site_imagens++;

    }

    if(isset($_FILES['site_favicon']) && !empty($_FILES['site_favicon']['tmp_name'])){

        $img = upload_imagem($_FILES['site_favicon']);

        site_perfil_images($img['name'], "site_favicon");

        if(is_dir(BASE_IMAGES_PATCH.'system/')){
            @move_uploaded_file($img['tmp_name'], BASE_IMAGES_PATCH.'system/'.$img['name']);
        }
        if(file_exists(BASE_IMAGES_PATCH.'system/'.SITE_FAVICON)){
            @unlink(BASE_IMAGES_PATCH.'system/'.SITE_FAVICON);
        }

        $site_imagens++;
    }

    if(isset($_FILES['site_avatar']) && !empty($_FILES['site_avatar']['tmp_name'])){

        $img = upload_imagem($_FILES['site_avatar']);

        site_perfil_images($img['name'], "site_avatar");

        if(is_dir(BASE_IMAGES_PATCH.'system/')){
            @move_uploaded_file($img['tmp_name'], BASE_IMAGES_PATCH.'system/'.$img['name']);
        }
        if(file_exists(BASE_IMAGES_PATCH.'system/'.SITE_AVATAR)){
            @unlink(BASE_IMAGES_PATCH.'system/'.SITE_AVATAR);
        }

        $site_imagens++;
    }

    if(isset($_FILES['site_background_user']) && !empty($_FILES['site_background_user']['tmp_name'])){

        $img = upload_imagem($_FILES['site_background_user']);

        site_perfil_images($img['name'], "site_background_user");

        if(is_dir(BASE_IMAGES_PATCH.'system/')){
            @move_uploaded_file($img['tmp_name'], BASE_IMAGES_PATCH.'system/'.$img['name']);
        }
        if(file_exists(BASE_IMAGES_PATCH.'system/'.SITE_BACKGROUND_USER)){
            @unlink(BASE_IMAGES_PATCH.'system/'.SITE_BACKGROUND_USER);
        }

        $site_imagens++;
    } 

    if(isset($_FILES['site_background_public']) && !empty($_FILES['site_background_public']['tmp_name'])){

        $img = upload_imagem($_FILES['site_background_public']);

        site_perfil_images($img['name'], "site_background_public");

        if(is_dir(BASE_IMAGES_PATCH.'system/')){
            @move_uploaded_file($img['tmp_name'], BASE_IMAGES_PATCH.'system/'.$img['name']);
        }
        if(file_exists(BASE_IMAGES_PATCH.'system/'.SITE_BACKGROUND_PUBLIC)){
            @unlink(BASE_IMAGES_PATCH.'system/'.SITE_BACKGROUND_PUBLIC);
        }

        $site_imagens++;
    }

    die_success_reload($site_imagens == 1 ? $site_imagens . " Imagem Foi atualizada." : $site_imagens. " Imagens Foram atualizadas.");
}
