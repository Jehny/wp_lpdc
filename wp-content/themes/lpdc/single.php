<?php include "layout/header.php"; ?>
		<div id="pagina" class="noticias">
			<header class="header_noticias">
				<h1 class="font24 colorTextWhite open_semibold">Notícias</h1>
			</header>
			
			<dl class="panel-group" id="accordion">
				<?php 
					$noticia = get_post();
				?>
					<dt class="panel panel-default panel-heading">
					<a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse1">
						<?php echo the_title();?>
					</a>
					<br />
					</dt>
					
					<dd id="collapse1" class="panel-collapse panel-body in collapse">
						<?php 
    						if ( get_post_thumbnail_id($noticia->ID)) {
    							// mostra a imagem destacada
    							$imagem = get_post(get_post_thumbnail_id($noticia->ID));
    							echo "<img src='".wp_get_attachment_url( get_post_thumbnail_id($noticia->ID)) . "' alt='".$imagem->post_title."'>";
    						}
    					?>
    				<p>
						<?php echo $noticia->post_content; ?>
					</p>
					<p><strong>Data da Publicação: </strong>
						<?php the_time('j')?> de
						<?php the_time('F')?> de 
						<?php the_time('Y')?>
					</p>
					</dd>	
				</dl>
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>