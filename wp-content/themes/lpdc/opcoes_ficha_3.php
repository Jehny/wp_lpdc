<?php 
// Métodos ficha 3
function buscar_paciente_ficha_3($num_paciente="", $id_ficha_3=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM paciente_ficha_3 WHERE num_paciente=" . $num_paciente . " AND id = ". $id_ficha_3);	
}

function buscar_pergunta_ficha_3 ($num_paciente="", $id_ficha="", $num_pergunta=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM ficha_3_perguntas WHERE num_paciente=" . $num_paciente . " AND id_ficha_3=". $id_ficha . " AND num_pergunta=" . $num_pergunta);
}

function buscar_avaliacao_ficha_3($num_paciente="", $id_ficha="", $avalicao=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM ficha_3_avaliacao WHERE num_paciente=" . $num_paciente . " AND id_ficha_3=". $id_ficha . " AND avaliacao like '%" . $avalicao . "%'");
}

function listar_opcoes_ficha_3_pergunta_1($value){
	
	if($value==1){
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='1' checked><span class='radio-label'>(1) Excelente</span>
				<input type='hidden' name='resposta_1_1' value='(1) Excelente'>
			</div>";
	}else {
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='1'><span class='radio-label'>(1) Excelente</span>
				<input type='hidden' name='resposta_1_1' value='(1) Excelente'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='2' checked><span class='radio-label'>(2) Muito Boa</span>
				<input type='hidden' name='resposta_1_2' value='(2) Muito Boa'>
			</div>";
	}else {
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='2'><span class='radio-label'>(2) Muito Boa</span>
				<input type='hidden' name='resposta_1_2' value='(2) Muito Boa'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='3' checked><span class='radio-label'>(3) Boa</span>
				<input type='hidden' name='resposta_1_3' value='(3) Boa'>
			</div>";
	}else {
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='3'><span class='radio-label'>(3) Boa</span>
				<input type='hidden' name='resposta_1_3' value='(3) Boa'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='4' checked><span class='radio-label'>(4) Ruim</span>
				<input type='hidden' name='resposta_1_4' value='(4) Ruim'>
			</div>";
	}else {
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='4'><span class='radio-label'>(4) Ruim</span>
				<input type='hidden' name='resposta_1_4' value='(4) Ruim'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='5' checked><span class='radio-label'>(5) Muito Ruim</span>
				<input type='hidden' name='resposta_1_5' value='(5) Muito Ruim'>
			</div>";
	}else {
		echo "<div class='radio-div span2 no_marging_left'>
				<input type='radio' name='resposta_1' value='5'><span class='radio-label'>(5) Muito Ruim</span>
				<input type='hidden' name='resposta_1_5' value='(5) Muito Ruim'>
			</div>";
	}
}

function listar_opcoes_ficha_3_pergunta_2($value){
	if($value==1){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='1' checked><span class='radio-label'>(1) Muito melhor agora do que a um ano atrás.</span>
				<input type='hidden' name='resposta_2_1' value='(1) Muito melhor agora do que a um ano atrás.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='1'><span class='radio-label'>(1) Muito melhor agora do que a um ano atrás</span>
				<input type='hidden' name='resposta_2_1' value='(1) Muito melhor agora do que a um ano atrás.'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='2' checked><span class='radio-label'>(2) Um pouco melhor agora do que a um ano atrás.</span>
				<input type='hidden' name='resposta_2_2' value='(2) Um pouco melhor agora do que a um ano atrás.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='2'><span class='radio-label'>(2) Um pouco melhor agora do que a um ano atrás.</span>
				<input type='hidden' name='resposta_2_2' value='(2) Um pouco melhor agora do que a um ano atrás.'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='3' checked><span class='radio-label'>(3) Quase a mesma de um ano atrás.</span>
				<input type='hidden' name='resposta_2_3' value='(3) Quase a mesma de um ano atrás.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='3'><span class='radio-label'>(3) Quase a mesma de um ano atrás.</span>
				<input type='hidden' name='resposta_2_3' value='(3) Quase a mesma de um ano atrás.'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='4' checked><span class='radio-label'>(4) Um pouco pior agora do que um ano atrás.</span>
				<input type='hidden' name='resposta_2_4' value='(4) Um pouco pior agora do que um ano atrás.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='4'><span class='radio-label'>(4) Um pouco pior agora do que um ano atrás.</span>
				<input type='hidden' name='resposta_2_4' value='(4) Um pouco pior agora do que um ano atrás.'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='5' checked><span class='radio-label'>(5) Muito pior agora do que um ano atrás.</span>
				<input type='hidden' name='resposta_2_5' value='(5) Muito pior agora do que um ano atrás.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_2' value='5'><span class='radio-label'>(5) Muito pior agora do que um ano atrás.</span>
				<input type='hidden' name='resposta_2_5' value='(5) Muito pior agora do que um ano atrás.'>
			</div>";
	}
}

function listar_opcoes_ficha_3_pergunta_6($value){
	if($value==1){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='1' checked><span class='radio-label'>(1) De forma alguma.</span>
				<input type='hidden' name='resposta_6_1' value='(1) De forma alguma.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='1'><span class='radio-label'>(1) De forma alguma.</span>
				<input type='hidden' name='resposta_6_1' value='(1) De forma alguma.'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='2' checked><span class='radio-label'>(2) Ligeiramente.</span>
				<input type='hidden' name='resposta_6_2' value='(2) Ligeiramente.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='2'><span class='radio-label'>(2) Ligeiramente.</span>
				<input type='hidden' name='resposta_6_2' value='(2) Ligeiramente.'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='3' checked><span class='radio-label'>(3) Moderadamente.</span>
				<input type='hidden' name='resposta_6_3' value='(3) Moderadamente.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='3'><span class='radio-label'>(3) Moderadamente.</span>
				<input type='hidden' name='resposta_6_3' value='(3) Moderadamente.'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='4' checked><span class='radio-label'>(4) Bastante.</span>
				<input type='hidden' name='resposta_6_4' value='(4) Bastante.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='4'><span class='radio-label'>(4) Bastante.</span>
				<input type='hidden' name='resposta_6_4' value='(4) Bastante.'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='5' checked><span class='radio-label'>(5) Extremamente.</span>
				<input type='hidden' name='resposta_6_5' value='(5) Extremamente.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_6' value='5'><span class='radio-label'>(5) Extremamente.</span>
				<input type='hidden' name='resposta_6_5' value='(5) Extremamente.'>
			</div>";
	}
}

function listar_opcoes_ficha_3_pergunta_7($value){
	if($value==1){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='1' checked><span class='radio-label'>(1) Nenhuma.</span>
				<input type='hidden' name='resposta_7_1' value='(1) Nenhuma.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='1'><span class='radio-label'>(1) Nenhuma.</span>
				<input type='hidden' name='resposta_7_1' value='(1) Nenhuma.'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='2' checked><span class='radio-label'>(2) Muito Leve.</span>
				<input type='hidden' name='resposta_7_2' value='(2) Muito Leve.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='2'><span class='radio-label'>(2) Muito Leve.</span>
				<input type='hidden' name='resposta_7_2' value='(2) Muito Leve.'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='3' checked><span class='radio-label'>(3) Leve.</span>
				<input type='hidden' name='resposta_7_3' value='(3) Leve.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='3'><span class='radio-label'>(3) Leve.</span>
				<input type='hidden' name='resposta_7_3' value='(3) Leve.'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='4' checked><span class='radio-label'>(4) Moderada.</span>
				<input type='hidden' name='resposta_7_4' value='(4) Moderada.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='4'><span class='radio-label'>(4) Moderada.</span>
				<input type='hidden' name='resposta_7_4' value='(4) Moderada.'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='5' checked><span class='radio-label'>(5) Grave.</span>
				<input type='hidden' name='resposta_7_5' value='(5) Grave.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='5'><span class='radio-label'>(5) Grave.</span>
				<input type='hidden' name='resposta_7_5' value='(5) Grave.'>
			</div>";
	}

	if($value==6){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='6' checked><span class='radio-label'>(6) Muito Grave.</span>
				<input type='hidden' name='resposta_7_6' value='(6) Muito Grave.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_7' value='6'><span class='radio-label'>(6) Muito Grave.</span>
				<input type='hidden' name='resposta_7_6' value='(6) Muito Grave.'>
			</div>";
	}
}

function listar_opcoes_ficha_3_pergunta_8($value){
	if($value==1){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='1' checked><span class='radio-label'>(1) De maneira alguma.</span>
				<input type='hidden' name='resposta_8_1' value='(1) De maneira alguma.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='1'><span class='radio-label'>(1) De maneira alguma.</span>
				<input type='hidden' name='resposta_8_1' value='(1) De maneira alguma.'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='2' checked><span class='radio-label'>(2) Um pouco.</span>
				<input type='hidden' name='resposta_8_2' value='(2) Um pouco.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='2'><span class='radio-label'>(2) Um pouco.</span>
				<input type='hidden' name='resposta_8_2' value='(2) Um pouco.'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='3' checked><span class='radio-label'>(3) Moderadamente.</span>
				<input type='hidden' name='resposta_8_3' value='(3) Moderadamente.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='3'><span class='radio-label'>(3) Moderadamente.</span>
				<input type='hidden' name='resposta_8_3' value='(3) Moderadamente.'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='4' checked><span class='radio-label'>(4) Bastante.</span>
				<input type='hidden' name='resposta_8_4' value='(4) Bastante.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='4'><span class='radio-label'>(4) Bastante.</span>
				<input type='hidden' name='resposta_8_4' value='(4) Bastante.'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='5' checked><span class='radio-label'>(5) Extremamente.</span>
				<input type='hidden' name='resposta_8_5' value='(5) Extremamente.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_8' value='5'><span class='radio-label'>(5) Extremamente.</span>
				<input type='hidden' name='resposta_8_5' value='(5) Extremamente.'>
			</div>";
	}
}

function listar_opcoes_ficha_3_pergunta_10($value){
	if($value==1){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='1' checked><span class='radio-label'>(1) Todo o tempo.</span>
				<input type='hidden' name='resposta_10_1' value='(1) Todo o tempo.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='1'><span class='radio-label'>(1) Todo o tempo.</span>
				<input type='hidden' name='resposta_10_1' value='(1) Todo o tempo.'>
			</div>";
	}

	if($value==2){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='2' checked><span class='radio-label'>(2) A maior parte do tempo.</span>
				<input type='hidden' name='resposta_10_2' value='(2) A maior parte do tempo.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='2'><span class='radio-label'>(2) A maior parte do tempo.</span>
				<input type='hidden' name='resposta_10_2' value='(2) A maior parte do tempo.'>
			</div>";
	}

	if($value==3){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='3' checked><span class='radio-label'>(3) Alguma parte do tempo.</span>
				<input type='hidden' name='resposta_10_3' value='(3) Alguma parte do tempo.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='3'><span class='radio-label'>(3) Alguma parte do tempo.</span>
				<input type='hidden' name='resposta_10_3' value='(3) Alguma parte do tempo.'>
			</div>";
	}

	if($value==4){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='4' checked><span class='radio-label'>(4) Uma pequena parte do tempo.</span>
				<input type='hidden' name='resposta_10_4' value='(4) Uma pequena parte do tempo.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='4'><span class='radio-label'>(4) Uma pequena parte do tempo.</span>
				<input type='hidden' name='resposta_10_4' value='(4) Uma pequena parte do tempo.'>
			</div>";
	}

	if($value==5){
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='5' checked><span class='radio-label'>(5) Nenhuma parte do tempo.</span>
				<input type='hidden' name='resposta_10_5' value='(5) Nenhuma parte do tempo.'>
			</div>";
	}else {
		echo "<div class='radio-div'>
				<input type='radio' name='resposta_10' value='5'><span class='radio-label'>(5) Nenhuma parte do tempo.</span>
				<input type='hidden' name='resposta_10_5' value='(5) Nenhuma parte do tempo.'>
			</div>";
	}
}

function buscar_pergunta_ficha_3_por_atividade($num_paciente="", $id_ficha="", $atividade=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM ficha_3_atividades WHERE num_paciente=" . $num_paciente . " AND id_ficha_3=". $id_ficha . " AND atividade like '%" . $atividade. "%'");
}

function listar_opcoes_ficha_3_pergunta_3($value, $grau){
	if($value == 1){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='1' checked><span class='radio-label'>1</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='1'><span class='radio-label'>1</span>
				</div>
			</td>";
	}

	if($value == 2){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='2' checked><span class='radio-label'>2</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='2'><span class='radio-label'>2</span>
				</div>
			</td>";
	}

	if($value == 3){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='3' checked><span class='radio-label'>3</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='grau_dificuldade_".$grau."' value='3'><span class='radio-label'>3</span>
				</div>
			</td>";
	}
}

function buscar_pergunta_ficha_3_por_item($num_paciente="", $id_ficha="", $tabela="", $item=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM ".$tabela." WHERE num_paciente=" . $num_paciente . " AND id_ficha_3=". $id_ficha . " AND item like '%" . $item. "%'");
}

function listar_opcoes_ficha_3_pergunta_4($value, $grau){
	if($value == 1){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_fisica_".$grau."' value='1' checked><span class='radio-label'>SIM</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_fisica_".$grau."' value='1'><span class='radio-label'>SIM</span>
				</div>
			</td>";
	}

	if($value == 2){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_fisica_".$grau."' value='2' checked><span class='radio-label'>NÃO</span>
					
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_fisica_".$grau."' value='2'><span class='radio-label'>NÃO</span>
				</div>
			</td>";
	}
}


function listar_opcoes_ficha_3_pergunta_5($value, $grau){
	if($value == 1){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_diaria_".$grau."' value='1' checked><span class='radio-label'>SIM</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_diaria_".$grau."' value='1'><span class='radio-label'>SIM</span>
				</div>
			</td>";
	}

	if($value == 2){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_diaria_".$grau."' value='2' checked><span class='radio-label'>NÃO</span>
					
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='saude_diaria_".$grau."' value='2'><span class='radio-label'>NÃO</span>
				</div>
			</td>";
	}
}

function listar_opcoes_ficha_3_pergunta_9($value, $grau){
	if($value == 1){
		echo "<td>
			<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='1' checked><span class='radio-label'>1</span>
				</div>
			</td>";
	} else {
		echo "<td>
			<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='1'><span class='radio-label'>1</span>
				</div>
			</td>";
	}

	if($value == 2){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='2' checked><span class='radio-label'>2</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='2'><span class='radio-label'>2</span>
				</div>
			</td>";
	}

	if($value == 3){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='3' checked><span class='radio-label'>3</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='3'><span class='radio-label'>3</span>
				</div>
			</td>";
	}

	if($value == 4){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='4' checked><span class='radio-label'>4</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='4'><span class='radio-label'>4</span>
				</div>
			</td>";
	}

	if($value == 5){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='5' checked><span class='radio-label'>5</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='5'><span class='radio-label'>5</span>
				</div>
			</td>";
	}

	if($value == 6){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='6' checked><span class='radio-label'>6</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_9_".$grau."' value='6'><span class='radio-label'>6</span>
				</div>
			</td>";
	}
}

function listar_opcoes_ficha_3_pergunta_11($value, $grau){
	if($value == 1){
		echo "<td>
			<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='1' checked><span class='radio-label'>1</span>
				</div>
			</td>";
	} else {
		echo "<td>
			<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='1'><span class='radio-label'>1</span>
				</div>
			</td>";
	}

	if($value == 2){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='2' checked><span class='radio-label'>2</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='2'><span class='radio-label'>2</span>
				</div>
			</td>";
	}

	if($value == 3){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='3' checked><span class='radio-label'>3</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='3'><span class='radio-label'>3</span>
				</div>
			</td>";
	}

	if($value == 4){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='4' checked><span class='radio-label'>4</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='4'><span class='radio-label'>4</span>
				</div>
			</td>";
	}

	if($value == 5){
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='5' checked><span class='radio-label'>5</span>
				</div>
			</td>";
	} else {
		echo "<td>
				<div class='radio-div'>
					<input type='radio' name='pergunta_11_".$grau."' value='5'><span class='radio-label'>5</span>
				</div>
			</td>";
	}
}

?>