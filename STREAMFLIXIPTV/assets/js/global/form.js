function ajax_processando() {
	Swal.fire({
		text: 'Por favor aguarde...',
		iconHtml: '<i class="fas fa-spinner fa-pulse text-dark"></i>',
		showConfirmButton: false,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-loading'
		}
	});
}    

function ajax_error(msg_error) {
	Swal.fire({
		icon: 'error',
		text: msg_error,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-error'
		}
	});
}

function ajax_error_redirect(msg_error, url) {
	Swal.fire({
		icon: 'error',
		text: msg_error,
		showConfirmButton: true,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-success'
		}
	}).then((result) => {
		if(result.isConfirmed){
			window.location.href = url;
		}
	});
}

function ajax_success(msg_success) {
	Swal.fire({
		icon: 'success',
		text: msg_success,
		showConfirmButton: true,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-success'
		}
	});
}

function ajax_success_redirect(msg_success, url) {
	Swal.fire({
		icon: 'success',
		text: msg_success,
		showConfirmButton: true,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-success'
		}
	}).then((result) => {
		if(result.isConfirmed){
			window.location.href = url;
		}
	});
}

function ajax_success_reload(msg_success) {
	Swal.fire({
		icon: 'success',
		text: msg_success,
		showConfirmButton: true,
		allowOutsideClick: false,
		customClass: {
			icon: 'sweet-icon-success'
		}
	}).then((result) => {
		if(result.isConfirmed){
			location.reload();
		}
	});
}

function controller_submit_form(form, pagina){
    send_form(form, SITE_URL + '/controller/' + pagina + '?ajax=ajax');
}

function send_form(form, url){

    $(form).on("submit", function(e){   

        e.preventDefault();

        var data = "";
        $('.form__textarea').each(function(){
            if($(this).prop('id') != null){
                for (instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[$(this).prop('id')].updateElement();
                }
            }
        });

        var form_ajax =  new FormData(this);

        $.ajax({
            url: url,
            data: form_ajax,
            method: "POST",
            async: true,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                ajax_processando(); 
            },
            success: function (res) {
				console.log(res);
                try {
                    data = JSON.parse(res);
                    if(data.status == 'success'){
                        ajax_success(data.msg);
                    }else if(data.status == 'success_reload'){
                        ajax_success_reload(data.msg);
                    }else if(data.status == 'success_redirect'){
                        ajax_success_redirect(data.msg, data.url);
                    }else if(data.status == 'redirect_after_confirm'){ 
                        ajax_success_redirect(data.msg, data.url);       
                    }else if(data.status == 'error'){
                        ajax_error(data.msg);
                    }else if(data.status == 'error_reload'){
                        ajax_error_reload(data.msg);
                    }else if(data.status == 'error_redirect'){
                        ajax_error_redirect(data.msg, data.url);
                    }else if(data.status == 'reload'){
                        location.reload();
                    }else if(data.status == 'redirect_url'){
                        window.location.href = data.url;
					}else if(data.status == 'download'){
						download_link(data.url);	
						swal.close();
                    }else if(data.status == 'login'){
                        window.location.href = data.url;  
                    }else{
                        ajax_error("O servidor enviou uma resposta inesperada. Tente novamente.");
                    }
                } catch (_) {
                    ajax_error("Ocorreu um problema. Tente mais tarde...");
                }
            },
            error: function () {
                ajax_error("Página não encontrada.");
            }
        });

    });

}

function ver_senha(input_classe, botao){
	$(botao).on("click", function(){
		if($(input_classe).attr("type") == 'password'){
			$(input_classe).attr("type", 'text');
			$(botao).html('<i class="far fa-eye-slash"></i>');
		}else{
			$(input_classe).attr("type", 'password');
			$(botao).html('<i class="far fa-eye"></i>');
		}
	});
} 

ver_senha(".input-senha-um", ".ver-senha-um");
ver_senha(".input-senha-dois", ".ver-senha-dois");
ver_senha(".input-senha-tres", ".ver-senha-tres");
