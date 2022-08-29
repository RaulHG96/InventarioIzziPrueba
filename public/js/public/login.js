// Opciones para cambio entre formularios de registro
$(document).on('click', '#btnCreateAccount', function(event) {
	$('#form_registro').css('display', 'inline');
	$('#form_acceso').css('display', 'none');
});

$(document).on('click', '#btnLoginAccount', function(event) {
	$('#form_registro').css('display', 'none');
	$('#form_acceso').css('display', 'inline');
});

// Login
$(document).on('submit', '#form_acceso', function(event) {
	event.preventDefault();
	let btnSubmit = $(this).find("button[type='submit']")[0];
	var formData = new FormData(this);
	$.ajax({
		url: './login',
		type: 'POST',
		dataType: 'json',
		data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
        	$(btnSubmit).prop('disabled', true);
        	$(btnSubmit).html('Validando, espere por favor...');
        }
	})
	.done(function(response) {
		if (response.success) {
			mixinMessage('¡Bienvenido de nuevo!', 'success', 'top-end', 1000, true, false, () => {
				window.location.href = './dashboard';
			});
		} else {
			mixinMessage(response.error, 'error', 'top-end', 1500, true, false);
		}
	})
	.fail(function() {
		showErrorMsg();
	})
	.always(() => {
		$(btnSubmit).prop('disabled', false);
		$(btnSubmit).html('Acceder');
	});
	
});