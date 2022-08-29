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

function obtenerInfoProducto() {
	$.ajax({
		url: '/info-producto',
		type: 'GET',
		dataType: 'json',
		data: {
			id: $('input[name="idProducto"]').val()
		},
	})
	.done(function(response) {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}


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
	})
	.done((response) => {
		if(response.success) {

		} else {

		}
	})
	.fail(() => {
		console.log("error");
	})
	.always(() => {
		console.log("complete");
	});
});