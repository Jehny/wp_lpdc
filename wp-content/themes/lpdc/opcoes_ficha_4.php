<?php
function buscar_paciente_ficha_4($num_paciente=""){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM paciente_ficha_4 WHERE num_paciente=" . $num_paciente);	
}

function buscar_perguntas_ficha_4($num_paciente, $id_ficha, $pergunta){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM ficha_4_perguntas WHERE num_paciente=" . $num_paciente . " AND id_ficha_4 = ". $id_ficha . " AND num_pergunta = ".$pergunta);
}
	
?>