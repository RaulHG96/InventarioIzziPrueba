$(document).ready((event) => {
	obtenerCategorias();
	obtenerSucursales();
	obtenerEstados();
	if($('input[name="isUpdate"]').val() == 1) {
		obtenerInfoProducto();
	}
});
/**
 * Obtener catálogo de categorías
 */
function obtenerCategorias() {
	$.ajax({
		url: '/categorias',
		type: 'GET',
		dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	})
	.done((response) => {
		if(response.success) {
			$.each(response.data, (index, element) => {
				$('#categoria').append(
					$('<option>', {
						value: element.id,
						text: element.nombreCategoria
					})
				);
			});
		} else {
			console.error('No se pudo obtener el catálogo de categorías');
		}
	})
	.fail(() => {
		showErrorMsg();
	});
}
/**
 * Obtener catálogo de sucursales
 */
function obtenerSucursales() {
	$.ajax({
		url: '/sucursales',
		type: 'GET',
		dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	})
	.done((response) => {
		// console.log(response);
		if(response.success) {
			$.each(response.data, (index, element) => {
				$('#sucursal').append(
					$('<option>', {
						value: element.id,
						text: element.nombreSucursal
					})
				);
			});
		} else {
			console.error('No se pudo obtener el catálogo de sucursales');
		}
	})
	.fail(() => {
		showErrorMsg();
	});
}
/**
 * Obtener catálogo de estados del producto
 */
function obtenerEstados() {
	$.ajax({
		url: '/estado',
		type: 'GET',
		dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	})
	.done((response) => {
		// console.log(response);
		if(response.success) {
			$.each(response.data, (index, element) => {
				if(element !== '') {
					$('#estado').append(
						$('<option>', {
							value: element,
							text: element
						})
					);
				}
			});
		} else {
			console.error('No se pudo obtener el catálogo de sucursales');
		}
	})
	.fail(() => {
		showErrorMsg();
	});
}
/**
 * Para obtención de información de producto
 */
function obtenerInfoProducto() {
	$.ajax({
		url: '/info-producto',
		type: 'GET',
		dataType: 'json',
		data: {
			id: $('input[name="idProducto"]').val()
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	})
	.done(function(response) {
		if (response.success) {
			$('#nombre_producto').val(response.data.nombreProducto);
			$('#precio').val(response.data.precio);
			$('#fecha_compra').val(response.data.fechaCompra);
			$('#categoria').val(response.data.idCategoria);
			$('#sucursal').val(response.data.idSucursal);
			$('#estado').val(response.data.estado);
			$('#descripcion').val(response.data.descripcion);
		} else {
			muestraErrores(response, '../lista-productos');
		}
	})
	.fail(function() {
		showErrorMsg();
	});
}

/**
 * Evento submit de formulario de actualización
 */
$(document).on('submit', '#form_register', function(event) {
	event.preventDefault();
	var formData = new FormData($('#form_register')[0]);
	$.ajax({
		url: '/registrar-producto',
		type: 'POST',
		dataType: 'json',
		data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
        	$('button[form="form_register"]').html('Registrando, espere por favor...');
        	$('button[form="form_register"]').prop('disabled', true);
        }
	})
	.done((response) => {
		if(response.success) {
			mixinMessage('¡Producto registrado!', 'success', 'top-end', 1500, true, false, () => {
				location.reload();
			});
		} else {
			muestraErrores(response);
		}
	})
	.fail(() => {
		showErrorMsg();
	})
	.always(() => {
    	$('button[form="form_register"]').html('Registrar');
    	$('button[form="form_register"]').prop('disabled', false);
	});
});
/**
 * Evento submit actualización de producto
 */
$(document).on('submit', '#form_update', function(event) {
	event.preventDefault();
	var formData = new FormData($('#form_update')[0]);
	$.ajax({
		url: '/actualizar-producto',
		type: 'POST',
		dataType: 'json',
		data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
        	$('button[form="form_update"]').html('Actualizando, espere por favor...');
        	$('button[form="form_update"]').prop('disabled', true);
        }
	})
	.done((response) => {
		if(response.success) {
			mixinMessage('¡Producto actualizado!', 'success', 'top-end', 1000, true, false, () => {
				window.location.href = '../lista-productos';
			});
		} else {
			muestraErrores(response);
		}
	})
	.fail(() => {
		showErrorMsg();
	})
	.always(() => {
    	$('button[form="form_update"]').html('Actualizar');
    	$('button[form="form_update"]').prop('disabled', false);
	});
});