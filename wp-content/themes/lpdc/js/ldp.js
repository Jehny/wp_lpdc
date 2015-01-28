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

	// medicamentos utilizados
	$('.mais_medic2').bind("click", function(){
		$('.linha2').css('display', 'block');
	});
	$('.mais_medic3').bind("click", function(){
		$('.linha3').css('display', 'block');
	});
	$('.mais_medic4').bind("click", function(){
		$('.linha4').css('display', 'block');
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

	$('.medic_uso2').bind("click", function(){
		$('.uso_linha3').css('display', 'block');
	});

	$('.medic_uso3').bind("click", function(){
		$('.uso_linha4').css('display', 'block');
	});

	$('.medic_uso4').bind("click", function(){
		$('.uso_linha5').css('display', 'block');
	});

	$('.medic_uso5').bind("click", function(){
		$('.uso_linha6').css('display', 'block');
	});

	$('.medic_uso6').bind("click", function(){
		$('.uso_linha7').css('display', 'block');
	});

	$('.medic_uso7').bind("click", function(){
		$('.uso_linha8').css('display', 'block');
	});

	// $('.medic_uso8').bind("click", function(){
	// 	$('.uso_linha8').css('display', 'block');
	// });
	
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

	/*Atendimento ao paciente*/

	$('.mais_atend_2').bind("click", function(e) {
		$('.att2').css('display', 'block');
		$('.bt1').css('display', 'none');
		
	});
	$('.mais_atend_3').bind("click", function(e) {
		$('.att3').css('display', 'block');
		$('.bt2').css('display', 'none');
	});
	$('.mais_atend_4').bind("click", function(e) {
		$('.att4').css('display', 'block');
		$('.bt3').css('display', 'none');
	});
	$('.mais_atend_5').bind("click", function(e) {
		$('.att5').css('display', 'block');
		$('.bt4').css('display', 'none');
	});
	$('.mais_atend_6').bind("click", function(e) {
		$('.att6').css('display', 'block');
		$('.bt5').css('display', 'none');
	});

	// Percentual de Aderência FICHA 2
	var qnt_ingeridos = Number($('#perg_aderencia_5').val());
	var qnt_deveria_tomado = Number($('#perg_aderencia_6').val());
	
	$("#perg_aderencia_5").keyup(function() {
		qnt_ingeridos = Number($('#perg_aderencia_5').val());
		qnt_deveria_tomado = Number($('#perg_aderencia_6').val());
	 	porcentagem = (qnt_ingeridos/qnt_deveria_tomado)*100;
	 	$('#porcentagem').val(porcentagem+"%");

	});
	$("#perg_aderencia_6").keyup(function() {
		qnt_ingeridos = Number($('#perg_aderencia_5').val());
		qnt_deveria_tomado = Number($('#perg_aderencia_6').val());
	 	porcentagem = (qnt_ingeridos/qnt_deveria_tomado)*100;
	 	$('#porcentagem').val(porcentagem+"%");
	});

	// Pegar valores de Avaliação
	// pegar valores para pergunta 3
	var a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
	var b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
	var c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
	var d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
	var e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
	var f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
	var g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
	var h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
	var i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
	var j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	var cap_func = a+b+c+d+e+f+g+h+i+j;
	$('input:radio[name=grau_dificuldade_1]').bind("click", function(ev) {
		a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
		cap_func = a+b+c+d+e+f+g+h+i+j;
		$('#cap_func').html(cap_func);
		$('#cap_func_2').val(cap_func);
	});

	$('input:radio[name=grau_dificuldade_2]').bind("click", function(ev) {
		a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
		cap_func = a+b+c+d+e+f+g+h+i+j;
		$('#cap_func').html(cap_func);
		$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_3]').bind("click", function(ev) {
		a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
		cap_func = a+b+c+d+e+f+g+h+i+j;
		$('#cap_func').html(cap_func);
		$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_4]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_5]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_6]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_7]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_8]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_9]').bind("click", function(ev) {
	 	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});
	$('input:radio[name=grau_dificuldade_10]').bind("click", function(ev) {
	  	a = Number($('input:radio[name=grau_dificuldade_1]:checked').val());
		b = Number($('input:radio[name=grau_dificuldade_2]:checked').val());
		c = Number($('input:radio[name=grau_dificuldade_3]:checked').val());
		d = Number($('input:radio[name=grau_dificuldade_4]:checked').val());
		e = Number($('input:radio[name=grau_dificuldade_5]:checked').val());
		f = Number($('input:radio[name=grau_dificuldade_6]:checked').val());
		g = Number($('input:radio[name=grau_dificuldade_7]:checked').val());
		h = Number($('input:radio[name=grau_dificuldade_8]:checked').val());
		i = Number($('input:radio[name=grau_dificuldade_9]:checked').val());
		j = Number($('input:radio[name=grau_dificuldade_10]:checked').val());
	  	cap_func = a+b+c+d+e+f+g+h+i+j;
	  	$('#cap_func').html(cap_func);
	  	$('#cap_func_2').val(cap_func);
	});

	// Avaliação pergunta 4
	var a = Number($('input:radio[name=saude_fisica_1]:checked').val());
	var b = Number($('input:radio[name=saude_fisica_2]:checked').val());
	var c = Number($('input:radio[name=saude_fisica_3]:checked').val());
	var d = Number($('input:radio[name=saude_fisica_4]:checked').val());
	var aspectos_fisicos = a+b+c+d;
	$('input:radio[name=saude_fisica_1]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_fisica_1]:checked').val());
		b = Number($('input:radio[name=saude_fisica_2]:checked').val());
		c = Number($('input:radio[name=saude_fisica_3]:checked').val());
		d = Number($('input:radio[name=saude_fisica_4]:checked').val());
		aspectos_fisicos = a+b+c+d;
		$('#aspectos_fisicos').html(aspectos_fisicos);
		$('#aspectos_fisicos_2').val(aspectos_fisicos);
	});
	$('input:radio[name=saude_fisica_2]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_fisica_1]:checked').val());
		b = Number($('input:radio[name=saude_fisica_2]:checked').val());
		c = Number($('input:radio[name=saude_fisica_3]:checked').val());
		d = Number($('input:radio[name=saude_fisica_4]:checked').val());
		aspectos_fisicos = a+b+c+d;
		$('#aspectos_fisicos').html(aspectos_fisicos);
		$('#aspectos_fisicos_2').val(aspectos_fisicos);
	});
	$('input:radio[name=saude_fisica_3]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_fisica_1]:checked').val());
		b = Number($('input:radio[name=saude_fisica_2]:checked').val());
		c = Number($('input:radio[name=saude_fisica_3]:checked').val());
		d = Number($('input:radio[name=saude_fisica_4]:checked').val());
		aspectos_fisicos = a+b+c+d;
		$('#aspectos_fisicos').html(aspectos_fisicos);
		$('#aspectos_fisicos_2').val(aspectos_fisicos);
	});
	$('input:radio[name=saude_fisica_4]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_fisica_1]:checked').val());
		b = Number($('input:radio[name=saude_fisica_2]:checked').val());
		c = Number($('input:radio[name=saude_fisica_3]:checked').val());
		d = Number($('input:radio[name=saude_fisica_4]:checked').val());
		aspectos_fisicos = a+b+c+d;
		$('#aspectos_fisicos').html(aspectos_fisicos);
		$('#aspectos_fisicos_2').val(aspectos_fisicos);
	});

	// Avaliação pergunta 7 e 8
	var perg_7 = Number($('input:radio[name=resposta_7]:checked').val());
	var perg_8 = Number($('input:radio[name=resposta_8]:checked').val());
	var perg_7_8 = perg_7 + perg_8;
	$('input:radio[name=resposta_7]').bind("click", function(ev) {
		perg_7 = Number($('input:radio[name=resposta_7]:checked').val());
		perg_8 = Number($('input:radio[name=resposta_8]:checked').val());
		perg_7_8 = perg_7 + perg_8;
		$('#dor').html(perg_7_8);
		$('#dor_2').val(perg_7_8);
	});
	$('input:radio[name=resposta_8]').bind("click", function(ev) {
		perg_7 = Number($('input:radio[name=resposta_7]:checked').val());
		perg_8 = Number($('input:radio[name=resposta_8]:checked').val());
		perg_7_8 = perg_7 + perg_8;
		$('#dor').html(perg_7_8);
		$('#dor_2').val(perg_7_8);
	});

	// Avaliação pergunta 11 e 1
	var perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
	var perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
	var perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
	var perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
	var perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val()); 
	var perg_1_11 = Number($('input:radio[name=pergunta_11_5]:checked').val());
	$('input:radio[name=resposta_1]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
		perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
		perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
		perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
		perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val());
		perg_1_11 = perg_1 + perg_11_1 + perg_11_2 + perg_11_3 + perg_11_4;
		$('#estado_geral').html(perg_1_11);
		$('#estado_geral_2').val(perg_1_11);
	});
	$('input:radio[name=pergunta_11_1]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
		perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
		perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
		perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
		perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val());
		perg_1_11 = perg_1 + perg_11_1 + perg_11_2 + perg_11_3 + perg_11_4;
		$('#estado_geral').html(perg_1_11);
		$('#estado_geral_2').val(perg_1_11);
	});
	$('input:radio[name=pergunta_11_2]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
		perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
		perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
		perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
		perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val());
		perg_1_11 = perg_1 + perg_11_1 + perg_11_2 + perg_11_3 + perg_11_4;
		$('#estado_geral').html(perg_1_11);
		$('#estado_geral_2').val(perg_1_11);
	});
	$('input:radio[name=pergunta_11_3]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
		perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
		perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
		perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
		perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val());
		perg_1_11 = perg_1 + perg_11_1 + perg_11_2 + perg_11_3 + perg_11_4;
		$('#estado_geral').html(perg_1_11);
		$('#estado_geral_2').val(perg_1_11);
	});
	$('input:radio[name=pergunta_11_4]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=resposta_1]:checked').val());
		perg_11_1 = Number($('input:radio[name=pergunta_11_1]:checked').val());
		perg_11_2 = Number($('input:radio[name=pergunta_11_2]:checked').val());
		perg_11_3 = Number($('input:radio[name=pergunta_11_3]:checked').val());
		perg_11_4 = Number($('input:radio[name=pergunta_11_4]:checked').val());
		perg_1_11 = perg_1 + perg_11_1 + perg_11_2 + perg_11_3 + perg_11_4;
		$('#estado_geral').html(perg_1_11);
		$('#estado_geral_2').val(perg_1_11);
	});

	// Avaliação perguta 9
	var a = Number($('input:radio[name=pergunta_9_1]:checked').val());
	var e = Number($('input:radio[name=pergunta_9_5]:checked').val());
	var g = Number($('input:radio[name=pergunta_9_7]:checked').val());
	var i = Number($('input:radio[name=pergunta_9_9]:checked').val());
	var perg_9 = a + e + g + i;
	$('input:radio[name=pergunta_9_1]').bind("click", function(ev) {
		a = Number($('input:radio[name=pergunta_9_1]:checked').val());
		e = Number($('input:radio[name=pergunta_9_5]:checked').val());
		g = Number($('input:radio[name=pergunta_9_7]:checked').val());
		i = Number($('input:radio[name=pergunta_9_9]:checked').val());
		perg_9 = a + e + g + i;
		$('#vitalidade').html(perg_9);
		$('#vitalidade_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_5]').bind("click", function(ev) {
		a = Number($('input:radio[name=pergunta_9_1]:checked').val());
		e = Number($('input:radio[name=pergunta_9_5]:checked').val());
		g = Number($('input:radio[name=pergunta_9_7]:checked').val());
		i = Number($('input:radio[name=pergunta_9_9]:checked').val());
		perg_9 = a + e + g + i;
		$('#vitalidade').html(perg_9);
		$('#vitalidade_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_7]').bind("click", function(ev) {
		a = Number($('input:radio[name=pergunta_9_1]:checked').val());
		e = Number($('input:radio[name=pergunta_9_5]:checked').val());
		g = Number($('input:radio[name=pergunta_9_7]:checked').val());
		i = Number($('input:radio[name=pergunta_9_9]:checked').val());
		perg_9 = a + e + g + i;
		$('#vitalidade').html(perg_9);
		$('#vitalidade_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_9]').bind("click", function(ev) {
		a = Number($('input:radio[name=pergunta_9_1]:checked').val());
		e = Number($('input:radio[name=pergunta_9_5]:checked').val());
		g = Number($('input:radio[name=pergunta_9_7]:checked').val());
		i = Number($('input:radio[name=pergunta_9_9]:checked').val());
		perg_9 = a + e + g + i;
		$('#vitalidade').html(perg_9);
		$('#vitalidade_2').val(perg_9);
	});

	// Avaliação pergunta 6 e 10
	var perg_6 = Number($('input:radio[name=resposta_6]:checked').val());
	var perg_10 = Number($('input:radio[name=resposta_10]:checked').val());
	var perg_6_10= perg_6 + perg_10;
	$('input:radio[name=resposta_6]').bind("click", function(ev) {
		perg_6 = Number($('input:radio[name=resposta_6]:checked').val());
		g_10 = Number($('input:radio[name=resposta_10]:checked').val());
		perg_6_10 = perg_6 + perg_10;
		$('#aspectos_sociais').html(perg_6_10);
		$('#aspectos_sociais_2').val(perg_6_10);
	});
	$('input:radio[name=resposta_10]').bind("click", function(ev) {
		perg_6 = Number($('input:radio[name=resposta_6]:checked').val());
		g_10 = Number($('input:radio[name=resposta_10]:checked').val());
		perg_6_10 = perg_6 + perg_10;
		$('#aspectos_sociais').html(perg_6_10);
		$('#aspectos_sociais_2').val(perg_6_10);
	});

	// Avaliação pergunta 5
	var a = Number($('input:radio[name=saude_diaria_1]:checked').val());
	var b = Number($('input:radio[name=saude_diaria_2]:checked').val());
	var c = Number($('input:radio[name=saude_diaria_3]:checked').val());
	var perg_5 = a + b + c;
	$('input:radio[name=saude_diaria_1]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_diaria_1]:checked').val());
		b = Number($('input:radio[name=saude_diaria_2]:checked').val());
		c = Number($('input:radio[name=saude_diaria_3]:checked').val());
		perg_5 = a + b + c;
		$('#aspecto_emo').html(perg_5);
		$('#aspecto_emo_2').val(perg_5);
	});
	$('input:radio[name=saude_diaria_2]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_diaria_1]:checked').val());
		b = Number($('input:radio[name=saude_diaria_2]:checked').val());
		c = Number($('input:radio[name=saude_diaria_3]:checked').val());
		perg_5 = a + b + c;
		$('#aspecto_emo').html(perg_5);
		$('#aspecto_emo_2').val(perg_5);
	});
	$('input:radio[name=saude_diaria_3]').bind("click", function(ev) {
		a = Number($('input:radio[name=saude_diaria_1]:checked').val());
		b = Number($('input:radio[name=saude_diaria_2]:checked').val());
		c = Number($('input:radio[name=saude_diaria_3]:checked').val());
		perg_5 = a + b + c;
		$('#aspecto_emo').html(perg_5);
		$('#aspecto_emo_2').val(perg_5);
	});

	// Avaliação pergunta 9
	var b = Number($('input:radio[name=pergunta_9_2]:checked').val());
	var c = Number($('input:radio[name=pergunta_9_3]:checked').val());
	var d = Number($('input:radio[name=pergunta_9_4]:checked').val());
	var f = Number($('input:radio[name=pergunta_9_6]:checked').val());
	var h = Number($('input:radio[name=pergunta_9_8]:checked').val());
	var perg_9 = b + c + d + f +h;
	
	$('input:radio[name=pergunta_9_2]').bind("click", function(ev) {
		b = Number($('input:radio[name=pergunta_9_2]:checked').val());
		c = Number($('input:radio[name=pergunta_9_3]:checked').val());
		d = Number($('input:radio[name=pergunta_9_4]:checked').val());
		f = Number($('input:radio[name=pergunta_9_6]:checked').val());
		h = Number($('input:radio[name=pergunta_9_8]:checked').val());
		perg_9 = b + c + d + f +h;
		$('#saude_mental').html(perg_9);
		$('#saude_mental_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_3]').bind("click", function(ev) {
		b = Number($('input:radio[name=pergunta_9_2]:checked').val());
		c = Number($('input:radio[name=pergunta_9_3]:checked').val());
		d = Number($('input:radio[name=pergunta_9_4]:checked').val());
		f = Number($('input:radio[name=pergunta_9_6]:checked').val());
		h = Number($('input:radio[name=pergunta_9_8]:checked').val());
		perg_9 = b + c + d +f +h;
		$('#saude_mental').html(perg_9);
		$('#saude_mental_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_4]').bind("click", function(ev) {
		b = Number($('input:radio[name=pergunta_9_2]:checked').val());
		c = Number($('input:radio[name=pergunta_9_3]:checked').val());
		d = Number($('input:radio[name=pergunta_9_4]:checked').val());
		f = Number($('input:radio[name=pergunta_9_6]:checked').val());
		h = Number($('input:radio[name=pergunta_9_8]:checked').val());
		perg_9 = b + c + d +f +h;
		$('#saude_mental').html(perg_9);
		$('#saude_mental_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_6]').bind("click", function(ev) {
		b = Number($('input:radio[name=pergunta_9_2]:checked').val());
		c = Number($('input:radio[name=pergunta_9_3]:checked').val());
		d = Number($('input:radio[name=pergunta_9_4]:checked').val());
		f = Number($('input:radio[name=pergunta_9_6]:checked').val());
		h = Number($('input:radio[name=pergunta_9_8]:checked').val());
		perg_9 = b + c + d +f +h;
		$('#saude_mental').html(perg_9);
		$('#saude_mental_2').val(perg_9);
	});
	$('input:radio[name=pergunta_9_8]').bind("click", function(ev) {
		b = Number($('input:radio[name=pergunta_9_2]:checked').val());
		c = Number($('input:radio[name=pergunta_9_3]:checked').val());
		d = Number($('input:radio[name=pergunta_9_4]:checked').val());
		f = Number($('input:radio[name=pergunta_9_6]:checked').val());
		h = Number($('input:radio[name=pergunta_9_8]:checked').val());
		perg_9 = b + c + d +f +h;
		$('#saude_mental').html(perg_9);
		$('#saude_mental_2').val(perg_9);
	});


	// Avaliação da Ficha 4
	var perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
	var perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
	var perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
	var perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
	var perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
	var perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
	var perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
	var total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
	

	$('input:radio[name=pergunta_1]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);

		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente"); 
			$('#classificacao_val').val("Insuficiente");
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular"); 
			$('#classificacao_val').val("Regular"); 
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom"); 
			$('#classificacao_val').val("Bom"); 
		}
	});

	$('input:radio[name=pergunta_2]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente");
			$('#classificacao_val').val("Insuficiente"); 
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular"); 
			$('#classificacao_val').val("Regular"); 
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom"); 
			$('#classificacao_val').val("Bom");
		}
	});

	$('input:radio[name=pergunta_3]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente"); 
			$('#classificacao_val').val("Insuficiente");
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular"); 
			$('#classificacao_val').val("Regular");
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom"); 
			$('#classificacao_val').val("Bom");
		}
	});

	$('input:radio[name=pergunta_4]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente"); 
			$('#classificacao_val').val("Insuficiente");
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular"); 
			$('#classificacao_val').val("Regular");
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom");
			$('#classificacao_val').val("Bom"); 
		}
	});

	$('input:radio[name=pergunta_5]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente");
			$('#classificacao_val').val("Insuficiente"); 
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular");
			$('#classificacao_val').val("Regular"); 
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom");
			$('#classificacao_val').val("Bom"); 
		}
	});

	$('input:radio[name=pergunta_6]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente");
			$('#classificacao_val').val("Insuficiente"); 
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular");
			$('#classificacao_val').val("Regular"); 
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom");
			$('#classificacao_val').val("Bom"); 
		}
	});

	$('input:radio[name=pergunta_7]').bind("click", function(ev) {
		perg_1 = Number($('input:radio[name=pergunta_1]:checked').val());
		perg_2 = Number($('input:radio[name=pergunta_2]:checked').val());
		perg_3 = Number($('input:radio[name=pergunta_3]:checked').val());
		perg_4 = Number($('input:radio[name=pergunta_4]:checked').val());
		perg_5 = Number($('input:radio[name=pergunta_5]:checked').val());
		perg_6 = Number($('input:radio[name=pergunta_6]:checked').val());
		perg_7 = Number($('input:radio[name=pergunta_7]:checked').val());
		total_pontos = perg_1 + perg_2 + perg_3 + perg_4 + perg_5 + perg_6 + perg_7;
		$('#total_pontos').html(total_pontos);
		$('#total_pontos_val').val(total_pontos);
		if(total_pontos < 6){
			$('#classificacao').html("Insuficiente"); 
			$('#classificacao_val').val("Insuficiente");
		}else if(total_pontos >= 6 && total_pontos <= 8){
			$('#classificacao').html("Regular"); 
			$('#classificacao_val').val("Regular");
		}else if(total_pontos > 8){
			$('#classificacao').html("Bom");
			$('#classificacao_val').val("Bom"); 
		}
	});


});