<?php 
	$sucesso = "";
	if(isset($_POST['submit'])){
		$sucesso = "<div class='alert alert-info'>
				<button type='button' class='close' data-dismiss='alert'>×</button>
				<strong>Sucesso!</strong>
				Seu e-mail foi enviado com sucesso.
			</div>";
	}

include "/layout/header.php"; 
?>
		<div id="pagina" class="contato">
			<header class="header_contato">
				<h1 class="font24 colorTextWhite open_semibold">Contato</h1>
			</header>
			
			<?php echo $sucesso; ?>
			
			<div class="alert alert-block alert-error fade in">
				<button type="button" class="close">×</button>
				<h4 class="alert-heading">Campo vazio!</h4>
				<p>Todos os campos devem ser preenchidos.</p>
				
			</div>
			<form action="contato" method="post" id="form_contato">
				<fieldset>
					<label class="font12 colorTextGray open_sansregular">Nome*</label>
					<input type="text" name="nome" id="nome" required>
					<label class="font12 colorTextGray open_sansregular">E-mail*</label>
					<input type="email" name="email" id="email" required>
					<label class="font12 colorTextGray open_sansregular">Assunto*</label>
					<input type="text" name="assunto" id="assunto" required>
					<label class="font12 colorTextGray open_sansregular">Descrição*</label>
					<textarea rows="6" cols="40" name="descricao" id="descricao"></textarea>
				
				</fieldset>
				<button type="reset" class="btn btn-small btn-primary btnStyleContato">Cancelar</button>
				<button type="button" name="submit" class="btn btn-small btn-primary enviar">Enviar</button>				
				
			</form>
			
			
			
		</div> <!-- Fim da Div de Página -->
<?php include "/layout/footer.php"; ?>