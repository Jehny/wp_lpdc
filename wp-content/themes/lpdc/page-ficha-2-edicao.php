<?php 
if($_GET['cod']){
	$num_paciente = $_GET['cod'];
	$id_ficha = $_GET['ficha'];
	$obj_paciente = buscar_paciente_ficha_2($num_paciente, $id_ficha);
	$avaliacao_aderencia_pergunta_1 = buscar_pergunta_avaliacao_aderencia($num_paciente, 1, $id_ficha);
	$avaliacao_aderencia_pergunta_2 = buscar_pergunta_avaliacao_aderencia($num_paciente, 2, $id_ficha);
	$avaliacao_aderencia_pergunta_3 = buscar_pergunta_avaliacao_aderencia($num_paciente, 3, $id_ficha);
	$avaliacao_aderencia_pergunta_5 = buscar_pergunta_avaliacao_aderencia($num_paciente, 5, $id_ficha);
	$avaliacao_aderencia_pergunta_6 = buscar_pergunta_avaliacao_aderencia($num_paciente, 6, $id_ficha);
	$avaliacao_aderencia_porque = buscar_aderencia_porque($num_paciente, $id_ficha);
	$reacao_indesejavel = buscar_pergunta_reacao_indesejavel($num_paciente, $id_ficha);
	$reacao_ram = buscar_reacoes_ram($num_paciente, $id_ficha);
	$uso_medicamento = buscar_uso_medicamento_id($num_paciente, $id_ficha);
}else{
	$num_paciente =  "";
	$id_ficha = "";
}

if(isset($_POST['submit'])){
	// inserir dados na ficha 2
	$paciente_ficha_2 = 'paciente_ficha_2';
	$where_paciente_ficha_2 = array('num_paciente'=> $num_paciente, 'id'=>$id_ficha);
	$data_paciente_ficha_2 = array(
		'num_paciente'=> $_POST['num_paciente'],
		'nom_paciente'=> $_POST['nom_paciente'],
		'etapa'=> $_POST['etapa'],
		'data'=> $_POST['data'],
		'porcentagem'=>$_POST['porcentagem']
	);
	$wpdb->insert( $paciente_ficha_2, $data_paciente_ficha_2, $format );
	$wpdb->update( $paciente_ficha_2, $data_paciente_ficha_2, $where_paciente_ficha_2, $format = null, $where_format = null ); 

	// Inserir dados na tabela de avaliacao_aderencias
	$avaliacao_aderencia = 'avaliacao_aderencia';
	for($i=1; $i < 7; $i++){
		if($i != 4){
			$where_avaliacao_aderencia = array('num_paciente'=> $num_paciente, 'id_pergunta'=>$i, 'id_ficha_2'=>$id_ficha);
			$data_avaliacao_aderencia = array(
				'num_paciente'=> $_POST['num_paciente'],
				'id_pergunta'=> $i,
				'des_pergunta'=> $_POST['perg'.$i],
				'resposta'=> $_POST['perg_aderencia_'.$i]
			);

		$wpdb->update( $avaliacao_aderencia, $data_avaliacao_aderencia, $where_avaliacao_aderencia, $format = null, $where_format = null ); 

		}
	}

	$count_array = count($_POST['perg_aderencia_4']);
	$array_valores = array();
	foreach ($_POST['perg_aderencia_4'] as $key => $value) {
		array_push($array_valores, $value);
	}

	atualizar_aderencia_porque($num_paciente, $count_array, $array_valores, $id_ficha);

	$reacoes_indesejaveis = 'reacoes_indesejaveis';
	$where_reacoes_indesejaveis = array('num_paciente'=> $num_paciente, 'id_ficha_2'=>$id_ficha);

	$data_reacoes_indesejaveis = array (
		'num_paciente'=>$_POST['num_paciente'],
		'pergunta'=> 'Você sentiu alguma reação indesejável durante a 1ª/2ª etapa do tratamento?',
		'resposta'=>$_POST['reacao1']
		);
	$wpdb->update( $reacoes_indesejaveis, $data_reacoes_indesejaveis, $where_reacoes_indesejaveis, $format = null, $where_format = null ); 

	if($_POST['reacao1'] == 'Sim'){
		$reacoes_indesejaveis_ram = 'reacoes_indesejaveis_ram';
		for($i=1; $i<8; $i++){
			$where_reacoes_indesejaveis_ram = array('num_paciente'=> $num_paciente, 'num_ram'=>$_POST['num_ram'.$i], 'id_ficha_2'=>$id_ficha);
			if(trim($_POST['ram'.$i] != "")){

				$data_reacoes_indesejaveis_ram = array (
					'num_paciente'=>$_POST['num_paciente'],
					'ram'=>$_POST['ram'.$i],
					'qual_dia'=>$_POST['dia'.$i],
					'continua'=>$_POST['continua'.$i]
					
				);
				// Pesquisa se tem algum dado com o item que deseja fazer a atualização
				$result2 = $wpdb->get_row('SELECT * FROM ' . $reacoes_indesejaveis_ram . ' WHERE num_ram='. $i . ' AND num_paciente='.$num_paciente . ' AND id_ficha_2='.$id_ficha);
				// Tenta fazer o update
				$result = $wpdb->update( $reacoes_indesejaveis_ram, $data_reacoes_indesejaveis_ram, $where_reacoes_indesejaveis_ram, $format = null, $where_format = null ); 
				// Se a busca e o upadate falharem faz um inserte na tabela
				if(!$result && !$result2){
					$data_reacoes_indesejaveis_ram = array (
						'num_paciente'=>$_POST['num_paciente'],
						'ram'=>$_POST['ram'.$i],
						'num_ram'=>$_POST['num_ram'.$i],
						'qual_dia'=>$_POST['dia'.$i],
						'continua'=>$_POST['continua'.$i],
						'id_ficha_2'=> $id_ficha
					);
					$wpdb->insert( $reacoes_indesejaveis_ram, $data_reacoes_indesejaveis_ram, $format );
				}
			} else {
				$result3 = $wpdb->get_row('SELECT * FROM ' . $reacoes_indesejaveis_ram . ' WHERE num_ram='. $i . ' AND num_paciente='.$num_paciente . ' AND id_ficha_2='.$id_ficha);
				// Se a busca retornar resultado mas os campos estiverem em branco exclui uma linha do banco
				if($result3 && trim($_POST['ram'.$i] == "") && trim($_POST['dia'.$i] == "")){
					$where =  array('num_paciente'=> $num_paciente, 'num_ram'=>$i, 'id_ficha_2'=>$id_ficha);
					$wpdb->delete( $reacoes_indesejaveis_ram, $where, $where_format = null);
				}
			}
		}
	}

	//Uso de medicamentos
	$uso_medicamento = 'uso_medicamento';
	$where_uso_medicamento = array('num_paciente'=> $num_paciente, 'id_ficha_2'=>$id_ficha);
	$data_uso_medicamento = array (
		'num_paciente'=>$_POST['num_paciente'],
		'pergunta'=>$_POST['uso_medicamento_perg'],
		'resposta'=>$_POST['medicamento_uso_continuo'],
		'qual'=>$_POST['quais_medicamentos'],
		'qnt_tempo'=>$_POST['tempo_medicamentos']
		
	);

	$wpdb->update( $uso_medicamento, $data_uso_medicamento, $where_uso_medicamento, $format = null, $where_format = null ); 

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
								<input type="text" name="nom_paciente" value="<?php echo $obj_paciente->nom_paciente; ?>" class="input_media" required>
							</div>
							<div class="span4">
								<label>Nº Paciente:</label>
								<input type="text" name="num_paciente" value="<?php echo $num_paciente; ?>" class="numero" required>
							</div>
						</fieldset>
						<fieldset>
							<div class="span8">
								<label>Avaliação do tratamento:</label>
								<?php if($obj_paciente->etapa == '1º Etapa') { ?>
									<div class="radio-div">
										<input type="radio" name="etapa" value="1º Etapa" id="cidade" checked><span class="radio-label">1º Etapa</span>
									</div>
									<div class="radio-div">
										<input type="radio" name="etapa" value="2º Etapa"><span class="radio-label">2º Etapa</span>
									</div>
								<?php } else { ?>
									<div class="radio-div">
										<input type="radio" name="etapa" value="1º Etapa" id="cidade"><span class="radio-label">1º Etapa</span>
									</div>
									<div class="radio-div">
										<input type="radio" name="etapa" value="2º Etapa" checked><span class="radio-label">2º Etapa</span>
									</div>
								<?php } ?>
							</div>
							
							<div class="span4">
								<label>Data:</label>
								<input type="date" name="data" value="<?php echo $obj_paciente->data; ?>" required>
							</div>
						</fieldset>
					</div>
						<div class="sessao row-fluid">
							<h5>Avaliação de Aderência</h5>
							<div class="span12 perguntas_aderencia">
								<label>Durante a 1ª/2ª etapa do tratamento, o Sr. (a) deixou de tomar o Benzonidazol alguma vez ou tomou menos comprimidos receitados pelo médico?</label>
								<?php if($avaliacao_aderencia_pergunta_1->resposta == 'Sim') { ?>
									<div class="radio-div">
										<input type="radio" name="perg_aderencia_1" value="Sim" checked><span class="radio-label">Sim</span>
									</div>
									<div class="radio-div">
										<input type="radio" name="perg_aderencia_1" value="Não"><span class="radio-label">Não</span>
									</div>
								<?php } else { ?>
									<div class="radio-div">
										<input type="radio" name="perg_aderencia_1" value="Sim"><span class="radio-label">Sim</span>
									</div>
									<div class="radio-div">
										<input type="radio" name="perg_aderencia_1" value="Não" checked><span class="radio-label">Não</span>
									</div>
								<?php } ?>
								<input type="hidden" name="perg1" value="Durante a 1ª/2ª etapa do tratamento, o Sr. (a) deixou de tomar o Benzonidazol alguma vez ou tomou menos comprimidos receitados pelo médico?">
							</div>

							<div class="span12 perguntas_aderencia">
								<label>Quantos comprimidos em média deixou de tomar?</label>
								<input type="text" value="<?php echo $avaliacao_aderencia_pergunta_2->resposta; ?>" name="perg_aderencia_2">
							</div>

							<div class="span12 perguntas_aderencia">
								<label>Aproximadamente quantas vezes?</label>
								<input type="text" value="<?php echo $avaliacao_aderencia_pergunta_3->resposta; ?>" name="perg_aderencia_3">
							</div>
							<input type="hidden" name="perg2" value="Quantos comprimidos em média deixou de tomar?">
							<input type="hidden" name="perg3" value="Aproximadamente quantas vezes?">
							<input type="hidden" name="perg4" value="Por que?">
							<input type="hidden" name="perg5" value="Quantos comprimidos no total o paciente tomou na 1ª/2ª etapa?">
							<input type="hidden" name="perg6" value="Quantos comprimidos deveria ter tomado na 1ª/2ª etapa?">
							
							<div class="span12 perguntas_aderencia">
								<label>Por que?</label>
								<?php 
								$array_porque = array();
								$total_check = count($avaliacao_aderencia_porque);
								for($i=0; $i<$total_check; $i++){
									array_push($array_porque, $avaliacao_aderencia_porque[$i]->item);
								}
								if(in_array("Não quis tomar", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Não quis tomar" checked=checked>Não quis tomar
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Não quis tomar">Não quis tomar
									</div>
								<?php } ?>
								<?php if(in_array("Para durar mais", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Para durar mais" checked=checked>Para durar mais
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Para durar mais">Para durar mais
									</div>
								<?php } ?>

								<?php if(in_array("Dose alta", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Dose alta" checked=checked>Dose alta
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Dose alta">Dose alta
									</div>
								<?php } ?>
								
								<?php if(in_array("Reação desagradável", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Reação desagradável" checked=checked>Reação desagradável
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Reação desagradável">Reação desagradável
									</div>
								<?php } ?>

								<?php if(in_array("Não sabe tomar", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Não sabe tomar" checked=checked>Não sabe tomar
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Não sabe tomar">Não sabe tomar
									</div>
								<?php } ?>
								
								<?php if(in_array("Sente-se bem", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Sente-se bem" checked=checked>Sente-se bem
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Sente-se bem">Sente-se bem
									</div>
								<?php } ?>
								<?php if(in_array("Esquecimento", $array_porque)) { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Esquecimento" checked=checked>Esquecimento
									</div>
								<?php } else { ?>
									<div class="checkbox">
										<input type="checkbox" name="perg_aderencia_4[]" value="Esquecimento">Esquecimento
									</div>
								<?php } ?>
							</div>		
					
							<div class="span12 perguntas_aderencia">
								<p><strong>Percentual de aderência (Calculado pelo farmacêutico):</strong></p>
								<div>
									<label>Quantos comprimidos no total o paciente tomou na 1ª/2ª etapa?</label>
									<input type="text" name="perg_aderencia_5" value="<?php echo $avaliacao_aderencia_pergunta_5->resposta; ?>">
								</div>
								<div>
									<label>Quantos comprimidos deveria ter tomado na 1ª/2ª etapa?</label>
									<input type="text" name="perg_aderencia_6" value="<?php echo $avaliacao_aderencia_pergunta_6->resposta; ?>">
								</div>
								<input type="text" name="porcentagem" id="porcentagem" value="<?php echo $obj_paciente->porcentagem; ?>" class="input_menor">
							</div>

						</div>
						<div class="sessao row-fluid perguntas_aderencia">
							<h5>Reações Indesejáveis</h5>
							<fieldset>
								<div class="span8">
									Você sentiu alguma reação indesejável durante a 1ª/2ª etapa do tratamento?
								</div>
								<div class="span4 resposta">
								<?php if($reacao_indesejavel->resposta == "Sim"){ ?>
										<div class="div_radio">
											<input type="radio" name="reacao1" value="Sim" checked>Sim
										</div>
										<div class="div_radio">
											<input type="radio" name="reacao1" value="Não">Não
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="reacao1" value="Sim">Sim
										</div>
										<div class="div_radio">
											<input type="radio" name="reacao1" value="Não" checked>Não
										</div>
								<?php } ?>
								</div>
							</fieldset>	
							<fieldset>
								<div class="div_full">
									Se sim, quais foram as reações?
							</fieldset>	
							<?php for ($i=0; $i<7; $i++) { 
								$j = $i + 1;
								if(isset($reacao_ram[$i])) {
							?>
								<fieldset>
									<div class="span4">
										RAM <?php echo $j; ?>: <input type="text" name="ram<?php echo $j; ?>" value="<?php echo $reacao_ram[$i]->ram; ?>">
										<input type="hidden" name="num_ram<?php echo $j; ?>" value="<?php echo $j; ?>">
									</div>
									<div class="span4">
										Qual dia?
										<input type="text" name="dia<?php echo $j; ?>" value="<?php echo $reacao_ram[$i]->ram ?>">
									</div>
									<div class="span4 continua">
										<p>Continua?</p>
										<?php if($reacao_ram[$i]->continua == "Sim"){ ?>
											<div class="div_radio">
												<input type="radio" name="continua<?php echo $j; ?>" value="Sim" checked>Sim
											</div>
											<div class="div_radio">
												<input type="radio" name="continua<?php echo $j; ?>" value="Não">Não
											</div>
										<?php } else { ?>
											<div class="div_radio">
												<input type="radio" name="continua<?php echo $j; ?>" value="Sim" >Sim
											</div>
											<div class="div_radio">
												<input type="radio" name="continua<?php echo $j; ?>" value="Não" checked>Não
											</div>
										<?php } ?> 
									</div>
								</fieldset>	
							<?php } else { ?>
								<fieldset>
									<div class="span4">
										RAM <?php echo $j; ?>: <input type="text" name="ram<?php echo $j; ?>" value="">
										<input type="hidden" name="num_ram<?php echo $j; ?>" value="<?php echo $j; ?>">
									</div>
									<div class="span4">
										Qual dia?
										<input type="text" name="dia<?php echo $j; ?>" value="">
									</div>
									<div class="span4 continua">
										<p>Continua?</p>
										<div class="div_radio">
											<input type="radio" name="continua<?php echo $j; ?>" value="Sim">Sim
										</div>
										<div class="div_radio">
											<input type="radio" name="continua<?php echo $j; ?>" value="Não">Não
										</div>
										
									</div>
								</fieldset>	
							<?php }
							} ?>
						</div>
					<div class="sessao row-fluid medicamento_ficha_2">
						<h5>Uso de medicamentos</h5>
						<fieldset>
							<div class="span8">
								Durante a 1ª/2ª etapa do tratamento, o Sr.(a) utilizou algum medicamento além daqueles de uso contínuo?
								<input type="hidden" name="uso_medicamento_perg" value="Durante a 1ª/2ª etapa do tratamento, o Sr.(a) utilizou algum medicamento além daqueles de uso contínuo?">
							</div>
							<div class="span4 resposta">
								<?php if($uso_medicamento->resposta=="Sim") { ?>
									<div class="div_radio">
										<input type="radio" name="medicamento_uso_continuo" value="Sim" checked>Sim
									</div>
									<div class="div_radio">
										<input type="radio" name="medicamento_uso_continuo" value="Não">Não
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="medicamento_uso_continuo" value="Sim">Sim
									</div>
									<div class="div_radio">
										<input type="radio" name="medicamento_uso_continuo" value="Não" checked>Não
									</div>
								<?php } ?>
							</div>
						</fieldset>	
						<fieldset>
							<div class="span2">
								Se sim, qual/quais?
							</div>
							<div class="span10">
								<input type="text" name="quais_medicamentos" value="<?php echo $uso_medicamento->qual; ?>" class="input_media">
							</div>
						</fieldset>	
						<fieldset>
							<div class="span2">
								Durante quanto tempo?
							</div>
							<div class="span10">
								<input type="text" name="tempo_medicamentos" value="<?php echo $uso_medicamento->qnt_tempo; ?>" class="input_media">
							</div>
						</fieldset>	
					</div>

					<button type="submit" name="submit" class="btn btn-primary enviar">Salvar</button>
					
				</form>

				<?php	
					// print_r($results);	
					// } else {
					//     echo 'Voce nao esta logado!';
					// }
					?>
			</div>	<!-- Div do formulário -->	
		
		</div> <!-- Div da página -->	
	
<?php include "layout/footer.php"; ?>