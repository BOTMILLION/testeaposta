const SITE_URL = document.location.origin;

if ($(".whatsapp_telegram") !== null) {
	$(".whatsapp_telegram").mask('+55 (00)00000-0000'); 
}
if ($(".preco") !== null) {
	$(".preco").mask('0.000.000,00', { reverse: true });
}
if ($(".number_two") !== null) {
	$(".number_two").mask('00');
}
if ($(".number_three") !== null) {
	$(".number_three").mask('000');
}
if ($(".number_four") !== null) {
	$(".number_four").mask('0000');
}


/*
*  EXIBIR A IMAGEM CARREGADA 
*/

$(".input-image-change").change(function () {
	show_image_on_chage(this); 
});

function show_image_on_chage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.load-image-on-change').attr('src', e.target.result);
			$(".load-image-on-change").fadeIn(); 
		}

		reader.readAsDataURL(input.files[0]);
	}
}

window.onpageshow = function(event) {
    if (event.persisted) {
        swal.close();
    }
}

function download_link(link){
    var file_path = link;
    var a = document.createElement('A');
    a.href = file_path;
    a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

$(".open-sidebar-one").on("click", function(){
	$(".sidebar-one").toggleClass("active");
	$(".page-content-opacity").toggleClass("active");

   
});
$(".page-content-opacity").on("click", function(){

	if($(".sidebar-one").hasClass("active")){
		
		$(".sidebar-one").removeClass("active");
		$(".page-content-opacity").removeClass("active"); 
	}
});

/* SENHA */
function getPassword() {
	var chars = "0123456789";
	var passwordLength = 8;
	var password = "";

	for (var i = 0; i < passwordLength; i++) {
		var randomNumber = Math.floor(Math.random() * chars.length);
		password += chars.substring(randomNumber, randomNumber + 1);
	}
	return password;
}



$(".gerar-senha").on("click", function() {
    var pass = getPassword();
    $(".input-senha-um").val(pass);
    $(".input-senha-dois").val(pass);
    if($(".input-senha-um").attr("type") == 'password'){
        $(".ver-senha-um").trigger("click");
    }
    if($(".input-senha-dois").attr("type") == 'password'){
        $(".ver-senha-dois").trigger("click");
    }
}); 