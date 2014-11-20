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

function buscar_atendimento_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM atendimento_paciente WHERE num_paciente='. $num_paciente);
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

function buscar_hemograma_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM hemograma WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_med_que_utiliza_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM med_que_utiliza WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_med_utilizados_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM med_que_utiliza WHERE num_paciente='. $num_paciente);
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
	$tipo = $wpdb->get_results('SELECT * FROM revisao_sistemas_sintomas WHERE num_paciente='. $num_paciente . ' AND id_sistema = ' . $id_sistema );
	return $tipo; 
}

function buscar_uso_medicamento_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM uso_medicamento WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

function buscar_total_porcentagem_id($num_paciente){
	global $wpdb;
	$tipo = $wpdb->get_results('SELECT * FROM total_porcentagem WHERE num_paciente='. $num_paciente);
	return $tipo; 
}

?>