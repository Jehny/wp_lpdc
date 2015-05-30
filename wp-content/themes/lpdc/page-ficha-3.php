<?php 

if($_GET['cod']){
	
	$num_paciente = $_GET['cod'];
}else{
	$num_paciente =  "";
}

if(isset($_POST['submit']) || isset($_POST['submitMesmo'])){
	// inserir dados na ficha 3
	
	$paciente_ficha_3 = 'paciente_ficha_3';
	
	$data_paciente_ficha_3 = array(
		'num_paciente'=> $_POST['num_paciente'],
		'nom_paciente'=> $_POST['nom_paciente'],
		'pesquisador'=> $_POST['pesquisador'],
		'data'=> $_POST['data'],
		'retorno'=>$_POST['data_retorno'],
		'num_protocolo'=>$_POST['num_protocolo'],
		'num_atendimento'=>$_POST['num_atendimento']
	);
	$redirect = $wpdb->insert( $paciente_ficha_3, $data_paciente_ficha_3, $format );
	$id_ficha_3 = $wpdb->insert_id;

	// Tabela de perguntas para a ficha 3
	// Todas as perguntas que são com apenas 1 resposta ficarão nessa tabela
	$ficha_3_perguntas = 'ficha_3_perguntas';
	for($i=1; $i < 11; $i++){
		if($i != 3 && $i != 4 && $i != 5 && $i != 9 && $i != 11){
			$valor = $_POST['resposta_'.$i];
			$data_ficha_3_perguntas = array(
				'num_paciente'=> $_POST['num_paciente'],
				'num_pergunta'=> $i,
				'pergunta'=>$_POST['pergunta_'.$i],
				'resposta'=>$_POST['resposta_'.$i.'_'.$valor],
				'valor'=>$valor,
				'id_ficha_3'=> $id_ficha_3
			);
			$redirect = $wpdb->insert( $ficha_3_perguntas, $data_ficha_3_perguntas, $format );
		}
	}

	// Tabela de atividades
	$ficha_3_atividades = 'ficha_3_atividades';
	for($i=1; $i<11; $i++){
		$valor = $_POST['grau_dificuldade_'.$i];
		$data_ficha_3_atividades = array(
				'num_paciente'=> $_POST['num_paciente'],
				'atividade'=> $_POST['atividade_'.$i],
				'resposta'=> $_POST['grau_dificuldade_label_'.$valor],
				'valor'=> $valor,
				'id_ficha_3'=> $id_ficha_3
			);
		$redirect = $wpdb->insert( $ficha_3_atividades, $data_ficha_3_atividades, $format );
	}

	// Tabela de saúde física
	$ficha_3_saude_fisica = 'ficha_3_saude_fisica';
	for($i=1; $i<5; $i++){
		$valor = $_POST['saude_fisica_'.$i];
		$data_ficha_3_saude_fisica = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['saude_fisica_item_'.$i],
				'resposta'=> $_POST['saude_fisica_resposta_'.$valor],
				'valor'=> $valor,
				'id_ficha_3'=> $id_ficha_3
			);
		$redirect = $wpdb->insert( $ficha_3_saude_fisica, $data_ficha_3_saude_fisica, $format );
	}

	// Tabela de saúde diária
	$ficha_3_saude_fisica = 'ficha_3_saude_diaria';
	for($i=1; $i<4; $i++){
		$valor = $_POST['saude_diaria_'.$i];
		$data_ficha_3_saude_fisica = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['saude_diaria_item_'.$i],
				'resposta'=> $_POST['saude_diaria_resposta_'.$valor],
				'valor'=> $valor,
				'id_ficha_3'=> $id_ficha_3
			);
		$redirect = $wpdb->insert( $ficha_3_saude_fisica, $data_ficha_3_saude_fisica, $format );
	}

	// Tabela de Pergunta 9
	$ficha_3_pergunta_9 = 'ficha_3_pergunta_9';
	for($i=1; $i<10; $i++){
		$valor = $_POST['pergunta_9_'.$i];
		$data_ficha_3_pergunta_9 = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['pergunta_9_item_'.$i],
				'resposta'=> $_POST['pergunta_9_label_'.$valor],
				'valor'=> $valor,
				'id_ficha_3'=> $id_ficha_3
			);
		$redirect = $wpdb->insert( $ficha_3_pergunta_9, $data_ficha_3_pergunta_9, $format );
	}

	// Tabela de Pergunta 11
	$ficha_3_pergunta_11 = 'ficha_3_pergunta_11';
	for($i=1; $i<5; $i++){
		$valor = $_POST['pergunta_11_'.$i];
		$data_ficha_3_pergunta_11 = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['pergunta_11_item_'.$i],
				'resposta'=> $_POST['pergunta_11_label_'.$valor],
				'valor'=> $valor,
				'id_ficha_3'=> $id_ficha_3
			);
		$redirect = $wpdb->insert( $ficha_3_pergunta_11, $data_ficha_3_pergunta_11, $format );
	}

	// Tabela de Avaliação
	$ficha_3_avaliacao = 'ficha_3_avaliacao';

	// Capacidade Funcional (3: a+b+c+d+e+f+g+h+i+j) =
	$data_cap_func = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Capacidade Funcional',
			'valor'=> $_POST['cap_func_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_cap_func, $format );

	// Aspectos Físicos (4: a+b+c+d) =
	$data_aspectos_fisicos = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspectos Físicos',
			'valor'=> $_POST['aspectos_fisicos_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_aspectos_fisicos, $format );

	// Dor (7+8) =
	$data_dor = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Dor',
			'valor'=> $_POST['dor_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_dor, $format );

	// Estado Geral de saúde (1+11) =
	$data_estado_geral = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Estado Geral de saúde',
			'valor'=> $_POST['estado_geral_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_estado_geral, $format );

	// Vitalidade (9: a+e+g+i) =
	$data_vitalidade = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Vitalidade',
			'valor'=> $_POST['vitalidade_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_vitalidade, $format );

	// Aspectos Sociais (6+10) =
	$data_aspectos_sociais = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspectos Sociais',
			'valor'=> $_POST['aspectos_sociais_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_aspectos_sociais, $format );

	// Aspecto Emocional (5: a+b+c) =
	$data_aspecto_emo = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspecto Emocional',
			'valor'=> $_POST['aspecto_emo_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_aspecto_emo, $format );

	// Saúde Mental (9: b+c+d+f+h) =
	$data_saude_mental = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Saúde Mental',
			'valor'=> $_POST['saude_mental_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$redirect = $wpdb->insert( $ficha_3_avaliacao, $data_saude_mental, $format );

	if($redirect){
		if(isset($_POST['submitMesmo'])){
			redirect_to("../ficha-4?cod=".$_POST['num_paciente']);
		}else {
			redirect_to("../ficha-4?cod=".$_POST['num_paciente']. "&ficha=".$id_ficha_3);
		}
	}

}

include "layout/header.php"; 
?>

<div id="pagina2" class="cadastro-paciente">
	<header class="header_cadastro-paciente">
		<h1 class="font24 colorTextWhite open_semibold title_maior">Ficha 3</h1>
	</header>

	<div class="cabecalho row-fluid">
		<p>Universidade Federal do Ceará</p>
		<p>Departamento de análises clínicas e toxicologicas (DACT)</p>
		<p>Laboratório de pesquisa em doença de chagas</p>
		<p>progama de atenção farmacêutica ao paciente chagástico</p>
	</div>
	<div class="row-fluid title">
		<h4>SF-6</h4>
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
					<div class="span11">
						<label>Paciente:</label>
						<input type="text" name="nom_paciente" value="" class="input_maior" required>
					</div>
				</fieldset>
				<fieldset>
					<div>
						<label>Nº do Protocolo:</label>
						<input type="text" name="num_protocolo" value="" class="numero" required>
					</div>
					<div>
						<label>Nº do Atendimento:</label>
						<input type="text" name="num_atendimento" value="" class="numero" required>
					</div>
					<div>
						<label>Retorno:</label>
						<input type="date" name="data_retorno" value="" required>
					</div>
				</fieldset>

			</div>

			<div class="sessao row-fluid">
				<p>
					Esta pesquisa questiona você sobre sua saúde. estas informações nos manterão informados de como você se sente
					e quão bem você é capaz de fazer suas atividades de vida diária. Responda cada questão marcando a resposta como indicado.
					Caso você esteja inseguro em como responder, por favor tente responder o melhot que puder.
				</p>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">1 - Em geral, você dirira que a sua saúde é:</p>
				<input type="hidden" name="pergunta_1" value="1 - Em geral, você dirira que a sua saúde é:">
				<div class="radio-div span2 no_marging_left">
					<input type="radio" name="resposta_1" value="1"><span class="radio-label">(1) Excelente</span>
					<input type="hidden" name="resposta_1_1" value="(1) Excelente">
				</div>
				<div class="radio-div span2">
					<input type="radio" name="resposta_1" value="2"><span class="radio-label">(2) Muito Boa</span>
					<input type="hidden" name="resposta_1_2" value="(2) Muito Boa">
				</div>
				<div class="radio-div span2">
					<input type="radio" name="resposta_1" value="3"><span class="radio-label">(3) Boa</span>
					<input type="hidden" name="resposta_1_3" value="(3) Boa">
				</div>
				<div class="radio-div span2">
					<input type="radio" name="resposta_1" value="4"><span class="radio-label">(4) Ruim</span>
					<input type="hidden" name="resposta_1_4" value="(4) Ruim">
				</div>
				<div class="radio-div span2">
					<input type="radio" name="resposta_1" value="4"><span class="radio-label">(5) Muito Ruim</span>
					<input type="hidden" name="resposta_1_5" value="(5) Muito Ruim">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">2 - Comparada a um ano atrás, como você classificaria sua saúde em geral, agora?  </p>
				<input type="hidden" name="pergunta_2" value="2 - Comparada a um ano atrás, como você classificaria sua saúde em geral, agora?">
				<div class="radio-div">
					<input type="radio" name="resposta_2" value="1"><span class="radio-label">(1) Muito melhor agora do que a um ano atrás.</span>
					<input type="hidden" name="resposta_2_1" value="(1) Muito melhor agora do que a um ano atrás.">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_2" value="2"><span class="radio-label">(2) Um pouco melhor agora do que a um ano atrás.</span>
					<input type="hidden" name="resposta_2_2" value="(2) Um pouco melhor agora do que a um ano atrás.">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_2" value="3"><span class="radio-label">(3) Quase a mesma de um ano atrás.</span>
					<input type="hidden" name="resposta_2_3" value="(3) Quase a mesma de um ano atrás.">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_2" value="4"><span class="radio-label">(4) Um pouco pior agora do que um ano atrás.</span>
					<input type="hidden" name="resposta_2_4" value="(4) Um pouco pior agora do que um ano atrás.">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_2" value="5"><span class="radio-label">(5) Muito pior agora do que um ano atrás.</span>
					<input type="hidden" name="resposta_2_5" value="(5) Muito pior agora do que um ano atrás.">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">3 - Os seguintes itens são sobre atividades que você poderia fazer atualmente durante um dia comum.
				Devido a sua saúde, você tem dificuldade para fazer essas atividades? Neste caso, quanto?</p>
				<input type="hidden" name="pergunta_3" value="3 - Os seguintes itens são sobre atividades que você poderia fazer atualmente durante um dia comum.
				Devido a sua saúde, você tem dificuldade para fazer essas atividades? Neste caso, quanto?">
				
				<table class="table">
					<thead>
						<th> Atividades </th>
						<th> Sim. Difuculta Muito</th>
						<th> Sim. Difuculta Um Pouco</th>
						<th> Não. Não Difuculta de Modo Algum</th>
						<input type="hidden" name="grau_dificuldade_label_1" value="Sim Dificulta Muito">
						<input type="hidden" name="grau_dificuldade_label_2" value="Sim Dificulta um Pouco">
						<input type="hidden" name="grau_dificuldade_label_3" value="Não. Não Dificulta de Modo Algum">
					</thead>

					<tr>
						<td>Atividades vigorosas, que exigem muito esforço, tais como correr, levantar objetos pesados, participar em esportes árduos.</td>
						<input type="hidden" name="atividade_1" value="Atividades vigorosas, que exigem muito esforço, tais como correr, levantar objetos pesados, participar em esportes árduos.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_1" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_1" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_1" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Atividades moderadas, tais como mover uma mesa, passar aspirador de pó, jogar bola, varrer a casa.</td>
						<input type="hidden" name="atividade_2" value="Atividades moderadas, tais como mover uma mesa, passar aspirador de pó, jogar bola, varrer a casa.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_2" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_2" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_2" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Levantar ou carregar mantimentos.</td>
						<input type="hidden" name="atividade_3" value="Levantar ou carregar mantimentos.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_3" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_3" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_3" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Subir vários lances de escada.</td>
						<input type="hidden" name="atividade_4" value="Subir vários lances de escada.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_4" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_4" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_4" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Subir um lance de escada.</td>
						<input type="hidden" name="atividade_5" value="Subir um ance de escada.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_5" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_5" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_5" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Curvar-se, ajoelhar-se ou dobrar-se.</td>
						<input type="hidden" name="atividade_6" value="Curvar-se, ajoelhar-se ou dobrar-se.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_6" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_6" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_6" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Andar mais de um quilômetro.</td>
						<input type="hidden" name="atividade_7" value="Andar mais de um quilômetro.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_7" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_7" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_7" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Andar vários quarteirões.</td>
						<input type="hidden" name="atividade_8" value="Andar vários quarteirões.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_8" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_8" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_8" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Andar um quarteirão.</td>
						<input type="hidden" name="atividade_9" value="Andar um quarteirão.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_9" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_9" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_9" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Tomar banho ou vestir-se.</td>
						<input type="hidden" name="atividade_10" value="Tomar banho ou vestir-se.">
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_10" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_10" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="grau_dificuldade_10" value="3"><span class="radio-label">3</span>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">4 - Durante as últimas 4 semanas, você teve algum dos seguintes problemas com o seu trabalho ou com alguma atividade diária regular, como consequência de sua saúde física?</p>
				<input type="hidden" name="pergunta_4" value="4 - Durante as últimas 4 semanas, você teve algum dos seguintes problemas com o seu trabalho ou com alguma atividade diária regular, como consequência de sua saúde física?">
				<table class="table">
					<tr>
						<td>
							Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras atividades?
							<input type="hidden" name="saude_fisica_item_1" value="Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras atividades?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_1" value="1"><span class="radio-label">SIM</span>
								<input type="hidden" name="saude_fisica_resposta_1" value="SIM">
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_1" value="2"><span class="radio-label">NÃO</span>
								<input type="hidden" name="saude_fisica_resposta_2" value="NÃO">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Realizou menos tarefas do que gostaria?
							<input type="hidden" name="saude_fisica_item_2" value="Realizou menos tarefas do que gostaria?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_2" value="1"><span class="radio-label">SIM</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_2" value="2"><span class="radio-label">NÃO</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Esteve limitado no seu tipo de trabalho ou outras atividades?
							<input type="hidden" name="saude_fisica_item_3" value="Esteve limitado no seu tipo de trabalho ou outras atividades?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_3" value="1"><span class="radio-label">SIM</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_3" value="2"><span class="radio-label">NÃO</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Teve dificuldade de fazer seu trabalho ou outras ativiades (por exemplo: necessitou de um esforço extra)?
							<input type="hidden" name="saude_fisica_item_4" value="Teve dificuldade de fazer seu trabalho ou outras ativiades (por exemplo: necessitou de um esforço extra)?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_4" value="1"><span class="radio-label">SIM</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_fisica_4" value="2"><span class="radio-label">NÃO</span>
							</div>
						</td>
					</tr>
					
				</table>

			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">5 - Durante as últimas 4 semanas, você teve algum dos seguintes problemas com o seu trabalho ou com alguma atividade diária regular, como consequência de algum problema emocional (como sentir-se deprimido ou ansioso)?</p>
				<input type="hidden" name="pergunta_5" value="5 - Durante as últimas 4 semanas, você teve algum dos seguintes problemas com o seu trabalho ou com alguma atividade diária regular, como consequência de algum problema emocional (como sentir-se deprimido ou ansioso)?">
				<table class="table">
					<tr>
						<td>
							Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras ativiadades?
							<input type="hidden" name="saude_diaria_item_1" value="Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras ativiadades?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_1" value="1"><span class="radio-label">SIM</span>
								<input type="hidden" name="saude_diaria_resposta_1" value="SIM">
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_1" value="2"><span class="radio-label">NÃO</span>
								<input type="hidden" name="saude_diaria_resposta_2" value="NÃO">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Realizou menos tarefas do que você gostaria?
							<input type="hidden" name="saude_diaria_item_2" value="Realizou menos tarefas do que você gostaria?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_2" value="1"><span class="radio-label">SIM</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_2" value="2"><span class="radio-label">NÃO</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Não trabalhou ou fez qualquer das atividades com tanto cuidado como geralmente faz? 
							<input type="hidden" name="saude_diaria_item_3" value="Não trabalhou ou fez qualquer das atividades com tanto cuidado como geralmente faz?">
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_3" value="1"><span class="radio-label">SIM</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="saude_diaria_3" value="2"><span class="radio-label">NÃO</span>
							</div>
						</td>
					</tr>
				</table>

			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">6 - Durante as últimas <strong>4 semanas,</strong> de que maneira sua saúde física ou problemas emocionais interferiram nas suas atividades sociais normais, em relação a família, vizinhos, amigos ou em grupo?</p>
				<input type="hidden" name="pergunta_6" value="6 - Durante as últimas <strong>4 semanas,</strong> de que maneira sua saúde física ou problemas emocionais interferiram nas suas atividades sociais normais, em relação a família, vizinhos, amigos ou em grupo?">
				<div class="radio-div">
					<input type="radio" name="resposta_6" value="1"><span class="radio-label">(1) De forma alguma.</span>
					<input type="hidden" name="resposta_6_1" value="(1) De forma alguma">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_6" value="2"><span class="radio-label">(2) Ligeiramente.</span>
					<input type="hidden" name="resposta_6_2" value="(2) Ligeiramente">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_6" value="3"><span class="radio-label">(3) Moderadamente.</span>
					<input type="hidden" name="resposta_6_3" value="(3) Moderadamente">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_6" value="4"><span class="radio-label">(4) Bastante.</span>
					<input type="hidden" name="resposta_6_4" value="(4) Bastante">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_6" value="5"><span class="radio-label">(5) Extremamente.</span>
					<input type="hidden" name="resposta_6_5" value="(5) Extremamente">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">7 - Quanta dor <strong>no corpo,</strong> você teve durante as últimas <strong>4 semanas?</strong></p>
				<input type="hidden" name="pergunta_7" value="7 - Quanta dor <strong>no corpo,</strong> você teve durante as últimas <strong>4 semanas?</strong>">
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="1"><span class="radio-label">(1) Nenhuma.</span>
					<input type="hidden" name="resposta_7_1" value="(1) Nenhuma">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="2"><span class="radio-label">(2) Muito Leve.</span>
					<input type="hidden" name="resposta_7_2" value="(2) Muito Leve">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="3"><span class="radio-label">(3) Leve.</span>
					<input type="hidden" name="resposta_7_3" value="(3) Leve">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="4"><span class="radio-label">(4) Moderada.</span>
					<input type="hidden" name="resposta_7_4" value="(4) Moderada">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="5"><span class="radio-label">(5) Grave.</span>
					<input type="hidden" name="resposta_7_5" value="(5) Grave">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_7" value="6"><span class="radio-label">(6) Muito Grave.</span>
					<input type="hidden" name="resposta_7_6" value="(6) Muito Grave">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">8 - Durante as últimas <strong>8 semanas,</strong> quanto a dor interferiu com o seu trabalho normal (incluindo tanto o trabalho, fora e dentro de casa)?</p>
				<input type="hidden" name="pergunta_8" value="8 - Durante as últimas <strong>8 semanas,</strong> quanto a dor interferiu com o seu trabalho normal (incluindo tanto o trabalho, fora e dentro de casa)?">
				<div class="radio-div">
					<input type="radio" name="resposta_8" value="1"><span class="radio-label">(1) De maneira alguma.</span>
					<input type="hidden" name="resposta_8_1" value="(1) De maneira alguma">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_8" value="2"><span class="radio-label">(2) Um pouco.</span>
					<input type="hidden" name="resposta_8_2" value="(2) Um pouco">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_8" value="3"><span class="radio-label">(3) Moderadamente.</span>
					<input type="hidden" name="resposta_8_3" value="(3) Moderadamente">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_8" value="4"><span class="radio-label">(4) Bastante.</span>
					<input type="hidden" name="resposta_8_4" value="(4) Bastante">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_8" value="5"><span class="radio-label">(5) Extremamente.</span>
					<input type="hidden" name="resposta_8_5" value="(5) Extremamente">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">9 - Estas questões são sobre como você se sente e como tudo tem acontecido com você durante as <strong>últimas 4 semanas.</strong> Para cada questão, por favor dê uma resposta que mais se aproxime da maneira como você se sente. Em relação as <strong>4 últimas semanas.</strong>?</p>
				<input type="hidden" name="pergunta_9" value=">9 - Estas questões são sobre como você se sente e como tudo tem acontecido com você durante as <strong>últimas 4 semanas.</strong> Para cada questão, por favor dê uma resposta que mais se aproxime da maneira como você se sente. Em relação as <strong>4 últimas semanas.</strong>?">
				<table class="table pergunta_9_th">
					<thead>
						<th></th>
						<th>TODO TEMPO</th>
						<th>A MAIOR PARTE DO TEMPO</th>
						<th>UMA BOA PARTE DO TEMPO</th>
						<th>ALGUMA PARTE DO TEMPO</th>
						<th>UMA PEQUENA PARTE DO TEMPO</th>
						<th>NUNCA</th>
						<input type="hidden" name="pergunta_9_label_1" value="TODO TEMPO">
						<input type="hidden" name="pergunta_9_label_2" value="A MAIOR PARTE DO TEMPO">
						<input type="hidden" name="pergunta_9_label_3" value="UMA BOA PARTE DO TEMPO">
						<input type="hidden" name="pergunta_9_label_4" value="ALGUMA PARTE DO TEMPO">
						<input type="hidden" name="pergunta_9_label_5" value="UMA PEQUENA PARTE DO TEMPO">
						<input type="hidden" name="pergunta_9_label_6" value="NUNCA">
					</thead>

					<tr>
						<td>Quanto tempo você tem se sentido cheio de vigor, cheio de vontade, cheio de força?</td>
						<input type="hidden" name="pergunta_9_item_1" value="Quanto tempo você tem se sentido cheio de vigor, cheio de vontade, cheio de força?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_1" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido uma pessoa muito nervosa?</td>
						<input type="hidden" name="pergunta_9_item_2" value="Quanto tempo você tem se sentido uma pessoa muito nervosa?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_2" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido tão deprimido que nada pode animá-lo?</td>
						<input type="hidden" name="pergunta_9_item_3" value="Quanto tempo você tem se sentido tão deprimido que nada pode animá-lo?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_3" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido calmo ou tranquilo?</td>
						<input type="hidden" name="pergunta_9_item_4" value="Quanto tempo você tem se sentido calmo ou tranquilo?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_4" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido com muita energia?</td>
						<input type="hidden" name="pergunta_9_item_5" value="Quanto tempo você tem se sentido com muita energia?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_5" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido desanimado e abatido?</td>
						<input type="hidden" name="pergunta_9_item_6" value="Quanto tempo você tem se sentido desanimado e abatido?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_6" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido esgotado?</td>
						<input type="hidden" name="pergunta_9_item_7" value="Quanto tempo você tem se sentido esgotado?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_7" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido uma pessoa feliz?</td>
						<input type="hidden" name="pergunta_9_item_8" value="Quanto tempo você tem se sentido uma pessoa feliz?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_8" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido cansado?</td>
						<input type="hidden" name="pergunta_9_item_9" value="Quanto tempo você tem se sentido cansado?">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="5"><span class="radio-label">5</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_9_9" value="6"><span class="radio-label">6</span>
							</div>
						</td>
					</tr>

				</table>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">10 - Durante as últimas <strong>4 semanas,</strong> quanto do seu tempo a sua <strong>saúde física ou problemas emocionais</strong> interferiram com as suas atividades sociais (como visitar amigos, parentes, etc)?</p>
				<input type="hidden" name="pergunta_10" value="10 - Durante as últimas <strong>4 semanas,</strong> quanto do seu tempo a sua <strong>saúde física ou problemas emocionais</strong> interferiram com as suas atividades sociais (como visitar amigos, parentes, etc)?">
				<div class="radio-div">
					<input type="radio" name="resposta_10" value="1"><span class="radio-label">(1) Todo o tempo.</span>
					<input type="hidden" name="resposta_10_1" value="(1) Todo o tempo">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_10" value="2"><span class="radio-label">(2) A maior parte do tempo.</span>
					<input type="hidden" name="resposta_10_2" value="(2) A maior parte do tempo">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_10" value="3"><span class="radio-label">(3) Alguma parte do tempo.</span>
					<input type="hidden" name="resposta_10_3" value="(3) Alguma parte do tempo">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_10" value="4"><span class="radio-label">(4) Uma pequena parte do tempo.</span>
					<input type="hidden" name="resposta_10_4" value="(4) Uma pequena parte do tempo">
				</div>
				<div class="radio-div">
					<input type="radio" name="resposta_10" value="5"><span class="radio-label">(5) Nenhuma parte do tempo.</span>
					<input type="hidden" name="resposta_10_5" value="(5) Nenhuma parte do tempo">
				</div>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">11 - O quanto <strong>verdadeiro ou falso</strong> é cada uma das afirmações?</p>
				<input type="hidden" name="pergunta_11" value="11 - O quanto <strong>verdadeiro ou falso</strong> é cada uma das afirmações?">
				<table class="table pergunta_9_th">
					<thead>
						<th></th>
						<th>DEFINITIVAMENTE VERDADEIRO</th>
						<th>A MAIORIA DAS VEZES VERDADEIRO</th>
						<th>NÃO SEI</th>
						<th>A MAIORIA DAS VEZES FALSA</th>
						<th>DEFINITIVAMENTE FALSA</th>
						<input type="hidden" name="pergunta_11_label_1" value="DEFINITIVAMENTE VERDADEIRO">
						<input type="hidden" name="pergunta_11_label_2" value="A MAIORIA DAS VEZES VERDADEIRO">
						<input type="hidden" name="pergunta_11_label_3" value="NÃO SEI">
						<input type="hidden" name="pergunta_11_label_4" value="A MAIORIA DAS VEZES FALSA">
						<input type="hidden" name="pergunta_11_label_5" value="DEFINITIVAMENTE FALSA">
					</thead>

					<tr>
						<td>Eu costumo adoecer um pouco mais facilmente que as outras pessoas.</td>
						<input type="hidden" name="pergunta_11_item_1" value="Eu costumo adoecer um pouco mais facilmente que as outras pessoas.">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_1" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_1" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_1" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_1" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_1" value="5"><span class="radio-label">5</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Eu sou tão saudável quanto qualquer pessoa que eu conheço.</td>
						<input type="hidden" name="pergunta_11_item_2" value="Eu sou tão saudável quanto qualquer pessoa que eu conheço.">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_2" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_2" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_2" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_2" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_2" value="5"><span class="radio-label">5</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Eu acho que a minha saúde vai piorar.</td>
						<input type="hidden" name="pergunta_11_item_3" value="Eu acho que a minha saúde vai piorar.">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_3" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_3" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_3" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_3" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_3" value="5"><span class="radio-label">5</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Minha saúde é excelente.</td>
						<input type="hidden" name="pergunta_11_item_4" value="Minha saúde é excelente.">
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_4" value="1"><span class="radio-label">1</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_4" value="2"><span class="radio-label">2</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_4" value="3"><span class="radio-label">3</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_4" value="4"><span class="radio-label">4</span>
							</div>
						</td>
						<td>
							<div class="radio-div">
								<input type="radio" name="pergunta_11_4" value="5"><span class="radio-label">5</span>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left"><strong><u>AVALIAÇÂO:</u></strong></p>
				<p>Capacidade Funcional (3: a+b+c+d+e+f+g+h+i+j) = <strong><span id="cap_func"></span></strong></p>
				<input type="hidden" name="cap_func_2" id="cap_func_2" value="">
				<p>Aspectos Físicos (4: a+b+c+d) = <strong><span id="aspectos_fisicos"></span></strong></p>
				<input type="hidden" name="aspectos_fisicos_2" id="aspectos_fisicos_2" value="">
				<p>Dor (7+8) = <strong><span id="dor"></span></strong></p>
				<input type="hidden" name="dor_2" id="dor_2" value="">
				<p>Estado Geral de saúde (1+11) = <strong><span id="estado_geral"></span></strong></p>
				<input type="hidden" name="estado_geral_2" id="estado_geral_2" value="">
				<p>Vitalidade (9: a+e+g+i) = <strong><span id="vitalidade"></span></strong></p>
				<input type="hidden" name="vitalidade_2" id="vitalidade_2" value="">
				<p>Aspectos Sociais (6+10) = <strong><span id="aspectos_sociais"></span></strong></p>
				<input type="hidden" name="aspectos_sociais_2" id="aspectos_sociais_2" value="">
				<p>Aspecto Emocional (5: a+b+c) = <strong><span id="aspecto_emo"></span></strong></p>
				<input type="hidden" name="aspecto_emo_2" id="aspecto_emo_2" value="">
				<p>Saúde Mental (9: b+c+d+f+h) = <strong><span id="saude_mental"></span></strong></p>
				<input type="hidden" name="saude_mental_2" id="saude_mental_2" value="">
			</div>
			<div class="botoesSumbit">
				<div class="span5">
					<button type="submit" name="submitMesmo" class="btn btn-primary enviar">Salvar e Adicionar +</button>	
				</div>
				
				<div class="span5 text_align_right">
					<button type="submit" name="submit" class="btn btn-primary enviar">Salvar e Ficha 4</button>	
				</div>	
				
			</div>
		</form>

	</div>
</div>

<?php include "layout/footer.php"; ?>
