<?php 
if($_GET['cod']){
	$num_paciente = $_GET['cod'];
	// $id_ficha = $_GET['ficha'];
}else{
	$num_paciente =  "";
}

if(isset($_POST['submit'])){
	// inserir dados na ficha 2
	$paciente_ficha_2 = 'paciente_ficha_2';
	
	$data_paciente_ficha_2 = array(
		'num_paciente'=> $_POST['num_paciente'],
		'nom_paciente'=> $_POST['nom_paciente'],
		'etapa'=> $_POST['etapa'],
		'data'=> $_POST['data'],
		'porcentagem'=>$_POST['porcentagem']
	);
	$wpdb->insert( $paciente_ficha_2, $data_paciente_ficha_2, $format );
	$id_ficha_2 = $wpdb->insert_id;

	// Inserir dados na tabela de avaliacao_aderencias
	$avaliacao_aderencia = 'avaliacao_aderencia';
	for($i=1; $i < 7; $i++){
		if($i != 4){
			$data_avaliacao_aderencia = array(
				'num_paciente'=> $_POST['num_paciente'],
				'id_pergunta'=> $i,
				'des_pergunta'=> $_POST['perg'.$i],
				'resposta'=> $_POST['perg_aderencia_'.$i],
				'id_ficha_2'=> $id_ficha_2
			);
			$wpdb->insert( $avaliacao_aderencia, $data_avaliacao_aderencia, $format );
		}
	}

	$avaliacao_aderencia_porque = 'avaliacao_aderencia_porque';
	foreach ($_POST['perg_aderencia_4'] as $key => $value) {
		$data_avaliacao_aderencia_porque = array(
			'num_paciente' => $_POST['num_paciente'], 
			'item'=> $value,
			'id_ficha_2'=> $id_ficha_2
		);
		$wpdb->insert( $avaliacao_aderencia_porque, $data_avaliacao_aderencia_porque, $format );
	}

	$reacoes_indesejaveis = 'reacoes_indesejaveis';

	$data_reacoes_indesejaveis = array (
		'num_paciente'=>$_POST['num_paciente'],
		'pergunta'=> 'Você sentiu alguma reação indesejável durante a 1ª/2ª etapa do tratamento?',
		'resposta'=>$_POST['reacao1'],
		'id_ficha_2'=> $id_ficha_2
		);
	$wpdb->insert( $reacoes_indesejaveis, $data_reacoes_indesejaveis, $format );

	if($_POST['reacao1'] == 'Sim'){
		$reacoes_indesejaveis_ram = 'reacoes_indesejaveis_ram';
		for($i=1; $i<8; $i++){
			if($_POST['ram'.$i] != ""){
				$data_reacoes_indesejaveis_ram = array (
					'num_paciente'=>$_POST['num_paciente'],
					'ram'=>$_POST['ram'.$i],
					'num_ram'=>$_POST['num_ram'.$i],
					'qual_dia'=>$_POST['dia'.$i],
					'continua'=>$_POST['continua'.$i],
					'id_ficha_2'=> $id_ficha_2
				);
				$wpdb->insert( $reacoes_indesejaveis_ram, $data_reacoes_indesejaveis_ram, $format );
			}
		}
	}

	// Uso de medicamentos
	$uso_medicamento = 'uso_medicamento';
	$data_uso_medicamento = array (
		'num_paciente'=>$_POST['num_paciente'],
		'pergunta'=>$_POST['uso_medicamento_perg'],
		'resposta'=>$_POST['medicamento_uso_continuo'],
		'qual'=>$_POST['quais_medicamentos'],
		'qnt_tempo'=>$_POST['tempo_medicamentos'],
		'id_ficha_2'=> $id_ficha_2
	);

	$wpdb->insert( $uso_medicamento, $data_uso_medicamento, $format );

}

include "layout/header.php"; 
?>
		<div id="pagina2" class="cadastro-paciente">
			<header class="header_cadastro-paciente">
				<h1 class="font24 colorTextWhite open_semibold title_maior">Ficha 2</h1>
			</header>

			<div class="cabecalho row-fluid">
				<p>Universidade Federal do Ceará</p>
				<p>Departamento de análises clínicas e toxicologicas (DACT)</p>
				<p>Laboratório de pesquisa em doença de chagas</p>
				<p>progama de atenção farmacêutica ao paciente chagástico</p>
			</div>
			<div class="row-fluid title">
				<h4>Ficha de Avaliação de Aderência e reações indesejáveis ao Benzonidazol</h4>
			</div>
			<div class="formulario">
				<?php
					// if (is_user_logged_in()) {
						// $user = wp_get_current_user();
					 //    print_r(wp_get_current_user());
					 //    echo '<br />';
					 //    echo $user->roles[0];
					 //    if($user->roles[0] == 'editor'){
					 //    	echo '<br />';
					 //    	echo 'Editor';	
					 //    }

					 //    if($user->roles[0] == 'colaborador'){
					 //    	echo '<br />';
					 //    	echo 'colaborador';	
					 //    }

					 //    echo '<br />';

				?>
				<form action="" method="post">
					<div class="sessao row-fluid">
						<fieldset>
							<div class="span8">
								<label>Paciente:</label>
								<input type="text" name="nom_paciente" value="" class="input_media" required>
							</div>
							<div class="span4">
								<label>Nº Paciente:</label>
								<input type="text" name="num_paciente" value="<?php echo $num_paciente; ?>" class="numero" required>
							</div>
						</fieldset>
						<fieldset>
							<div class="span8">
							<label>Avaliação do tratamento:</label>
								<div class="radio-div">
									<input type="radio" name="etapa" value="1º Etapa" id="cidade"><span class="radio-label">1º Etapa</span>
								</div>
								<div class="radio-div">
									<input type="radio" name="etapa" value="2º Etapa"><span class="radio-label">2º Etapa</span>
								</div>
							</div>
							
							<div class="span4">
								<label>Data:</label>
								<input type="date" name="data" value="" required>
							</div>
						</fieldset>
					</div>
					<div class="sessao row-fluid">
						<h5>Avaliação de Aderência</h5>
							<div class="span12 perguntas_aderencia">
								<label>Durante a 1ª/2ª etapa do tratamento, o Sr. (a) deixou de tomar o Benzonidazol alguma vez ou tomou menos comprimidos receitados pelo médico?</label>
								<div class="radio-div">
									<input type="radio" name="perg_aderencia_1" value="Sim"><span class="radio-label">Sim</span>
								</div>
								<div class="radio-div">
									<input type="radio" name="perg_aderencia_1" value="Não"><span class="radio-label">Não</span>
								</div>
								<input type="hidden" name="perg1" value="Durante a 1ª/2ª etapa do tratamento, o Sr. (a) deixou de tomar o Benzonidazol alguma vez ou tomou menos comprimidos receitados pelo médico?">
							</div>

							<div class="span12 perguntas_aderencia">
								<label>Quantos comprimidos em média deixou de tomar?</label>
								<input type="text" value="" name="perg_aderencia_2">
							</div>

							<div class="span12 perguntas_aderencia">
								<label>Aproximadamente quantas vezes?</label>
								<input type="text" value="" name="perg_aderencia_3">
							</div>
							<input type="hidden" name="perg2" value="Quantos comprimidos em média deixou de tomar?">
							<input type="hidden" name="perg3" value="Aproximadamente quantas vezes?">
							<input type="hidden" name="perg4" value="Por que?">
							<input type="hidden" name="perg5" value="Quantos comprimidos no total o paciente tomou na 1ª/2ª etapa?">
							<input type="hidden" name="perg6" value="Quantos comprimidos deveria ter tomado na 1ª/2ª etapa?">

							<div class="span12 perguntas_aderencia">
								<label>Por que?</label>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Não quis tomar">Não quis tomar
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Para durar mais">Para durar mais
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Dose alta">Dose alta
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Reação desagradável">Reação desagradável
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Não sabe tomar">Não sabe tomar
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Sente-se bem">Sente-se bem
								</div>
								<div class="checkbox">
									<input type="checkbox" name="perg_aderencia_4[]" value="Esquecimento">Esquecimento
								</div>
							</div>
							<div class="span12 perguntas_aderencia">
								<p><strong>Percentual de aderência (Calculado pelo farmacêutico):</strong></p>
								<div>
									<label>Quantos comprimidos no total o paciente tomou na 1ª/2ª etapa?</label>
									<input type="text" name="perg_aderencia_5" value="">
								</div>
								<div>
									<label>Quantos comprimidos deveria ter tomado na 1ª/2ª etapa?</label>
									<input type="text" name="perg_aderencia_6" value="">
								</div>
								<input type="text" name="porcentagem" id="porcentagem" value="" class="input_menor">
							</div>

					</div>

					<div class="sessao row-fluid perguntas_aderencia">
						<h5>Reações Indesejáveis</h5>
						<fieldset>
							<div class="span8">
								Você sentiu alguma reação indesejável durante a 1ª/2ª etapa do tratamento?
							</div>
							<div class="span4 resposta">
								<div class="div_radio">
									<input type="radio" name="reacao1" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="reacao1" value="Não">Não
								</div>
							</div>
						</fieldset>	
						<fieldset>
							<div class="div_full">
								Se sim, quais foram as reações?
						</fieldset>	
						<fieldset>
							<div class="span4">
								RAM 1: <input type="text" name="ram1" value="">
								<input type="hidden" name="num_ram1" value="1">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia1" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua1" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua1" value="Não">Não
								</div>
							</div>
						</fieldset>	
						<fieldset>
							<div class="span4">
								RAM 2: <input type="text" name="ram2" value="">
								<input type="hidden" name="num_ram2" value="2">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia2" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua2" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua2" value="Não">Não
								</div>
							</div>
						</fieldset>	

						<fieldset>
							<div class="span4">
								RAM 3: <input type="text" name="ram3" value="">
								<input type="hidden" name="num_ram3" value="3">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia3" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua3" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua3" value="Não">Não
								</div>
							</div>
						</fieldset>	
						<fieldset>
							<div class="span4">
								RAM 4: <input type="text" name="ram4" value="">
								<input type="hidden" name="num_ram4" value="4">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia4" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua4" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua4" value="Não">Não
								</div>
							</div>
						</fieldset>	

						<fieldset>
							<div class="span4">
								RAM 5: <input type="text" name="ram5" value="">
								<input type="hidden" name="num_ram5" value="5">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia5" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua5" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua5" value="Não">Não
								</div>
							</div>
						</fieldset>	
						<fieldset>
							<div class="span4">
								RAM 6: <input type="text" name="ram6" value="">
								<input type="hidden" name="num_ram6" value="6">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia6" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua6" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua6" value="Não">Não
								</div>
							</div>
						</fieldset>	

						<fieldset>
							<div class="span4">
								RAM 7: <input type="text" name="ram7" value="">
								<input type="hidden" name="num_ram7" value="7">
							</div>
							<div class="span4">
								Qual dia?
								<input type="text" name="dia7" value="">
							</div>
							<div class="span4 continua">
								<p>Continua?</p>
								<div class="div_radio">
									<input type="radio" name="continua7" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="continua7" value="Não">Não
								</div>
							</div>
						</fieldset>	
					</div>
					<div class="sessao row-fluid">
						<h5>Uso de medicamentos</h5>
						<fieldset>
							<div class="span8">
								Durante a 1ª/2ª etapa do tratamento, o Sr.(a) utilizou algum medicamento além daqueles de uso contínuo?
								<input type="hidden" name="uso_medicamento_perg" value="Durante a 1ª/2ª etapa do tratamento, o Sr.(a) utilizou algum medicamento além daqueles de uso contínuo?">
							</div>
							<div class="span4 resposta">
								<div class="div_radio">
									<input type="radio" name="medicamento_uso_continuo" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="medicamento_uso_continuo" value="Não">Não
								</div>
							</div>
						</fieldset>	
						<fieldset>
							<div class="span2">
								Se sim, qual/quais?
							</div>
							<div class="span10">
								<input type="text" name="quais_medicamentos" value="" class="input_media">
							</div>
						</fieldset>	
						<fieldset>
							<div class="span2">
								Durante quanto tempo?
							</div>
							<div class="span10">
								<input type="text" name="tempo_medicamentos" value="" class="input_media">
							</div>
						</fieldset>	
					</div>

					<button type="submit" name="submit" class="btn btn-large btn-primary enviar">Salvar</button>
					
				</form>

				<?php	
					// print_r($results);	
					// } else {
					//     echo 'Voce nao esta logado!';
					// }
					?>
			</div>

			
			
			
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>