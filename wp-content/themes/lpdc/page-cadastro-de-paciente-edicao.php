<?php 

if(isset($_GET['cod'])){
	$numero_paciente = $_GET['cod'];

	$obj_paciente = buscar_paciente_id($numero_paciente);
	$obj_atendimento = buscar_atendimento_id($numero_paciente);
	$obj_exames_clinicos = buscar_exames_clinicos_id($numero_paciente);
	$obj_funcao_hepatica = buscar_funcao_hepatica_id($numero_paciente);
	$obj_funcao_renal = buscar_funcao_renal_id($numero_paciente);
	$obj_habitos_vida = buscar_habitos_vida_id($numero_paciente);
	$obj_hemograma = buscar_hemograma_id($numero_paciente);
	$obj_med_que_utiliza = buscar_med_que_utiliza_id($numero_paciente);
	$obj_med_utilizados = buscar_med_utilizados_id($numero_paciente);
	$obj_outros_param = buscar_outros_param_id($numero_paciente);
	$obj_outro_ex_bioq = buscar_outro_ex_bioq_id($numero_paciente);
	$obj_problemas_saude = buscar_problemas_saude_id($numero_paciente);
	$obj_residencia = buscar_residencia_id($numero_paciente);
	// $obj_revisao_sistemas = buscar_revisao_sistemas_id($numero_paciente);
	$obj_uso_medicamento = buscar_uso_medicamento_id($numero_paciente);

} else {
	$numero_paciente = '';
}

if(isset($_POST['submit'])){
	// Inserir dados na tabela Paciente
	$table = 'paciente';
	
	// verifica se é série ou escolaridade
	if($_POST['serie'] != ""){
		$escolaridade = $_POST['escolaridade'];
	}else {
		$escolaridade = $_POST['serie'];
	}
	$data_paciente = array('num_paciente'=> $_POST['num_paciente'], 
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
		'qnt_comp_presc'=> $_POST['descoberta-doenca'],
		'dose_diaria'=> $_POST['descoberta-doenca'],
		'posologia'=> $_POST['descoberta-doenca'],
		'dose_total'=> $_POST['descoberta-doenca'],
		'evolucao'=> $_POST['evolucao_paciente']
	);

	$wpdb->insert( $table, $data_paciente, $format );



	// Inserir dados na tabela Atendimento
	// Saber qual atendimento está sendo cadastrado
	// chamar método que verifica o atendimento
	$table_atendimento = 'atendimento_paciente';
	
	if(isset($_POST['atendimento_1'])){
		foreach ($_POST['atendimento_1'] as $key => $value) { 
			$data_atendimento = array(
				'num_paciente'=> $_POST['num_paciente'],
				'atendimento'=> '1',
				'data'=> $_POST['data_atend'],
				'dados'=> $value
			);
			$wpdb->insert( $table_atendimento, $data_atendimento, $format );
		}
	}

	// Residencia
	$table_residencia = 'residencia';

	if($_POST['residiu'] == 'Não'){
		for($i=1; $i < 5; $i++){
			$periodo = 'periodo'. $i;
			if(isset($_POST[$periodo]) && $_POST[$periodo] != ''){
				$area = 'area'.$i;
				$cobertura = 'cobertura'. $i;
				$casa = 'tipo-casa' .$i;
				$peridomicilio = 'predomicilio'. $i;
				$animais = 'animais' . $i;
				$qnt = 'qnt-familiares' . $i;

				$data_residencia = array(
					'num_paciente'=> $_POST['num_paciente'],
					'periodo'=> $_POST[$periodo],
					'area'=> $_POST[$area],
					'tipo_cobertura'=> $_POST[$cobertura],
					'tipo_casa'=> $_POST[$casa],
					'peridomicilio'=> $_POST[$peridomicilio],
					'animais'=> $_POST[$animais],
					'qnt_familiares'=> $_POST[$qnt]
				);

				$wpdb->insert( $table_residencia, $data_residencia, $format );
			}
		}
	}

	// Problemas de saúde
	$table_problemas = 'problemas_saude';
	for ($i=1; $i < 7; $i++) { 
		$problema = 'problema'. $i;
		if(isset($_POST[$problema]) && $_POST[$problema] != ''){
			$problema_controlado = 'problema-controlado' . $i;
			$problema_data = 'problema-data' . $i;

			$data_problemas = array(
				'num_paciente'=> $_POST['num_paciente'],
				'problema'=> $_POST[$problema],
				'controlado'=> $_POST[$problema_controlado],
				'inicio'=> $_POST[$problema_data]
			);

			$wpdb->insert( $table_problemas, $data_problemas, $format );
		}
	}

	// Medicamentos Utilizados 
	$table_med_utilizados = 'med_utilizados';
	for ($i=1; $i < 5; $i++) { 
		$medicamento = 'medicamento'. $i;
		if(isset($_POST[$medicamento]) && $_POST[$medicamento] != ''){
			$indicacao = 'indicacao' . $i;
			$resposta = 'resposta'. $i;
			$periodo = 'periodo' . $i;
			$data_med_utilizados = array(
				'num_paciente'=> $_POST['num_paciente'],
				'medicamento'=> $_POST[$medicamento],
				'indicacao'=> $_POST[$indicacao],
				'resposta'=> $_POST[$resposta],
				'periodo'=> $_POST[$periodo]
			);

			$wpdb->insert( $table_med_utilizados, $data_med_utilizados, $format );
		}
	}

	// Medicamento que utiliza uso contínuo
	$table_med_que_utiliza = 'med_que_utiliza';
	for ($i=1; $i < 9; $i++) { 
		$medicamento = 'medicamento_uso'. $i;
		if(isset($_POST[$medicamento]) && $_POST[$medicamento] != ''){
			$posologia = 'posologia' . $i;
			$indicado = 'indicado'. $i;
			$indicacao_uso = 'indicacao_uso' . $i;
			$modo_uso = 'modo_uso' . $i;
			$resposta = 'resposta' . $i;
			$efeito_uso = 'efeito_uso' . $i;
			$inicio_uso = 'inicio_uso' . $i;

			$data_med_utilizados = array(
				'num_paciente'=> $_POST['num_paciente'],
				'medicamento'=> $_POST[$medicamento],
				'posologia'=> $_POST[$posologia],
				'indicado_por'=> $_POST[$indicado],
				'ind_uso'=> $_POST[$indicacao_uso],
				'modo_uso'=> $_POST[$modo_uso],
				'resposta'=> $_POST[$resposta],
				'efeitos'=> $_POST[$efeito_uso],
				'inicio'=> $_POST[$inicio_uso]
			);

			$wpdb->insert( $table_med_utilizados, $data_med_utilizados, $format );
		}
	}

	// REVISÃO DE SISTEMAS 
	$table_revisao_sistemas = 'revisao_sistemas';
	$total = total_sistemas();
	$sinais = "";
	for ($i=1; $i <= $total ; $i++) { 
		foreach ($_POST[$i] as $key => $value) {
			$sinais .= $value;
		}
		if($sinais != ""){
			$nome_sistema = revisao_de_sistemas_sistema($i);
			$data_sistemas = array(
				'num_paciente'=> $_POST['num_paciente'],
				'sistema_nome'=> $nome_sistema,
				'sintoma_nome'=> $sinais,
				'sistema_id'=> $i
			);

			$wpdb->insert( $table_revisao_sistemas, $data_sistemas, $format );
		}
	}

	// Hábitos de Vida
	// Fuma 
	$table_habitos_vida = 'habitos_vida';
	if($_POST['fuma'] == 'Sim'){
		$pratica_fuma = "Sim";
	}else {
		$pratica_fuma = "Não";
	}
	$data_habitos_vida_fuma = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Fuma?',
		'pratica_atual'=> $pratica_fuma,
		'frequencia'=> $_POST['frequencia_fuma'],
		'tempo_deixou'=> $_POST['qnt_tempo_fuma'],
		'motivo'=> $_POST['motivo_fuma']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_fuma, $format );
	
	// Toma café
	if($_POST['cafe'] == 'Sim'){
		$pratica_cafe = "Sim";
	}else {
		$pratica_cafe = "Não";
	}
	$data_habitos_vida_cafe = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Toma café?',
		'pratica_atual'=> $pratica_cafe,
		'frequencia'=> $_POST['frequencia_cafe'],
		'tempo_deixou'=> $_POST['qnt_tempo_cafe'],
		'motivo'=> $_POST['motivo_cafe']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_cafe, $format );

	// Ingere bebidas alcoólicas?
	if($_POST['bebida'] == 'Sim'){
		$pratica_bebe = "Sim";
	}else {
		$pratica_bebe = "Não";
	}
	$data_habitos_vida_bebe = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Ingere bebidas alcoólicas?',
		'pratica_atual'=> $pratica_cafe,
		'frequencia'=> $_POST['frequencia_bebe'],
		'tempo_deixou'=> $_POST['qnt_tempo_bebe'],
		'motivo'=> $_POST['motivo_bebe']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_bebe, $format );

	// Utiliza chás de plantas medicinais?
	if($_POST['cha'] == 'Sim'){
		$pratica_cha = "Sim";
	}else {
		$pratica_cha = "Não";
	}
	$data_habitos_vida_cha = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Utiliza chás de plantas medicinais?',
		'pratica_atual'=> $pratica_cha,
		'frequencia'=> $_POST['frequencia_cha'],
		'tempo_deixou'=> $_POST['qnt_tempo_cha'],
		'motivo'=> $_POST['motivo_cha'],
		'tipo_planta'=> $_POST['cha_tipo_planta'],
		'indicacao_planta'=> $_POST['cha_indicacao']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_cha, $format );

	// Pratica atividade física?
	if($_POST['atividade_fisica'] == 'Sim'){
		$pratica_atividade = "Sim";
	}else {
		$pratica_atividade = "Não";
	}
	$data_habitos_vida_atividade = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Pratica atividade física?',
		'pratica_atual'=> $pratica_atividade,
		'tipo_atividade'=> $_POST['tipo_ativiadade_fisica'],
		'frequencia'=> $_POST['ativ_fisica_freq']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_atividade, $format );
	
	// Você considera sua alimentação saudável?
	if($_POST['alimentacao'] == 'Sim'){
		$pratica_alimentacao = "Sim";
	}else {
		$pratica_alimentacao = "Não";
	}
	$data_habitos_vida_alimentacao = array(
		'num_paciente'=> $_POST['num_paciente'],
		'pratica'=> 'Você considera sua alimentação saudável?',
		'pratica_atual'=> $pratica_alimentacao,
		'tipo_alimentacao'=> $_POST['tipo_alimentacao'],
		'outros'=> $_POST['outros_alimentacao']
	);
	$wpdb->insert( $table_habitos_vida, $data_habitos_vida_alimentacao, $format );


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
			if($i < 4){
				// inserir na tabela de Hemograma
				$exames_hemograma = exames(1);
				foreach ($exames_hemograma as $key) {
					$data_hemograma = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_1'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_hemograma, $data_hemograma, $format );
				}

				// inserir na tabela de funcao Renal
				$exames_funcao_renal = exames(2);
				foreach ($exames_funcao_renal as $key) {
					$data_funcao_renal = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_2'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_funcao_renal, $data_funcao_renal, $format );
				}

				// inserir na tabela de funcao Renal
				$exames_funcao_hepatica = exames(3);
				foreach ($exames_funcao_hepatica as $key) {
					$data_funcao_hepatica = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_3'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_funcao_hepatica, $data_funcao_hepatica, $format );
				}

				// inserir na tabela de Outros exames bioquimicos
				$exames_outro_ex_bioq = exames(4);
				foreach ($exames_outro_ex_bioq as $key) {
					$data_outro_ex_bioq = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_4'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_outro_ex_bioq, $data_outro_ex_bioq, $format );
				}

				// inserir na tabela de Teste para Chagas
				$exames_teste_chagas = exames(5);
				foreach ($exames_teste_chagas as $key) {
					$data_teste_chagas = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_5'],
						'obs'=> $_POST[$key->id.'obs'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_teste_chagas, $data_teste_chagas, $format );
				}

				// inserir na tabela de Outros Parâmetros
				$exames_outros_param = exames(6);
				foreach ($exames_outros_param as $key) {
					$data_outros_param = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_6'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_outros_param, $data_outros_param, $format );
				}
			}

			if($i > 4){
				// inserir na tabela de Outros Parâmetros
				$exames_outros_param = exames(6);
				foreach ($exames_outros_param as $key) {
					$data_outros_param = array(
						'num_paciente'=> $_POST['num_paciente'],
						'nome'=> $key->nome,
						'coleta'=> $_POST['coleta'.$i.'_6'],
						'valor'=> $_POST[$key->id.'coleta'.$i]
					);
					$wpdb->insert( $table_outros_param, $data_outros_param, $format );
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
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
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
				'obs'=> $_POST['eletro_obs'],
				'valor'=> $_POST['eletro'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_eletro, $format );
		}
	}

	// Ecocardiograma 
	for($i=1; $i < 5; $i++){
		$date = 'eco_date_'.$i;
		$valor = 'eco_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
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
				'obs'=> $_POST['eco_obs'],
				'valor'=> $_POST['eco'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_eco, $format );
		}
	}

	// Holter 
	for($i=1; $i < 5; $i++){
		$date = 'holter_date_'.$i;
		$valor = 'holter_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
			if($_POST['holter'] == '1'){
				$tipo = 'Normal';
			}else{
				$tipo = 'Anormal';
			}

			$data_eco = array(
				'num_paciente'=> $_POST['num_paciente'],
				'nome'=> $tipo,
				'nome_exame'=> 'Holter',
				'data'=> $_POST[$date],
				'obs'=> $_POST['holter_obs'],
				'valor'=> $_POST['holter'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_eco, $format );
		}
	}

	// RX Coração 
	for($i=1; $i < 5; $i++){
		$date = 'rx_co_date_'.$i;
		$valor = 'rx_co_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
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
				'obs'=> $_POST['rx_co_obs'],
				'valor'=> $_POST['rx_coracao'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_rx_co, $format );
		}
	}

	// RX Esôfago 
	for($i=1; $i < 5; $i++){
		$date = 'rx_eso_date_'.$i;
		$valor = 'rx_eso_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
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
				'obs'=> $_POST['rx_eso_obs'],
				'valor'=> $_POST['rx_esofago'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_rx_eso, $format );
		}
	}

	// Enema Opaco
	for($i=1; $i < 5; $i++){
		$date = 'enema_date_'.$i;
		$valor = 'enema_valor_'.$i;
		if(isset($_POST[$date]) && $_POST[$date] != '0000-00-00'){
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
				'obs'=> $_POST['enema_obs'],
				'valor'=> $_POST['enema'],
				'texto' => $_POST[$valor]
			);

			$wpdb->insert( $table_exames_clinicos, $data_enema, $format );
		}
	}	

}

include "layout/header.php"; 
?>
		<div id="pagina2" class="cadastro-paciente">
			<header class="header_cadastro-paciente">
				<h1 class="font24 colorTextWhite open_semibold title_maior">Cadastro Paciente</h1>
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

							<div class="div_media">
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
								$check = buscar_atendimento_id($numero_paciente);
								$total_check = count($check);
								$array_atend = array();
								for($i=0; $i<$total_check; $i++){
									array_push($array_atend, $check[$i]->dados);
								}
								echo "<h6>1º Atendimento <input type='date' name='data_atend' value='". buscar_atendimento_id_data($numero_paciente) ."' required></h6>";
								foreach ($atendimento_1 as $key) {
									if(in_array($key->opcao, $array_atend)) {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_1[]' value='".$key->opcao."' checked=checked><span>" . $key->opcao . "</span></div>";
									} else {
										echo "<div class='opcao_check'><input type='checkbox' name='atendimento_1[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
									}
									
								}

							?>
							</div>

							<div class="divisao att2">
							<?php 
								$atendimento_2 = pegar_opcao_atendimento(2);
								echo "<h6>2º Atendimento</h6>";
								foreach ($atendimento_2 as $key) {
									echo "<div class='opcao_check'><input type='checkbox' name='atendimento_2[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
								}

							?>
							</div>

							<div class="divisao att3">
							<?php 
								$atendimento_3 = pegar_opcao_atendimento(3);
								echo "<h6>3º Atendimento</h6>";
								foreach ($atendimento_3 as $key) {
									echo "<div class='opcao_check'><input type='checkbox' name='atendimento_3[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
								}

							?>
							</div>

							<div class="divisao att4">
							<?php 
								$atendimento_4 = pegar_opcao_atendimento(4);
								echo "<h6>4º Atendimento</h6>";
								foreach ($atendimento_4 as $key) {
									echo "<div class='opcao_check'><input type='checkbox' name='atendimento_4[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
								}

							?>
							</div>

							<div class="divisao att5">
							<?php 
								$atendimento_5 = pegar_opcao_atendimento(1);
								echo "<h6>5º Atendimento</h6>";
								foreach ($atendimento_5 as $key) {
									echo "<div class='opcao_check'><input type='checkbox' name='atendimento_5[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
								}

							?>
							</div>

							<div class="divisao att6">
							<?php 
								$atendimento_6 = pegar_opcao_atendimento(1);
								echo "<h6>6º Atendimento</h6>";
								foreach ($atendimento_6 as $key) {
									echo "<div class='opcao_check'><input type='checkbox' name='atendimento_6[]' value='".$key->opcao."'><span>" . $key->opcao . "</span></div>";
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
						<div id="residencia1" class="residencia display_none">
							<fieldset class="residencias">
								<div class="div_full">
									<h6>RESIDÊNCIA 1</h6>
									<div>
										<div>
											<label>PERÍODO:</label>	
											<input type="text" name="periodo1" value="">
										</div>							
									</div>
									
									<div class="religiao">
										<label>Área:</label>	
										<div class="div_radio">
											<input type="radio" name="area1" value="Urbana">Urbana
										</div>
										<div class="div_radio">
											<input type="radio" name="area1" value="Rural">Rural
										</div>
									</div>
									<div class="religiao">
										<label>Tipo de Cobertura:</label>	
										<div class="div_radio">
											<input type="radio" name="cobertura1" value="Palha">Palha
										</div>
										<div class="div_radio">
											<input type="radio" name="cobertura1" value="Telha">Telha
										</div>
									</div>
								</div>
								<div class="div_full">
									<div class="div_maior religiao">
										<label>Tipo de casa:</label>
										<div class="div_radio">
											<input type="radio" name="tipo-casa1" value="Tijolo com reboco">Tijolo com reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa1" value="Tijolo sem reboco">Tijolo sem reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa1" value="Pau-à-pique e barro">Pau-à-pique e barro
										</div>
									</div>
									<div class="religiao">
										<label>Peridomicílio:</label>
										<div class="div_radio">
											<input type="radio" name="predomicilio1" value="Galinheiro">Galinheiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio1" value="Chiqueiro">Chiqueiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio" value="Currais">Currais
										</div>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<label>Animais domésticos:</label>
								<div class="div_media religiao">
									<div class="div_radio">
										<input type="radio" name="animais1" value="Cães">Cães
									</div>
									<div class="div_radio">
										<input type="radio" name="animais1" value="Gatos">Gatos
									</div>
									<div class="div_radio">
										<input type="radio" name="animais1" value="Pássaros">Pássaros
									</div>
								</div>
								<div class="div_media">
									Quantidade de familiares:
									<input type="text" name="qnt-familiares1" value="">
								</div>

							</fieldset>
							<a href="javascript:void(0);" id="resid2" class="btn btn-warning">Mais</a>
						</div>

						<div id="residencia2" class="residencia display_none">
							<fieldset class="residencias">
								<div class="div_full">
									<h6>RESIDÊNCIA 2</h6>
									<div>
										<div>
											<label>PERÍODO:</label>	
											<input type="text" name="periodo2" value="">
										</div>							
									</div>
									
									<div class="religiao">
										<label>Área:</label>	
										<div class="div_radio">
											<input type="radio" name="area2" value="Urbana">Urbana
										</div>
										<div class="div_radio">
											<input type="radio" name="area2" value="Rural">Rural
										</div>
									</div>
									<div class="religiao">
										<label>Tipo de Cobertura:</label>	
										<div class="div_radio">
											<input type="radio" name="cobertura2" value="Palha">Palha
										</div>
										<div class="div_radio">
											<input type="radio" name="cobertura2" value="Telha">Telha
										</div>
									</div>
								</div>
								<div class="div_full">
									<div class="div_maior religiao">
										<label>Tipo de casa:</label>
										<div class="div_radio">
											<input type="radio" name="tipo-casa2" value="Tijolo com reboco">Tijolo com reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa2" value="Tijolo sem reboco">Tijolo sem reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa2" value="Pau-à-pique e barro">Pau-à-pique e barro
										</div>
									</div>
									<div class="religiao">
										<label>Peridomicílio:</label>
										<div class="div_radio">
											<input type="radio" name="predomicilio2" value="Galinheiro">Galinheiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio2" value="Chiqueiro">Chiqueiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio2" value="Currais">Currais
										</div>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<label>Animais domésticos:</label>
								<div class="div_media religiao">
									<div class="div_radio">
										<input type="radio" name="animais2" value="Cães">Cães
									</div>
									<div class="div_radio">
										<input type="radio" name="animais2" value="Gatos">Gatos
									</div>
									<div class="div_radio">
										<input type="radio" name="animais2" value="Pássaros">Pássaros
									</div>
								</div>
								<div class="div_media">
									Quantidade de familiares:
									<input type="text" name="qnt-familiares2" value="">
								</div>
							</fieldset>
							<a href="javascript:void(0);" id="resid3" class="btn btn-warning">Mais</a>
						</div>

						<div id="residencia3" class="residencia display_none">
							<fieldset class="residencias">
								<div class="div_full">
									<h6>RESIDÊNCIA 3</h6>
									<div>
										<div>
											<label>PERÍODO:</label>	
											<input type="text" name="periodo3" value="">
										</div>							
									</div>
									
									<div class="religiao">
										<label>Área:</label>	
										<div class="div_radio">
											<input type="radio" name="area3" value="Urbana">Urbana
										</div>
										<div class="div_radio">
											<input type="radio" name="area3" value="Rural">Rural
										</div>
									</div>
									<div class="religiao">
										<label>Tipo de Cobertura:</label>	
										<div class="div_radio">
											<input type="radio" name="cobertura3" value="Palha">Palha
										</div>
										<div class="div_radio">
											<input type="radio" name="cobertura3" value="Telha">Telha
										</div>
									</div>
								</div>
								<div class="div_full">
									<div class="div_maior religiao">
										<label>Tipo de casa:</label>
										<div class="div_radio">
											<input type="radio" name="tipo-casa3" value="Tijolo com reboco">Tijolo com reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa3" value="Tijolo sem reboco">Tijolo sem reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa3" value="Pau-à-pique e barro">Pau-à-pique e barro
										</div>
									</div>
									<div class="religiao">
										<label>Peridomicílio:</label>
										<div class="div_radio">
											<input type="radio" name="predomicilio3" value="Galinheiro">Galinheiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio3" value="Chiqueiro">Chiqueiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio3" value="Currais">Currais
										</div>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<label>Animais domésticos:</label>
								<div class="div_media religiao">
									<div class="div_radio">
										<input type="radio" name="animais3" value="Cães">Cães
									</div>
									<div class="div_radio">
										<input type="radio" name="animais3" value="Gatos">Gatos
									</div>
									<div class="div_radio">
										<input type="radio" name="animais3" value="Pássaros">Pássaros
									</div>
								</div>
								<div class="div_media">
									Quantidade de familiares:
									<input type="text" name="qnt-familiares3" value="">
								</div>
							</fieldset>
							<a href="javascript:void(0);" id="resid4" class="btn btn-warning">Mais</a>
						</div>

						<div id="residencia4" class="residencia display_none">
							<fieldset class="residencias">
								<div class="div_full">
									<h6>RESIDÊNCIA 4</h6>
									<div>
										<div>
											<label>PERÍODO:</label>	
											<input type="text" name="periodo4" value="">
										</div>							
									</div>
									
									<div class="religiao">
										<label>Área:</label>	
										<div class="div_radio">
											<input type="radio" name="area4" value="Urbana">Urbana
										</div>
										<div class="div_radio">
											<input type="radio" name="area4" value="Rural">Rural
										</div>
									</div>
									<div class="religiao">
										<label>Tipo de Cobertura:</label>	
										<div class="div_radio">
											<input type="radio" name="cobertura4" value="Palha">Palha
										</div>
										<div class="div_radio">
											<input type="radio" name="cobertura4" value="Telha">Telha
										</div>
									</div>
								</div>
								<div class="div_full">
									<div class="div_maior religiao">
										<label>Tipo de casa:</label>
										<div class="div_radio">
											<input type="radio" name="tipo-casa4" value="Tijolo com reboco">Tijolo com reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa4" value="Tijolo sem reboco">Tijolo sem reboco
										</div>
										<div class="div_radio">
											<input type="radio" name="tipo-casa4" value="Pau-à-pique e barro">Pau-à-pique e barro
										</div>
									</div>
									<div class="religiao">
										<label>Peridomicílio:</label>
										<div class="div_radio">
											<input type="radio" name="predomicilio4" value="Galinheiro">Galinheiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio4" value="Chiqueiro">Chiqueiro
										</div>
										<div class="div_radio">
											<input type="radio" name="predomicilio4" value="Currais">Currais
										</div>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<label>Animais domésticos:</label>
								<div class="div_media religiao">
									<div class="div_radio">
										<input type="radio" name="animais4" value="Cães">Cães
									</div>
									<div class="div_radio">
										<input type="radio" name="animais4" value="Gatos">Gatos
									</div>
									<div class="div_radio">
										<input type="radio" name="animais4" value="Pássaros">Pássaros
									</div>
								</div>
								<div class="div_media">
									Quantidade de familiares:
									<input type="text" name="qnt-familiares4" value="">
								</div>
							</fieldset>
							
						</div>
					</div>

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

						<fieldset>
							<div class="centro">1.<input type="text" name="problema1" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado1" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problema-controlado1" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data1" value=""></div>
						</fieldset>
						<fieldset>
							<div class="centro">2.<input type="text" name="problema2" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado2" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problem-controlado2" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data2" value=""></div>
						</fieldset>
						<fieldset>
							<div class="centro">3.<input type="text" name="problema3" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado3" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problema-controlado3" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data3" value=""></div>
						</fieldset>
						<fieldset>
							<div class="centro">4.<input type="text" name="problema4" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado4" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problema-controlado4" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data4" value=""></div>
						</fieldset>
						<fieldset>
							<div class="centro">5.<input type="text" name="problema5" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado5" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problema-controlado5" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data5" value=""></div>
						</fieldset>
						<fieldset>
							<div class="centro">6.<input type="text" name="problema6" value=""></div>
							<div class="centro">
								<div class="div_radio">
									<input type="radio" name="problema-controlado6" value="Sim">Sim
								</div>
								<div class="div_radio">
									<input type="radio" name="problema-controlado6" value="Não">Não
								</div>
							</div>
							<div class="centro"><input type="text" name="problema-data6" value=""></div>
						</fieldset>
						
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
						<div class="span3 primeiro"><h6>Medicmentos</h6></div>
						<div class="span3"><h6>Indicação</h6></div>
						<div class="span3"><h6>Respostas</h6></div>
						<div class="span3"><h6>Período de uso</h6></div>
						<div class="linha">
							<div class="span3 primeiro">
								<input type="text" name="medicamento1" value="">
							</div>
							<div class="span3">
								<input type="text" name="indicacao1" value="">
							</div>
							<div class="span3">
								<input type="text" name="resposta1" value="">
							</div>
							<div class="span3">
								<input type="text" name="periodo1" value="" class="input_menor">
								<a href="javascript:void(0);" class="mais_medic2 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha dois">
							<div class="span3 primeiro">
								<input type="text" name="medicamento2" value="">
							</div>
							<div class="span3">
								<input type="text" name="indicacao2" value="">
							</div>
							<div class="span3">
								<input type="text" name="resposta2" value="">
							</div>
							<div class="span3">
								<input type="text" name="periodo2" value="" class="input_menor">
								<a href="javascript:void(0);" class="mais_medic3 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>

						<div class="linha tres">
							<div class="span3 primeiro">
								<input type="text" name="medicamento3" value="">
							</div>
							<div class="span3">
								<input type="text" name="indicacao3" value="">
							</div>
							<div class="span3">
								<input type="text" name="resposta3" value="">
							</div>
							<div class="span3">
								<input type="text" name="periodo3" value="" class="input_menor">
								<a href="javascript:void(0);" class="mais_medic4 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>

						<div class="linha quatro">
							<div class="span3 primeiro">
								<input type="text" name="medicamento4" value="">
							</div>
							<div class="span3">
								<input type="text" name="indicacao4" value="">
							</div>
							<div class="span3">
								<input type="text" name="resposta4" value="">
							</div>
							<div class="span3">
								<input type="text" name="periodo4" value="" class="input_menor">
							</div>
						</div>
					</div>

					<div class="sessao row-fluid medicamentos_uso">
						<h5>Medicamentos que utiliza (uso contínuo)</h5>
						<div class="linha">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso1" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia1" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado1" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso1" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso1" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta1" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso1" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso1" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso2 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha dois_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso2" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia2" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado2" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso2" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso2" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta2" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso2" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso2" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso3 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha tres_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso3" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia3" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado3" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso3" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso3" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta3" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso3" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso3" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso4 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha quatro_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso4" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia4" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado4" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso4" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso4" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta4" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso4" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso4" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso5 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha cinco_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso5" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia5" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado5" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso5" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso5" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta5" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso5" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso5" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso6 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha seis_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso6" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia6" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado6" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso6" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso6" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta6" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso6" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso6" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso7 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha sete_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso7" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia7" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado7" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso7" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso7" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta7" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso7" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso7" value="" class="input_menor">
								<a href="javascript:void(0);" class="medic_uso8 mais"><img src="<?php bloginfo('template_url'); ?>/img/mais.png"></a>
							</div>
						</div>
						<div class="linha oito_uso">
							<div class="span3 primeiro">
								<label>Medicamento</label>
								<input type="text" name="medicamento_uso8" value="">
							</div>
							<div class="span3">
								<label>Posologia</label>
								<input type="text" name="posologia8" value="">
							</div>
							<div class="span3">
								<label>Indicado por*</label>
								<input type="text" name="indicado8" value="">
							</div>
							<div class="span3">
								<label>Indicação de uso</label>
								<input type="text" name="indicacao_uso8" value="">
							</div>
							<div class="span3 primeiro">
								<label>Modo de uso</label>
								<input type="text" name="modo_uso8" value="">
							</div>
							<div class="span3">
								<label>Respostas</label>
								<input type="text" name="resposta8" value="">
							</div>
							<div class="span3">
								<label>Efeitos indesejáveis</label>
								<input type="text" name="efeito_uso8" value="">
							</div>
								<div class="span3">
								<label>Início</label>
								<input type="text" name="inicio_uso8" value="">
							</div>
						</div>
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
										$sinais = revisao_de_sistemas_sinais($i, $value='');
										foreach ($sinais as $sinal) {
											if($sinal->id == $value){
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
						<div class="span2 primeiro caixa">
							<div class="div_radio">
								<input type="radio" name="fuma" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="fuma" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs">Se fuma: Qual a frequência?</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_fuma" value="0-10 cigarros/dia">0-10 cigarros/dia
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_fuma" value="10-20 cigarros/dia">10-20 cigarros/dia
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_fuma" value="Acima de 20cigarros/dia">Acima de 20 cigarros/dia
							</div>

							<div class="div_2">
								Se já fumou: Há quanto tempo deixou de usar?
								<input type="text" name="qnt_tempo_fuma" value="">
								Motivo? <input type="text" name="motivo_fuma" value="">
							</div>
							
						</div>

						<div class="span2 primeiro caixa">
							<p><strong>Toma café?</strong></p>
						</div>
						<div class="span2 primeiro caixa">
							<div class="div_radio">
								<input type="radio" name="cafe" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="cafe" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs">Se toma café: Qual a frequência?</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_cafe" value="1 xícara/dia">1 xícara/dia
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_cafe" value="2-3 xícaras/dia">2-3 xícaras/dia
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_cafe" value="Acima de 6/dia">Acima de 6/dia
							</div>

							<div class="div_2">
								Se já tomava café: Há quanto tempo deixou de tomar?
								<input type="text" name="qnt_tempo_cafe" value="" class="input_menor">
								Motivo? <input type="text" name="motivo_cafe" value="" class="input_menor">
							</div>
						</div>

						<div class="span2 primeiro caixa2">
							<p><strong>Ingere bebidas alcoólicas?</strong></p>
						</div>
						<div class="span2 primeiro caixa2">
							<div class="div_radio">
								<input type="radio" name="bebida" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="bebida" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="">Se bebe: analisar possibilidade do paciente ser alcoólatra. Em média consome:</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_bebe" value="1 copo/semana">1 copo/semana
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_bebe" value="2-6 copos/semana">2-6 copos/semana
							</div>
							<div class="div_radio_obs">
								<input type="radio" name="frequencia_bebe" value="7-12 copos/semana">7-12 copos/semana
							</div>
							<br />
							<div class="div_2">
								Se bebia: Há quanto tempo deixou de beber?
								<input type="text" name="qnt_tempo_bebe" value="" class="input_menor">
								Motivo? <input type="text" name="motivo_bebe" value="" class="input_menor">
							</div>
						</div>

						<div class="span2 primeiro caixa3">
							<p><strong>Utiliza chás de plantas medicinais?</strong></p>
						</div>
						<div class="span2 primeiro caixa3">
							<div class="div_radio">
								<input type="radio" name="cha" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="cha" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="div_text_obs">Se sim qual a frequência?</div>
							<div class="div_radio_obs2">
								<input type="radio" name="frequencia_cha" value="1 xícara/dia">1 xícara/dia
							</div>
							<div class="div_radio_obs2">
								<input type="radio" name="frequencia_cha" value="2-3 xícaras/dia">2-3 xícaras/dia
							</div>
							<div class="div_radio_obs2">
								<input type="radio" name="frequencia_cha" value="4-6 xícaras/dia">4-6 xícaras/dia
							</div>
							<div class="div_radio_obs2">
								<input type="radio" name="frequencia_cha" value="Acima de 6/dia">Acima de 6/dia
							</div>
							<br />
							<div class="div_2">
								Tipo de planta que utiliza?	<input type="text" name="cha_tipo_planta" value="">
								Para qual indicação? <input type="text" name="cha_indicacao" value="">
							</div>
						</div>

						<div class="span2 primeiro caixa3">
							<p><strong>Pratica atividade física?</strong></p>
						</div>
						<div class="span2 primeiro caixa3">
							<div class="div_radio">
								<input type="radio" name="atividade_fisica" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="atividade_fisica" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="div_2">
								Tipo de prática que realiza?<input type="text" name="tipo_ativiadade_fisica" value="">
							</div>
							<div class="div_text_obs">Frequência:</div>
							<div class="div_radio_obs2">
								<input type="radio" name="ativ_fisica_freq" value="1-2x/semana">1-2x/semana
							</div>
							<div class="div_radio_obs2">
								<input type="radio" name="ativ_fisica_freq" value="3-4x/semana">3-4x/semana
							</div>
							<div class="div_radio_obs2">
								<input type="radio" name="ativ_fisica_freq" value="5-7x/semana">5-7x/semana
							</div>
						</div>

						<div class="span2 primeiro caixa4">
							<p><strong>Você considera sua alimentação saudável?</strong></p>
						</div>
						<div class="span2 primeiro caixa4">
							<div class="div_radio">
								<input type="radio" name="alimentacao" value="S">S
							</div>
							<div class="div_radio">
								<input type="radio" name="alimentacao" value="N">N
							</div>
						</div>
						<div class="span8 primeiro">
							<div class="">Tipo de alimentação:</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em massas">Rica em massas
							</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em frutas">Rica em frutas
							</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em carne vermelha">Rica em carne vermelha
							</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em verdura">Rica em verdura
							</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em carne branca">Rica em carne branca
							</div>
							<div class="div_check">
								<input type="checkbox" name="tipo_alimentacao" value="Rica em óleos e gorduras">Rica em óleos e gorduras
							</div>
							<div class="">
								Outros. Epecificar: <input type="text" name="outros_alimentacao" value="">
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
										<input type="date" name="coleta1_<?php echo $i; ?>" value="">
									</div>
									<div class="span1 col">
										<h6>2º COLETA</h6>
										<input type="date" name="coleta2_<?php echo $i; ?>" value="">
									</div>
									<div class="span1 col">
										<h6>3º COLETA</h6>
										<input type="date" name="coleta3_<?php echo $i; ?>" value="">
									</div>
									<div class="span1 col">
										<h6>4º COLETA</h6>
										<input type="date" name="coleta4_<?php echo $i; ?>" value="">
									</div>
									<div class="span1 col">
										<h6>5º COLETA</h6>
										<input type="date" name="coleta5_<?php echo $i; ?>" value="">
									</div>
									<div class="span1 col">
										<h6>6º COLETA</h6>
										<input type="date" name="coleta6_<?php echo $i; ?>" value="">
									</div>
							<?php 
								} else {
							?>
									<div class="span2 col">
										<h6>1º COLETA</h6>
										<input type="date" name="coleta1_<?php echo $i; ?>" value="">
									</div>
									<div class="span2 col">
										<h6>2º COLETA</h6>
										<input type="date" name="coleta2_<?php echo $i; ?>" value="">
									</div>
									<div class="span2 col">
										<h6>3º COLETA</h6>
										<input type="date" name="coleta3_<?php echo $i; ?>" value="">
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
						?>
									<div class="span2 primeiro col">
										<h6><?php echo $ex->nome; ?></h6>
									</div>
						<?php	
									if($i == 6){
						?>				<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta1'; ?>" value="">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta2'; ?>" value="">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id. 'coleta3'; ?>" value="">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id. 'coleta4'; ?>" value="">
										</div>
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta5'; ?>" value="">
										</div>	
										<div class="span1 col">
											<input type="text" name="<?php echo $ex->id . 'coleta6'; ?>" value="">
										</div>
						<?php
									} else {
						?>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id .'coleta1'; ?>" value="">
										</div>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id . 'coleta2'; ?>" value="">
										</div>
										<div class="span2 col">
											<input type="text" name="<?php echo $ex->id . 'coleta3'; ?>" value="">
										</div>
										<div class="span4 col">
											<input type="text" name="<?php echo $ex->id . 'obs'; ?>" value="">
										</div>
						<?php
									}
								}
							} ?>
					</div>

					<div class="sessao row-fluid exames_clinicos2">
						<h5>Exames Clínicos</h5>
						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Eletrocardiograma</h6>
								<div class="div_radio">
									<input type="radio" name="eletro" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="eletro" value="2">
									<p>(2) Anormal</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eletro_date_1" value="">
								<input type="text" name="eletro_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eletro_date_2" value="">
								<input type="text" name="eletro_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eletro_date_3" value="">
								<input type="text" name="eletro_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eletro_date_4" value="">
								<input type="text" name="eletro_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="eletro_obs" value="">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Ecocardiograma</h6>
								<div class="div_radio">
									<input type="radio" name="eco" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="eco" value="2">
									<p>(2) Anormal</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eco_date_1" value="">
								<input type="text" name="eco_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eco_date_2" value="">
								<input type="text" name="eco_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eco_date_3" value="">
								<input type="text" name="eco_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="eco_date_4" value="">
								<input type="text" name="eco_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="eco_obs" value="">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Holter</h6>
								<div class="div_radio">
									<input type="radio" name="holter" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="holter" value="2">
									<p>(2) Anormal</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="holter_date_1" value="">
								<input type="text" name="holter_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="holter_date_2" value="">
								<input type="text" name="holter_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="holter_date_3" value="">
								<input type="text" name="holter_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="holter_date_4" value="">
								<input type="text" name="holter_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="holter_obs" value="">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>RX Coração</h6>
								<div class="div_radio">
									<input type="radio" name="rx_coracao" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="rx_coracao" value="2">
									<p>(2) Dilatação</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_co_date_1" value="">
								<input type="text" name="rx_co_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_co_date_2" value="">
								<input type="text" name="rx_co_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_co_date_3" value="">
								<input type="text" name="rx_co_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_co_date_4" value="">
								<input type="text" name="rx_co_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="rx_co_obs" value="">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>RX Esôfago</h6>
								<div class="div_radio">
									<input type="radio" name="rx_esofago" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="rx_esofago" value="2">
									<p>(2) Dilatação</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_eso_date_1" value="">
								<input type="text" name="rx_eso_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_eso_date_2" value="">
								<input type="text" name="rx_eso_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_eso_date_3" value="">
								<input type="text" name="rx_eso_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="rx_eso_date_4" value="">
								<input type="text" name="rx_eso_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="rx_eso_obs" value="">
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3 primeiro col">
								<h6>Enema Opaco</h6>
								<div class="div_radio">
									<input type="radio" name="enema" value="1">
									<p>(1) Normal</p>
								</div>
								<div class="div_radio">
									<input type="radio" name="enema" value="2">
									<p>(2) Dilatação</p>
								</div>
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="enema_date_1" value="">
								<input type="text" name="enema_valor_1" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="enema_date_2" value="">
								<input type="text" name="enema_valor_2" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="enema_date_3" value="">
								<input type="text" name="enema_valor_3" value="">
							</div>
							<div class="span1 primeiro col">
								<input type="date" name="enema_date_4" value="">
								<input type="text" name="enema_valor_4" value="">
							</div>
							<div class="span5 primeiro col">
								<h6>Observações</h6>
								<input type="text" name="enema_obs" value="">
							</div>
						</div>
					</div>

					<div class="sessao row-fluid evolucao">
						<h5>Evolução do Paciente:</h5>
						<textarea name="evolucao_paciente" rows="10" cols="200"><?php echo $obj_paciente->evolucao; ?></textarea>
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