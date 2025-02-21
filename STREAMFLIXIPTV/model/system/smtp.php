<?php 
function site_smtp_get(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM site_smtp LIMIT 1");
    $v->execute();
    return $v->fetch();
}

function site_smtp_editar($smtp_user, $smtp_senha, $smtp_email, $smtp_porta, $smtp_host){
    global $pdo;
    
    // INSERIR INFORMAÇÕES DO SERVIDOR
    if(empty(site_smtp_get())):

        $edt = $pdo->prepare("INSERT site_smtp SET 
                              smtp_user  = (:smtp_user),
                              smtp_senha = (:smtp_senha),
                              smtp_email = (:smtp_email),
                              smtp_porta = (:smtp_porta),
                              smtp_host  = (:smtp_host)");

    //EDITAR INFORMAÇÕES DO SERVIDOR
    else:

        $edt = $pdo->prepare("UPDATE site_smtp SET 
                              smtp_user  = (:smtp_user),
                              smtp_senha = (:smtp_senha),
                              smtp_email = (:smtp_email),
                              smtp_porta = (:smtp_porta),
                              smtp_host  = (:smtp_host)");
        
        
    endif;    

    $edt->bindValue(":smtp_user", $smtp_user);
    $edt->bindValue(":smtp_senha", $smtp_senha);
    $edt->bindValue(":smtp_email", $smtp_email);
    $edt->bindValue(":smtp_porta", $smtp_porta);
    $edt->bindValue(":smtp_host", $smtp_host);       
    if($edt->execute()){
        return true;
    }  
    return false;             

}


function enviar_email($email_destinatario, $email_destinatario_nome,$email_assunto,$email_mensagem){

    require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    if(empty(site_smtp_get())){
        die_error("Serviço indisponível no momento.");
    }

    $res = site_smtp_get();

    //Server settings
    $mail = new PHPMailer\PHPMailer\PHPMailer;
    $mail->CharSet    = "UTF-8";
    $mail->SMTPDebug  = 0;                     
    $mail->isSMTP();                                            
    $mail->Host       = $res['smtp_host'];                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = $res['smtp_user'];                     
    $mail->Password   = $res['smtp_senha'];                    
    $mail->SMTPSecure = 'ssl';                                 
    $mail->Port       = $res['smtp_porta'];  
    

    //Recipients
    $mail->setFrom($res['smtp_email'], SITE_NOME); //REMETENTE
    $mail->addAddress($email_destinatario, $email_destinatario_nome);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $email_assunto; //ASSUNTO TÍTULO APARECE
    $mail->Body    = $email_mensagem;  //ASSUNTO DO EMAIL
    
    if($mail->send()){
        return true;
    }
    return false;

} 
