$(function(){
	$('.carousel').carousel({
	  interval: 4000
	});
	
	//página de contato
	$('.enviar').bind("click", function(){
		if($('#nome').val() == "" || $('#email').val() == "" || $('#assunto').val() == "" || $('#descricao').val() == ""){
			$('.alert').show();
		}
	});
	
	$('.alert .close').bind("click", function(e) {
		$(this).parent().hide();
		
	});

	// medicamentos utilizados
	$('.mais_medic2').bind("click", function(){
		$('.dois').css('display', 'block');
	});
	$('.mais_medic3').bind("click", function(){
		$('.tres').css('display', 'block');
	});
	$('.mais_medic4').bind("click", function(){
		$('.quatro').css('display', 'block');
	});

	// medicamentos que utiliza
	$('.medic_uso2').bind("click", function(){
		$('.dois_uso').css('display', 'block');
	});

	$('.medic_uso3').bind("click", function(){
		$('.tres_uso').css('display', 'block');
	});

	$('.medic_uso4').bind("click", function(){
		$('.quatro_uso').css('display', 'block');
	});

	$('.medic_uso5').bind("click", function(){
		$('.cinco_uso').css('display', 'block');
	});

	$('.medic_uso6').bind("click", function(){
		$('.seis_uso').css('display', 'block');
	});

	$('.medic_uso7').bind("click", function(){
		$('.sete_uso').css('display', 'block');
	});

	$('.medic_uso8').bind("click", function(){
		$('.oito_uso').css('display', 'block');
	});
	
	// ***
	// limita a quantidade de caracteres apresentados para ...
	// ***
	
	$('.textLimiter').html(function(i, h) {
	    return h.length > 130 ? h.slice(0, 129) + ' <span title="' + h + '">...</span>': h;
	  });

	// ***
	// Ações do formulário de cadastro de pacientes
	// ***
	$('#interior').bind("click", function(e) {
		$('#qual').removeAttr('disabled');
	});
	$('#cidade').bind("click", function(e) {
		$('#qual').attr('disabled', 'disabled');
	});

	$('#idoso-sim').bind("click", function(e) {
		$('#cuidador').removeAttr('disabled');
	});
	$('#idoso-nao').bind("click", function(e) {
		$('#cuidador').attr('disabled', 'disabled');
	});

	$('#ocupacao-sim').bind("click", function(e) {
		$('#ocupacao').removeAttr('disabled');
	});
	$('#ocupacao-nao').bind("click", function(e) {
		$('#ocupacao').attr('disabled', 'disabled');
	});

	$('#residiu-nao').bind("click", function(e) {
		$('#residencia1').removeClass('display_none');
	});

	$('#residiu-sim').bind("click", function(e) {
		$('#residencia1').addClass('display_none');
		$('#residencia2').addClass('display_none');
		$('#residencia3').addClass('display_none');
		$('#residencia4').addClass('display_none');
	});

	 

	$('#resid2').bind("click", function(e) {
		$('#residencia2').removeClass('display_none');
	});
	$('#resid3').bind("click", function(e) {
		$('#residencia3').removeClass('display_none');
	});
	$('#resid4').bind("click", function(e) {
		$('#residencia4').removeClass('display_none');
	});

});