<?php
if(isset($_POST['submit'])){
	
	$nome = $_POST['nome'];
	$num_paciente = $_POST['num_paciente'];
	$num_prontuario = $_POST['num_prontuario'];
	$pesquisador = $_POST['pesquisador'];
	$result = buscar_paciente($num_paciente, $num_prontuario, $pesquisador, $nome);
}
// Ficha 2
if(isset($_GET['ficha'])){
	$num_paciente = $_GET['cod'];
	if($_GET['ficha'] == '2'){
		$result = buscar_quantidade_ficha_2($num_paciente);
	}

	if($_GET['ficha'] == '3'){
		$result = buscar_quantidade_ficha_3($num_paciente);
	}

	if($_GET['ficha'] == '4'){
		$result = buscar_quantidade_ficha_4($num_paciente);
	}
}

include "layout/header.php"; 
?>
		<div id="pagina2" class="cadastro-paciente">
			<header class="header_cadastro-paciente">
				<h1 class="font24 colorTextWhite open_semibold title_maior">Buscar Paciente</h1>
			</header>

			<div class="cabecalho row-fluid">
				<p>Universidade Federal do Ceará</p>
				<p>Departamento de análises clínicas e toxicologicas (DACT)</p>
				<p>Laboratório de pesquisa em doença de chagas</p>
				<p>progama de atenção farmacêutica ao paciente chagástico</p>
			</div>
			<div class="row-fluid title">
				<h4>Buscar paciente</h4>
			</div>
			
			<div class="row-fluid">
				<?php if(!isset($_GET['ficha'])){ ?>
				<form action="" method="post" id="busca_paciente">
					
					<div class="row-fluid">
						<div class="span4">
							<label>Nº Paciente</label>
							<input type="text" name="num_paciente">
						</div>
						<div class="span8">
							<label>Nº Prontuário</label>
							<input type="text" name="num_prontuario">
						</div>
					</div>
					<div class="row-fluid sessao">
						<div class="span4">
							<label>Pesquisador</label>
							<input type="text" name="pesquisador">
						</div>
						<div class="span8">
							<label>Nome</label>
							<input type="text" name="nome" class="input_media">
						</div>
					</div>
					<div class="row-fluid">
						<button class="btn btn-primary enviar" name="submit">Pesquisar</button>						
					</div>
				</form>
				<?php } else { ?>
						<div class="row-fluid">
							<a href="../busca" class="btn btn-primary enviar">Refazer pesquisa</a>						
						</div>
				<?php } ?>
			</div>

			<div class="row-fluid busca_resultado">
				
			<?php 	if(isset($result)){ ?>
						<div class="sessao">
							<h5>Resultado</h5>
						</div>
					<?php
						// Ficha 1
						if(!isset($_GET['ficha'])){
							foreach ($result as $key) { ?>		
						
								<div class="row-fluid lista">
									<div class="row-fluid linha">
										<div class="span2 label2">Nº Paciente:</div>
										<div class="span2 result"><?php echo $key->num_paciente; ?></div>
										<div class="span2 label2">Pesquisador:</div>
										<div class="span3 result pesq"><?php echo $key->pesquisador; ?></div>
										<div class="span1 label1_1 text_align_right">Data:</div>
										<div class="span1 result"><?php echo $key->data; ?></div>
										<div class="span1">
											<a href="<?php echo '../cadastro-de-paciente-edicao?cod='. $key->num_paciente . '&ficha='.$key->id; ?>"><i class="icon-editar edit_lista"></i></a>
											<a href=""><i class="icon-olho edit_lista"></i></a>
										</div>

									</div>
									<div class="row-fluid linha">
										<div class="span1 label1">Nome:</div>
										<div class="span6 nome"><?php echo $key->nome; ?></div>
										<div class="span2 label3">Nº Prontuário:</div>
										<div class="span2 result"><?php echo $key->num_prontuario; ?></div>
									</div>
									<div class="row-fluid linha">
										<div class="span2"><a href="<?php echo '../busca/?cod='.$key->num_paciente . '&ficha=2'?>"><strong>Ficha 2 </strong>(<?php echo count(buscar_quantidade_ficha_2($key->num_paciente));?>)</a></div>
										<div class="span2"><a href="<?php echo '../busca/?cod='.$key->num_paciente . '&ficha=3'?>"><strong>Ficha 3 </strong>(<?php echo count(buscar_quantidade_ficha_3($key->num_paciente));?>)</a></div>
										<div class="span2"><a href="<?php echo '../busca/?cod='.$key->num_paciente . '&ficha=4'?>"><strong>Ficha 4 </strong>(<?php echo count(buscar_quantidade_ficha_4($key->num_paciente));?>)</a></div>
									</div>
									
								</div>
				<?php 		}
						}
						
					// Ficha 2
						if(isset($_GET['ficha']) && $_GET['ficha']=="2"){
							foreach ($result as $key) { 
						?>
								<div class="row-fluid lista">
										<div class="row-fluid linha">
											<div class="span2 label2">Nº Paciente:</div>
											<div class="span7 result"><?php echo $key->num_paciente; ?></div>
											<div class="span1 label1_1 text_align_right">Data:</div>
											<div class="span1 result"><?php echo $key->data; ?></div>
											<div class="span1">
												<a href="<?php echo '../ficha-2-edicao/?cod='. $key->num_paciente . '&ficha='.$key->id; ?>"><i class="icon-editar edit_lista"></i></a>
												<a href=""><i class="icon-olho edit_lista"></i></a>
											</div>

										</div>
										<div class="row-fluid linha">
											<div class="span1 label1">Nome:</div>
											<div class="span4 nome"><?php echo $key->nom_paciente; ?></div>
											<div class="span4 label1_1">Etapa:</div>
											<div class="span2 result"><?php echo $key->etapa; ?></div>
										</div>
										
									</div>
					<?php	}
						}

						// Ficha 3
						if(isset($_GET['ficha']) && $_GET['ficha']=="3"){
							foreach ($result as $key) { ?>		
						
								<div class="row-fluid lista">
									<div class="row-fluid linha">
										<div class="span2 label2">Nº Paciente:</div>
										<div class="span2 result"><?php echo $key->num_paciente; ?></div>
										<div class="span2 label2">Pesquisador:</div>
										<div class="span3 result pesq"><?php echo $key->pesquisador; ?></div>
										<div class="span1 label1_1 text_align_right">Data:</div>
										<div class="span1 result"><?php echo $key->data; ?></div>
										<div class="span1">
											<a href="<?php echo '../cadastro-de-paciente-edicao?cod='. $key->num_paciente . '&ficha='.$key->id; ?>"><i class="icon-editar edit_lista"></i></a>
											<a href=""><i class="icon-olho edit_lista"></i></a>
										</div>

									</div>
									<div class="row-fluid linha">
										<div class="span1 label1">Nome:</div>
										<div class="span6 nome"><?php echo $key->nom_paciente; ?></div>
										<div class="span2 label3">Nº Protocolo:</div>
										<div class="span2 result"><?php echo $key->num_protocolo; ?></div>
									</div>
									<div class="row-fluid linha">
										<div class="span1 label1_1">Retorno:</div>
										<div class="span5 nome"><?php echo $key->retorno; ?></div>
										<div class="span2 label2">Atendimento:</div>
										<div class="span2 result"><?php echo $key->num_atendimento; ?></div>
									</div>
									
								</div>
				<?php 		}
						}

						// Ficha 4
						if(isset($_GET['ficha']) && $_GET['ficha']=="4"){
							foreach ($result as $key) { ?>		
						
								<div class="row-fluid lista">
									<div class="row-fluid linha">
										<div class="span2 label2">Nº Paciente:</div>
										<div class="span2 result"><?php echo $key->num_paciente; ?></div>
										<div class="span2 label2">Pesquisador:</div>
										<div class="span3 result pesq"><?php echo $key->pesquisador; ?></div>
										<div class="span1 label1_1 text_align_right">Data:</div>
										<div class="span1 result"><?php echo $key->data; ?></div>
										<div class="span1">
											<a href="<?php echo '../ficha-4-edicao?cod='. $key->num_paciente . '&ficha='.$key->id; ?>"><i class="icon-editar edit_lista"></i></a>
											<a href=""><i class="icon-olho edit_lista"></i></a>
										</div>

									</div>
									<div class="row-fluid linha">
										<div class="span1 label1">Nome:</div>
										<div class="span6 nome"><?php echo $key->nom_paciente; ?></div>
										<div class="span2 label3">Nº Protocolo:</div>
										<div class="span2 result"><?php echo $key->num_protocolo; ?></div>
									</div>
									<div class="row-fluid linha">
										<div class="span1 label1_1">Pontos:</div>
										<div class="span5 nome"><?php echo $key->pontos; ?></div>
										<div class="span2 label2">Clasificação:</div>
										<div class="span2 result"><?php echo $key->classificacao; ?></div>
									</div>
									
								</div>
				<?php 		}
						}

					}	?>
				
			</div>

		</div>

<?php include "layout/footer.php"; ?>