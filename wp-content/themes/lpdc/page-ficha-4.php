<?php 
if($_GET['cod']){
	$num_paciente = $_GET['cod'];
}else{
	$num_paciente =  "";
}

if(isset($_POST['submit'])){


	$paciente_ficha_4 = 'paciente_ficha_4';
		
		$data_paciente_ficha_4 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'nom_paciente'=> $_POST['nom_paciente'],
			'pesquisador'=> $_POST['pesquisador'],
			'data'=> $_POST['data'],
			'num_protocolo'=>$_POST['num_protocolo'],
			'pontos'=> $_POST['total_pontos_val'],
			'classificacao'=> $_POST['classificacao_val']
		);
	$wpdb->insert( $paciente_ficha_4, $data_paciente_ficha_4, $format );
	$id_ficha_4 = $wpdb->insert_id;

	// Perguntas
	$ficha_4_perguntas = 'ficha_4_perguntas';

		// Pergunta 1
		$valor_1 = $_POST['pergunta_1'];
		$data_ficha_4_pergunta_1 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_1'],
			'pergunta'=> $_POST['perg_1_medic'],
			'resposta'=> $_POST['pergunta_1_nome_'.$valor_1],
			'valor'=> $_POST['pergunta_1'],
			'obs'=>$_POST['obs_1'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_1, $format );

	// Pergunta 2
	$valor_2 = $_POST['pergunta_2'];
	$data_ficha_4_pergunta_2 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_2'],
			'pergunta'=> $_POST['perg_2_medic'],
			'resposta'=> $_POST['pergunta_2_nome_'.$valor_2],
			'valor'=> $_POST['pergunta_2'],
			'obs'=>$_POST['obs_2'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_2, $format );

	// Pergunta 3
	$valor_3 = $_POST['pergunta_3'];
	$data_ficha_4_pergunta_3 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_3'],
			'pergunta'=> $_POST['perg_3_medic'],
			'resposta'=> $_POST['pergunta_3_nome_'.$valor_3],
			'valor'=> $_POST['pergunta_3'],
			'obs'=>$_POST['obs_3'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_3, $format );

	// Pergunta 4
	$valor_4 = $_POST['pergunta_4'];
	$data_ficha_4_pergunta_4 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_4'],
			'pergunta'=> $_POST['perg_4_medic'],
			'resposta'=> $_POST['pergunta_4_nome_'.$valor_4],
			'valor'=> $_POST['pergunta_4'],
			'obs'=>$_POST['obs_4'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_4, $format );

	// Pergunta 5
	$valor_5 = $_POST['pergunta_5'];
	$data_ficha_4_pergunta_5 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_5'],
			'pergunta'=> $_POST['perg_5_medic'],
			'resposta'=> $_POST['pergunta_5_nome_'.$valor_5],
			'valor'=> $_POST['pergunta_5'],
			'obs'=>$_POST['obs_5'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_5, $format );

	// Pergunta 6
	$valor_6 = $_POST['pergunta_6'];
	$data_ficha_4_pergunta_6 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_6'],
			'pergunta'=> $_POST['perg_6_medic'],
			'resposta'=> $_POST['pergunta_6_nome_'.$valor_6],
			'valor'=> $_POST['pergunta_6'],
			'obs'=>$_POST['obs_6'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_6, $format );

	// Pergunta 7
	$valor_7 = $_POST['pergunta_7'];
	$data_ficha_4_pergunta_7 = array(
			'num_paciente'=> $_POST['num_paciente'],
			'num_pergunta'=> $_POST['num_pergunta_7'],
			'pergunta'=> $_POST['perg_7_medic'],
			'resposta'=> $_POST['pergunta_7_nome_'.$valor_7],
			'valor'=> $_POST['pergunta_7'],
			'obs'=>$_POST['obs_7'],
			'id_ficha_4'=>$id_ficha_4
		);
	$wpdb->insert( $ficha_4_perguntas, $data_ficha_4_pergunta_7, $format );

}
include "layout/header.php"; 
?>

<div id="pagina2" class="cadastro-paciente">
	<header class="header_cadastro-paciente">
		<h1 class="font24 colorTextWhite open_semibold title_maior">Ficha 4</h1>
	</header>

	<div class="cabecalho row-fluid">
		<p>Universidade Federal do Ceará</p>
		<p>Departamento de análises clínicas e toxicologicas (DACT)</p>
		<p>Laboratório de pesquisa em doença de chagas</p>
		<p>progama de atenção farmacêutica ao paciente chagástico</p>
	</div>
	<div class="row-fluid title">
		<h4>NÍVEL DE INFORMAÇÃO SOBRE TRATAMENTO PRESCRITO </h4>
	</div>

	<div class="formulario">
		<form action="" method="post">
			<div class="sessao row-fluid">
				<fieldset>
					<div>
						<label>Nº Paciente:</label>
						<input type="text" name="num_paciente" value="<?php echo $num_paciente; ?>" class="numero" required>
					</div>
					<div>
						<label>Pesquisador:</label>
						<input type="text" name="pesquisador" value="" required>
					</div>
					<div>
						<label>Data:</label>
						<input type="date" name="data" value="" required>
					</div>
				</fieldset>
				<fieldset>
					<div>
						<label>Nº do Protocolo:</label>
						<input type="text" name="num_protocolo" value="" class="numero" required>
					</div>
				</fieldset>
			</div>
			<div class="sessao row-fluid">
				<h5>Informações Pessoais</h5>
				<fieldset>
					<div class="span11">
						<label>Nome:</label>
						<input type="text" name="nom_paciente" value="" class="input_maior" required>
					</div>
				</fieldset>
			</div>

			<div class="sessao row-fluid">
				<h5>Nome do Medicamento</h5>
				<p class="no_padding_left no_margin_bottom">1. Qual o nome do medicamento que o sr.(a) vai usar?
					<input type="hidden" name='perg_1_medic' value="1. Qual o nome do medicamento que o sr.(a) vai usar?">
					<input type="text" name='obs_1' value="">
					<input type="hidden" name="num_pergunta_1" value="1">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_1" value="2"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_1_nome_2' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_1" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_1_nome_0' value="Não Sabe">
				</div>
			</div>
			<div class="sessao row-fluid">
				<h5>Indicação do Medicamento</h5>
				<p class="no_padding_left no_margin_bottom">2. Para que esse medicamento foi receitado?
					<input type="hidden" name='perg_2_medic' value="2. Para que esse medicamento foi receitado?">
					<input type="text" name='obs_2' value="">
					<input type="hidden" name="num_pergunta_2" value="2">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_2" value="1"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_2_nome_1' value="Sabe">

				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_2" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_2_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Dose do Medicamento</h5>
				<p class="no_padding_left no_margin_bottom">3. Quantos comprimidos desse medicamento o sr.(a) tem que tomar de cada vez?
					<input type="hidden" name='perg_3_medic' value="3. Quantos comprimidos desse medicamento o sr.(a) tem que tomar de cada vez?">
					<input type="text" name='obs_3' value="">
					<input type="hidden" name="num_pergunta_3" value="3">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_3" value="2"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_3_nome_2' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_3" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_3_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Frequencia de tomada do Medicamento</h5>
				<p class="no_padding_left no_margin_bottom">4. Quantas vezes por dia o sr.(a) tem que tomar esse medicamento?
					<input type="hidden" name='perg_4_medic' value="4. Quantas vezes por dia o sr.(a) tem que tomar esse medicamento?">
					<input type="text" name='obs_4' value="">
					<input type="hidden" name="num_pergunta_4" value="4">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_4" value="2"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_4_nome_2' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_4" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_4_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Intervalo das Doses</h5>
				<p class="no_padding_left no_margin_bottom">5. Em que horas o sr.(a) tem que tomar esse medicamento?
					<input type="hidden" name='perg_5_medic' value="5. Em que horas o sr.(a) tem que tomar esse medicamento?">
					<input type="text" name='obs_5' value="">
					<input type="hidden" name="num_pergunta_5" value="5">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_5" value="1"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_5_nome_1' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_5" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_5_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Duração do Tratamento</h5>
				<p class="no_padding_left no_margin_bottom">6. Por quantos dias o sr.(a) tem que tomar esse medicamento?
					<input type="hidden" name='perg_6_medic' value="6. Por quantos dias o sr.(a) tem que tomar esse medicamento?">
					<input type="text" name='obs_6' value="">
					<input type="hidden" name="num_pergunta_6" value="6">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_6" value="1"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_6_nome_1' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_6" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_6_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Efeitos adversos</h5>
				<p class="no_padding_left no_margin_bottom">7. Esse medicamento pode causar reações desagradáveis ou efeitos tóxicos? Quais?
					<input type="hidden" name='perg_7_medic' value="7. Esse medicamento pode causar reações desagradáveis ou efeitos tóxicos? Quais?">
					<input type="text" name='obs_7' value="">
					<input type="hidden" name="num_pergunta_7" value="7">
				</p>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_7" value="1"><span class="radio-label">Sabe</span>
					<input type="hidden" name='pergunta_7_nome_1' value="Sabe">
				</div>
				<div class="radio-div span2 no_marging_left no_margin_top">
					<input type="radio" name="pergunta_7" value="0"><span class="radio-label">Não Sabe</span>
					<input type="hidden" name='pergunta_7_nome_0' value="Não Sabe">
				</div>
			</div>

			<div class="sessao row-fluid">
				<h5>Pontuação Final</h5>
				<p class="no_padding_left no_margin_bottom">Classificação do nível de Informação:</p>
				<ul>
					<li>Insuficiente = Menos de 6 pontos</li>
					<li>Regular = 6 a 8 pontos</li>
					<li>Bom = Mais de 8 pontos</li>
				</ul>
				<p class="span4">
					Total de Pontos: <strong><span id="total_pontos"></span></strong>
					<input type="hidden" value="" id="total_pontos_val" name="total_pontos_val">
				</p>
				<p class="span4">
					Classificação: <strong><span id="classificacao"></span></strong>
					<input type="hidden" value="" id="classificacao_val" name="classificacao_val">
				</p>
			</div>

			<button type="submit" name="submit" class="btn btn-large btn-primary enviar">Salvar</button>
		</form>

	</div>
</div>

<?php include "layout/footer.php"; ?>
