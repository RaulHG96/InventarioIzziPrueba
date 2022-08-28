$(document).on('click', '#btnCreateAccount', function(event) {
	$('#form_registro').css('display', 'inline');
	$('#form_acceso').css('display', 'none');
});

$(document).on('click', '#btnLoginAccount', function(event) {
	$('#form_registro').css('display', 'none');
	$('#form_acceso').css('display', 'inline');
});