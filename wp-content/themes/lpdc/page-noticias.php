<?php include "layout/header.php"; ?>
		<div id="pagina" class="noticias">
			<header class="header_noticias">
				<h1 class="font24 colorTextWhite open_semibold">Notícias</h1>
			</header>
			
			<dl class="panel-group" id="accordion">
				<?php if(isset($_GET['post'])){	
					$noticias = get_posts('post_id='. $_GET['post']);
					foreach ($noticias as $noticia){
						
					
				?>
					<dt class="panel panel-default panel-heading">
					<a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse1">
						<?php echo the_title();?>
					</a>
					<br />
					</dt>
					
					<dd id="collapse1" class="panel-collapse panel-body collapse">
						<?php 
    						if ( get_post_thumbnail_id($noticia->ID)) {
    							// mostra a imagem destacada
    							echo wp_get_attachment_url( get_post_thumbnail_id($noticia->ID));
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
					
					
				<?php 
					}	
				} else {
				?>
				<?php $args = array(
	
					'offset'          => 0,
					'category'        => 5,
					'orderby'         => 'post_date',
					'order'           => 'DESC',
					'include'         => '',
					'exclude'         => '',
					'meta_key'        => '',
					'meta_value'      => '',
					'post_type'       => 'post',
					'post_mime_type'  => '',
					'post_parent'     => '',
					'post_status'     => 'publish',
					'suppress_filters' => true ); ?>
				<?php $m = get_posts(); ?>
				<?php if(have_posts()) : ?>
				<?php 
					// The Query
					query_posts( 'cat=5' );
					$i = 0;
					while(have_posts()) : the_post(); 
					$i++;
					?>
									
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
					
				<?php endwhile; 
					wp_reset_query();
				?>
				<?php endif; ?>	
			<?php } ?>	
			</dl>
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>