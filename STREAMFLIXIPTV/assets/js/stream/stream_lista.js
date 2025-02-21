$(document).ready(function(){
    $("#stream_lista").on("click", function(){
        var stream_lista_stream = $("#stream-info").attr("data-id");
        var stream_lista_type   = $("#stream-info").attr("data-type");
        var acao                = 'stream_lista';
        $.ajax({
            url: SITE_URL + "/controller/stream/stream_lista.php?ajax=ajax",
            method: "POST",
            data:{acao:acao, stream_lista_stream:stream_lista_stream,stream_lista_type:stream_lista_type},
            success: function(res){
                try{
                    var json = JSON.parse(res);
                    var icon = $("#stream_lista").find("i");
                    if(json.status == "success"){
                        if(json.msg == "adicionado"){
                            icon.removeClass("fa-plus");
                            icon.addClass("fa-heart");
                        }
                        if(json.msg == "removido"){
                            icon.addClass("fa-plus");
                            icon.removeClass("fa-heart");
                        }
                    }
                    if(json.status == "login"){
                        window.location.href = SITE_URL + '/user/login'; 
                    }
                }catch(e){
                    
                }
            }
        });
    });
});