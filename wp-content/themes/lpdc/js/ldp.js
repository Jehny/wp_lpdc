$(function(){
	$('.carousel').carousel({
	  interval: 4000
	});
	
	//página de contato
	$('.enviar').bind("click", function(){
		if($('#nome').val() == "" || $('#email').val() == "" || $('#assunto').val() == "" || $('#descricao').val() == ""){
			$('.alert').show();
			console.log('show');
		}
	});
	
	$('.alert .close').bind("click", function(e) {
		$(this).parent().hide();
		console.log('hide');
	});
	
});