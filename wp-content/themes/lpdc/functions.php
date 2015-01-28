<?php

register_nav_menu( 'main-menu', __( 'Main Menu' ) );

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'banners_post_type' );

add_post_type_support('banners', 'thumbnail');

function banners_post_type() {
	register_post_type( 'banners',
			array(
					'labels' => array(
							'name' => __( 'Banners' ),
							'singular_name' => __( 'Banner' )
					),
					'public' => true,
					'has_archive' => true,
			)
	);
}

// Custom WordPress Login Logo
function my_login_logo() { ?>
	<style>
	   body.login div#login h1 a {
	        background: url('wp-content/themes/lpdc/img/logo_login.png')no-repeat;
	        height: 70px;
	        width: 323px;
	        
	   }
 	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//Link na tela de login para a página inicial
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Laboratório de Pesquisa em Doenças de Chagas - LPDC';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Custom dashboard logo
add_action('admin_head', 'my_custom_logo');
function my_custom_logo() {
	echo '<style>
 			#wpadminbar>#wp-toolbar>#wp-admin-bar-root-default>#wp-admin-bar-wp-logo .ab-icon {
 				background: url('.get_bloginfo('template_directory').'/img/logo_tabless.png) no-repeat left 6px !important;
				height: 20px;
				width: 20px;
				font-family: normal !important;
				font-family: normal !important;
				font-weight: normal !important;
			}
		</style>';
}



function limpaHtml($arrayParam, $string){
	$array = explode(',', $arrayParam);
	$d = count($array);
	for($i = 0; $i < $d; $i++){
		$newstring = str_replace($array[$i],"",$string);
	}
	echo $newstring;
}

function pegar_opcao_atendimento($atendimento){
	global $wpdb;
	return $wpdb->get_results( 'SELECT * FROM opcao_atendimento WHERE atendimento = ' . $atendimento);

}

function listar_perguntas_historia_familiar(){
	global $wpdb;
	return $wpdb->get_results( 'SELECT * FROM historia_familiar');

}

function revisao_de_sistemas_sistema($id_sistema = 0) {
	global $wpdb;
	return $wpdb->get_results('SELECT * FROM sistemas WHERE id = ' . $id_sistema);
}

function total_sistemas(){
	global $wpdb;
	$total = $wpdb->get_var('SELECT COUNT(*) FROM sistemas'); 
	return $total;
}

function nome_sistema($id = 0) {
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM sistemas WHERE id='. $id);
	return $tipo->nome; 
}

function revisao_de_sistemas_sinais($id_sistema = 0) {
	global $wpdb;
	return $wpdb->get_results('SELECT * FROM sinais WHERE id_sistemas =' . $id_sistema);
}

function total_tipo_exames(){
	global $wpdb;
	$total = $wpdb->get_var('SELECT COUNT(*) FROM tipo_exame'); 
	return $total;
}

function evolucao_exames_tipo($id = 0) {
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM tipo_exame WHERE id='. $id);
	echo $tipo->nome; 
}

function exames($id = 0){
	global $wpdb;
	return $wpdb->get_results('SELECT * FROM exames WHERE id_tipo_exames =' . $id);
}

function total_exames($id = 0){
	global $wpdb;
	$total = $wpdb->get_var('SELECT COUNT(*) FROM exames WHERE id_tipo_exames = ' . $id); 
	return $total;
}

function atualizar_atendimento($num_atend, $num_paciente, $count_array, $array_valores, $data){
	global $wpdb;

	$table = 'atendimento_paciente';
	
	//  Verifica se a quantidade do Array é menor, maior ou igual
	$atendimento_banco = buscar_atendimento_id($num_paciente, $num_atend);
	$total_result_banco = count($atendimento_banco);
	$array_ids_banco = array();

	// atualizar data do atendimento para todas as linhas no banco
	$where = array('num_paciente'=> $num_paciente, 'atendimento'=> $num_atend); 
	$data_array = array('data'=>$data);
	$wpdb->update( $table, $data_array, $where, $format = null, $where_format = null );
	
	// pegar ids da consulta e colocar em um array
	foreach ($atendimento_banco as $key) {
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
				$data_valores = array('dados'=>$array_valores[$i]);
				$wpdb->update( $table, $data_valores, $where, $format = null, $where_format = null );
				
			} 
			else {
				$array_dados = array(
					'num_paciente'=> $num_paciente,
					'atendimento'=> $num_atend,
					'data'=> $data,
					'dados'=> $array_valores[$i]
					);
				$wpdb->insert( $table, $array_dados, $format);
			}
				$j++;
			
		}
	}
	else if($total_result_banco > $count_array){

		// atualizar data do atendimento para todas as linhas no banco
		$where = array('num_paciente'=> $num_paciente, 'atendimento'=> $num_atend); 
		$data_array = array('data'=>$data);
		$wpdb->update( $table, $data_array, $where, $format = null, $where_format = null );

		// verifica se a quantidade do banco é maior que a editada na tela
		$j = 1;
		for($i=0; $i < $total_result_banco; $i++){
			// o if irá verificar se o contador é maior ou igual com a quantidade
			// passada pelo banco para que seja possível fazer a atualização para os
			// ids que já existem no banco
			// Quando essa quantidade for maior será feita uma deleção
			if($j<=$count_array){
				$data_valores = array('dados'=>$array_valores[$i]);
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
		// atualizar data do atendimento para todas as linhas no banco
		$where = array('num_paciente'=> $num_paciente, 'atendimento'=> $num_atend); 
		$data = array('data'=>$data);
		$wpdb->update( $table, $data, $where, $format = null, $where_format = null );

		// se a quantidade do banco for igual a que é passada pela tela
		// será feita apenas um update
		for($i=0; $i < $total_result_banco; $i++){
			$where = array('num_paciente'=> $num_paciente, 'id'=> $array_ids_banco[$i]); 
			$data_valores = array('dados'=>$array_valores[$i]);
			$wpdb->update( $table, $data_valores, $where, $format = null, $where_format = null );
		}
	}
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

function buscar_atendimento_id_data($num_paciente, $num_atend){
	global $wpdb;
	$tipo = $wpdb->get_row('SELECT * FROM atendimento_paciente WHERE num_paciente='. $num_paciente . ' AND atendimento = '. $num_atend);
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

// Metodos Ficha 3
include 'opcoes_ficha_2.php';

// Metodos Ficha 3
include 'opcoes_ficha_3.php';

// Métodos ficha 4
include 'opcoes_ficha_4.php';

?>