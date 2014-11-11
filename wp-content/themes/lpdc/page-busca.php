<?php
if(issset($_POST['submit'])){
	
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
			</div>

			<div class="row-fluid">
				<div class="sessao">
					<h5>Resultado</h5>
				</div>
				<table class="table lista">
					<tr>
						<td class="titulo_busca">Nº Paciente:</td>
						<td></td>
						<td class="titulo_busca">Pesquisador:</td>
						<td></td>
						<td class="titulo_busca">Data:</td>
						<td></td>
						<td><i class="icon-editar edit_lista"></i></td>
					</tr>
					<tr>
						<td colspan="4" class="titulo_busca">Nome:</td>
						<td></td>
						<td class="titulo_busca">Nº Prontuário:</td>
						<td></td>
					</tr>
				</table>
			</div>

		</div>

<?php include "layout/footer.php"; ?>