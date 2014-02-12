<?php include "/layout/header.php"; 
	$pageTitle = "Página Inicial";
?>
		<div id="banner" class="carousel slide">
			<!-- Itens de carousel -->
			<div class="carousel-inner">
			    <div class="active item">
			    	<img alt="Banner 1" src="<?php bloginfo('template_url'); ?>/img/banner1.png">
			    </div>
			    <div class="item">
			    	<img alt="Banner 2" src="<?php bloginfo('template_url'); ?>/img/banner2.png">
			    </div>
		    	<div class="item">
		    		<img alt="Banner 3" src="<?php bloginfo('template_url'); ?>/img/banner3.png">
		    	</div>
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
	    				<div class="thumbnail">
	    					<div class="labelParticoes">
	    						<h5>Login Usuário</h5>
	    					</div>
	    				</div>
	    			</li>
				</ul>
	    	</div>
	    	<div id="secondLine" class="row-fluid">
	    		<ul class="inline">
	    			<li	class="span8">
	    				<ul class="inline ulInsideLi">
	    					<li class="span5"> <img src="<?php bloginfo('template_url'); ?>/img/img_noticia1.png" alt="Notícia 1" title="Notícia 1" /></li>
	    					<li class="span7"> 
		    					<h4 class="open_light colorTexBlue">Últimas descobertas do LPDC</h4>
								<p class="open_regular font12 colorTextGray"> Inauguração do site do Laboratório de Pesquisa em Doença 
									de Chagas - UFC. Estudos relacionados ao tratamento de portadores da doença, visando a melhoria da qualidade 
									de vida desses pacientes,..
								</p>
<!-- 								<a href="#" class="btn btn-link linkStyle">Leia mais</a> -->
							</li>
						</ul>
						<ul class="inline ulInsideLi">
							<li class="span5"> <img src="<?php bloginfo('template_url'); ?>/img/img_noticia1.png" alt="Notícia 1" title="Notícia 1" /></li>
	    					<li class="span7"> 
		    					<h4 class="open_light colorTexBlue">Últimas descobertas do LPDC</h4>
								<p class="open_regular font12 colorTextGray"> Inauguração do site do Laboratório de Pesquisa em Doença 
									de Chagas - UFC. Estudos relacionados ao tratamento de portadores da doença, visando a melhoria da qualidade 
									de vida desses pacientes,..
								</p>
<!-- 								<a href="#" class="btn btn-link linkStyle">Leia mais</a> -->
							</li>
	    				</ul>
					</li>
	    			<li	class="span4"> 
						<div class="thumbnail">
	    					<div class="labelParticoes">
	    						<h5>Últimos Posts</h5>
	    					</div>
	    					<div class="textoCaixas">
		    					<ul class="inline ulPost">
		    						<li class="span3">
										<p class="backgroundBlueDark colorTextWhite open_regular font16 dataPostStyleDia">15</p>
										<p class="backgroundBlueWhite colorTextWhite open_regular font16 dataPostStyleMes">JAN</p>
									</li>
		    						<li class="span9 open_regular font12 colorTextGray">
		    							Inauguração do site do Laboratório de Pesquisa em Doença 
		    							de Chagas - UFC
		    							<!-- <a href="#" class="btn btn-link linkStylePost">Leia mais</a> -->
		    						</li>
		    					</ul>
		    					
		    					<!-- <ul class="inline ulPost">
		    						<li class="span3">
										<p class="backgroundBlueDark colorTextWhite open_regular font16 dataPostStyleDia">18</p>
										<p class="backgroundBlueWhite colorTextWhite open_regular font16 dataPostStyleMes">NOV</p>
									</li>
		    						<li class="span9 open_regular font12 colorTextGray">
		    							Inauguração do site do Laboratório de Pesquisa em Doença 
		    							de Chagas - UFC
		    							<a href="#" class="btn btn-link linkStylePost">Leia mais</a>
		    						</li>
		    					</ul>
		    					
		    					<ul class="inline ulPost">
		    						<li class="span3">
										<p class="backgroundBlueDark colorTextWhite open_regular font16 dataPostStyleDia">18</p>
										<p class="backgroundBlueWhite colorTextWhite open_regular font16 dataPostStyleMes">NOV</p>
									</li>
		    						<li class="span9 open_regular font12 colorTextGray">
		    							Inauguração do site do Laboratório de Pesquisa em Doença 
		    							de Chagas - UFC
		    							<a href="#" class="btn btn-link linkStylePost">Leia mais</a>
		    						</li>
		    					</ul>
		    					
		    					<p> <a href="#" class="btn btn-link linkStylePost">Ver todas</a> </p> -->
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
	    
<?php include "/layout/footer.php"; ?>