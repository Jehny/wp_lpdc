<?php include "layout/header.php"; ?>
		<div id="pagina" class="noticias">
			<header class="header_noticias">
				<h1 class="font24 colorTextWhite open_semibold">Quem Somos</h1>
			</header>
			<div class="quem_somos">
			<?php 
				$page = get_page_by_title( 'Quem somos' );

				echo  $page->post_content;
			?>
			</div>
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>