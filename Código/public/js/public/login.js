// Opciones para cambio entre formularios de registro
$(document).on('click', '#btnCreateAccount', function(event) {
	$('#form_registro').css('display', 'inline');
	$('#form_acceso').css('display', 'none');
	obtenerPermisos();
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

/**
 * Registro de usuario
 */
$(document).on('submit', '#form_registro', function(event) {
	event.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: 'registrar-usuario',
		type: 'POST',
		dataType: 'json',
		data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
        	$('button[form="form_registro"]').prop('disabled', true);
        	$('button[form="form_registro"]').html('Registrando sus datos, espere por favor...');
        }
	})
	.done(function(response) {
		if (response.success) {
			mixinMessage('¡Registro exitoso!, inicie sesión para acceder', 'success', 'top-end', 1500, true, false, () => {
				$('#btnLoginAccount').trigger('click');
			});
		} else {
			muestraErrores(response);
		}
	})
	.fail(function() {
		showErrorMsg();
	})
	.always(function() {
    	$('button[form="form_registro"]').prop('disabled', false);
    	$('button[form="form_registro"]').html('Registrarse');
	});
});

function obtenerPermisos() {
	$.ajax({
		url: 'perfil',
		type: 'GET',
		dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	})
	.done(function(response) {
		if (response.success) {
			$('#permiso').html('');
			$('#permiso').append(`<option disabled selected value="">&#xF4D7;&nbsp;Permisos</option>`);
			$.each(response.data, function(index, element) {
				$('#permiso').append(
					$('<option>', {
						value: element.id,
						text: element.nombrePerfil
					})
				);
			});
		} else {
			console.error('No se pudieron obtener el listado de perfiles');
		}
	})
	.fail(function() {
		showErrorMsg();
	});
}