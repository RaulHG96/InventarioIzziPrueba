const msjError = 'Ocurrió un incidente al realizar su petición';
/**
 * Mostrar mensaje emergente de sweetalert
 * @param  {String}  title             Mensaje a mostrar
 * @param  {String}  icon              Tipo de icono del mensaje: success, error, warning, info, question
 * @param  {String}  position          Posición del popup de ventana, puede ser 'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', o 'bottom-end'
 * @param  {Number}  timer             Temporizador de cierre automático de la ventana emergente. Establecido en ms (milisegundos).
 * @param  {Boolean} timerProgressBar  Si se establece en verdadero, el temporizador tendrá una barra de progreso en la parte inferior de una ventana emergente. Principalmente, esta característica es útil con brindis.
 * @param  {Boolean} showConfirmButton Si se establece en falso, no se mostrará el botón "Confirmar".
 */
function mixinMessage(title = '', icon = 'success', position = 'top-end', timer = 0, timerProgressBar = true, showConfirmButton = false, callback = undefined) {
	const Toast = Swal.mixin({
	  	toast: true,
	  	position: position,
	  	showConfirmButton: showConfirmButton,
	  	timer: timer,
	  	timerProgressBar: true,
	  	didOpen: (toast) => {
	    	toast.addEventListener('mouseenter', Swal.stopTimer)
	    	toast.addEventListener('mouseleave', Swal.resumeTimer)
	  	}
	})

	Toast.fire({
	  	icon: icon,
	  	title: title
	}).then((result) => {
		if(typeof callback !== 'undefined') {
			callback();
		}
	});
}

function showErrorMsg() {
	mixinMessage(msjError, 'error', 'top-end', 2000, true, false);
}
/**
 * Muestra los errores de validación de lado de servidor
 * @param  {JSON} data [JSON con el arreglo de errores]
 * @param  {String} url  [Url para redirección]
 */
function muestraErrores(data, url = '') {
	var html = '';
	$.each(data.error, function(index, val) {
		html += `<li>${val}</li>`;
	});
	Swal.fire({
		icon: 'info',
		html: html,
		confirmButtonText: `Aceptar`
	}).then(function() {
		if(url !== '') {
			location.href = url;	
		}
	});
}
