<?php 
function user_template_recuperar_senha($user_nome, $hash, $recuperar_data_formatado){     

    return '<!doctype html>
    <html lang="pt-BR">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>'.SITE_NOME.' Recuperar Senha</title>
        <style media="all" type="text/css">
  
    </style>
      </head>
      <body style="width: 100%;"> 
        <div style="background-color:rgb(41,46,57); border: 5px solid #5c51ff; border-radius:10px; text-align: center; width: 100%; max-width: 500px; margin: auto;">    
                <div style="padding-top:30px; padding-bottom:30px;">
                    <div style="text-align: center;">
                        <h1 style="color: rgb(149,159,185);">'.SITE_NOME.'</h1> 
                        <h3 style="color: rgb(149,159,185);">Recuperar Senha</h3> 
                    </div>
                    <div style="text-align: center;">
                        <p style="margin-bottom:0px; color: rgb(149,159,185);">Olá '.$user_nome.'</p> 
                        <p style="margin-bottom:0px; color: rgb(149,159,185);">Você solicitou um link de recuperação de senha em nosso site.</p> 
                        <p style="margin-bottom:0px; color: rgb(149,159,185);">Se não foi você quem solicitou, desconsiderar este email.</p> 
                        <p style="margin-bottom:0px; color: rgb(149,159,185);">O link expira em: '.$recuperar_data_formatado.'</p> 
                        <p style="margin-bottom:0px; color: rgb(149,159,185);">Click no botão abaixo para alterar sua senha.</p> 
                        <a href="'.BASE_USER.'alterar-senha/'.$hash.'"
                            style="background-color: #5c51ff; color:#fff;padding:10px; border-radius:5px; display:block; width:300px; margin:auto; margin-top:20px; text-decoration:none;">Recuperar Senha</a>
                    </div>
                </div>
        </div>
      </body>
    </html>';
    
}