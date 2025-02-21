$(document).ready(function(){
   
    $(".perfil-selecionar-item").on("click", function(){
        $("input[name=perfil-selecionar-id]").val($(this).attr("data-id"));
        $("#perfil-selecionar-form").trigger("submit");
    });
    function cliente_perfil_verificar(){
        if(window.location.href != SITE_URL + '/cliente/perfil-selecionar'){
            $.ajax({
                url: SITE_URL + "/controller/cliente/perfil_selecionar.php?ajax=ajax",
                method: "POST",
                data:{acao: "perfil-verificar"},
                success: function(res){
                    try{
                        var pf = JSON.parse(res);
                        if(pf.status == "login"){
                            ajax_error("Sua conta foi desconectada. Faça login novamente.");
                        }
                        if(pf.status == "perfil"){
                            ajax_error("Alguém acessou o seu perfil.");
                        }
                        setTimeout(function(){
                            window.location.href = pf.url; 
                        },2000);
                        return false;
                    }catch(_){

                    }
                }
            });
        }
    }
    setInterval(function(){
        cliente_perfil_verificar();
    },5000);
    
    controller_submit_form("#perfil-selecionar-form", "cliente/perfil_selecionar.php");
    user_online_cad("cliente");

});