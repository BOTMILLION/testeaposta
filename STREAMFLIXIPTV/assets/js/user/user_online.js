function user_online_ajax_cad(user_tipo){
    var acao = 'user_online_cad';
    $.ajax({
        url: SITE_URL + "/controller/user/user_online.php?ajax=ajax",
        method: "POST",
        data:{acao:acao,user_tipo:user_tipo},
    });
    
}

function user_online_cad(user_tipo){
    user_online_ajax_cad(user_tipo);
    setInterval(function(){
        user_online_ajax_cad(user_tipo);
    },30000);
}
