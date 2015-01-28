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