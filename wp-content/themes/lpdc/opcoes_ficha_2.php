<?php 
// Ficha dois
function pergunta_aderencia(){
	global $wpdb;
	return $wpdb->get_results('SELECT * FROM pergunta_aderencia');
}

// Busca de pacientes 
function buscar_paciente($n_paciente="", $prontuario="", $pesquisador="", $nome=""){
	global $wpdb;

	if($n_paciente != ""){
		$filtro_1 = " AND num_paciente like '%" . $n_paciente  . "%'";
	}else {
		$filtro_1 =  "";
	}

	if($prontuario != ""){
		$filtro_2 = " AND num_prontuario like '%" . $prontuario  . "%'";
	}else {
		$filtro_2 =  "";
	}

	if($pesquisador != ""){
		$filtro_3 = " AND pesquisador like '%" . $pesquisador . "%'";
	}else {
		$filtro_3 =  "";
	}

	return $wpdb->get_results("SELECT * FROM paciente WHERE nome like '%" . $nome . "%'" . $filtro_1 . $filtro_2. $filtro_3);	
}

function buscar_paciente_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM paciente WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_atendimento_id($num_paciente, $atendimento){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM atendimento_paciente WHERE num_paciente='. $num_paciente . " AND atendimento = " . $atendimento);
	return $tipo; 
}

function buscar_atendimento_id_data($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM atendimento_paciente WHERE num_paciente='. $num_paciente);
	return $tipo->data; 
}

function buscar_exames_clinicos_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM exames_clinicos WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_funcao_hepatica_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM funcao_hepatica WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_funcao_renal_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM funcao_renal WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_habitos_vida_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM habitos_vida WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_hemograma_id($num_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM hemograma WHERE num_paciente=". $num_paciente . " AND tipo = ". $tipo . " AND nome like '%".$nome."%'");
	return $tipo; 
}

function buscar_hemograma_id_data($numero_paciente, $tipo){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM hemograma WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_hemograma_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM hemograma WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_funcao_renal_id_data($numero_paciente, $tipo) {
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM funcao_renal WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_funcao_renal_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM funcao_renal WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_funcao_hepatica_id_data($numero_paciente, $tipo) {
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM funcao_hepatica WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_funcao_hepatica_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM funcao_hepatica WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_ex_bioq_id_data($numero_paciente, $tipo) {
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM outro_ex_bioq WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_ex_bioq_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM outro_ex_bioq WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_teste_chagas_id_data($numero_paciente, $tipo) {
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM teste_chagas WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_teste_chagas_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM teste_chagas WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_outros_param_id_data($numero_paciente, $tipo) {
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM outros_param WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo );
	return $tipo; 
}

function buscar_outros_param_por_valor($numero_paciente, $tipo, $nome){
	global $wpdb;
	$tipo = $wpdb->get_row("SELECT * FROM outros_param WHERE num_paciente=". $numero_paciente . " AND tipo = ". $tipo . " AND nome like '%" .$nome. "%'");
	return $tipo; 
}

function buscar_med_que_utiliza_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM med_que_utiliza WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_med_utilizados_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM med_utilizados WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_outros_param_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM outros_param WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_outro_ex_bioq_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM outro_ex_bioq WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_problemas_saude_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM problemas_saude WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_residencia_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM residencia WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_revisao_sistemas_id($num_paciente, $id_sistema){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM revisao_sistemas_sintoma WHERE num_paciente='. $num_paciente . ' AND id_sistema = ' . $id_sistema);
	return $tipo; 
}

function buscar_habitos_de_vida($num_paciente, $pratica){
	global $wpdb;
	$habitos = $wpdb->get_row("SELECT * FROM habitos_vida WHERE num_paciente=". $num_paciente . " AND pratica like '%" . $pratica . "%'");
	return $habitos;
}

function buscar_exames_clinicos($num_paciente, $nome_exame){
	global $wpdb;
	$exames = $wpdb->get_row("SELECT * FROM exames_clinicos WHERE num_paciente=". $num_paciente . " AND nome_exame like '%" . $nome_exame . "%'");
	return $exames;
}

function buscar_exames_clinicos_todos($num_paciente, $nome_exame){
	global $wpdb;
	$exames = $wpdb->get_results("SELECT * FROM exames_clinicos WHERE num_paciente=". $num_paciente . " AND nome_exame like '%" . $nome_exame . "%' ORDER BY data ASC");
	return $exames;
}


function buscar_paciente_ficha_2($num_paciente, $id_ficha){
	global $wpdb;
	$paciente = $wpdb->get_row('SELECT * FROM paciente_ficha_2 WHERE num_paciente='. $num_paciente . ' AND id = '.$id_ficha );
	return $paciente; 
}

function buscar_pergunta_avaliacao_aderencia($num_paciente, $id_pergunta, $id_ficha){
	global $wpdb;
	$avalicao = $wpdb->get_row('SELECT * FROM avaliacao_aderencia WHERE num_paciente='. $num_paciente . ' AND id_pergunta = '.$id_pergunta.' AND id_ficha_2 = '.$id_ficha );
	return $avalicao; 
}

function buscar_aderencia_porque($num_paciente, $id_ficha){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM avaliacao_aderencia_porque WHERE num_paciente='. $num_paciente .' AND id_ficha_2 = '.$id_ficha );
	return $tipo; 
}

function buscar_pergunta_reacao_indesejavel($num_paciente, $id_ficha){
	global $wpdb;
	$reacao = $wpdb->get_row('SELECT * FROM reacoes_indesejaveis WHERE num_paciente='. $num_paciente . ' AND id_ficha_2 = '.$id_ficha );
	return $reacao; 
}

function buscar_reacoes_ram($num_paciente, $id_ficha){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM reacoes_indesejaveis_ram WHERE num_paciente='. $num_paciente .' AND id_ficha_2 = '.$id_ficha );
	return $tipo; 
}

function buscar_uso_medicamento_id($num_paciente,  $id_ficha){
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM uso_medicamento WHERE num_paciente='. $num_paciente . ' AND id_ficha_2 = '.  $id_ficha);
	return $tipo; 
}

function buscar_total_porcentagem_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM total_porcentagem WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_aderencia_porque_id($num_paciente, $id_ficha){
	global $wpdb;
	$porque = $wpdb->get_results('SELECT * FROM avaliacao_aderencia_porque WHERE num_paciente='. $num_paciente. ' AND id_ficha_2 ='.$id_ficha);
	return $porque; 
}

function atualizar_aderencia_porque($num_paciente, $count_array, $array_valores, $id_ficha){
	global $wpdb;

	$table = 'avaliacao_aderencia_porque';
	
	//  Verifica se a quantidade do Array é menor, maior ou igual
	$aderencia_porque_banco = buscar_aderencia_porque_id($num_paciente, $id_ficha);
	$total_result_banco = count($aderencia_porque_banco);
	$array_ids_banco = array();
	
	// Where
	$where = array('num_paciente'=> $num_paciente, 'id_ficha_2'=> $id_ficha); 
	// pegar ids da consulta e colocar em um array
	foreach ($aderencia_porque_banco as $key) {
		array_push($array_ids_banco, $key->id);	
	}

	// verifica se a quantidade do banco é menor que a editada na tela
	if($total_result_banco < $count_array){
		$j = 1;
		for($i=0; $i < $count_array; $i++){

			// o if irá verificar se o contador é menor ou igual com a quantidade
			// passada na tela para que seja possível fazer a atualização para os
			// ids que já existem no banco
			// Quando essa quantidade for maior será feita uma inserção
			if($j<=$total_result_banco){
				
				$where = array('num_paciente'=> $num_paciente, 'id'=> $array_ids_banco[$i]); 
				// $array de valores deve ser distribuido
				$data_valores = array('item'=>$array_valores[$i]);
				$wpdb->update( $table, $data_valores, $where, $format = null, $where_format = null );
				
			} 
			else {
				$array_dados = array(
					'num_paciente'=> $num_paciente,
					'item'=> $array_valores[$i],
					'id_ficha_2'=> $id_ficha
					);
				$wpdb->insert( $table, $array_dados, $format);
			}
				$j++;
			
		}
	}
	else if($total_result_banco > $count_array){
		// verifica se a quantidade do banco é maior que a editada na tela
		$j = 1;
		for($i=0; $i < $total_result_banco; $i++){
			// o if irá verificar se o contador é maior ou igual com a quantidade
			// passada pelo banco para que seja possível fazer a atualização para os
			// ids que já existem no banco
			// Quando essa quantidade for maior será feita uma deleção
			if($j<=$count_array){
				$data_valores = array('item'=>$array_valores[$i]);
				$where = array('num_paciente'=> $num_paciente, 'id'=> $array_ids_banco[$i]); 
				$wpdb->update( $table, $data_valores, $where, $format = null, $where_format = null );
			} else {
				$where = array('id'=> $array_ids_banco[$i]);
				$wpdb->delete( $table, $where, $where_format = null);
			}

			$j++;
		}
	} 
	else {
		// se a quantidade do banco for igual a que é passada pela tela
		// será feita apenas um update
		for($i=0; $i < $total_result_banco; $i++){
			$where = array('num_paciente'=> $num_paciente, 'id'=> $array_ids_banco[$i]); 
			$data_valores = array('item'=>$array_valores[$i]);
			$wpdb->update( $table, $data_valores, $where, $format = null, $where_format = null );
		}
	}
}

?>