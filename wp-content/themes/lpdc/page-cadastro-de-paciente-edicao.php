<?php 

if(isset($_GET['cod'])){
	$numero_paciente = $_GET['cod'];

	$obj_paciente = buscar_paciente_id($numero_paciente);
	$obj_exames_clinicos = buscar_exames_clinicos_id($numero_paciente);
	$obj_funcao_hepatica = buscar_funcao_hepatica_id($numero_paciente);
	$obj_funcao_renal = buscar_funcao_renal_id($numero_paciente);
	$obj_habitos_vida = buscar_habitos_vida_id($numero_paciente);
	$obj_med_que_utiliza = buscar_med_que_utiliza_id($numero_paciente);
	$obj_med_utilizados = buscar_med_utilizados_id($numero_paciente);
	$obj_outros_param = buscar_outros_param_id($numero_paciente);
	$obj_outro_ex_bioq = buscar_outro_ex_bioq_id($numero_paciente);
	$obj_problemas_saude = buscar_problemas_saude_id($numero_paciente);
	$obj_residencia = buscar_residencia_id($numero_paciente);
	// $obj_revisao_sistemas = buscar_revisao_sistemas_id($numero_paciente);

} else {
	$numero_paciente = '';
}

if(isset($_POST['submit'])){
	$numero_paciente = $_POST['paciente'];
	// Inserir dados na tabela Paciente
	$table = 'paciente';
	$where = array('num_paciente'=> $numero_paciente);
	// verifica se é série ou escolaridade
	if($_POST['serie'] != ""){
		$escolaridade = $_POST['escolaridade'];
	}else {
		$escolaridade = $_POST['serie'];
	}
	$data_paciente = array( 
		'pesquisador'=> $_POST['pesquisador'],
		'data'=> $_POST['data'],
		'nome'=> $_POST['nome'],
		'num_prontuario'=> $_POST['prontuario'], 
		'nome_mae'=> $_POST['mae'],
		'endereco'=> $_POST['endereco'],
		'telefones'=> $_POST['telefone'],
		'procedencia'=> $_POST['procedencia'],
		'qual'=> $_POST['nome_interior'],
		'estado'=> $_POST['estado'],
		'idoso'=> $_POST['idoso'],
		'cuidador'=> $_POST['cuidador'],
		'dt_nascimento'=> $_POST['dt_nascimento'],
		'local_nascimento'=> $_POST['local_nascimento'],
		'sexo'=> $_POST['sexo'],
		'trabalha'=> $_POST['trabalha'],
		'ocupacao'=> $_POST['ocupacao'],
		'escolaridade'=> $escolaridade,
		'renda'=> $_POST['renda-familiar'],
		'estado_civil'=> $_POST['estado-civil'],
		'peso'=> $_POST['peso'],
		'altura'=> $_POST['altura'],
		'imc'=> $_POST['imc'],
		'cor'=> $_POST['cor'],
		'religiao'=> $_POST['religiao'],
		'pratica'=> $_POST['religiao-pratica'],
		'plano_saude'=> $_POST['plano-saude'],
		'adquire_med'=> $_POST['adquire-medicamento'],
		'residiu'=> $_POST['residiu'],
		'tempo_doenca'=> $_POST['tempo-doenca'],
		'descoberta_doenca'=> $_POST['descoberta-doenca'],
		'sintomas_doenca'=> $_POST['sintomas-doenca'],
		'estagio_doenca'=> $_POST['estagio-doenca'],
		'historico'=> $_POST['historia-medica'],
		'possui_historico'=> $_POST['hist-fam-1'],
		'historico_morte'=> $_POST['hist-fam-2'],
		'historico_card'=> $_POST['hist-fam-3'],
		'ale_hist_ram'=> $_POST['alergia'],
		'ale_med_causador'=> $_POST['med_causador'],
		'ale_esp_ram'=> $_POST['RAM'],
		'ale_alimento'=> $_POST['alergia_alimento'],
		'ale_espec_alimento'=> $_POST['ale_alimento'],
		'ale_outros'=> $_POST['outros'],
		'qnt_comp_presc'=> $_POST['qnt_comp_presc'],
		'dose_diaria'=> $_POST['dose_diaria'],
		'posologia'=> $_POST['posologia'],
		'dose_total'=> $_POST['dose_total'],
		'evolucao'=> $_POST['evolucao_paciente']
	);

	$redirect = $wpdb->update( $table, $data_paciente, $where, $format = null, $where_format = null ); 


	// Atualizar tabela de atendimento_paciente
	// loop para verificar se existe mais de de um atendimento e assim atualizar todos
	for ($j=1; $j < 7 ; $j++) { 
		
		if(isset($_POST['atendimento_'.$j]) && count($_POST['atendimento_'.$j]) > 0){
			$i=0;
			$array_valores = array();
			foreach ($_POST['atendimento_'.$j] as $key => $value) { 
				array_push($array_valores, $value);
				$i++;
			}

			$count_array = count($array_valores);
		
			$redirect = atualizar_atendimento($j, $numero_paciente, $count_array, $array_valores, $_POST['data_atend_'.$j]);	
		}
	}

	// Residencia
	$table_residencia = 'residencia';
	if($_POST['residiu'] == 'Não'){

		for($i=1; $i<5; $i++){
			$periodo = 'periodo_resid_'. $i;
			
			if(isset($_POST[$periodo]) && $_POST[$periodo] != ''){

				$num_residencia = 'num_residencia'.$i;

				$where_residencia = array('num_paciente'=> $_POST['num_paciente'], 'num_residencia'=> $_POST[$num_residencia]);
				$area = 'area'.$i;
				$cobertura = 'cobertura'. $i;
				$casa = 'tipo-casa' .$i;
				$peridomicilio = 'predomicilio'. $i;
				$animais = 'animais' . $i;
				$qnt = 'qnt-familiares' . $i;
				$data_residencia = array (
					'num_residencia'=>$_POST[$num_residencia],
					'periodo'=>$_POST[$periodo],
					'area'=>$_POST[$area],
					'tipo_cobertura'=>$_POST[$cobertura],
					'tipo_casa'=> $_POST[$casa],
					'peridomicilio'=>  $_POST[$peridomicilio],
					'animais'=> $_POST[$animais],
					'qnt_familiares'=> $_POST[$qnt]
					
				);
				// Pesquisa se tem algum dado com o item que deseja fazer a atualização
				$result2 = $wpdb->get_row('SELECT * FROM ' . $table_residencia . ' WHERE num_paciente='. $_POST['num_paciente'] . ' AND num_residencia='.$_POST[$num_residencia]);
				// Tenta fazer o update
				$result = $wpdb->update( $table_residencia, $data_residencia, $where_residencia, $format = null, $where_format = null ); 
				// Se a busca e o upadate falharem faz um inserte na tabela
				if(!$result && !$result2){
					$cobertura = 'cobertura'. $i;
					$casa = 'tipo-casa' .$i;
					$peridomicilio = 'predomicilio'. $i;
					$animais = 'animais' . $i;
					$qnt = 'qnt-familiares' . $i;
					$num_residencia = 'num_residencia'.$i;
					$data_residencia = array (
						'num_paciente'=>$_POST['num_paciente'],
						'num_residencia'=>$_POST[$num_residencia],
						'periodo'=>$_POST[$periodo],
						'area'=>$_POST[$area],
						'tipo_cobertura'=>$_POST[$cobertura],
						'tipo_casa'=> $_POST[$casa],
						'peridomicilio'=>  $_POST[$peridomicilio],
						'animais'=> $_POST[$animais],
						'qnt_familiares'=> $_POST[$qnt]
					);
					$redirect = $wpdb->insert( $table_residencia, $data_residencia, $format );
				}
			} 
			else {
				$result3 = $wpdb->get_row('SELECT * FROM ' . $table_residencia . ' WHERE num_residencia='. $i . ' AND num_paciente='.$_POST['num_paciente']);
				// Se a busca retornar resultado mas os campos estiverem em branco exclui uma linha do banco
				if($result3 && (trim($_POST['periodo_resid_'.$i] == "") || trim($_POST['area'.$i] == ""))){
					$where_residencia =  array('num_paciente'=> $_POST['num_paciente'], 'num_residencia'=>$i);
					$redirect = $wpdb->delete( $table_residencia, $where_residencia, $where_format = null);
				}
			}
		}
	}

	// Problemas de saúde
	$table_problemas = 'problemas_saude';

	for($i=1; $i<7; $i++){
		$where_problemas = array('num_paciente'=> $_POST['num_paciente'], 'num_problema'=> $i);
		if(trim($_POST['problema'.$i] != "")){
			$data_problemas = array (
				'problema'=>$_POST['problema'. $i],
				'controlado'=>$_POST['problema-controlado' . $i],
				'inicio'=>$_POST['problema-data' . $i]
				
			);
			// Pesquisa se tem algum dado com o item que deseja fazer a atualização
			$result2 = $wpdb->get_row('SELECT * FROM ' . $table_problemas . ' WHERE num_paciente='. $_POST['num_paciente'] . ' AND num_problema='.$i);
			// Tenta fazer o update
			$result = $wpdb->update( $table_problemas, $data_problemas, $where_problemas, $format = null, $where_format = null ); 
			// Se a busca e o upadate falharem faz um inserte na tabela
			if(!$result && !$result2){
				$data_problemas = array (
					'num_paciente'=>$_POST['num_paciente'],
					'num_problema'=>$i,
					'problema'=>$_POST['problema'. $i],
					'controlado'=>$_POST['problema-controlado' . $i],
					'inicio'=>$_POST['problema-data' . $i]
				);
				$redirect = $wpdb->insert( $table_problemas, $data_problemas, $format );
			}
		} 
		else {
			$result3 = $wpdb->get_row('SELECT * FROM ' . $table_problemas . ' WHERE num_problema='. $i . ' AND num_paciente='.$_POST['num_paciente']);
			// Se a busca retornar resultado mas os campos estiverem em branco exclui uma linha do banco
			if($result3 && (trim($_POST['problema'.$i] == "") || trim($_POST['problema-data'.$i] == ""))){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'num_problema'=>$i);
				$redirect = $wpdb->delete( $table_problemas, $where_problemas, $where_format = null);
			}
		}
	}
	

	// Medicamentos Utilizados 
	$table_med_utilizados = 'med_utilizados';
	for($i=1; $i<5; $i++){
		$where_med_utilizados = array('num_paciente'=> $_POST['num_paciente'], 'num_med'=> $i);
		if(isset($_POST['medicamento'. $i]) && trim($_POST['medicamento'. $i] != "")){
			$medicamento = 'medicamento'. $i;
			$indicacao = 'indicacao' . $i;
			$resposta = 'resposta_'. $i;
			$periodo = 'periodo' . $i;
			$data_med_utilizados = array(
				'medicamento'=> $_POST[$medicamento],
				'indicacao'=> $_POST[$indicacao],
				'resposta'=> $_POST[$resposta],
				'periodo'=> $_POST[$periodo]
			);
				
			// Pesquisa se tem algum dado com o item que deseja fazer a atualização
			$result2 = $wpdb->get_row('SELECT * FROM ' . $table_med_utilizados . ' WHERE num_paciente='. $_POST['num_paciente'] . ' AND num_med='.$i);
			// Tenta fazer o update
			$result = $wpdb->update( $table_med_utilizados, $data_med_utilizados, $where_med_utilizados, $format = null, $where_format = null ); 
			// Se a busca e o upadate falharem faz um inserte na tabela
			if(!$result && !$result2){
				$medicamento = 'medicamento'. $i;
				$indicacao = 'indicacao' . $i;
				$resposta = 'resposta_'. $i;
				$periodo = 'periodo' . $i;
				$data_med_utilizados = array(
					'num_paciente'=> $_POST['num_paciente'],
					'num_med'=>$i,
					'medicamento'=> $_POST[$medicamento],
					'indicacao'=> $_POST[$indicacao],
					'resposta'=> $_POST[$resposta],
					'periodo'=> $_POST[$periodo]
				);
				$redirect = $wpdb->insert( $table_med_utilizados, $data_med_utilizados, $format );
			}
		} 
		else {
			$result3 = $wpdb->get_row('SELECT * FROM ' . $table_med_utilizados . ' WHERE num_med='. $i . ' AND num_paciente='.$_POST['num_paciente']);
			// Se a busca retornar resultado mas os campos estiverem em branco exclui uma linha do banco
			if($result3 && (trim($_POST['medicamento' . $i] == "") || trim($_POST['indicacao' . $i] == "") || trim($_POST['resposta'. $i] == "") || trim($_POST['periodo' . $i] == ""))){
				$where_med_utilizados =  array('num_paciente'=> $_POST['num_paciente'], 'num_med'=>$i);
				$redirect = $wpdb->delete( $table_med_utilizados, $where_med_utilizados, $where_format = null);
			}
		}
	}

	$table_med_que_utiliza = 'med_que_utiliza';
	for($i=1; $i<9; $i++){
		$where_med_que_utiliza = array('num_paciente'=> $_POST['num_paciente'], 'num_med'=> $i);
		if(isset($_POST['medicamento_uso'. $i]) && trim($_POST['medicamento_uso'. $i] != "")){
			$medicamento = 'medicamento_uso'. $i;
			$num_med = 'num_med'.$i;
			$posologia = 'posologia' . $i;
			$indicacao = 'indicado'. $i;
			$idicacao_uso = 'indicacao_uso' . $i;
			$modo_uso = 'modo_uso'.$i;
			$resposta = 'resposta'.$i;
			$efeito_uso = 'efeito_uso'.$i;
			$inicio_uso = 'inicio_uso'.$i;
			$data_med_que_utiliza = array(
				'medicamento'=> $_POST[$medicamento],
				'num_med'=> $_POST[$num_med],
				'posologia'=> $_POST[$posologia],
				'indicado_por'=> $_POST[$indicacao],
				'ind_uso'=> $_POST[$idicacao_uso],
				'inicio'=> $_POST[$inicio_uso],
				'modo_uso' =>$_POST[$modo_uso],
				'resposta' =>$_POST[$resposta],
				'efeitos' =>$_POST[$efeito_uso]
			);
				
			// Pesquisa se tem algum dado com o item que deseja fazer a atualização
			$result2 = $wpdb->get_row('SELECT * FROM ' . $table_med_que_utiliza . ' WHERE num_paciente='. $_POST['num_paciente'] . ' AND num_med='.$i);
			// Tenta fazer o update
			$result = $wpdb->update( $table_med_que_utiliza, $data_med_que_utiliza, $where_med_que_utiliza, $format = null, $where_format = null ); 
			// Se a busca e o upadate falharem faz um inserte na tabela
			if(!$result && !$result2){
				$medicamento = 'medicamento_uso'. $i;
				$num_med = 'num_med'.$i;
				$posologia = 'posologia' . $i;
				$indicacao = 'indicado'. $i;
				$idicacao_uso = 'indicacao_uso' . $i;
				$modo_uso = 'modo_uso'.$i;
				$resposta = 'resposta'.$i;
				$efeito_uso = 'efeito_uso'.$i;
				$inicio_uso = 'inicio_uso'.$i;
				$data_med_que_utiliza = array(
					'num_paciente'=> $_POST['num_paciente'],
					'num_med'=> $_POST[$num_med],
					'medicamento'=> $_POST[$medicamento],
					'posologia'=> $_POST[$posologia],
					'indicado_por'=> $_POST[$indicacao],
					'ind_uso'=> $_POST[$idicacao_uso],
					'inicio'=> $_POST[$inicio_uso],
					'modo_uso' =>$_POST[$modo_uso],
					'resposta' =>$_POST[$resposta],
					'efeitos' =>$_POST[$efeito_uso]
				);
				$redirect = $wpdb->insert( $table_med_que_utiliza, $data_med_que_utiliza, $format );
			}
		} 
		else {
			$result3 = $wpdb->get_row('SELECT * FROM ' . $table_med_que_utiliza . ' WHERE num_med='. $i . ' AND num_paciente='.$_POST['num_paciente']);
			// Se a busca retornar resultado mas os campos estiverem em branco exclui uma linha do banco
			if($result3 && (trim($_POST['medicamento' . $i] == "") || trim($_POST['posologia' . $i] == "") || trim($_POST['indicado'. $i] == "") || trim($_POST['inicio_uso' . $i] == ""))){
				$where_med_que_utiliza =  array('num_paciente'=> $_POST['num_paciente'], 'num_med'=>$i);
				$wpdb->delete( $table_med_que_utiliza, $where_med_que_utiliza, $where_format = null);
			}
		}
	}

	// REVISÃO DE SISTEMAS 

	// Fazer um loop para passar por todos os sistemas
	for($i=1; $i < 14; $i++){
		$count_array_sistemas = count($_POST[$i]);
		$array_valores_sistemas = array();
		if($count_array_sistemas > 0){
			foreach ($_POST[$i] as $key => $value) {
				array_push($array_valores_sistemas, $value);
			}
		}
		
		$redirect = atualizar_revisao_sistema($i, $_POST['num_paciente'], $count_array_sistemas, $array_valores_sistemas);
	}

	// Hábitos de Vida
	// Fuma 
	$table_habitos_vida = 'habitos_vida';
	if($_POST['fuma'] == 'S'){
		$pratica_fuma = "S";
	}else {
		$pratica_fuma = "N";
	}
	$where_fuma = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Fuma?');
	$data_habitos_vida_fuma = array(
		'pratica'=> 'Fuma?',
		'pratica_atual'=> $pratica_fuma,
		'frequencia'=> $_POST['frequencia_fuma'],
		'tempo_deixou'=> $_POST['qnt_tempo_fuma'],
		'motivo'=> $_POST['motivo_fuma']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_fuma, $where_fuma, $format = null, $where_format = null );
	
	// Toma café
	if($_POST['cafe'] == 'S'){
		$pratica_cafe = "S";
	}else {
		$pratica_cafe = "N";
	}
	$where_cafe = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Toma café?');
	$data_habitos_vida_cafe = array(
		'pratica'=> 'Toma café?',
		'pratica_atual'=> $pratica_cafe,
		'frequencia'=> $_POST['frequencia_cafe'],
		'tempo_deixou'=> $_POST['qnt_tempo_cafe'],
		'motivo'=> $_POST['motivo_cafe']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_cafe, $where_cafe, $format = null, $where_format = null );

	// Ingere bebidas alcoólicas?
	if($_POST['bebida'] == 'S'){
		$pratica_bebe = "S";
	}else {
		$pratica_bebe = "N";
	}
	$where_bebe = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Ingere bebidas alcoólicas?');
	$data_habitos_vida_bebe = array(
		'pratica'=> 'Ingere bebidas alcoólicas?',
		'pratica_atual'=> $pratica_bebe,
		'frequencia'=> $_POST['frequencia_bebe'],
		'tempo_deixou'=> $_POST['qnt_tempo_bebe'],
		'motivo'=> $_POST['motivo_bebe']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_bebe, $where_bebe, $format = null, $where_format = null );

	// Utiliza chás de plantas medicinais?
	if($_POST['cha'] == 'S'){
		$pratica_cha = "S";
	}else {
		$pratica_cha = "N";
	}
	$where_cha = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Utiliza chás de plantas medicinais?');
	$data_habitos_vida_cha = array(
		'pratica'=> 'Utiliza chás de plantas medicinais?',
		'pratica_atual'=> $pratica_cha,
		'frequencia'=> $_POST['frequencia_cha'],
		'tempo_deixou'=> $_POST['qnt_tempo_cha'],
		'motivo'=> $_POST['motivo_cha'],
		'tipo_planta'=> $_POST['cha_tipo_planta'],
		'indicacao_planta'=> $_POST['cha_indicacao']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_cha, $where_cha, $format = null, $where_format = null );

	// Pratica atividade física?
	if($_POST['atividade_fisica'] == 'S'){
		$pratica_atividade = "S";
	}else {
		$pratica_atividade = "N";
	}
	$where_atividade = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Pratica atividade física?');
	$data_habitos_vida_atividade = array(
		'pratica'=> 'Pratica atividade física?',
		'pratica_atual'=> $pratica_atividade,
		'tipo_atividade'=> $_POST['tipo_ativiadade_fisica'],
		'frequencia'=> $_POST['ativ_fisica_freq']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_atividade, $where_atividade, $format = null, $where_format = null );
	
	// Você considera sua alimentação saudável?
	if($_POST['alimentacao'] == 'S'){
		$pratica_alimentacao = "S";
	}else {
		$pratica_alimentacao = "N";
	}
	$alimentacao = "";
	foreach ($_POST['tipo_alimentacao_1'] as $key => $value) {
		$alimentacao .= $value;
		$alimentacao .= ";";
	}
	$where_alimentacao = array('num_paciente'=>$_POST['num_paciente'], 'pratica'=> 'Você considera sua alimentação saudável?');
	$data_habitos_vida_alimentacao = array(
		'pratica'=> 'Você considera sua alimentação saudável?',
		'pratica_atual'=> $pratica_alimentacao,
		'tipo_alimentacao'=> $alimentacao,
		'outros'=> $_POST['outros_alimentacao']
	);
	$redirect = $wpdb->update( $table_habitos_vida, $data_habitos_vida_alimentacao, $where_alimentacao, $format = null, $where_format = null );


	//EVOLUÇÃO DE PARÂMETROS LABORATORIAIS E CLÍNICOS
	$table_hemograma = 'hemograma';
	$table_funcao_renal = 'funcao_renal';
	$table_funcao_hepatica = 'funcao_hepatica';
	$table_outro_ex_bioq = 'outro_ex_bioq';
	$table_teste_chagas = 'teste_chagas';
	$table_outros_param = 'outros_param';
	
	$total_hemograma = total_exames(1);
	$total_funcao_renal = total_exames(2);
	$total_funcao_hepatica = total_exames(3);
	$total_outro_ex_bioq = total_exames(4);
	$total_teste_chagas = total_exames(5);
	$total_outros_param = total_exames(6);

	// for para percorrer os exames
	for($i = 1; $i <= 6; $i++){

		// pega a data da coleta, se tiver passa para os exames e insere no banco
		if(isset($_POST['coleta1_'.$i]) && $_POST['coleta1_'.$i] != '0000-00-00'){
			if($i < 4 && $_POST['coleta'.$i.'_1'] != '0000-00-00' && $_POST['coleta'.$i.'_1'] != ''){
				// inserir na tabela de Hemograma
				$exames_hemograma = exames(1);
				foreach ($exames_hemograma as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_hemograma = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_1'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					
					$result = $wpdb->update( $table_hemograma, $data_hemograma, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM hemograma WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						foreach ($exames_hemograma as $key) {
							$data_hemograma = array(
							'num_paciente'=> $_POST['num_paciente'],
							'nome'=> $key->nome,
							'coleta'=> $_POST['coleta'.$i.'_1'],
							'obs'=> $_POST[$key->id.'obs'],
							'valor'=> $_POST[$key->id.'coleta'.$i],
							'tipo'=> $i
						);
							$redirect = $wpdb->insert( $table_hemograma, $data_hemograma, $format );
						}
					}
				}

				// inserir na tabela de funcao Renal
				$exames_funcao_renal = exames(2);
				foreach ($exames_funcao_renal as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_funcao_renal = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_2'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					$result = $wpdb->update( $table_funcao_renal, $data_funcao_renal, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM funcao_renal WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						if($_POST['coleta'.$i.'_2']!= '0000-00-00' && $_POST['coleta'.$i.'_2'] != ''){
							foreach ($exames_funcao_renal as $key) {
								$data_funcao_renal = array(
									'num_paciente'=> $_POST['num_paciente'],
									'nome'=> $key->nome,
									'coleta'=> $_POST['coleta'.$i.'_2'],
									'obs'=> $_POST[$key->id.'obs'],
									'valor'=> $_POST[$key->id.'coleta'.$i],
									'tipo'=> $i
								);
								$redirect = $wpdb->insert( $table_funcao_renal, $data_funcao_renal, $format );
							}
						}
					}
				}

				// inserir na tabela de funcao Renal
				$exames_funcao_hepatica = exames(3);
				foreach ($exames_funcao_hepatica as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_funcao_hepatica = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_3'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					
					$result = $wpdb->update( $table_funcao_hepatica, $data_funcao_hepatica, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM funcao_hepatica WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						if($_POST['coleta'.$i.'_3']!= '0000-00-00' && $_POST['coleta'.$i.'_3'] != ''){
							foreach ($exames_funcao_hepatica as $key) {
								$data_funcao_hepatica = array(
									'num_paciente'=> $_POST['num_paciente'],
									'nome'=> $key->nome,
									'coleta'=> $_POST['coleta'.$i.'_3'],
									'obs'=> $_POST[$key->id.'obs'],
									'valor'=> $_POST[$key->id.'coleta'.$i],
									'tipo'=> $i
								);
								$redirect = $wpdb->insert( $table_funcao_hepatica, $data_funcao_hepatica, $format );
							}
						}
					}
				}

				// inserir na tabela de Outros exames bioquimicos
				$exames_outro_ex_bioq = exames(4);
				foreach ($exames_outro_ex_bioq as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_outro_ex_bioq = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_4'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					$result = $wpdb->update( $table_outro_ex_bioq, $data_outro_ex_bioq, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM outro_ex_bioq WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						if($_POST['coleta'.$i.'_4']!= '0000-00-00' && $_POST['coleta'.$i.'_4'] != ''){
							foreach ($exames_outro_ex_bioq as $key) {
								$data_outro_ex_bioq = array(
									'num_paciente'=> $_POST['num_paciente'],
									'nome'=> $key->nome,
									'coleta'=> $_POST['coleta'.$i.'_4'],
									'obs'=> $_POST[$key->id.'obs'],
									'valor'=> $_POST[$key->id.'coleta'.$i],
									'tipo'=> $i
								);
								$redirect = $wpdb->insert( $table_outro_ex_bioq, $data_outro_ex_bioq, $format );
							}
						}
					}
				}

				// inserir na tabela de Teste para Chagas
				$exames_teste_chagas = exames(5);
				foreach ($exames_teste_chagas as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_teste_chagas = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_5'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					$result = $wpdb->update( $table_teste_chagas, $data_teste_chagas, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM teste_chagas WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						if($_POST['coleta'.$i.'_5']!= '0000-00-00' && $_POST['coleta'.$i.'_5'] != ''){
							foreach ($exames_teste_chagas as $key) {
								$data_teste_chagas = array(
									'num_paciente'=> $_POST['num_paciente'],
									'nome'=> $key->nome,
									'coleta'=> $_POST['coleta'.$i.'_5'],
									'obs'=> $_POST[$key->id.'obs'],
									'valor'=> $_POST[$key->id.'coleta'.$i],
									'tipo'=> $i
								);
								$redirect = $wpdb->insert( $table_teste_chagas, $data_teste_chagas, $format );
							}
						}
					}
					
				}

				// inserir na tabela de Outros Parâmetros
				$exames_outros_param = exames(6);
				foreach ($exames_outros_param as $key) {
					$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
					$data_outros_param = array(
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_6'],
						'valor'=> $_POST[$key->id.'coleta'.$i],
						'tipo'=> $i
					);
					$result = $wpdb->update( $table_outros_param, $data_outros_param, $where, $format = null, $where_format = null );
					$result2 = $wpdb->get_results('SELECT * FROM outros_param WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
					if(!$result && !$result2){
						if($_POST['coleta'.$i.'_6']!= '0000-00-00' && $_POST['coleta'.$i.'_6'] != ''){
							foreach ($exames_outros_param as $key) {
								$data_outros_param = array(
									'num_paciente'=> $_POST['num_paciente'],
									'nome'=> $key->nome,
									'coleta'=> $_POST['coleta'.$i.'_6'],
									'valor'=> $_POST[$key->id.'coleta'.$i],
									'tipo'=> $i
								);
								$redirect = $wpdb->insert( $table_outros_param, $data_outros_param, $format );
							}
						}
					}
					
				}
			

				if($i > 4){
					// inserir na tabela de Outros Parâmetros
					$exames_outros_param = exames(6);
					foreach ($exames_outros_param as $key) {
						$where = array('num_paciente'=>$_POST['num_paciente'], 'nome'=> $key->nome, 'tipo'=> $i);
						$data_outros_param = array(
							'nome'=> $key->nome,
							'coleta'=> $_POST['coleta'.$i.'_6'],
							'valor'=> $_POST[$key->id.'coleta'.$i],
							'tipo'=> $i
						);
						$result = $wpdb->update( $table_outros_param, $data_outros_param, $where, $format = null, $where_format = null );
						$result2 = $wpdb->get_results('SELECT * FROM outros_param WHERE tipo = '.$i . ' AND num_paciente = '.$_POST['num_paciente']);
						if(!$result && !$result2){
							if($_POST['coleta'.$i.'_6']!= '0000-00-00' && $_POST['coleta'.$i.'_6'] != ''){
								foreach ($exames_outros_param as $key) {
									$data_outros_param = array(
										'num_paciente'=> $_POST['num_paciente'],
										'nome'=> $key->nome,
										'coleta'=> $_POST['coleta'.$i.'_6'],
										'valor'=> $_POST[$key->id.'coleta'.$i],
										'tipo'=> $i
									);
									$redirect = $wpdb->insert( $table_outros_param, $data_outros_param, $format );
								}
							}
						}
						
					}
				}
				
			}
		}
	}

	//Exames Clínicos
	$table_exames_clinicos = "exames_clinicos";
	// eletrocardiograma 
	for($i=1; $i < 5; $i++){
		$date = 'eletro_date_'.$i;
		$valor = 'eletro_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['eletro'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Anormal';
			}

			$data_eletro = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'Eletrocardiograma',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['eletro_obs'],
				'valor'=> $_POST['eletro'],
				'texto' => $_POST[$valor]
			);

			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "Eletrocardiograma" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'Eletrocardiograma', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_eletro, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_eletro, $format );
			}
			
		}
	}

	// Ecocardiograma 
	for($i=1; $i < 5; $i++){
		$date = 'eco_date_'.$i;
		$valor = 'eco_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['eco'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Anormal';
			}
			$data_eco = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'Ecocardiograma',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['eco_obs'],
				'valor'=> $_POST['eco'],
				'texto' => $_POST[$valor]
			);

			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "Ecocardiograma" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'Ecocardiograma', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_eco, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_eco, $format );
			}
		}
	}

	// Holter 
	for($i=1; $i < 5; $i++){
		$date = 'holter_date_'.$i;
		$valor = 'holter_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['holter'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Anormal';
			}

			$data_holter = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'Holter',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['holter_obs'],
				'valor'=> $_POST['holter'],
				'texto' => $_POST[$valor]
			);

			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "Holter" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'Holter', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_holter, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_holter, $format );
			}
			
		}
	}

	// RX Coração 
	for($i=1; $i < 5; $i++){
		$date = 'rx_co_date_'.$i;
		$valor = 'rx_co_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['rx_coracao'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Dilatação';
			}

			$data_rx_co = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'RX Coração',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['rx_co_obs'],
				'valor'=> $_POST['rx_coracao'],
				'texto' => $_POST[$valor]
			);
			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "RX Coração" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'RX Coração', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_rx_co, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_rx_co, $format );
			}
		}
	}

	// RX Esôfago 
	for($i=1; $i < 5; $i++){
		$date = 'rx_eso_date_'.$i;
		$valor = 'rx_eso_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['rx_esofago'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Dilatação';
			}

			$data_rx_eso = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'RX Esôfago',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['rx_eso_obs'],
				'valor'=> $_POST['rx_esofago'],
				'texto' => $_POST[$valor]
			);
			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "RX Esôfago" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'RX Esôfago', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_rx_eso, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_rx_eso, $format );
			}
		}
	}

	// Enema Opaco
	for($i=1; $i < 5; $i++){
		$date = 'enema_date_'.$i;
		$valor = 'enema_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00' && $_POST[$date] != ''){
			if($_POST['enema'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Dilatação';
			}

			$data_enema = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'Enema Opaco',
				'data'=> $_POST[$date],
				'coleta'=> $i,
				'obs'=> $_POST['enema_obs'],
				'valor'=> $_POST['enema'],
				'texto' => $_POST[$valor]
			);
			$result = $wpdb->get_row('SELECT * FROM exames_clinicos WHERE num_paciente ='.$_POST['num_paciente']. ' AND nome_exame = "Enema Opaco" AND coleta = '.$i);
			if($result){
				$where =  array('num_paciente'=> $_POST['num_paciente'], 'nome_exame'=> 'Enema Opaco', 'coleta'=> $i);
				$redirect = $wpdb->update( $table_exames_clinicos, $data_enema, $where, $format = null, $where_format = null);
			} else {
				$redirect = $wpdb->insert( $table_exames_clinicos, $data_enema, $format );
			}
			
		}
	}
	
}

include "layout/header.php"; 
?>
		<div id="pagina2" class="cadastro-paciente">
			<header class="header_cadastro-paciente">
				<h1 class="font24 colorTextWhite open_semibold title_maior">Edição Paciente</h1>
			</header>

			<div class="cabecalho row-fluid">
				<p>Universidade Federal do Ceará</p>
				<p>Departamento de análises clínicas e toxicologicas (DACT)</p>
				<p>Laboratório de pesquisa em doença de chagas</p>
				<p>progama de atenção farmacêutica ao paciente chagástico</p>
			</div>
			<div class="row-fluid title">
				<h4>Ficha de Caracterização e seguimento do Paciente</h4>
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
							<div>
								<label>Nº Paciente:</label>
								<input type="text" name="num_paciente" value="<?php echo $obj_paciente->num_paciente; ?>" class="numero" required>
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
					</div>
					<div class="sessao row-fluid">
						<h5>Informações Pessoais</h5>
						<fieldset>
							<div class="div_maior">
								<label>Nome do paciente:</label>
								<input type="text" name="nome" value="<?php echo $obj_paciente->nome; ?>" class="input_maior" required>
							</div>

							<div class="text_align_right">
								<label>Nº do prontuário:</label>
								<input type="text" name="prontuario" value="<?php echo $obj_paciente->num_prontuario; ?>" class="numero" required>
							</div>

						</fieldset>

						<fieldset>
							<div class="div_media">
								<label>Nome da mãe:</label>
								<input type="text" name="mae" value="<?php echo $obj_paciente->nome_mae; ?>" class="input_media" required>
							</div>
							<div class="div_media">
								<label>Endereço:</label>
								<input type="text" name="endereco" value="<?php echo $obj_paciente->endereco; ?>" class="input_media" required>
							</div>
						</fieldset>

						<fieldset>
							<div class="div_media">
								<label>Telefones para contato:</label>
								<input type="text" name="telefone" value="<?php echo $obj_paciente->telefones; ?>" class="input_media">
							</div>

							<div class="div_media print_procedencia">
								<label>Procedência:</label>
								<div class="radio-div">
									<?php if($obj_paciente->procedencia == "cidade"){
										echo '<input type="radio" name="procedencia" value="cidade" id="cidade" checked><span class="radio-label">Cidade</span>';
										echo '<input type="radio" name="procedencia" value="interior" id="interior"><span class="radio-label">Interior</span>';
									}else {
										echo '<input type="radio" name="procedencia" value="cidade" id="cidade"><span class="radio-label">Cidade</span>';
										echo '<input type="radio" name="procedencia" value="interior" id="interior" checked><span class="radio-label">Interior</span>';
									}?>
								</div>

								<?php if($obj_paciente->qual !=''){ 
										$enable = ""; 
									} else {
										$enable = "disabled";
									} ?>
								<div class="interior">Qual? <input type="text" name="nome_interior" value="<?php echo $obj_paciente->qual; ?>" <?php echo $enable; ?> id="qual"></div>
							</div>
						</fieldset>

						<fieldset>
							<div class="div_estado">
								<label>Estado:</label>
								<input type="text" name="estado" value="<?php echo $obj_paciente->estado; ?>" required>
							</div>

							<div class="div_maior">
								<label>É idoso? >= 60 anos:</label>
								<div class="radio-idoso">
									<?php if($obj_paciente->idoso == "Sim") {
										echo '<input type="radio" name="idoso" value="sim" id="idoso-sim" checked><span class="radio-label">Sim</span>';
										echo '<input type="radio" name="idoso" value="não" id="idoso-nao"><span class="radio-label idoso-nao">Não</span>';
									} else {
										echo '<input type="radio" name="idoso" value="sim" id="idoso-sim"><span class="radio-label">Sim</span>';
										echo '<input type="radio" name="idoso" value="não" id="idoso-nao" checked><span class="radio-label idoso-nao">Não</span>';
									}?>
									
									
								</div>
								<?php if($obj_paciente->cuidador !=''){ 
										$enable = ""; 
									} else {
										$enable = "disabled";
									} ?>
								<div class="idoso_div">Possui Cuidador? <input type="text" name="cuidador" value="<?php echo $obj_paciente->cuidador; ?>" <?php echo $enable; ?> id="cuidador"></div>
							</div>
						</fieldset>
					</div>

					<div class="sessao row-fluid atendimento">
						<h5>Agendamento do paciente</h5>
							<div class="divisao att1">
							<?php 
								$atendimento_1 = pegar_opcao_atendimento(1);
								$check = buscar_atendimento_id($numero_paciente, 1);
								$total_check = count($check);
								$array_atend = array();
								for($i=0; $i<$total_check; $i++){
									array_push($array_atend, $check[$i]->dados);
								}
								echo "<h6>1º Atendimento <input type='date' name='data_atend_1' value='". buscar_atendimento_id_data($numero_paciente, 1) ."'></h6>";
								foreach ($atendimento_1 as $key) {
									if(in_array($key->opcao, $array_atend)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_1[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_1[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}
								$check2 = buscar_atendimento_id($numero_paciente, 2); 
								if($check2){
									$display = "";
								
								}else {
									$display = "att2";
								?>
								<div class="span12 botao_adicionar bt1">
									<p><a href="javascript:void(0);" class="mais_atend_2 btn btn-info">Adicionar atendimento</a></p>
								</div>
							<?php } ?>
							
							</div>
							<div class="divisao <?php echo $display; ?>">
							<?php 
								$atendimento_2 = pegar_opcao_atendimento(2);
								$total_check2 = count($check2);
								$array_atend2 = array();
								for($i=0; $i<$total_check2; $i++){
									array_push($array_atend2, $check2[$i]->dados);
								}
								echo "<h6>2º Atendimento <input type='date' name='data_atend_2' value='". buscar_atendimento_id_data($numero_paciente, 2) ."'></h6>";
								foreach ($atendimento_2 as $key) {
									if(in_array($key->opcao, $array_atend2)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_2[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_2[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}

								$check3 = buscar_atendimento_id($numero_paciente, 3); 
								if($check3){
									$display = "";
								}else {
									$display = "att3";
								?>
								<div class="span12 botao_adicionar bt2">
									<p><a href="javascript:void(0);" class="mais_atend_3 btn btn-info">Adicionar atendimento</a></p>
								</div>
								<?php }	?>
							
							</div>
							<div class="divisao <?php echo $display; ?>">
							<?php 
								$atendimento_3 = pegar_opcao_atendimento(3);
								$total_check3 = count($check3);
								$array_atend3 = array();
								for($i=0; $i<$total_check3; $i++){
									array_push($array_atend3, $check3[$i]->dados);
								}
								echo "<h6>3º Atendimento <input type='date' name='data_atend_3' value='". buscar_atendimento_id_data($numero_paciente, 3) ."'></h6>";
								foreach ($atendimento_3 as $key) {
									if(in_array($key->opcao, $array_atend3)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_3[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_3[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}

								$check4 = buscar_atendimento_id($numero_paciente, 4); 
								if($check4){
									$display = "";
								}else {
									$display = "att4";
								?>
								<div class="span12 botao_adicionar bt3">
									<p><a href="javascript:void(0);" class="mais_atend_4 btn btn-info">Adicionar atendimento</a></p>
								</div>
								<?php } ?>
							</div>
							<div class="divisao <?php echo $display; ?>">
							<?php 
								$atendimento_4 = pegar_opcao_atendimento(4);
								$total_check4 = count($check4);
								$array_atend4= array();
								for($i=0; $i<$total_check4; $i++){
									array_push($array_atend4, $check4[$i]->dados);
								}
								echo "<h6>4º Atendimento <input type='date' name='data_atend_4' value='". buscar_atendimento_id_data($numero_paciente, 4) ."'></h6>";
								foreach ($atendimento_4 as $key) {
									if(in_array($key->opcao, $array_atend4)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_4[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_4[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}

								$check5 = buscar_atendimento_id($numero_paciente, 5); 
								if($check5){
									$display = "";
								}else {
									$display = "att5";
								?>
								<div class="span12 botao_adicionar bt4">
									<p><a href="javascript:void(0);" class="mais_atend_5 btn btn-info">Adicionar atendimento</a></p>
								</div>
							<?php }	?>
							</div>
							<div class="divisao <?php echo $display; ?>">
							<?php 
								$atendimento_5 = pegar_opcao_atendimento(1);
								$total_check5 = count($check5);
								$array_atend5= array();
								for($i=0; $i<$total_check5; $i++){
									array_push($array_atend5, $check5[$i]->dados);
								}
								echo "<h6>5º Atendimento <input type='date' name='data_atend_5' value='". buscar_atendimento_id_data($numero_paciente, 5) ."'></h6>";
								foreach ($atendimento_5 as $key) {
									if(in_array($key->opcao, $array_atend5)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_5[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_5[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}
								$check6 = buscar_atendimento_id($numero_paciente, 6); 
								if($check6){
									$display = "";
								}else {
									$display = "att6";
								?>

							<?php } ?>
								<div class="span12 botao_adicionar bt5">
									<p><a href="javascript:void(0);" class="mais_atend_6 btn btn-info">Adicionar atendimento</a></p>
								</div>
							?>
							
							</div>

							<div class="divisao <?php echo $display; ?>">
							<?php 
								$atendimento_6 = pegar_opcao_atendimento(1);
								$total_check6 = count($check6);
								$array_atend6= array();
								for($i=0; $i<$total_check6; $i++){
									array_push($array_atend6, $check6[$i]->dados);
								}
								echo "<h6>6º Atendimento <input type='date' name='data_atend_6' value='". buscar_atendimento_id_data($numero_paciente, 6) ."'></h6>";
								foreach ($atendimento_6 as $key) {
									if(in_array($key->opcao, $array_atend6)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_6[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_6[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}

							?>
							</div>
					</div>
					<div class="sessao row-fluid">
						<h5>Dados Sócio-demográfico/econômicos</h5>
						<fieldset>
							<div>
								<label>Data de nascimento:</label>
								<input type="text" name="dt_nascimento" value="<?php echo $obj_paciente->dt_nascimento; ?>">
							</div>

							<div>
								<label>Local de nascimento:</label>
								<input type="text" name="local_nascimento" value="<?php echo $obj_paciente->local_nascimento; ?>">
							</div>
							<div>
								<label>Sexo:</label>
								<div class="radio-idoso">
									<?php if($obj_paciente->sexo == 'F'){
									?>
										<input type="radio" name="sexo" value="M"><span class="radio-label">M</span>
										<input type="radio" name="sexo" value="F" checked><span class="radio-label">F</span>
									<?php } else { ?>
										<input type="radio" name="sexo" value="M" checked><span class="radio-label">M</span>
										<input type="radio" name="sexo" value="F"><span class="radio-label">F</span>
									<?php } ?>
									
								</div>
							</div>
						</fieldset>

						<fieldset>
							<div>
								<label>Trabalha?</label>
								<div class="radio-ocupacao">
									<?php if($obj_paciente->trabalha == 'Sim') { ?>
											<input type="radio" name="trabalha" value="Sim" id="ocupacao-sim" checked><span class="radio-label">Sim</span>
											<input type="radio" name="trabalha" value="Não" id="ocupacao-nao"><span class="radio-label">Não</span>
									<?php } else { ?>
											<input type="radio" name="trabalha" value="Sim" id="ocupacao-sim"><span class="radio-label">Sim</span>
											<input type="radio" name="trabalha" value="Não" id="ocupacao-nao" checked><span class="radio-label">Não</span>
									<?php } ?>
								</div>
							</div>
							<div>
								<label>Qual a ocupação? </label>
								<?php if($obj_paciente->ocupacao != "") { ?>
									<input type="text" name="ocupacao" value="<?php echo $obj_paciente->ocupacao; ?>" id="ocupacao">
								<?php } else { ?>
									<input type="text" name="ocupacao" value="" disabled="disabled" id="ocupacao">
								<?php } ?>
							</div>
						</fieldset>
						<fieldset>
							<div class="div_full">
								<label><strong>Escolaridade</strong></label>
								<?php if($obj_paciente->escolaridade != "AN" 
								&& $obj_paciente->escolaridade != "Fundamental Inc." 
								&& $obj_paciente->escolaridade != "Fund. cp." 
								&& $obj_paciente->escolaridade != "Médio inc."
								&& $obj_paciente->escolaridade != "M. cp."
								&& $obj_paciente->escolaridade != "Superior" ) { ?>
									<div class="div_serie">
										<label>Série:</label>
										<input type="text" name="serie" value="<?php echo $obj_paciente->escolaridade; ?>">
									</div>
								<?php } else { ?>
										<div class="div_serie">
											<label>Série:</label>
											<input type="text" name="serie" value="">
										</div>
									<?php } 
										if($obj_paciente->escolaridade == "AN") {
									?>
											<div class="div_radio">
												<input type="radio" name="escolaridade" value="AN" checked>AN
											</div>
									<?php 	} else { ?>
											<div class="div_radio">
												<input type="radio" name="escolaridade" value="AN" checked>AN
											</div>
									<?php 	} if($obj_paciente->escolaridade == "Fundamental Inc.") { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Fundamental Inc." checked>Fundamental Inc.
												</div>
									<?php 	} else { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Fundamental Inc.">Fundamental Inc.
												</div>
									<?php 	} if($obj_paciente->escolaridade == "Fund. cp.") { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Fund. cp." checked>Fund. cp
												</div>
									<?php 	} else { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Fund. cp.">Fund. cp
												</div>
									<?php 	} if($obj_paciente->escolaridade == "Médio inc.") { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Médio inc." checked>Médio inc.
												</div>
									<?php 	} else { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Médio inc.">Médio inc.
												</div>
									<?php	} if($obj_paciente->escolaridade == "M. cp.") { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="M. cp." checked>M. cp.
												</div>
									<?php	} else { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Médio inc.">Médio inc.
												</div>
									<?php	} if($obj_paciente->escolaridade == "Superior") { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Superior" checked>Superior
												</div>
									<?php	} else { ?>
												<div class="div_radio">
													<input type="radio" name="escolaridade" value="Superior">Superior
												</div>
									<?php 	} ?>
							</div>
						</fieldset>
						<fieldset>
							<div class="div_media">
								<label><strong>Renda familiar</strong></label>
								<?php if($obj_paciente->renda == '< 1 SM ') { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="< 1 SM " checked> < 1 SM
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="< 1 SM "> < 1 SM
										</div>
								<?php } if($obj_paciente->renda == '1 SM ') { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="1 SM " checked>1 SM
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="1 SM ">1 SM
										</div>
								<?php } if($obj_paciente->renda == '2 a 4 SM ') { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="2 a 4 SM " checked>2 a 4 SM
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value="2 a 4 SM ">2 a 4 SM
										</div>
								<?php } if($obj_paciente->renda == '>= 5 SM ') { ?> 
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value=">= 5 SM " checked> >= 5 SM
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="renda-familiar" value=">= 5 SM "> >= 5 SM
										</div>
								<?php } ?>
							</div>

							<div class="div_media">
								<label><strong>Estado civil</strong></label>
								<?php if($obj_paciente->estado_civil == 'Solteiro') { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Solteiro" checked> Solteiro
											</div>
								<?php } else { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Solteiro" checked> Solteiro
											</div>
								<?php } if($obj_paciente->estado_civil == 'Casado') { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Casado" checked>Casado
											</div>
								<?php } else { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Casado">Casado
											</div>
								<?php } if($obj_paciente->estado_civil == 'Viúvo') { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Viúvo" checked>Viúvo
											</div>
								<?php } else { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Viúvo">Viúvo
											</div>
								<?php } if($obj_paciente->estado_civil == 'Amigado') { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Amigado" checked>Amigado
											</div>
								<?php } else { ?>
											<div class="div_radio">
												<input type="radio" name="estado-civil" value="Amigado">Amigado
											</div>
								<?php } ?>
							</div>
						</fieldset>
						<fieldset>
							<div>
								<label>Peso</label>
								<input type="text" name="peso" value="<?php echo $obj_paciente->peso; ?>">
							</div>
							<div>
								<label>Altura</label>
								<input type="text" name="altura" value="<?php echo $obj_paciente->altura; ?>">
							</div>
							<div>
								<label>IMC</label>
								<input type="text" name="imc" value="<?php echo $obj_paciente->imc; ?>">
							</div>
						</fieldset>

						<fieldset>
							<div class="religiao">
								<label><strong>Cor</strong></label>
								<?php if($obj_paciente->cor == 'Branco') { ?>
										<div class="div_radio">
											<input type="radio" name="cor" value="Branco" checked> Branco
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="cor" value="Branco"> Branco
										</div>
								<?php } if($obj_paciente->cor == 'Pardo') { ?>
									<div class="div_radio">
										<input type="radio" name="cor" value="Pardo" checked> Pardo
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="cor" value="Pardo" checked> Pardo
									</div>
								<?php } if($obj_paciente->cor == 'Negro') { ?>
									<div class="div_radio">
										<input type="radio" name="cor" value="Negro" checked>Negro
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="cor" value="Negro">Negro
									</div>
								<?php } ?>
							</div>

							<div>
								<div class="div_serie">
									<label>Religião</label>
									<input type="text" name="religiao" value="<?php echo $obj_paciente->religiao; ?>">
								</div>
							</div>
							<div class="religiao">
								<label>Pratica?</label>
								<?php if($obj_paciente->pratica == 'Sim') { ?>
									<div class="div_radio">
										<input type="radio" name="religiao-pratica" value="Sim" checked>Sim
									</div>
									<div class="div_radio">
										<input type="radio" name="religiao-pratica" value="Não">Não
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="religiao-pratica" value="Sim">Sim
									</div>
									<div class="div_radio">
										<input type="radio" name="religiao-pratica" value="Não" checked>Não
									</div>
								<?php } ?>
							</div>
							
						</fieldset>
							
						<fieldset>
							<div class="religiao">
								<label>Plano de saúde</label>
								<?php if($obj_paciente->plano_saude == 'Sim') { ?>
										<div class="div_radio">
											<input type="radio" name="plano-saude" value="Sim" checked>Sim
										</div>
										<div class="div_radio">
											<input type="radio" name="plano-saude" value="Não">Não
										</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="plano-saude" value="Sim">Sim
									</div>
									<div class="div_radio">
										<input type="radio" name="plano-saude" value="Não" checked>Não
									</div>
								<?php } ?>
							</div>

							<div class="div_maior">
								<label>Onde adquire medicamentos?</label>
								<input type="text" name="adquire-medicamento" value="<?php echo $obj_paciente->adquire_med; ?>" class="input_maior">
							</div>
						</fieldset>
						<fieldset>
							<div class="div_full">
								<label><strong>Residiu o tempo todo em um mesmo local?</strong></label>
								<?php if($obj_paciente->residiu == 'Sim') { ?>
										<div class="div_radio">
											<input type="radio" name="residiu" value="Sim" id="residiu-sim" checked>Sim
										</div>

										<div class="div_radio">
											<input type="radio" name="residiu" value="Não" id="residiu-nao">Não
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="residiu" value="Sim" id="residiu-sim">Sim
										</div>

										<div class="div_radio">
											<input type="radio" name="residiu" value="Não" id="residiu-nao" checked>Não
										</div>
								<?php } ?>

							</div>
						</fieldset>
						<?php 
						$qnt_residencia = count($obj_residencia);
						$i=1;
						$j=2;
						if($obj_residencia){
							foreach ($obj_residencia as $r) {
						?>	
							<div id="residencia<?php echo $i; ?>" class="residencia">
								<fieldset class="residencias">
									<div class="div_full">
										<h6>RESIDÊNCIA <?php echo $r->num_residencia; ?></h6>
										<div>
											<div>
												<label>PERÍODO:</label>	
												<input type="text" name="periodo_resid_<?php echo $i; ?>" value="<?php echo $r->periodo; ?>">
												<input type="hidden" name="num_residencia<?php echo $i; ?>" value="<?php echo $i; ?>">
											</div>							
										</div>
										<div class="religiao">
											<label>Área:</label>
											<?php if($r->area == "Urbana"){ ?>	
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Urbana" checked>Urbana
												</div>
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Rural">Rural
												</div>
											<?php } else { ?>
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Urbana">Urbana
												</div>
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Rural" checked>Rural
												</div>
											<?php } ?>
										</div>
										<div class="religiao">
												<label>Tipo de Cobertura:</label>	
												<?php if($r->tipo_cobertura == "Palha"){ ?>
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $i; ?>" value="Palha" checked>Palha
													</div>
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $i; ?>" value="Telha">Telha
													</div>
												<?php } else { ?>
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $i; ?>" value="Palha">Palha
													</div>
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $i; ?>" value="Telha" checked>Telha
													</div>
												<?php } ?>
											</div>
									</div>
									<div class="div_full">
										<div class="div_maior religiao">
											<label>Tipo de casa:</label>
											<?php if($r->tipo_casa == "Tijolo com reboco"){ ?>	
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo com reboco" checked>Tijolo com reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo sem reboco">Tijolo sem reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Pau-à-pique e barro">Pau-à-pique e barro
												</div>
											<?php } else if($r->tipo_casa == "Tijolo sem reboco"){ ?>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo com reboco">Tijolo com reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo sem reboco" checked>Tijolo sem reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Pau-à-pique e barro">Pau-à-pique e barro
												</div>
											<?php } else { ?>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo com reboco">Tijolo com reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo sem reboco">Tijolo sem reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Pau-à-pique e barro" checked>Pau-à-pique e barro
												</div>

											<?php } ?>
										</div>
										<div class="religiao">
											<label>Peridomicílio:</label>
											<?php if($r->peridomicilio == "Galinheiro"){ ?>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Galinheiro" checked>Galinheiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Chiqueiro">Chiqueiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Currais">Currais
												</div>
											<?php } else if($r->peridomicilio == "Chiqueiro"){ ?>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Galinheiro">Galinheiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Chiqueiro" checked>Chiqueiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Currais">Currais
												</div>
											<?php } else { ?>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Galinheiro">Galinheiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Chiqueiro">Chiqueiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Currais" checked>Currais
												</div>
											<?php } ?>

										</div>
									</div>
								</fieldset>
								<fieldset>
									<label>Animais domésticos:</label>
									<div class="div_media religiao">
									<?php if($r->animais == "Cães"){ ?>	
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Cães" checked>Cães
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Gatos">Gatos
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Pássaros">Pássaros
											</div>
									<?php }else if($r->animais == "Gatos"){ ?>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Cães">Cães
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Gatos" checked>Gatos
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Pássaros">Pássaros
											</div>
									<?php }else { ?>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Cães">Cães
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Gatos">Gatos
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Pássaros" checked>Pássaros
											</div>
									<?php } ?>
									</div>
									<div class="div_media">
										Quantidade de familiares:
										<input type="text" name="qnt-familiares<?php echo $i; ?>" value="<?php echo $r->qnt_familiares; ?>">
									</div>
								</fieldset>
								<?php if($y<4){ ?>
									<a href="javascript:void(0);" id="resid<?php echo $j; ?>" class="btn btn-warning">Mais</a>
								<?php } ?>
							</div>
						<?php	
							$i++;	
							$j++;
							}
							if($qnt_residencia > 0 && $qnt_residencia < 5){ 
								
								for($k = $i++; $k < 5; $k++){
							?>
									<div id="residencia<?php echo $k; ?>" class="residencia display_none">
										<fieldset class="residencias">
											<div class="div_full">
												<h6>RESIDÊNCIA <?php echo $k; ?></h6>
												<div>
													<div>
														<label>PERÍODO:</label>	
														<input type="text" name="periodo_resid_<?php echo $k; ?>" value="">
														<input type="hidden" name="num_residencia<?php echo $k; ?>" value="<?php echo $k; ?>">
													</div>							
												</div>
												
												<div class="religiao">
													<label>Área:</label>	
													<div class="div_radio">
														<input type="radio" name="area<?php echo $k; ?>" value="Urbana">Urbana
													</div>
													<div class="div_radio">
														<input type="radio" name="area<?php echo $k; ?>" value="Rural">Rural
													</div>
												</div>
												<div class="religiao">
													<label>Tipo de Cobertura:</label>	
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $k; ?>" value="Palha">Palha
													</div>
													<div class="div_radio">
														<input type="radio" name="cobertura<?php echo $k; ?>" value="Telha">Telha
													</div>
												</div>
											</div>
											<div class="div_full">
												<div class="div_maior religiao">
													<label>Tipo de casa:</label>
													<div class="div_radio">
														<input type="radio" name="tipo-casa<?php echo $k; ?>" value="Tijolo com reboco">Tijolo com reboco
													</div>
													<div class="div_radio">
														<input type="radio" name="tipo-casa<?php echo $k; ?>" value="Tijolo sem reboco">Tijolo sem reboco
													</div>
													<div class="div_radio">
														<input type="radio" name="tipo-casa<?php echo $k; ?>" value="Pau-à-pique e barro">Pau-à-pique e barro
													</div>
												</div>
												<div class="religiao">
													<label>Peridomicílio:</label>
													<div class="div_radio">
														<input type="radio" name="predomicilio<?php echo $k; ?>" value="Galinheiro">Galinheiro
													</div>
													<div class="div_radio">
														<input type="radio" name="predomicilio<?php echo $k; ?>" value="Chiqueiro">Chiqueiro
													</div>
													<div class="div_radio">
														<input type="radio" name="predomicilio<?php echo $k; ?>" value="Currais">Currais
													</div>
												</div>
											</div>
										</fieldset>

										<fieldset>
											<label>Animais domésticos:</label>
											<div class="div_media religiao">
												<div class="div_radio">
													<input type="radio" name="animais<?php echo $k; ?>" value="Cães">Cães
												</div>
												<div class="div_radio">
													<input type="radio" name="animais<?php echo $k; ?>" value="Gatos">Gatos
												</div>
												<div class="div_radio">
													<input type="radio" name="animais<?php echo $k; ?>" value="Pássaros">Pássaros
												</div>
											</div>
											<div class="div_media">
												Quantidade de familiares:
												<input type="text" name="qnt-familiares<?php echo $k; ?>" value="">
											</div>
										</fieldset>
										<?php $y=$k+1; 
											if($k < 4) { ?>
												<a href="javascript:void(0);" id="resid<?php echo $y; ?>" class="btn btn-warning">Mais</a>
										<?php $y++;
											} ?>
									</div>
					<?php  		}
							}
						} else { 
							for ($i=1; $i < 5; $i++) { 
							
							?>
								<div id="residencia<?php echo $i; ?>" class="residencia display_none">
									<fieldset class="residencias">
										<div class="div_full">
											<h6>RESIDÊNCIA <?php echo $i; ?></h6>
											<div>
												<div>
													<label>PERÍODO:</label>	
													<input type="text" name="periodo_resid_<?php echo $i; ?>" value="">
													<input type="hidden" name="num_residencia<?php echo $i; ?>" value="<?php echo $i; ?>">
												</div>							
											</div>
											
											<div class="religiao">
												<label>Área:</label>	
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Urbana">Urbana
												</div>
												<div class="div_radio">
													<input type="radio" name="area<?php echo $i; ?>" value="Rural">Rural
												</div>
											</div>
											<div class="religiao">
												<label>Tipo de Cobertura:</label>	
												<div class="div_radio">
													<input type="radio" name="cobertura<?php echo $i; ?>" value="Palha">Palha
												</div>
												<div class="div_radio">
													<input type="radio" name="cobertura<?php echo $i; ?>" value="Telha">Telha
												</div>
											</div>
										</div>
										<div class="div_full">
											<div class="div_maior religiao">
												<label>Tipo de casa:</label>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo com reboco">Tijolo com reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Tijolo sem reboco">Tijolo sem reboco
												</div>
												<div class="div_radio">
													<input type="radio" name="tipo-casa<?php echo $i; ?>" value="Pau-à-pique e barro">Pau-à-pique e barro
												</div>
											</div>
											<div class="religiao">
												<label>Peridomicílio:</label>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Galinheiro">Galinheiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Chiqueiro">Chiqueiro
												</div>
												<div class="div_radio">
													<input type="radio" name="predomicilio<?php echo $i; ?>" value="Currais">Currais
												</div>
											</div>
										</div>
									</fieldset>

									<fieldset>
										<label>Animais domésticos:</label>
										<div class="div_media religiao">
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Cães">Cães
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Gatos">Gatos
											</div>
											<div class="div_radio">
												<input type="radio" name="animais<?php echo $i; ?>" value="Pássaros">Pássaros
											</div>
										</div>
										<div class="div_media">
											Quantidade de familiares:
											<input type="text" name="qnt-familiares<?php echo $i; ?>" value="">
										</div>
									</fieldset>
									<?php $j=2; 
										if($i < 4) { ?>
											<a href="javascript:void(0);" id="resid<?php echo $j; ?>" class="btn btn-warning">Mais</a>
									<?php $j++;
										} ?>
								</div>
						<?php }
						}	?>

					<div class="sessao row-fluid">
						<h5>Aspectos Relacionados à doença de chagas</h5>
						<fieldset>
							<div class="div_full aspectos">
								<label>Há quanto tempo sabe que tem a doença?</label>
								<?php if($obj_paciente->tempo_doenca == 'Menos de 1 ano') { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="Menos de 1 ano" checked>Menos de 1 ano
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="Menos de 1 ano">Menos de 1 ano
									</div>
								<?php }  if($obj_paciente->tempo_doenca == '1 a 5 anos') { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="1 a 5 anos" checked>1 a 5 anos
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="1 a 5 anos">1 a 5 anos
									</div>
								<?php } if($obj_paciente->tempo_doenca == '6 a 10 anos'){ ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="6 a 10 anos" checked>6 a 10 anos
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="6 a 10 anos">6 a 10 anos
									</div>
								<?php } if($obj_paciente->tempo_doenca == '11 a 15 anos') { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="11 a 15 anos" checked>11 a 15 anos
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="11 a 15 anos">11 a 15 anos
									</div>
								<?php } if($obj_paciente->tempo_doenca == '15 a 20 anos') { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="15 a 20 anos" checked>15 a 20 anos
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="15 a 20 anos">15 a 20 anos
									</div>
								<?php } if($obj_paciente->tempo_doenca == 'Mais de 20 anos'){ ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="Mais de 20 anos" checked>Mais de 20 anos
									</div>
								<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="tempo-doenca" value="Mais de 20 anos">Mais de 20 anos
									</div>
								<?php } ?>
							</div>
						</fieldset>

						<fieldset>
							<div class="div_full aspectos">
								<label>Como descobriu que tem a doença?</label>
								<textarea name="descoberta-doenca" cols="80" rows="5"><?php echo $obj_paciente->descoberta_doenca; ?></textarea>
							</div>
						</fieldset>

						<fieldset>
							<div class="div_full aspectos">
								<label>Você percebe algum sofrimento, desconforto, ou dor física que associe a essa doença? Qual(is)?(Citar sintomas relacionados ao coração e ao TGI)</label>
								<textarea name="sintomas-doenca" cols="80" rows="5"><?php echo $obj_paciente->sintomas_doenca; ?></textarea>
							</div>
						</fieldset>

						<fieldset>
							<div class="div_full">
								<label>Estágio da doença(a partir do prontuário):</label>
								<?php if($obj_paciente->estagio_doenca == 'Forma Indeterminada'){ ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Indeterminada" checked>Forma Inderteminada
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Indeterminada">Forma Inderteminada
										</div>
								<?php } if($obj_paciente->estagio_doenca == 'Forma Cardíaca') { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Cardíaca" checked>Forma Cardíaca
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Cardíaca">Forma Cardíaca
										</div>
								<?php } if($obj_paciente->estagio_doenca == 'Forma Digestiva') { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Digestiva" checked>Forma Digestiva
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Digestiva">Forma Digestiva
										</div>
								<?php } if($obj_paciente->estagio_doenca == 'Forma Mista') { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Mista" checked>Forma Mista
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="estagio-doenca" value="Forma Mista">Forma Mista
										</div>
								<?php } ?>
							</div>
						</fieldset>
					</div>
					<div class="sessao row-fluid">
						<h5>Outros problemas de saúde/preocupações de saúde</h5>
						<fieldset>
							<div class="centro"><label>Problemas de saúde/Preocupação</label></div>
							<div class="centro"><label>Controlado: Sim(s) Não (n)</label></div>
							<div class="centro"><label>Início</label></div>
	
						</fieldset>
								
						<?php 
							$qnt_problema = count($obj_problemas_saude);
							$j=1;
							foreach($obj_problemas_saude as $prob){
								echo "<fieldset>";
								echo "<div class='centro'>".$j.".<input type='text' name='problema".$j."' value='".$prob->problema."'></div>
								<div class='centro'>";
									if($prob->controlado == "Sim"){
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$j."' value='Sim' checked>Sim";
										echo "</div>";
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$j."' value='Não'>Não";
										echo "</div>";
									}else {
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$j."' value='Sim'>Sim";
										echo "</div>";
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$j."' value='Não' checked>Não";
										echo "</div>";
									}
								echo "</div>";
								echo "<div class='centro'><input type='text' name='problema-data".$j."' value='".$prob->inicio."'></div>";
								echo "</fieldset>";
							$j++;
							}
						?>
						
						
						<?php
							if($qnt_problema < 7){
								$total = 7 - $qnt_problema;
								for($i=1; $i < $total; $i++){
									$q = $i + $qnt_problema;
									echo "<fieldset>";
									echo "<div class='centro'>".$q.".<input type='text' name='problema".$q."' value=''></div>
									<div class='centro'>";
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$q."' value='Sim'>Sim";
										echo "</div>";
										echo "<div class='div_radio'>";
											echo "<input type='radio' name='problema-controlado".$q."' value='Não'>Não";
										echo "</div>";
									echo "</div>";
									echo "<div class='centro'><input type='text' name='problema-data".$q."' value=''></div>";
									echo "</fieldset>";
								}
							}
							?>
					</div>

					<div class="sessao row-fluid aspectos">
						<h5>História Médica pregressiva</h5>
						
						<textarea name="historia-medica" cols="80" rows="5"><?php echo $obj_paciente->historico; ?></textarea>

					</div>

					<div class="sessao row-fluid historia_familiar">
						<h5>História  Familiar</h5>
						<?php $perguntas = listar_perguntas_historia_familiar();
							foreach ($perguntas as $key) {
						?>		
							<fieldset>

								<div class="div_maior">
									<?php 
										echo $key->num . ". ";
										echo $key->pergunta;

									?>
								</div>

							<?php if(($key->num == '1' && $obj_paciente->possui_historico == 'Sim') || ($key->num == '2' && $obj_paciente->historico_morte == 'Sim') || ($key->num == '3' && $obj_paciente->historico_card == 'Sim')) { ?>
										<div class="div_menor">
											<div class="div_radio">
												<input type="radio" name="hist-fam-<?php echo $key->num; ?>" value="Sim" checked>Sim
											</div>
											<div class="div_radio">
												<input type="radio" name="hist-fam-<?php echo $key->num; ?>" value="Não">Não
											</div>
										</div>
							<?php } else { ?>
									<div class="div_menor">
										<div class="div_radio">
											<input type="radio" name="hist-fam-<?php echo $key->num; ?>" value="Sim">Sim
										</div>
										<div class="div_radio">
											<input type="radio" name="hist-fam-<?php echo $key->num; ?>" value="Não" checked>Não
										</div>
									</div>
							<?php } ?> 
							</fieldset>
						<?php } ?>
						
					</div>

					<div class="sessao row-fluid antecedentes">
						<h5>Antecedentes Alérgicos</h5>
						<fieldset>
							<h6>Alergias</h6>
							<div class="div_menor">
								<p class="label-p">Histórico de RAM: </p>
							<?php if($obj_paciente->ale_hist_ram == 'S') { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="S" checked>S
									</div>
							<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="S">S
									</div>
							<?php } if($obj_paciente->ale_hist_ram == 'N') { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="N" checked>N
									</div>
							<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="N">N
									</div>
							<?php } if($obj_paciente->ale_hist_ram == 'NS') { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="NS" checked>NS
									</div>
							<?php } else  { ?>
									<div class="div_radio">
										<input type="radio" name="alergia" value="NS">NS
									</div>
							<?php } ?>
							</div>
							<div class="div_maior">
								<p class="label-p">Medicamento causador: </p>
								<input type="text" value="<?php echo $obj_paciente->ale_med_causador; ?>" name="med_causador">
							</div>
						</fieldset>
						<fieldset>
							<div class="div_full">
								<label>Especificar RAM:</label>
								<input type="text" value="<?php echo $obj_paciente->ale_esp_ram; ?>" name="RAM" class="input_maior">
							</div>
						</fieldset>
						<fieldset>
							<div class="div_menor">
								<p class="label-p">Alergia a algum alimento? </p>
								<?php if($obj_paciente->ale_alimento == 'S') { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="S" checked>S
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="S">S
										</div>
								<?php } if($obj_paciente->ale_alimento == 'N') { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="N" checked>N
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="N">N
										</div>
								<?php } if($obj_paciente->ale_alimento == 'NS') { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="NS" checked>NS
										</div>
								<?php } else { ?>
										<div class="div_radio">
											<input type="radio" name="alergia_alimento" value="NS">NS
										</div>
								<?php } ?>
							</div>
							<div class="div_maior">
								<p class="label-p">Especificar: </p>
								<input type="text" value="<?php echo $obj_paciente->ale_espec_alimento; ?>" name="ale_alimento">
							</div>
						</fieldset>
						<fieldset>
							<div class="div_full">
								<label>Outros:</label>
								<input type="text" value="<?php echo $obj_paciente->ale_outros; ?>" name="outros" class="input_maior">
							</div>
						</fieldset>
					</div>

					<div class="sessao row-fluid medicamentos">
						<h5>Medicamentos utilizados a 15 dias atrás</h5>
						<div class="span3 primeiro"><h6>Medicamentos</h6></div>
						<div class="span3"><h6>Indicação</h6></div>
						<div class="span3"><h6>Respostas</h6></div>
						<div class="span3"><h6>Período de uso</h6></div>
						<?php $qnt_med = count($obj_med_utilizados);
						  $i = 1;
							foreach ($obj_med_utilizados as $med) {

								if($i < 5 && $med->medicamento !='' && $i != 4){
									$j = $i+1;
									echo "<div class='linha'>
											<div class='span3 primeiro'>
												<input type='text' name='medicamento".$i."' value='".$med->medicamento."'>
											</div>
											<div class='span3'>
												<input type='text' name='indicacao".$i."' value='".$med->indicacao."'>
											</div>
											<div class='span3'>
												<input type='text' name='resposta_".$i."' value='".$med->resposta."'>
											</div>
											<div class='span3'>
												<input type='text' name='periodo".$i."' value='".$med->periodo."' class='input_menor'>
												<a href='javascript:void(0);' class='mais_medic".$j." mais'><img src='"; 
												bloginfo('template_url'); 
												echo "/img/mais.png'></a>
											</div>
										</div>";
										$i++;
								} 
							}
							if($qnt_med < 5){
								$j = $qnt_med +1;
								for($i=$j; $i < 5; $i++){
									$q = $i+1;
									if($i != 4){
										echo "<div class='linha linha".$i."'>
											<div class='span3 primeiro'>
												<input type='text' name='medicamento".$i."' value=''>
											</div>
											<div class='span3'>
												<input type='text' name='indicacao".$i."' value=''>
											</div>
											<div class='span3'>
												<input type='text' name='resposta_".$i."' value=''>
											</div>
											<div class='span3'>
												<input type='text' name='periodo".$i."' value='' class='input_menor'>
												<a href='javascript:void(0);' class='mais_medic".$q." mais'><img src='";
												bloginfo('template_url'); 
												echo "/img/mais.png'></a>
											</div>
										</div>";
									}else {
										echo "<div class='linha linha".$i."'>
												<div class='span3 primeiro'>
													<input type='text' name='medicamento".$i."' value=''>
												</div>
												<div class='span3'>
													<input type='text' name='indicacao".$i."' value=''>
												</div>
												<div class='span3'>
													<input type='text' name='resposta_".$i."' value=''>
												</div>
												<div class='span3'>
													<input type='text' name='periodo".$i."' value='' class='input_menor'>
												</div>
											</div>";
									}
								}
							}
								
						?>
					</div>

					<div class="sessao row-fluid medicamentos_uso">
						<h5>Medicamentos que utiliza (uso contínuo)</h5>
						<?php $qnt_q_utiliza = count($obj_med_que_utiliza); 
						 	$i = 1;
						 	$q = 2;
							foreach ($obj_med_que_utiliza as $m) {
								if($i < 8 && $med->medicamento !='' && $i != 7){
								echo "<div class='linha'>
										<div class='span3 primeiro'>
											<label>Medicamento</label>
											<input type='text' name='medicamento_uso".$i."' value='".$m->medicamento."'>
											<input type='hidden' name='num_med".$i."' value='".$i."'>
										</div>
										<div class='span3'>
											<label>Posologia</label>
											<input type='text' name='posologia".$i."' value='".$m->posologia."'>
										</div>
										<div class='span3'>
											<label>Indicado por*</label>
											<input type='text' name='indicado".$i."' value='".$m->indicado_por."'>
										</div>
										<div class='span3'>
											<label>Indicação de uso</label>
											<input type='text' name='indicacao_uso".$i."' value='".$m->ind_uso."'>
										</div>
										<div class='span3 primeiro'>
											<label>Modo de uso</label>
											<input type='text' name='modo_uso".$i."' value='".$m->modo_uso."'>
										</div>
										<div class='span3'>
											<label>Respostas</label>
											<input type='text' name='resposta".$i."' value='".$m->resposta."'>
										</div>
										<div class='span3'>
											<label>Efeitos indesejáveis</label>
											<input type='text' name='efeito_uso".$i."' value='".$m->efeitos."'>
										</div>
											<div class='span3'>
											<label>Início</label>
											<input type='text' name='inicio_uso".$i."' value='".$m->inicio."' class='input_menor'>
											<a href='javascript:void(0);' class='medic_uso".$q." mais'><img src='";
											bloginfo('template_url'); 
											echo "/img/mais.png'></a>
										</div>
									</div>";
									$i++;
									$q++;
								}
							}

							if($qnt_q_utiliza < 9){
								$j = $qnt_q_utiliza +1;
								for($i=$j; $i < 9; $i++){
									if($i != 8){
										echo "<div class='linha uso_linha".$i."'>
												<div class='span3 primeiro'>
													<label>Medicamento</label>
													<input type='text' name='medicamento_uso".$i."' value=''>
													<input type='hidden' name='num_med".$i."' value='".$i."'>
												</div>
												<div class='span3'>
													<label>Posologia</label>
													<input type='text' name='posologia".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Indicado por*</label>
													<input type='text' name='indicado".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Indicação de uso</label>
													<input type='text' name='indicacao_uso".$i."' value=''>
												</div>
												<div class='span3 primeiro'>
													<label>Modo de uso</label>
													<input type='text' name='modo_uso".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Respostas</label>
													<input type='text' name='resposta".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Efeitos indesejáveis</label>
													<input type='text' name='efeito_uso".$i."' value=''>
												</div>
													<div class='span3'>
													<label>Início</label>
													<input type='text' name='inicio_uso".$i."' value='' class='input_menor'>
													<a href='javascript:void(0);' class='medic_uso".$q." mais'><img src='";
													bloginfo('template_url'); 
													echo "/img/mais.png'></a>
												</div>
											</div>";
											$q++;
										}else {
											echo "<div class='linha uso_linha".$i."'>
												<div class='span3 primeiro'>
													<label>Medicamento</label>
													<input type='text' name='medicamento_uso".$i."' value=''>
													<input type='hidden' name='num_med".$i."' value='".$i."'>
												</div>
												<div class='span3'>
													<label>Posologia</label>
													<input type='text' name='posologia".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Indicado por*</label>
													<input type='text' name='indicado".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Indicação de uso</label>
													<input type='text' name='indicacao_uso".$i."' value=''>
												</div>
												<div class='span3 primeiro'>
													<label>Modo de uso</label>
													<input type='text' name='modo_uso".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Respostas</label>
													<input type='text' name='resposta".$i."' value=''>
												</div>
												<div class='span3'>
													<label>Efeitos indesejáveis</label>
													<input type='text' name='efeito_uso".$i."' value=''>
												</div>
													<div class='span3'>
													<label>Início</label>
													<input type='text' name='inicio_uso".$i."' value='' class='input_menor'>
												</div>
											</div>";

										}
									}
								}
						?>
						<div class="obs">
							<p>*Indicado por: AM-automedicação; Md-Médico; Par-Parente; ProfS-Profissional de saúde; Ot.-Outro</p>
							<p><strong>(OBS.: Se paciente mulher em idade fértil, questioná-la sobre o uso de anticoncepcional)</strong></p>
						</div>
					</div>

					<div class="sessao row-fluid">
						<h5>Informações sobre a prescrição do benzonidazol</h5>
						<div class="span3 primeiro">
							<label>Quantidade total de comp. prescritos:</label>
							<input type="text" name="qnt_prescritos" value="<?php echo $obj_paciente->qnt_comp_presc; ?>">
						</div>
						<div class="span3">
							<label>Posologia:</label>
							<input type="text" name="posologia_presc" value="<?php echo $obj_paciente->dose_diaria; ?>">
						</div>
						<div class="span3">
							<label>Dose diária (mg/Kg/dia):</label>
							<input type="text" name="dose_diaria" value="<?php echo $obj_paciente->posologia; ?>">
						</div>
						<div class="span3">
							<label>Dose total ingerida durante o tto (g):</label>
							<input type="text" name="dose_ingerida" value="<?php echo $obj_paciente->dose_total; ?>">
						</div>
					</div>

					<div class="sessao row-fluid revisao_sistemas">
						<h5>Revisão de Sistemas (Avaliação de co-morbidades)</h5>
						<div class="span2 primeiro">
							<h6>Sistema</h6>
						</div>
						<div class="span10 primeiro">
							<h6>Aparelho/Sinais e sintomas</h6>
						</div>
							<?php 
								for ($i=1; $i < 14; $i++) {
									$sinais_bd = buscar_revisao_sistemas_id($numero_paciente, $i);
									$sinais_array = array();
									foreach($sinais_bd as $bd_sinais){
										array_push($sinais_array, $bd_sinais->sintoma);
									}
							?>

								<div class="span2 primeiro">
									<?php 
										$sistemas = revisao_de_sistemas_sistema($i);
										$id;
										foreach ($sistemas as $sistema) {
											echo $sistema->nome . " ";
											$id = $sistema->id;
										}
									?>
								</div> 
								<div class="span10 primeiro">
									<?php 
										$sinais = revisao_de_sistemas_sinais($i);
										foreach ($sinais as $sinal) {
											if(in_array($sinal->nome, $sinais_array)){
												echo "<div class='check'><input type='checkbox' name='".$id."[]' value='".$sinal->nome."' checked = checked>". $sinal->nome . "</div> ";	
											} else {
												echo "<div class='check'><input type='checkbox' name='".$id."[]' value='".$sinal->nome."'>". $sinal->nome . "</div> ";	
											}
											
										}
									?>
								</div>

							<?php } ?>
					</div>
					
					<div class="sessao row-fluid habitos">
						<h5>Hábitos de Vida</h5>
						<div class="span2 primeiro">
							<h6>Prática</h6>
						</div>
						<div class="span2 primeiro">
							<h6>Prática atual</h6>
						</div>
						<div class="span8 primeiro">
							<h6>Observações</h6>
						</div>

						<div class="span2 primeiro caixa">
							<p><strong>Fuma?</strong></p>
						</div>
						<?php $fuma = buscar_habitos_de_vida($numero_paciente, 'Fuma?'); 
						?>
						<div class="span2 primeiro caixa">
						<?php if($fuma->pratica_atual == 'S'){ ?>
								<div class="div_radio">
									<input type="radio" name="fuma" value="S" checked>S
								</div>
								<div class="div_radio">
									<input type="radio" name="fuma" value="N">N
								</div>
						<?php } else { ?>
								<div class="div_radio">
									<input type="radio" name="fuma" value="S">S
								</div>
								<div class="div_radio">
									<input type="radio" name="fuma" value="N" checked>N
								</div>
						<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs primeira_frase">Se fuma: Qual a frequência?</div>
							<div class="div_radio_obs tam_radio_1">
							<?php if($fuma->frequencia == '0-10 cigarros/dia'){ ?>
								<input type="radio" name="frequencia_fuma" value="0-10 cigarros/dia" checked>0-10 cigarros/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_fuma" value="0-10 cigarros/dia">0-10 cigarros/dia
							<?php } ?>
							</div>
							<div class="div_radio_obs tam_radio_2">
							<?php if($fuma->frequencia == '10-20 cigarros/dia'){ ?>
								<input type="radio" name="frequencia_fuma" value="10-20 cigarros/dia" checked>10-20 cigarros/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_fuma" value="10-20 cigarros/dia">10-20 cigarros/dia
							<?php } ?>
							</div>
							<div class="div_radio_obs tam_radio_3">
							<?php if($fuma->frequencia == 'Acima de 20cigarros/dia'){ ?>
								<input type="radio" name="frequencia_fuma" value="Acima de 20cigarros/dia"checked>Acima de 20 cigarros/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_fuma" value="Acima de 20cigarros/dia">Acima de 20 cigarros/dia
							<?php } ?>
							</div>

							<div class="div_2">
								Se já fumou: Há quanto tempo deixou de usar?
								<input type="text" name="qnt_tempo_fuma" value="<?php echo $fuma->tempo_deixou; ?>">
								Motivo? <input type="text" name="motivo_fuma" value="<?php echo $fuma->motivo; ?>">
							</div>
							
						</div>

						<div class="span2 primeiro caixa">
							<p><strong>Toma café?</strong></p>
						</div>
						<div class="span2 primeiro caixa">
						<?php
							$cafe = buscar_habitos_de_vida($numero_paciente, 'Toma café?');  
							if($cafe->pratica_atual == 'S'){ ?>
								<div class="div_radio">
									<input type="radio" name="cafe" value="S" checked>S
								</div>
								<div class="div_radio">
									<input type="radio" name="cafe" value="N">N
								</div>
						<?php } else { ?>
								<div class="div_radio">
									<input type="radio" name="cafe" value="S">S
								</div>
								<div class="div_radio">
									<input type="radio" name="cafe" value="N" checked>N
								</div>
						<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs primeira_frase tam_pergunta_1">Se toma café: Qual a frequência?</div>
							<div class="div_radio_obs tam_radio_1">
								<?php if($cafe->frequencia == '1 xícara/dia'){ ?>
									<input type="radio" name="frequencia_cafe" value="1 xícara/dia" checked>1 xícara/dia
								<?php } else { ?>
									<input type="radio" name="frequencia_cafe" value="1 xícara/dia">1 xícara/dia
								<?php } ?>
							</div>
							<div class="div_radio_obs tam_radio_2">
								<?php if($cafe->frequencia == '2-3 xícaras/dia'){ ?>
									<input type="radio" name="frequencia_cafe" value="2-3 xícaras/dia" checked>2-3 xícaras/dia
								<?php } else { ?>
									<input type="radio" name="frequencia_cafe" value="2-3 xícaras/dia">2-3 xícaras/dia
								<?php } ?>
							</div>
							<div class="div_radio_obs altura_radio">
								<?php if($cafe->frequencia == 'Acima de 6/dia'){ ?>
									<input type="radio" name="frequencia_cafe" value="Acima de 6/dia" checked>Acima de 6/dia
								<?php } else { ?>
									<input type="radio" name="frequencia_cafe" value="Acima de 6/dia">Acima de 6/dia
								<?php } ?>
								
							</div>

							<div class="div_2">
								Se já tomava café: Há quanto tempo deixou de tomar?
								<input type="text" name="qnt_tempo_cafe" value="<?php echo $cafe->tempo_deixou; ?>" class="input_menor">
								Motivo? <input type="text" name="motivo_cafe" value="<?php echo $cafe->motivo; ?>" class="input_menor">
							</div>
						</div>

						<div class="span2 primeiro caixa2">
							<p><strong>Ingere bebidas alcoólicas?</strong></p>
						</div>
						
						<div class="span2 primeiro caixa2">
							<?php
								$bebida = buscar_habitos_de_vida($numero_paciente, 'Ingere bebidas alcoólicas?');  
								if($bebida->pratica_atual == 'S'){ ?>
									<div class="div_radio">
										<input type="radio" name="bebida" value="S" checked>S
									</div>
									<div class="div_radio">
										<input type="radio" name="bebida" value="N">N
									</div>
							<?php } else { ?>
									<div class="div_radio">
										<input type="radio" name="bebida" value="S">S
									</div>
									<div class="div_radio">
										<input type="radio" name="bebida" value="N" checked>N
									</div>
							<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="habitos_print primeira_frase">Se bebe: analisar possibilidade do paciente ser alcoólatra. Em média consome:</div>
							<div class="div_radio_obs">
							<?php if($bebida->frequencia == '1 copo/semana'){ ?>
								<input type="radio" name="frequencia_bebe" value="1 copo/semana" checked>1 copo/semana
							<?php } else { ?>
								<input type="radio" name="frequencia_bebe" value="1 copo/semana">1 copo/semana
							<?php } ?>
							</div>
							<div class="div_radio_obs">
								<?php if($bebida->frequencia == '2-6 copos/semana'){ ?>
									<input type="radio" name="frequencia_bebe" value="2-6 copos/semana" checked>2-6 copos/semana
								<?php } else { ?>
									<input type="radio" name="frequencia_bebe" value="2-6 copos/semana">2-6 copos/semana
								<?php } ?>
							</div>
							<div class="div_radio_obs">
								<?php if($bebida->frequencia == '7-12 copos/semana'){ ?>
									<input type="radio" name="frequencia_bebe" value="7-12 copos/semana" checked>7-12 copos/semana
								<?php } else { ?>
									<input type="radio" name="frequencia_bebe" value="7-12 copos/semana">7-12 copos/semana
								<?php } ?>
								
							</div>
							<br />
							<div class="div_2 altura_radio">
								Se bebia: Há quanto tempo deixou de beber?
								<input type="text" name="qnt_tempo_bebe" value="<?php echo $bebida->tempo_deixou; ?>" class="input_menor">
								Motivo? <input type="text" name="motivo_bebe" value="<?php echo $bebida->motivo; ?>" class="input_menor">
							</div>
						</div>

						<div class="span2 primeiro caixa3">
							<p><strong>Utiliza chás de plantas medicinais?</strong></p>
						</div>
						<div class="span2 primeiro caixa3">
						<?php
							$plantas = buscar_habitos_de_vida($numero_paciente, 'Utiliza chás de plantas medicinais?');  
							if($plantas->pratica_atual == 'S'){ ?>
								<div class="div_radio">
									<input type="radio" name="cha" value="S" checked>S
								</div>
								<div class="div_radio">
									<input type="radio" name="cha" value="N">N
								</div>
							<?php } else { ?>
								<div class="div_radio">
									<input type="radio" name="cha" value="S">S
								</div>
								<div class="div_radio">
									<input type="radio" name="cha" value="N" checked>N
								</div>
							<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs primeira_frase">Se sim qual a frequência?</div>
							<div class="div_radio_obs2">
							<?php if($plantas->frequencia == '1 xícara/dia'){ ?>
								<input type="radio" name="frequencia_cha" value="1 xícara/dia" checked>1 xícara/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_cha" value="1 xícara/dia">1 xícara/dia
							<?php } ?>
							</div>
							<div class="div_radio_obs2">
							<?php if($plantas->frequencia == '2-3 xícaras/dia'){ ?>
								<input type="radio" name="frequencia_cha" value="2-3 xícaras/dia" checked>2-3 xícaras/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_cha" value="2-3 xícaras/dia">2-3 xícaras/dia
							<?php } ?>
							</div>
							<div class="div_radio_obs2">
							<?php if($plantas->frequencia == '4-6 xícaras/dia'){ ?>
								<input type="radio" name="frequencia_cha" value="4-6 xícaras/dia" checked>4-6 xícaras/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_cha" value="4-6 xícaras/dia">4-6 xícaras/dia
							<?php } ?>
							</div>
							<div class="div_radio_obs2">
							<?php if($plantas->frequencia == 'Acima de 6/dia'){ ?>
								<input type="radio" name="frequencia_cha" value="Acima de 6/dia" checked>Acima de 6/dia
							<?php } else { ?>
								<input type="radio" name="frequencia_cha" value="Acima de 6/dia">Acima de 6/dia
							<?php } ?>
								
							</div>
							<br />
							<div class="div_2">
								Tipo de planta que utiliza?	<input type="text" name="cha_tipo_planta" value="<?php echo $plantas->tipo_planta; ?>">
								Para qual indicação? <input type="text" name="cha_indicacao" value="<?php echo $plantas->indicacao_planta; ?>">
							</div>
						</div>

						<div class="span2 primeiro caixa3">
							<p><strong>Pratica atividade física?</strong></p>
						</div>
						<div class="span2 primeiro caixa3">
						<?php
							$atividade = buscar_habitos_de_vida($numero_paciente, 'Pratica atividade física?');  
							if($atividade->pratica_atual == 'S'){ ?>
								<div class="div_radio">
									<input type="radio" name="atividade_fisica" value="S" checked>S
								</div>
								<div class="div_radio">
									<input type="radio" name="atividade_fisica" value="N">N
								</div>
							<?php } else { ?>
								<div class="div_radio">
									<input type="radio" name="atividade_fisica" value="S">S
								</div>
								<div class="div_radio">
									<input type="radio" name="atividade_fisica" value="N" checked>N
								</div>
							<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="div_2">
								Tipo de prática que realiza?<input type="text" name="tipo_ativiadade_fisica" value="<?php echo $atividade->tipo_atividade; ?>">
							</div>
							<div class="div_text_obs">Frequência:</div>
							<div class="div_radio_obs2">
								<?php if($atividade->frequencia == '1-2x/semana'){ ?>
									<input type="radio" name="ativ_fisica_freq" value="1-2x/semana" checked>1-2x/semana
								<?php } else { ?>
									<input type="radio" name="ativ_fisica_freq" value="1-2x/semana">1-2x/semana
								<?php } ?>
							</div>
							<div class="div_radio_obs2">
								<?php if($atividade->frequencia == '3-4x/semana'){ ?>
									<input type="radio" name="ativ_fisica_freq" value="3-4x/semana" checked>3-4x/semana
								<?php } else { ?>
									<input type="radio" name="ativ_fisica_freq" value="3-4x/semana">3-4x/semana
								<?php } ?>
							</div>
							<div class="div_radio_obs2">
								<?php if($atividade->frequencia == '5-7x/semana'){ ?>
									<input type="radio" name="ativ_fisica_freq" value="5-7x/semana" checked>5-7x/semana
								<?php } else { ?>
									<input type="radio" name="ativ_fisica_freq" value="5-7x/semana">5-7x/semana
								<?php } ?>
							</div>
						</div>

						<div class="span2 primeiro caixa4">
							<p><strong>Você considera sua alimentação saudável?</strong></p>
						</div>
						<div class="span2 primeiro caixa4">
						<?php
							$alimentacao = buscar_habitos_de_vida($numero_paciente, 'Você considera sua alimentação saudável?');  
							if($alimentacao->pratica_atual == 'S'){ ?>
								<div class="div_radio">
									<input type="radio" name="alimentacao" value="S" checked>S
								</div>
								<div class="div_radio">
									<input type="radio" name="alimentacao" value="N">N
								</div>
							<?php } else { ?>
								<div class="div_radio">
									<input type="radio" name="alimentacao" value="S">S
								</div>
								<div class="div_radio">
									<input type="radio" name="alimentacao" value="N" checked>N
								</div>
							<?php } ?>
						</div>
						<div class="span8 primeiro">
							<div class="habitos_print">Tipo de alimentação:</div>
							<div class="div_check">
								<?php $tipo = explode(";", $alimentacao->tipo_alimentacao); ?>

								<?php if(in_array("Rica em massas", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em massas" checked>Rica em massas
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em massas">Rica em massas
								<?php } ?>
							</div>
							<div class="div_check">
								<?php if(in_array("Rica em frutas", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em frutas" checked>Rica em frutas
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em frutas">Rica em frutas
								<?php } ?>
							</div>
							<div class="div_check">
								<?php if(in_array("Rica em carne vermelha", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em carne vermelha" checked>Rica em carne vermelha
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em carne vermelha">Rica em carne vermelha
								<?php } ?>
								
							</div>
							<div class="div_check">
								<?php if(in_array("Rica em verdura", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em verdura" checked>Rica em verdura
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em verdura">Rica em verdura
								<?php } ?>
							</div>
							<div class="div_check">
								<?php if(in_array("Rica em carne branca", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em carne branca" checked>Rica em carne branca
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em carne branca">Rica em carne branca
								<?php } ?>
							</div>
							<div class="div_check">
								<?php if(in_array("Rica em óleos e gorduras", $tipo)){ ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em óleos e gorduras" checked>Rica em óleos e gorduras
								<?php } else { ?>
									<input type="checkbox" name="tipo_alimentacao_1[]" value="Rica em óleos e gorduras">Rica em óleos e gorduras
								<?php } ?>
							</div>
							<div class="habitos_print">
								Outros. Epecificar: <input type="text" name="outros_alimentacao" value="<?php echo $alimentacao->outros; ?>">
							</div>
						</div>
					</div>

					<div class="sessao row-fluid exames_clinicos">
						<h5>EVOLUÇÃO DE PARÂMETROS LABORATORIAIS E CLÍNICOS</h5>
						<?php 
							$total = total_tipo_exames();

							for($i=1; $i<=$total; $i++){
						?>
							<div class="span2 primeiro col">
								<h6><?php evolucao_exames_tipo($i); ?></h6>
							</div>
							
							<?php 
								if($i == 6){
							?>		
									<div class="span1 col">
										<h6>1º COLETA</h6>
										<?php 
											$data = buscar_outros_param_id_data($numero_paciente, 1); 
											$data2 = buscar_outros_param_id_data($numero_paciente, 2);
											$data3 = buscar_outros_param_id_data($numero_paciente, 3);
											$data4 = buscar_outros_param_id_data($numero_paciente, 4); 
											$data5 = buscar_outros_param_id_data($numero_paciente, 5);
											$data6 = buscar_outros_param_id_data($numero_paciente, 6);
										?>
										<input type="date" name="coleta1_<?php echo $i; ?>" value="<?php echo $data->coleta; ?>">
									</div>
									<div class="span1 col">
										<h6>2º COLETA</h6>
										<input type="date" name="coleta2_<?php echo $i; ?>" value="<?php echo $data2->coleta; ?>">
									</div>
									<div class="span1 col">
										<h6>3º COLETA</h6>
										<input type="date" name="coleta3_<?php echo $i; ?>" value="<?php echo $data3->coleta; ?>">
									</div>
									<div class="span1 col">
										<h6>4º COLETA</h6>
										<input type="date" name="coleta4_<?php echo $i; ?>" value="<?php echo $data4->coleta; ?>">
									</div>
									<div class="span1 col">
										<h6>5º COLETA</h6>
										<input type="date" name="coleta5_<?php echo $i; ?>" value="<?php echo $data5->coleta; ?>">
									</div>
									<div class="span1 col">
										<h6>6º COLETA</h6>
										<input type="date" name="coleta6_<?php echo $i; ?>" value="<?php echo $data6->coleta; ?>">
									</div>
							<?php 
								} else {
							?>
									<div class="span2 col">
										<h6>1º COLETA</h6>
										<?php if($i == 1) {
											$data = buscar_hemograma_id_data($numero_paciente, 1); 
											$data2 = buscar_hemograma_id_data($numero_paciente, 2); 
											$data3 = buscar_hemograma_id_data($numero_paciente, 3); 
										}else if($i == 2) {
											$data = buscar_funcao_renal_id_data($numero_paciente, 1);
											$data2 = buscar_funcao_renal_id_data($numero_paciente, 2);
											$data3 = buscar_funcao_renal_id_data($numero_paciente, 3);   
										}else if($i == 3) {
											$data = buscar_funcao_hepatica_id_data($numero_paciente, 1); 
											$data2 = buscar_funcao_hepatica_id_data($numero_paciente, 2); 
											$data3 = buscar_funcao_hepatica_id_data($numero_paciente, 3); 
										}else if($i == 4) {
											$data = buscar_ex_bioq_id_data($numero_paciente, 1); 
											$data2 = buscar_ex_bioq_id_data($numero_paciente, 2);
											$data3 = buscar_ex_bioq_id_data($numero_paciente, 3);
										}else if($i == 5) {
											$data = buscar_teste_chagas_id_data($numero_paciente, 1); 
											$data2 = buscar_teste_chagas_id_data($numero_paciente, 2);
											$data3 = buscar_teste_chagas_id_data($numero_paciente, 3);  
										}else {
											$data = buscar_outros_param_id_data($numero_paciente, 1); 
											$data2 = buscar_outros_param_id_data($numero_paciente, 2);
											$data3 = buscar_outros_param_id_data($numero_paciente, 3);
										}
										?>
										<input type="date" name="coleta1_<?php echo $i; ?>" value="<?php echo $data->coleta; ?>">
									</div>
									<div class="span2 col">
										<h6>2º COLETA</h6>
										<input type="date" name="coleta2_<?php echo $i; ?>" value="<?php echo $data2->coleta; ?>">
									</div>
									<div class="span2 col">
										<h6>3º COLETA</h6>
										<input type="date" name="coleta3_<?php echo $i; ?>" value="<?php echo $data3->coleta; ?>">
									</div>
									<div class="span4 col">
										<h6>Observações</h6>
									</div>
							<?php		
								}
							?>
							
						<?php 
								$exames = exames($i);
								foreach ($exames as $ex) {
									if($i==1){
										$valor = buscar_hemograma_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_hemograma_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_hemograma_por_valor($numero_paciente, 3, $ex->nome);
									} else if($i==2){
										$valor = buscar_funcao_renal_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_funcao_renal_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_funcao_renal_por_valor($numero_paciente, 3, $ex->nome);
									} else if($i==3){
										$valor = buscar_funcao_hepatica_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_funcao_hepatica_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_funcao_hepatica_por_valor($numero_paciente, 3, $ex->nome);
									} else if($i==4){
										$valor = buscar_ex_bioq_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_ex_bioq_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_ex_bioq_por_valor($numero_paciente, 3, $ex->nome);
									} else if($i==5){
										$valor = buscar_teste_chagas_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_teste_chagas_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_teste_chagas_por_valor($numero_paciente, 3, $ex->nome);
									} else if($i==6){
										$valor = buscar_outros_param_por_valor($numero_paciente, 1, $ex->nome);
										$valor2 = buscar_outros_param_por_valor($numero_paciente, 2, $ex->nome);
										$valor3 = buscar_outros_param_por_valor($numero_paciente, 3, $ex->nome);
										$valor4 = buscar_outros_param_por_valor($numero_paciente, 4, $ex->nome);
										$valor5 = buscar_outros_param_por_valor($numero_paciente, 5, $ex->nome);
										$valor6 = buscar_outros_param_por_valor($numero_paciente, 6, $ex->nome);
									}
						?>
									<div class="span2 primeiro col">
										<h6><?php echo $ex->nome; ?></h6>
									</div>
						<?php	
									if($i == 6){
						?>				<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta1'; ?>" value="<?php echo $valor->valor; ?>">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta2'; ?>" value="<?php echo $valor2->valor; ?>">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id. 'coleta3'; ?>" value="<?php echo $valor3->valor; ?>">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id. 'coleta4'; ?>" value="<?php echo $valor4->valor; ?>">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta5'; ?>" value="<?php echo $valor5->valor; ?>">
										</div>	
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta6'; ?>" value="<?php echo $valor6->valor; ?>">
										</div>
						<?php
									} else {
										
						?>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id .'coleta1'; ?>" value="<?php echo $valor->valor; ?>">
										</div>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id . 'coleta2'; ?>" value="<?php echo $valor2->valor; ?>">
										</div>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id . 'coleta3'; ?>" value="<?php echo $valor3->valor; ?>">
										</div>
										<div class="span4 col">
											<input type="text" name="<?php echo $ex->id . 'obs'; ?>" value="<?php echo $valor->obs; ?>">
										</div>
						<?php
									}
								}
							} ?>
					</div>

					<div class="sessao row-fluid exames_clinicos2">
						<h5>Exames Clínicos</h5>
						<div class="row-fluid">
							<?php 
								$eletro =  buscar_exames_clinicos($numero_paciente, "Eletrocardiograma"); 
								$eletro_dados = buscar_exames_clinicos_todos($numero_paciente, "Eletrocardiograma");
								if($eletro->valor == 1){
									$check = "checked";
									$check2 = "";
								}else if($eletro->valor == 2){
									$check = "";
									$check2 = "checked";
								} else {
									$check = "";
									$check2 = "";
								}
							?>
							<div class="span3 primeiro col">
								<h6>Eletrocardiograma</h6>
								<div class="div_radio">
									<input type="radio" name="eletro" value="1" <?php echo $check; ?> >
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="eletro" value="2" <?php echo $check2; ?> >
									<p>(2) Anormal</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($eletro_dados);
								foreach ($eletro_dados as $e) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='eletro_date_".$i."' value='".$e->data."'>
											<input type='text' name='eletro_valor_".$i."' value='".$e->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($eletro_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='eletro_date_".$k."' value=''>
											<input type='text' name='eletro_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="eletro_obs" value="<?php echo $eletro->obs; ?>">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Ecocardiograma</h6>
								<?php 
									$eco =  buscar_exames_clinicos($numero_paciente, "Ecocardiograma");
									$eco_dados =  buscar_exames_clinicos_todos($numero_paciente, "Ecocardiograma");  
									if($eco->valor == 1){
										$check = "checked";
										$check2 = "";
									}else {
										$check = "";
										$check2 = "checked";
									}
								?>
								<div class="div_radio">
									<input type="radio" name="eco" value="1" <?php echo $check; ?> >
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="eco" value="2" <?php echo $check2; ?> >
									<p>(2) Anormal</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($eco_dados);
								foreach ($eco_dados as $e) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='eco_date_".$i."' value='".$e->data."'>
											<input type='text' name='eco_valor_".$i."' value='".$e->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($eco_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='eco_date_".$k."' value=''>
											<input type='text' name='eco_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="eco_obs" value="<?php echo $eco->obs; ?>">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Holter</h6>
								<?php 
									$holter =  buscar_exames_clinicos($numero_paciente, "Holter"); 
									$holter_dados =  buscar_exames_clinicos_todos($numero_paciente, "Holter");  
									if($eletro->valor == 1){
										$check = "checked";
										$check2 = "";
									}else {
										$check = "";
										$check2 = "checked";
									}
								?>
								<div class="div_radio">
									<input type="radio" name="holter" value="1" <?php echo $check; ?>>
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="holter" value="2" <?php echo $check2; ?>>
									<p>(2) Anormal</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($holter_dados);
								foreach ($holter_dados as $h) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='holter_date_".$i."' value='".$h->data."'>
											<input type='text' name='holter_valor_".$i."' value='".$h->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($holter_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='holter_date_".$k."' value=''>
											<input type='text' name='holter_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="holter_obs" value="<?php echo $holter->obs; ?>">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>RX Coração</h6>
								<?php 
									$rx_coracao =  buscar_exames_clinicos($numero_paciente, "RX Coração"); 
									$rx_coracao_dados =  buscar_exames_clinicos_todos($numero_paciente, "RX Coração"); 
									if($eletro->valor == 1){
										$check = "checked";
										$check2 = "";
									}else {
										$check = "";
										$check2 = "checked";
									}
								?>
								<div class="div_radio">
									<input type="radio" name="rx_coracao" value="1" <?php echo $check; ?> >
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="rx_coracao" value="2" <?php echo $check2; ?> >
									<p>(2) Dilatação</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($rx_coracao_dados);
								foreach ($rx_coracao_dados as $rx) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='rx_co_date_".$i."' value='".$rx->data."'>
											<input type='text' name='rx_co_valor_".$i."' value='".$rx->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($rx_coracao_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='rx_co_date_".$k."' value=''>
											<input type='text' name='rx_co_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="rx_co_obs" value="<?php echo $rx_coracao->obs; ?>">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>RX Esôfago</h6>
								<?php 
									$rx_esofago =  buscar_exames_clinicos($numero_paciente, "RX Esôfago"); 
									$rx_esofago_dados =  buscar_exames_clinicos_todos($numero_paciente, "RX Esôfago"); 
									if($rx_esofago->valor == 1){
										$check = "checked";
										$check2 = "";
									}else {
										$check = "";
										$check2 = "checked";
									}
								?>
								<div class="div_radio">
									<input type="radio" name="rx_esofago" value="1" <?php echo $check; ?> >
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="rx_esofago" value="2" <?php echo $check2; ?> >
									<p>(2) Dilatação</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($rx_esofago_dados);
								foreach ($rx_esofago_dados as $rx) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='rx_eso_date_".$i."' value='".$rx->data."'>
											<input type='text' name='rx_eso_valor_".$i."' value='".$rx->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($rx_esofago_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='rx_eso_date_".$k."' value=''>
											<input type='text' name='rx_eso_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="rx_eso_obs" value="<?php echo $rx_esofago->obs; ?>">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Enema Opaco</h6>
								<?php 
									$enema =  buscar_exames_clinicos($numero_paciente, "Enema Opaco"); 
									$enema_dados =  buscar_exames_clinicos_todos($numero_paciente, "Enema Opaco"); 
									if($enema->valor == 1){
										$check = "checked";
										$check2 = "";
									}else {
										$check = "";
										$check2 = "checked";
									}
								?>
								<div class="div_radio">
									<input type="radio" name="enema" value="1" <?php echo $check; ?> >
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="enema" value="2" <?php echo $check2; ?> >
									<p>(2) Dilatação</p>
								</div>
							</div>
							<?php 
								$i=1;
								$j=count($rx_esofago_dados);
								foreach ($rx_esofago_dados as $rx) {
									echo "<div class='span1 primeiro col'>
											<input type='date' name='enema_date_".$i."' value='".$rx->data."'>
											<input type='text' name='enema_valor_".$i."' value='".$rx->texto."'>
										</div>";
										$i++;
								}
								
								if($j < 5){
									for($k=count($rx_esofago_dados)+1; $k < 5; $k++){
										echo "<div class='span1 primeiro col'>
											<input type='date' name='enema_date_".$k."' value=''>
											<input type='text' name='enema_valor_".$k."' value=''>
										</div>";
									}
								}
							?>
							
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="enema_obs" value="<?php echo $enema->obs; ?>">
							</div>
						</div>
					</div>

					<div class="sessao row-fluid evolucao">
						<h5>Evolução do Paciente:</h5>
						<textarea name="evolucao_paciente" rows="10" cols="200"><?php echo $obj_paciente->evolucao; ?></textarea>
					</div>
					<input type="hidden" name="paciente" value="<?php echo $numero_paciente; ?>">

					<div class="botoesSumbit">		
						<div class="span5">
							<button type="submit" name="submit" class="btn btn-primary enviar">Salvar</button>
						</div>
						<div class="span5 text_align_right">
							<a href="javascript:void(0);"><i class="icon-imprimir edit_lista"></i></a>	
						</div>
					</div>
					
				</form>

				<?php	
					// print_r($results);	
					// } else {
					//     echo 'Voce nao esta logado!';
					// }
					?>
			</div>
		</div>
			
	</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>