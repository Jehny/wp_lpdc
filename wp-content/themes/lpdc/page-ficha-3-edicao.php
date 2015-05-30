<?php 

if($_GET['cod']){
	$id_ficha = $_GET['ficha'];
	$num_paciente = $_GET['cod'];
	$obj_paciente = buscar_paciente_ficha_3($num_paciente, $id_ficha);
	$cap_funcional = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Capacidade Funcional");
	$aspc_fisicos = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Aspectos Físicos");
	$dor = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Dor");
	$est_geral = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Estado Geral de saúde");
	$vitalidade = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Vitalidade");
	$aspc_sociais = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Aspectos Sociais");
	$aspc_emo = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Aspecto Emocional");
	$saude_mental = buscar_avaliacao_ficha_3($num_paciente, $id_ficha, "Saúde Mental");

}else{
	$num_paciente =  "";
	$id_ficha ="";
}

if(isset($_POST['submit'])){
	$id_ficha = $_POST['ficha'];

	// inserir dados na ficha 3
	$where_paciente_ficha_3 = array('num_paciente'=> $num_paciente, 'id'=>$id_ficha);
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
	$wpdb->update( $paciente_ficha_3, $data_paciente_ficha_3, $where_paciente_ficha_3, $format = null, $where_format = null ); 

	// Tabela de perguntas para a ficha 3
	// Todas as perguntas que são com apenas 1 resposta ficarão nessa tabela
	$ficha_3_perguntas = 'ficha_3_perguntas';

	for($i=1; $i < 11; $i++){
		if($i != 3 && $i != 4 && $i != 5 && $i != 9 && $i != 11){
			$where_ficha_3_perguntas = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'num_pergunta'=>$i);
			$valor = $_POST['resposta_'.$i];
			$data_ficha_3_perguntas = array(
				'num_paciente'=> $_POST['num_paciente'],
				'num_pergunta'=> $i,
				'pergunta'=>$_POST['pergunta_'.$i],
				'resposta'=>$_POST['resposta_'.$i.'_'.$valor],
				'valor'=>$valor
			);
			$wpdb->update( $ficha_3_perguntas, $data_ficha_3_perguntas, $where_ficha_3_perguntas, $format = null, $where_format = null ); 
		}
	}

	// Tabela de atividades
	$ficha_3_atividades = 'ficha_3_atividades';
	for($i=1; $i<11; $i++){
		$valor = $_POST['grau_dificuldade_'.$i];
		$where_ficha_3_atividades = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'atividade'=>$_POST['atividade_'.$i]);
		$data_ficha_3_atividades = array(
				'num_paciente'=> $_POST['num_paciente'],
				'atividade'=> $_POST['atividade_'.$i],
				'resposta'=> $_POST['grau_dificuldade_label_'.$valor],
				'valor'=> $valor
			);
		$wpdb->update( $ficha_3_atividades, $data_ficha_3_atividades, $where_ficha_3_atividades, $format = null, $where_format = null ); 
	}

	// Tabela de saúde física
	$ficha_3_saude_fisica = 'ficha_3_saude_fisica';
	for($i=1; $i<5; $i++){
		$valor = $_POST['saude_fisica_'.$i];
		$where_ficha_3_saude_fisica = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'item'=>$_POST['saude_fisica_item_'.$i]);
		$data_ficha_3_saude_fisica = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['saude_fisica_item_'.$i],
				'resposta'=> $_POST['saude_fisica_resposta_'.$valor],
				'valor'=> $valor
			);
		$wpdb->update( $ficha_3_saude_fisica, $data_ficha_3_saude_fisica, $where_ficha_3_saude_fisica, $format = null, $where_format = null ); 
	}

	// Tabela de saúde diária
	$ficha_3_saude_diaria = 'ficha_3_saude_diaria';
	for($i=1; $i<4; $i++){
		$valor = $_POST['saude_diaria_'.$i];
		$where_ficha_3_saude_diaria = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'item'=>$_POST['saude_diaria_item_'.$i]);
		$data_ficha_3_saude_diaria = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['saude_diaria_item_'.$i],
				'resposta'=> $_POST['saude_diaria_resposta_'.$valor],
				'valor'=> $valor
			);
		$wpdb->update( $ficha_3_saude_diaria, $data_ficha_3_saude_diaria, $where_ficha_3_saude_diaria, $format = null, $where_format = null ); 
	}

	// Tabela de Pergunta 9
	$ficha_3_pergunta_9 = 'ficha_3_pergunta_9';
	for($i=1; $i<10; $i++){
		$valor = $_POST['pergunta_9_'.$i];
		$where_ficha_3_pergunta_9 = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'item'=>$_POST['pergunta_9_item_'.$i]);
		$data_ficha_3_pergunta_9 = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['pergunta_9_item_'.$i],
				'resposta'=> $_POST['pergunta_9_label_'.$valor],
				'valor'=> $valor
			);
		$wpdb->update( $ficha_3_pergunta_9, $data_ficha_3_pergunta_9, $where_ficha_3_pergunta_9, $format = null, $where_format = null ); 
	}

	// Tabela de Pergunta 11
	$ficha_3_pergunta_11 = 'ficha_3_pergunta_11';
	for($i=1; $i<5; $i++){
		$where_ficha_3_pergunta_11 = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'item'=>$_POST['pergunta_11_item_'.$i]);
		$valor = $_POST['pergunta_11_'.$i];
		$data_ficha_3_pergunta_11 = array(
				'num_paciente'=> $_POST['num_paciente'],
				'item'=> $_POST['pergunta_11_item_'.$i],
				'resposta'=> $_POST['pergunta_11_label_'.$valor],
				'valor'=> $valor
			);
		$wpdb->update( $ficha_3_pergunta_11, $data_ficha_3_pergunta_11, $where_ficha_3_pergunta_11, $format = null, $where_format = null ); 
	}

	// Tabela de Avaliação
	$ficha_3_avaliacao = 'ficha_3_avaliacao';
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Capacidade Funcional');
	// Capacidade Funcional (3: a+b+c+d+e+f+g+h+i+j) =
	$data_cap_func = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Capacidade Funcional',
			'valor'=> $_POST['cap_func_2']
		);
	$wpdb->update( $ficha_3_avaliacao, $data_cap_func, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 


	// Aspectos Físicos (4: a+b+c+d) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Aspectos Físicos');
	$data_aspectos_fisicos = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspectos Físicos',
			'valor'=> $_POST['aspectos_fisicos_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$wpdb->update( $ficha_3_avaliacao, $data_aspectos_fisicos, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 

	// Dor (7+8) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Dor');
	$data_dor = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Dor',
			'valor'=> $_POST['dor_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$wpdb->update( $ficha_3_avaliacao, $data_dor, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 

	// Estado Geral de saúde (1+11) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Estado Geral de saúde');
	$data_estado_geral = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Estado Geral de saúde',
			'valor'=> $_POST['estado_geral_2'],
			'id_ficha_3'=> $id_ficha_3
		);
	$wpdb->update( $ficha_3_avaliacao, $data_estado_geral, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 

	// Vitalidade (9: a+e+g+i) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Vitalidade');
	$data_vitalidade = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Vitalidade',
			'valor'=> $_POST['vitalidade_2']
		);
	$wpdb->update( $ficha_3_avaliacao, $data_vitalidade, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 

	// Aspectos Sociais (6+10) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Aspectos Sociais');
	$data_aspectos_sociais = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspectos Sociais',
			'valor'=> $_POST['aspectos_sociais_2']
		);
	$wpdb->update( $ficha_3_avaliacao, $data_aspectos_sociais, $where_ficha_3_avaliacao, $format = null, $where_format = null ); 

	// Aspecto Emocional (5: a+b+c) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Aspecto Emocional');
	$data_aspecto_emo = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Aspecto Emocional',
			'valor'=> $_POST['aspecto_emo_2']
		);
	$wpdb->update( $ficha_3_avaliacao, $data_aspecto_emo, $where_ficha_3_avaliacao, $format = null, $where_format = null );

	// Saúde Mental (9: b+c+d+f+h) =
	$where_ficha_3_avaliacao = array('num_paciente'=> $num_paciente, 'id_ficha_3'=>$id_ficha, 'avaliacao'=>'Saúde Mental');
	$data_saude_mental = array(
			'num_paciente'=> $_POST['num_paciente'],
			'avaliacao'=> 'Saúde Mental',
			'valor'=> $_POST['saude_mental_2']
		);
	$wpdb->update( $ficha_3_avaliacao, $data_saude_mental, $where_ficha_3_avaliacao, $format = null, $where_format = null );

}

include "layout/header.php"; 
?>

<div id="pagina2" class="cadastro-paciente">
	<header class="header_cadastro-paciente">
		<h1 class="font24 colorTextWhite open_semibold title_maior">Ficha 3 Edição</h1>
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
						<input type="text" name="pesquisador" value="<?php echo $obj_paciente->pesquisador; ?>" required>
					</div>
					<div>
						<label>Data:</label>
						<input type="date" name="data" value="<?php echo $obj_paciente->data; ?>" required>
					</div>
				</fieldset>
				<fieldset>
					<div class="span11">
						<label>Paciente:</label>
						<input type="text" name="nom_paciente" value="<?php echo $obj_paciente->nom_paciente; ?>" class="input_maior" required>
					</div>
				</fieldset>
				<fieldset>
					<div>
						<label>Nº do Protocolo:</label>
						<input type="text" name="num_protocolo" value="<?php echo $obj_paciente->num_protocolo; ?>" class="numero" required>
					</div>
					<div>
						<label>Nº do Atendimento:</label>
						<input type="text" name="num_atendimento" value="<?php echo $obj_paciente->num_atendimento; ?>" class="numero" required>
					</div>
					<div>
						<label>Retorno:</label>
						<input type="date" name="data_retorno" value="<?php echo $obj_paciente->retorno; ?>" required>
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

				<?php
					$pergunta_1 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 1); 
					listar_opcoes_ficha_3_pergunta_1($pergunta_1->valor); 
				?>

			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">2 - Comparada a um ano atrás, como você classificaria sua saúde em geral, agora?  </p>
				<input type="hidden" name="pergunta_2" value="2 - Comparada a um ano atrás, como você classificaria sua saúde em geral, agora?">
				<?php
					$pergunta_2 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 2); 
					listar_opcoes_ficha_3_pergunta_2($pergunta_2->valor); 
				?>
				
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
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Atividades vigorosas, que exigem muito esforço, tais como correr, levantar objetos pesados, participar em esportes árduos."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 1); 
						?>
				
					</tr>
					<tr>
						<td>Atividades moderadas, tais como mover uma mesa, passar aspirador de pó, jogar bola, varrer a casa.</td>
						<input type="hidden" name="atividade_2" value="Atividades moderadas, tais como mover uma mesa, passar aspirador de pó, jogar bola, varrer a casa.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Atividades moderadas, tais como mover uma mesa, passar aspirador de pó, jogar bola, varrer a casa."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 2); 
						?>
					</tr>
					<tr>
						<td>Levantar ou carregar mantimentos.</td>
						<input type="hidden" name="atividade_3" value="Levantar ou carregar mantimentos.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Levantar ou carregar mantimentos."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 3); 
						?>
					</tr>
					<tr>
						<td>Subir vários lances de escada.</td>
						<input type="hidden" name="atividade_4" value="Subir vários lances de escada.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Subir vários lances de escada."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 4); 
						?>
					</tr>
					<tr>
						<td>Subir um ance de escada.</td>
						<input type="hidden" name="atividade_5" value="Subir um ance de escada.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Subir um ance de escada."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 5); 
						?>
					</tr>
					<tr>
						<td>Curvar-se, ajoelhar-se ou dobrar-se.</td>
						<input type="hidden" name="atividade_6" value="Curvar-se, ajoelhar-se ou dobrar-se.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Curvar-se, ajoelhar-se ou dobrar-se."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 6); 
						?>
					</tr>
					<tr>
						<td>Andar mais de um quilômetro.</td>
						<input type="hidden" name="atividade_7" value="Andar mais de um quilômetro.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Andar mais de um quilômetro."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 7); 
						?>
					</tr>
					<tr>
						<td>Andar vários quarteirões.</td>
						<input type="hidden" name="atividade_8" value="Andar vários quarteirões.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Andar vários quarteirões."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 8); 
						?>
					</tr>
					<tr>
						<td>Andar um quarteirão.</td>
						<input type="hidden" name="atividade_9" value="Andar um quarteirão.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Andar um quarteirão."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 9); 
						?>
					</tr>
					<tr>
						<td>Tomar banho ou vestir-se.</td>
						<input type="hidden" name="atividade_10" value="Tomar banho ou vestir-se.">
						<?php
							$pergunta_3 = buscar_pergunta_ficha_3_por_atividade ($num_paciente, $id_ficha, "Tomar banho ou vestir-se."); 
							listar_opcoes_ficha_3_pergunta_3($pergunta_3->valor, 10); 
						?>
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
							<input type='hidden' name='saude_fisica_resposta_1' value='SIM'>
							<input type='hidden' name='saude_fisica_resposta_2' value='NÃO'>
						</td>
						<?php
							$pergunta_4 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_fisica", "Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras atividades?"); 
							listar_opcoes_ficha_3_pergunta_4($pergunta_4->valor, 1); 
						?>
					</tr>
					<tr>
						<td>
							Realizou menos tarefasdo que gostaria?
							<input type="hidden" name="saude_fisica_item_2" value="Realizou menos tarefasdo que gostaria?">
						</td>
						<?php
							$pergunta_4 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_fisica", "Realizou menos tarefasdo que gostaria?"); 
							listar_opcoes_ficha_3_pergunta_4($pergunta_4->valor, 2); 
						?>
					</tr>
					<tr>
						<td>
							Esteve limitado no seu tipo de trabalho ou outras atividades?
							<input type="hidden" name="saude_fisica_item_3" value="Esteve limitado no seu tipo de trabalho ou outras atividades?">
						</td>
						<?php
							$pergunta_4 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_fisica", "Esteve limitado no seu tipo de trabalho ou outras atividades?"); 
							listar_opcoes_ficha_3_pergunta_4($pergunta_4->valor, 3); 
						?>
					</tr>
					<tr>
						<td>
							Teve dificuldade de fazer seu trabalho ou outras ativiades (por exemplo: necessitou de um esforço extra)?
							<input type="hidden" name="saude_fisica_item_4" value="Teve dificuldade de fazer seu trabalho ou outras ativiades (por exemplo: necessitou de um esforço extra)?">
						</td>
						<?php
							$pergunta_4 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_fisica", "Teve dificuldade de fazer seu trabalho ou outras ativiades (por exemplo: necessitou de um esforço extra)?"); 
							listar_opcoes_ficha_3_pergunta_4($pergunta_4->valor, 4); 
						?>
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
							<input type="hidden" name="saude_diaria_resposta_1" value="SIM">
							<input type="hidden" name="saude_diaria_resposta_2" value="NÃO">
						</td>
						<?php
							$pergunta_5 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_diaria", "Você diminuiu a quantidade de tempo que se dedicava ao seu trabalho ou a outras ativiadades?"); 
							listar_opcoes_ficha_3_pergunta_5($pergunta_5->valor, 1); 
						?>
						
					</tr>
					<tr>
						<td>
							Realizou menos tarefas do que você gostaria?
							<input type="hidden" name="saude_diaria_item_2" value="Realizou menos tarefas do que você gostaria?">
						</td>
						<?php
							$pergunta_5 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha,  "ficha_3_saude_diaria", "Realizou menos tarefas do que você gostaria?"); 
							listar_opcoes_ficha_3_pergunta_5($pergunta_5->valor, 2); 
						?>
					</tr>
					<tr>
						<td>
							Não trabalhou ou fez qualquer das atividades com tanto cuidado como geralmente faz? 
							<input type="hidden" name="saude_diaria_item_3" value="Não trabalhou ou fez qualquer das atividades com tanto cuidado como geralmente faz?">
						</td>
						<?php
							$pergunta_5 = buscar_pergunta_ficha_3_por_item ($num_paciente, $id_ficha, "ficha_3_saude_diaria", "Não trabalhou ou fez qualquer das atividades com tanto cuidado como geralmente faz?"); 
							listar_opcoes_ficha_3_pergunta_5($pergunta_5->valor, 3); 
						?>
					</tr>
				</table>

			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">6 - Durante as últimas <strong>4 semanas,</strong> de que maneira sua saúde física ou problemas emocionais interferiram nas suas atividades sociais normais, em relação a família, vizinhos, amigos ou em grupo?</p>
				<input type="hidden" name="pergunta_6" value="6 - Durante as últimas <strong>4 semanas,</strong> de que maneira sua saúde física ou problemas emocionais interferiram nas suas atividades sociais normais, em relação a família, vizinhos, amigos ou em grupo?">
				<?php
					$pergunta_6 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 6); 
					listar_opcoes_ficha_3_pergunta_6($pergunta_6->valor); 
				?>
				
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">7 - Quanta dor <strong>no corpo,</strong> você teve durante as últimas <strong>4 semanas?</strong></p>
				<input type="hidden" name="pergunta_7" value="7 - Quanta dor <strong>no corpo,</strong> você teve durante as últimas <strong>4 semanas?</strong>">
				<?php
					$pergunta_7 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 7); 
					listar_opcoes_ficha_3_pergunta_7($pergunta_7->valor); 
				?>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">8 - Durante as últimas <strong>8 semanas,</strong> quanto a dor interferiu com o seu trabalho normal (incluindo tanto o trabalho, fora e dentro de casa)?</p>
				<input type="hidden" name="pergunta_8" value="8 - Durante as últimas <strong>8 semanas,</strong> quanto a dor interferiu com o seu trabalho normal (incluindo tanto o trabalho, fora e dentro de casa)?">
				<?php
					$pergunta_8 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 8); 
					listar_opcoes_ficha_3_pergunta_8($pergunta_8->valor); 
				?>
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
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido cheio de vigor, cheio de vontade, cheio de força?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 1); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido uma pessoa muito nervosa?</td>
						<input type="hidden" name="pergunta_9_item_2" value="Quanto tempo você tem se sentido uma pessoa muito nervosa?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido uma pessoa muito nervosa?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 2); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido tão deprimido que nada pode animá-lo?</td>
						<input type="hidden" name="pergunta_9_item_3" value="Quanto tempo você tem se sentido tão deprimido que nada pode animá-lo?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido tão deprimido que nada pode animá-lo?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 3); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido calmo ou tranquilo?</td>
						<input type="hidden" name="pergunta_9_item_4" value="Quanto tempo você tem se sentido calmo ou tranquilo?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido calmo ou tranquilo?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 4); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido com muita energia?</td>
						<input type="hidden" name="pergunta_9_item_5" value="Quanto tempo você tem se sentido com muita energia?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido com muita energia?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 5); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido desanimado e abatido?</td>
						<input type="hidden" name="pergunta_9_item_6" value="Quanto tempo você tem se sentido desanimado e abatido?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido desanimado e abatido?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 6); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido esgotado?</td>
						<input type="hidden" name="pergunta_9_item_7" value="Quanto tempo você tem se sentido esgotado?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido esgotado?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 7); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido uma pessoa feliz?</td>
						<input type="hidden" name="pergunta_9_item_8" value="Quanto tempo você tem se sentido uma pessoa feliz?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido uma pessoa feliz?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 8); 
						?>
					</tr>
					<tr>
						<td>Quanto tempo você tem se sentido cansado?</td>
						<input type="hidden" name="pergunta_9_item_9" value="Quanto tempo você tem se sentido cansado?">
						<?php
							$pergunta_9 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_9", "Quanto tempo você tem se sentido cansado?"); 
							listar_opcoes_ficha_3_pergunta_9($pergunta_9->valor, 9); 
						?>
					</tr>

				</table>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left">10 - Durante as últimas <strong>4 semanas,</strong> quanto do seu tempo a sua <strong>saúde física ou problemas emocionais</strong> interferiram com as suas atividades sociais (como visitar amigos, parentes, etc)?</p>
				<input type="hidden" name="pergunta_10" value="10 - Durante as últimas <strong>4 semanas,</strong> quanto do seu tempo a sua <strong>saúde física ou problemas emocionais</strong> interferiram com as suas atividades sociais (como visitar amigos, parentes, etc)?">
				<?php
					$pergunta_10 = buscar_pergunta_ficha_3 ($num_paciente, $id_ficha, 10); 
					listar_opcoes_ficha_3_pergunta_10($pergunta_10->valor); 
				?>
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
						<?php
							$pergunta_11 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_11", "Eu costumo adoecer um pouco mais facilmente que as outras pessoas."); 
							listar_opcoes_ficha_3_pergunta_11($pergunta_11->valor, 1); 
						?>
					</tr>
					<tr>
						<td>Eu sou tão saudável quanto qualquer pessoa que eu conheço.</td>
						<input type="hidden" name="pergunta_11_item_2" value="Eu sou tão saudável quanto qualquer pessoa que eu conheço.">
						<?php
							$pergunta_11 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_11", "Eu sou tão saudável quanto qualquer pessoa que eu conheço."); 
							listar_opcoes_ficha_3_pergunta_11($pergunta_11->valor, 2); 
						?>
					</tr>
					<tr>
						<td>Eu acho que a minha saúde vai piorar.</td>
						<input type="hidden" name="pergunta_11_item_3" value="Eu acho que a minha saúde vai piorar.">
						<?php
							$pergunta_11 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_11", "Eu acho que a minha saúde vai piorar."); 
							listar_opcoes_ficha_3_pergunta_11($pergunta_11->valor, 3); 
						?>
					</tr>
					<tr>
						<td>Minha saúde é excelente.</td>
						<input type="hidden" name="pergunta_11_item_4" value="Minha saúde é excelente.">
						<?php
							$pergunta_11 = buscar_pergunta_ficha_3_por_item($num_paciente, $id_ficha, "ficha_3_pergunta_11", "Minha saúde é excelente."); 
							listar_opcoes_ficha_3_pergunta_11($pergunta_11->valor, 4); 
						?>
					</tr>
				</table>
			</div>

			<div class="sessao row-fluid">
				<p class="no_padding_left"><strong><u>AVALIAÇÂO:</u></strong></p>
				<p>Capacidade Funcional (3: a+b+c+d+e+f+g+h+i+j) = <strong><span id="cap_func"><?php echo $cap_funcional->valor; ?></span></strong></p>
				<input type="hidden" name="cap_func_2" id="cap_func_2" value="<?php echo $cap_funcional->valor; ?>">
				<p>Aspectos Físicos (4: a+b+c+d) = <strong><span id="aspectos_fisicos"><?php echo $aspc_fisicos->valor; ?></span></strong></p>
				<input type="hidden" name="aspectos_fisicos_2" id="aspectos_fisicos_2" value="<?php echo $aspc_fisicos->valor; ?>">
				<p>Dor (7+8) = <strong><span id="dor"><?php echo $dor->valor; ?></span></strong></p>
				<input type="hidden" name="dor_2" id="dor_2" value="<?php echo $dor->valor; ?>">
				<p>Estado Geral de saúde (1+11) = <strong><span id="estado_geral"><?php echo $est_geral->valor; ?></span></strong></p>
				<input type="hidden" name="estado_geral_2" id="estado_geral_2" value="<?php echo $est_geral->valor; ?>">
				<p>Vitalidade (9: a+e+g+i) = <strong><span id="vitalidade"><?php echo $vitalidade->valor; ?></span></strong></p>
				<input type="hidden" name="vitalidade_2" id="vitalidade_2" value="<?php echo $vitalidade->valor; ?>">
				<p>Aspectos Sociais (6+10) = <strong><span id="aspectos_sociais"><?php echo $aspc_sociais->valor; ?></span></strong></p>
				<input type="hidden" name="aspectos_sociais_2" id="aspectos_sociais_2" value="<?php echo $aspc_sociais->valor; ?>">
				<p>Aspecto Emocional (5: a+b+c) = <strong><span id="aspecto_emo"><?php echo $aspc_emo->valor; ?></span></strong></p>
				<input type="hidden" name="aspecto_emo_2" id="aspecto_emo_2" value="<?php echo $aspc_emo->valor; ?>">
				<p>Saúde Mental (9: b+c+d+f+h) = <strong><span id="saude_mental"><?php echo $saude_mental->valor; ?></span></strong></p>
				<input type="hidden" name="saude_mental_2" id="saude_mental_2" value="<?php echo $saude_mental->valor; ?>">
			</div>
			<input type="hidden" name="ficha" value="<?php echo $id_ficha; ?>">
			<button type="submit" name="submit" class="btn btn-primary enviar">Salvar</button>
		</form>

	</div>
</div>

<?php include "layout/footer.php"; ?>
