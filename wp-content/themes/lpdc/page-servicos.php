<?php include "layout/header.php"; ?>
		<div id="pagina" class="servicos">
			<header class="header_servicos">
				<h1 class="font24 colorTextWhite open_semibold">Serviços</h1>
			</header>
			<?php 
// 			var_dump(get_category(6, '', ''));
			$idObj = get_category_by_slug('servico'); 
			?>
				<?php $servico = get_post($idObj->term_id);	?>
				<?php if(have_posts()) { ?>
				<?php 
					// The Query
					query_posts( 'cat='.$idObj->term_id );
					while(have_posts()) : the_post(); 
				?>
				<h2 class="open_regular font18">
				<?php echo the_title();?>
				</h2>
				<p>
				<?php 
    				if ( has_post_thumbnail() ) {
    				// mostra a imagem destacada
    					the_post_thumbnail();
    				}
    			?>
				
				<?php echo get_the_content(); ?>
				</p>
				<?php endwhile; 
					wp_reset_query();
				?>
				<?php } else { ?>
					<p> Página em Construção</p>
				<?php } ?>	
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>