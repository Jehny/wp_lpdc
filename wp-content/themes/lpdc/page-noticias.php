<?php include "layout/header.php"; ?>
		<div id="pagina" class="noticias">
			<header class="header_noticias">
				<h1 class="font24 colorTextWhite open_semibold">Notícias</h1>
			</header>
			
			<dl class="panel-group" id="accordion">
				<?php $m = get_posts(); 
					$idObj = get_category_by_slug('noticias'); 
					$servico = get_post($idObj->term_id);	
				?>
				<?php if(have_posts()) : ?>
				<?php 
					// The Query
					$query = query_posts( 'cat='.$idObj->term_id );
					if ($query){
						$i = 0;
						while(have_posts()) : the_post(); 
						$i++;
						if(count($query) == 1){
							echo "<p><strong>";
							the_title();
							echo "</strong></p>";

	    						if ( has_post_thumbnail() ) {
	    							// mostra a imagem destacada
	    							the_post_thumbnail();
	    						}
	    				?>
	    				<p>
							<?php echo get_the_content(); ?>
						</p>
						<p><strong>Data da Publicação: </strong>
							<?php the_time('j')?> de
							<?php the_time('F')?> de 
							<?php the_time('Y')?>
						</p>
				<?php } else { ?>
									
	<!-- 					 Aqui serão listados os projetos -->
						<dt class="panel panel-default panel-heading">
						<a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse<?php echo $i; ?>">
							<?php echo the_title();?>
						</a>
						<br />
						</dt>
						<dd id="collapse<?php echo $i; ?>" class="panel-collapse panel-body collapse">
							<?php 
	    						if ( has_post_thumbnail() ) {
	    							// mostra a imagem destacada
	    							the_post_thumbnail();
	    						}
	    					?>
	    				<p>
							<?php echo get_the_content(); ?>
						</p>
						<p><strong>Data da Publicação: </strong>
							<?php the_time('j')?> de
							<?php the_time('F')?> de 
							<?php the_time('Y')?>
						</p>
						</dd>	
					
					<?php }
						endwhile; 
						wp_reset_query();
					
				}
				?>
				<?php endif; ?>	
			</dl>
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>