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
	
	// ***
	// limita a quantidade de caracteres apresentados para ...
	// ***
	
	$('.textLimiter').html(function(i, h) {
	    return h.length > 75 ? h.slice(0, 74) + ' <span title="' + h + '">...</span>': h;
	  });
	
});