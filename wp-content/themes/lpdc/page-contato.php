<?php 
	if(isset($_POST['submit'])){
		
		$to = 'jehnyffen@gmail.com';
		$nome = $_POST['nome'];
		$subject = $_POST['assunto'];
		$email = $_POST['email'];
		$headers = "MIME-Version: 1.1 \r\n";
		$headers .= "Content-type: text/html; charset=utf-8 \r\n";
		$message = "<html><body>";
		$message .= "<table style='border:1px solid #006dcc;width:97%;'>";
		$message .= "<tr><td style='text-align:left;padding-left:10px;padding-top:20px;'><img src='http://www.lpdc.ufc.br/wp-content/themes/lpdc/img/logo_LPDC.png' alt='Laboratório em Doenças de Chagas' width=200></td></tr>";
		$message .= "<tr><td style='padding-left:10px;padding-top:20px;padding-bottom:20px;'>Segue os dados de contato: </td></tr>";
		$message .= "<tr><td style='padding-left:10px;'><strong>Nome: </strong>" . $_POST['nome'] . "</td></tr>";
		$message .= "<tr><td style='padding-left:10px;'><strong>Assunto: </strong>" . $_POST['assunto'] . "</td></tr>";
		$message .= "<tr><td style='padding-left:10px;'><strong>E-mail: </strong>" . $_POST['email']. "</td></tr>";
		$message .= "<tr><td style='padding-left:10px;padding-bottom:30px;'><strong>Mensagem: </strong>" . $_POST['descricao']. "</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";

		if($subject != "" && $email != "" && $message != "" && $nome != ""){
			if(wp_mail( $to, $subject, $message, $headers)){
				$sucesso = "<div class='sucesso alert alert-info'>
					<button type='button' class='close' data-dismiss='alert'>×</button>
					<strong>Sucesso!</strong>
					Seu e-mail foi enviado com sucesso.
					</div>";
				
			}
		}else{
			echo $nome . ", ". $subject . ", ". $email . ", ". $message;
		}
		
	}

include "layout/header.php"; 
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
			<form action="" method="post" id="form_contato">
				<fieldset>
					<label class="font12 colorTextGray open_sansregular">Nome*</label>
					<input type="text" name="nome" id="nome" required>
					<label class="font12 colorTextGray open_sansregular">E-mail*</label>
					<input type="email" name="email" id="email" required>
					<label class="font12 colorTextGray open_sansregular">Assunto*</label>
					<input type="text" name="assunto" id="assunto" required>
				</fieldset>
				<fieldset>
					<label class="font12 colorTextGray open_sansregular">Descrição*</label>
					<textarea rows="6" cols="40" name="descricao" id="descricao" required></textarea>
					<button type="reset" class="btn btn-large btn-primary btnStyleContato open_light">Cancelar</button>
				<button type="submit" name="submit" class="btn btn-large btn-primary enviar open_light">Enviar</button>				
				</fieldset>
				
				
			</form>
			
			
			
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>