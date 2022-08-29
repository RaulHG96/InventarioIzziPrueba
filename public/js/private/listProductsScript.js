var tableGrid;
$(document).ready(function() {
	tableGrid = new gridjs.Grid({
	  	columns: [{
	  		name: "ID",
	  		width: '5%'
	  	}, {
	  		name: "Nombre del producto",
	  		width: '20%'
	  	}, {
	  		name: "Categoría",
	  		width: '30%'
	  	}, {
	  		name: "Sucursal",
	  		width: '20%'
	  	},{
	  		name: "Funciones",
	  		width: '25%'
	  	}],
	  	autoWidth: false,
	  	width: '100%',
		language: {
			'search': {
	  			'placeholder': '🔍 Buscar...'
			},
			'pagination': {
	  			'previous': 'Anterior',
	  			'next': 'Siguiente',
	  			'showing': 'Mostrando',
			    'of': 'de',
			    'to': 'a',
	  			'results': () => 'Registros'
			},
			loading: 'Cargando...',
			noRecordsFound: 'No se encontraron registros coincidentes',
			error: 'Ocurrió un problema al obtener los datos',
		},
		pagination: {
			enabled: true,
			limit: 8,
			server: {
		  		url: (prev, page, limit) => `${prev}?limit=${limit}&offset=${page * limit}`
			}
		},
		server: {
			url: '../../obtener-productos',
			then: data => data.data.rows.map(producto => [
		  		producto.id,
		  		producto.nombreProducto,
		  		producto.nombreCategoria,
		  		producto.nombreSucursal,
		  		gridjs.html(`
		  			<a href='${producto.url}' class="btn btn-primary">Editar</a>
		  			<button val="${producto.id}" class="btn btn-danger btn-delete">Eliminar</button>
	  			`)
			]),
			total: data => data.data.cantidad
		} 
	}).render(document.getElementById("wrapper"));	
});
/**
 * Evento eliminación de producto de la base de datos
 */
$(document).on('click', '.btn-delete', function(event) {
	let idProducto = $(this).attr('val');
	let btn = $(this);
	$.ajax({
		url: '../../eliminar-producto',
		type: 'POST',
		dataType: 'json',
		data: {
			id: idProducto
		},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
        	btn.html('Eliminando...');
        	btn.prop('disabled', true);
        }
	})
	.done(function(response) {
		if(response.success) {
			mixinMessage('¡Producto eliminado!', 'success', 'top-end', 1000, true, false, () => {
				tableGrid.forceRender();
			});
		} else {
			muestraErrores(response);
		}
	})
	.fail(function() {
		showErrorMsg();
	})
	.always(function() {
    	btn.html('Eliminar');
    	btn.prop('disabled', false);
	});
	
});