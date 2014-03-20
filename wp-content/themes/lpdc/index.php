<?php include "layout/header.php"; 
	$pageTitle = "Página Inicial";
?>
		<div id="banner" class="carousel slide">
			<!-- Itens de carousel -->
			<div class="carousel-inner">
			<?php $banners = get_posts('post_type=banners');
				if($banners){
					foreach ($banners as $banner){
						if($i++ == 1){
							$active = "active";
						}else{$active = "";}
						?>
						<div class="<?php echo $active; ?> item">
							<img alt="LPDC Imagens" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($banner->ID) ); ?>">
						</div>
			<?php  }
				}
				
			?>
		  	</div>
		  	<!-- Navegador do carousel -->
			  <a class="carousel-control left" href="#banner" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#banner" data-slide="next">&rsaquo;</a>
		</div>
	    <div id="pagina">
	    	<div id="firstLine" class="row-fluid">
	    		<ul class="inline">
	    			<li class="span4"> 
	    				<div class="thumbnail">
	    					<div class="labelParticoes">
	    						<h5>Exames</h5>
	    					</div>
	    					<div class="textoCaixas">
	    						<ul class="inline">
	    							<li class="span4"> <img src="<?php bloginfo('template_url'); ?>/img/img_exames.png" alt="Exames" title="Exames" /></li>
	    							<li class="span8"> 
	    								<p class="open_regular font13 colorTextGray">Saiba quais exames realizamos:</p>
    									<p class="open_regular backgroudWhite font14 colorText">IFI</p>
    									<p class="open_regular backgroudWhite font14 colorText">ELISA</p>
    									<p class="open_regular backgroudWhite font14 colorText">Xenodiagnóstipo</p>
	    							</li>
	    						</ul>
	    					</div>
	    				</div> 
	    			</li>
	    			<li class="span4"> 
	    				<div class="thumbnail">
	    					<div class="labelParticoes">
	    						<h5>Projetos</h5>
	    					</div>
	    					<div class="textoCaixas">
	    						<ul class="inline">
	    							<li class="span4"> <img src="<?php bloginfo('template_url'); ?>/img/img_projeto.png" alt="Projetos" title="Projetos" /></li>
	    							<li class="span8"> 
										<p class="open_regular font13 colorTextGray">Conheça um pouco sobre os projetos realizados pelo Laboratório de Pesquisa em Doença de Chagas.</p>
										<a href="projetos" class="btn btn-small btn-primary btnStyle">Clique Aqui</a>
									</li>
	    						</ul>
	    					</div>
	    				</div> 
	    			</li>
	    			<li class="span4"> 
	    				<div class="thumbnail login">
	    					<div class="labelParticoes">
	    						<h5>Login Usuário</h5>
	    					</div>
	    					<?php 
	    					 $args = array(
	    							'echo'           => true,
	    							'redirect'       => site_url( "wp-admin" ),
	    							'form_id'        => 'loginform',
	    							'label_username' => __( 'Username' ),
	    							'label_password' => __( 'Password' ),
	    							'label_remember' => __( 'Remember Me' ),
	    							'label_log_in'   => __( 'Log In' ),
	    							'id_username'    => 'user_login',
	    							'id_password'    => 'user_pass',
	    							'id_remember'    => 'rememberme',
	    							'id_submit'      => 'wp-submit',
	    							'remember'       => true,
	    							'value_username' => NULL,
	    							'value_remember' => false
	    					); 
	    					
	    					wp_login_form($args);
	    				?>
	    				</div>
	    			</li>
				</ul>
	    	</div>
	    	<div id="secondLine" class="row-fluid">
	    		<ul class="inline">
	    			<li	class="span8">
	    				<?php $idDesc = get_category_by_slug('descobertas'); ?>
	    				<?php if(have_posts()) : ?>
						<?php 
							// The Query
							query_posts( 'cat='.$idDesc->term_id .'&orderby=DESC&posts_per_page=2' );
							while(have_posts()) : the_post(); 
						?>
			    				<ul class="inline ulInsideLi">
			    					<li class="span5"> 
			    						<?php 
			    						if ( has_post_thumbnail() ) {
			    							// mostra a imagem destacada
			    							the_post_thumbnail();
			    						}
			    						?>
			    					</li>
			    					<li class="span7"> 
				    					<h4 class="open_light colorTexBlue"><?php echo the_title();?></h4>
										<p class="open_regular font12 colorTextGray"> 
											<?php echo get_the_content(); ?>
											
											
											
										</p>
<!-- 										<a href="#" class="btn btn-link linkStyle">Leia mais</a>  -->
									</li>
								</ul>
						<?php endwhile; 
						wp_reset_query();
						?>
						<?php endif; ?>
					</li>
	    			<li	class="span4"> 
						<div class="thumbnail">
	    					<div class="labelParticoes">
	    						<h5>Últimos Posts</h5>
	    					</div>
	    					<div class="textoCaixas">
	    					<?php $idNoticia = get_category_by_slug('noticias');?>
		    					<?php if(have_posts()) : ?>
								<?php 
									// The Query
									query_posts( 'cat='.$idNoticia->term_id.'&order=DESC&orderby=date&posts_per_page=3' );
									while(have_posts()) : the_post(); 
								?>
	    								<ul class="inline ulPost">
				    						<li class="span3">
												<p class="backgroundBlueDark colorTextWhite open_regular font16 dataPostStyleDia"><?php the_time('j')?></p>
												<p class="backgroundBlueWhite colorTextWhite open_regular font16 dataPostStyleMes"><?php the_time('M')?></p>
											</li>
				    						<li class="span9 open_regular font12 colorTextGray">
				    							<p class="textLimiter"><?php echo strip_tags(get_the_content()); ?></p>
				    							<a href="noticias?post=<?php the_ID(); ?>" class="btn btn-link linkStylePost open_regular">Leia mais</a>
				    						</li>
				    					</ul>
	    					
	    						<?php endwhile; 
								wp_reset_query();
								?>
								<?php endif; ?>
								<?php  $qntNote = count(query_posts( 'cat=' . $idNoticia->term_id));
									if($qntNote > 3){ ?>
										<p> <a href="noticias" class="btn btn-link linkStylePost">Ver todas</a> </p>
								<?php }?>
		    					
	    					</div>
	    				</div>
					</li>
	    			
	    		</ul>
	    	</div>
	    	<div id="carrosel">
	    		<ul class="inline">
	    			<li><img src="<?php bloginfo('template_url'); ?>/img/cnpq.png" alt="CNPQ" title="CNPQ" /></li>
	    			<li><img src="<?php bloginfo('template_url'); ?>/img/portal_capes.png" alt="Portal CAPES" title="Portal CAPES" /></li>
	    			<li><img src="<?php bloginfo('template_url'); ?>/img/funcap.png" alt="FUNCAP" title="FUNCAP" /></li>
	    			<li><img src="<?php bloginfo('template_url'); ?>/img/lattes.png" alt="Portal Lattes" title="Portal Lattes" /></li>
	    			<li><img src="<?php bloginfo('template_url'); ?>/img/ufc_hospital.png" alt="Hospital Universitário Walter Cantídio" title="Hospital Universitário Walter Cantídio" /></li>
	    		</ul>
	    	</div>
	    </div>  <!-- Fim da Div de Página -->
	    
<?php include "layout/footer.php"; ?>