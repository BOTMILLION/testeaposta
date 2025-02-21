$(document).ready(function(){
    $("#form-public-busca").on("submit", function(e){
        e.preventDefault(); 
    
        const sti = $("input[name=input-public-busca]").val(); 
    
        var esp = "";
        for(var ei = 0; ei<sti.length; ei++){
            esp += " ";
        }
        if(sti == esp){
            return false;
        }
    
        var str = sti.replace(/[ ]/g,"-");
     
        var busca = str.toLowerCase();
    
        window.location.href = SITE_URL+ "/stream/busca/"+busca+"/pagina/1"; 
    });

    $("#submit-public-busca").on("click", function(){
        $("#form-public-busca").trigger("submit");
    });
})