<?php include "layout/header.php"; ?>
		<div id="pagina" class="projeto">
			<header class="header_projeto">
				<h1 class="font24 colorTextWhite open_semibold">Projetos</h1>
			</header>
			<dl class="panel-group" id="accordion">
				<?php $args = array(
	
					'offset'          => 0,
					'category'        => 2,
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
					query_posts( 'cat=1' );
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
					<span>
					<?php 
						$campoPers = get_post_meta($post->ID, 'Ano', true);
						if(!empty($campoPers)){
							echo $campoPers;
						}
					?>
					</span>
					</dt>
					<dd id="collapse<?php echo $i; ?>" class="panel-collapse panel-body collapse">
						<?php echo get_the_content(); ?>
					</dd>	
					
				<?php endwhile; 
					wp_reset_query();
				?>
				<?php endif; ?>		
			</dl>	
		</div> <!-- Fim da Div de Página -->
<?php include "layout/footer.php"; ?>