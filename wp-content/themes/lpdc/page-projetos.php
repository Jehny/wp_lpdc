<?php include "/layout/header.php"; ?>
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
					query_posts( 'cat=2' );
					$i = 0;
					while(have_posts()) : the_post(); 
					$i++;
					?>
									
<!-- 					 Aqui serão listados os projetos -->
					<dt class="panel panel-default panel-heading">
					<a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapseOne">
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
					<dd id="collapseOne" class="panel-collapse panel-body collapse">
						<?php echo get_the_content(); ?>
					</dd>	
					
				<?php endwhile; 
					wp_reset_query();
				?>
				<?php endif; ?>			
			
			
			
<!-- 		        <dt class="panel panel-default panel-heading">  -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapseOne"> -->
<!-- 		          	Inovação do Serviço de Atenção Farmacêutico aos Pacientes Chagásicos -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2013 - Atual</span> -->
<!-- 		        </dt> -->
<!-- 				<dd id="collapseOne" class="panel-collapse panel-body collapse in"> -->
<!-- 					O projeto, Serviço de atenção farmacêutica aos pacientes chagásicos do  -->
<!-- 					Estado do Ceará, existe desde 2005. Quando idealizei esse projeto pensei  -->
<!-- 					em oferecer um serviço especializado de qualidade para esse grupo de pacientes  -->
<!-- 					estigmatizados e sem acesso ao sistema de saúde. O projeto mantém parceria  -->
<!-- 					com o Hospital Universitário Walter Cantídio/HUWC e o Laboratório de Análises  -->
<!-- 					Clínicas e Toxicológicas /LACT. Atualmente, a evidência é de um serviço de referência  -->
<!-- 					em todo o Estado do Ceará e Estados vizinhos como Piauí e Rio Grande do Norte e vem  -->
<!-- 					despertando interesse de outros profissionais da saúde para fortalecer a integração -->
<!-- 					e apoiar a Pós Graduação em programa de doutorado em saúde pública em tese de doutorado e -->
<!-- 					 mestrado. Hoje, julho de 2012, o projeto conta com mais de 360 pacientes chagásicos  -->
<!-- 					 cadastrados no serviço. O controle vetorial é uma prática permanente do governo  -->
<!-- 					 para erradicar a transmissão vetorial da doença, enquanto isso os milhões de  -->
<!-- 					 pacientes com essa enfermidade permanecem sem acesso ao sistema de saúde.  -->
<!-- 					 Além de oferecer um serviço especializado de qualidade em prática humanizada e  -->
<!-- 					 de atenção farmacêutica para os pacientes chagásicos, desenvolve habilidade de  -->
<!-- 					 comunicação, competência para informar sobre medicamentos e participar na  -->
<!-- 					 prevenção e promoção a saúde. O serviço de atenção farmacêutica também  -->
<!-- 					 tem a função de esclarecer às duvidas e confortar os pacientes do estigma da  -->
<!-- 					 sentença de morte, além de fazer dispensação, orientação e atendimento farmacêutico.  -->
<!-- 					 O projeto também faz uma busca ativa nos municípios endêmicos, fazendo notificação de novos  -->
<!-- 					 casos através de exames sorológicos e assim com um diagnóstico precoce o tratamento  -->
<!-- 					 pode ser instituído imediatamente, trazendo maior beneficio ao paciente que pode  -->
<!-- 					 resultar num maior índice de cura, pois quanto mais precoce for instituído o  -->
<!-- 					 tratamento maior a chance de cura para o paciente visto que na fase  -->
<!-- 					 crônica tardia o índice de cura não chega a 10%.  <br />  -->
<!-- 					Situação: Em andamento; Natureza: Pesquisa. <br />  -->
<!-- 					Alunos envolvidos: Graduação: (1) / Mestrado acadêmico: (2) / Doutorado: (1) . <br /> <br />  -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Coordenador /  -->
<!-- 					LAÍSE DOS SANTOS PEREIRA - Integrante / Arduina Sofia Ortet Barros Vasconcelos - Integrante /  -->
<!-- 					Monica Andrade Coelho - Integrante / Kátia Cristina Morais Soares Gomes - Integrante /  -->
<!-- 					João Paulo Ramalho Correia - Integrante.<br />  -->
<!-- 					Financiador(es): Fundação Cearense de Apoio ao Desenvolvimento Científico e  -->
<!-- 					Tecnológico - Auxílio financeiro. -->

<!-- 				</dd> -->
				
<!-- 				<dt class="panel panel-default panel-heading"> -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapseTwo"> -->
<!-- 		          	Avaliação de TGF- β1 como marcador clínico em pacientes chagásicos crônicos. -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2011 - 2014</span> -->
<!-- 		        </dt> -->
<!-- 				<dd id="collapseTwo" class="panel-collapse panel-body collapse"> -->
<!-- 					Nos últimos anos, o fator transformador do crescimento β (TGF- β)  -->
<!-- 					tem sido apontado como a principal citocina envolvida na redução de  -->
<!-- 					junções comunicantes, no desenvolvimento de fibrose e da cardiomiopatia  -->
<!-- 					chagásica. A imagem por ressonância magnética (IRM) tem se destacado como um método -->
<!-- 					 não invasivo de diagnóstico precoce de fibrose, enquanto que outros exames utilizados  -->
<!-- 					 na Doença de Chagas, como o ECG, são sensíveis apenas quando a fibrose é extensa o  -->
<!-- 					 suficiente para causar alterações na função miocárdica. Proposta: Avaliar a  -->
<!-- 					 utilização de TGF- β1 como marcador clínico de fibrose e de acompanhamento  -->
<!-- 					 pós-tratamento com benzonidazol (Bz) em pacientes chagásicos crônicos.  -->
<!-- 					 Métodos: Correlacionar os níveis séricos de TGF- β1 com a extensão de fibrose  -->
<!-- 					 miocárdica determinada por IRM, em 20 pacientes chagásicos crônicos não tratados.  -->
<!-- 					 Analisar os níveis séricos de TGF- β1 antes e anualmente após a terapia com Bz em 40  -->
<!-- 					 pacientes chagásicos crônicos tratados por 60dias (5mg/Kg/dia).  -->
<!-- 					 Contribuições: Inclusão de um novo marcador (TGF- β1) que diagnostique fibrose de forma precoce,  -->
<!-- 					 além de substituir um exame de imagem (IRM) por um método imunológico simples (TGF- β1),  -->
<!-- 					 de custo extremamente inferior, de rápida execução e igualmente não invasivo. Em adição,  -->
<!-- 					 atestar o possível efeito protetor de Bz em pacientes chagásicos crônicos contra o  -->
<!-- 					 desenvolvimento de cardiomiopatias. Resultados: Esperamos obter uma relação positiva  -->
<!-- 					 entre os níveis séricos de TGF- β1 e a porcentagem de fibrose diagnosticada por IRM,  -->
<!-- 					 que permita sua utilização como marcador de fibrose . Além de uma redução desses  -->
<!-- 					 níveis após o tratamento com Bz. <br />  -->
<!-- 					Situação: Em andamento; Natureza: Pesquisa. <br />  -->
<!-- 					Alunos envolvidos: Graduação: (2) / Mestrado acadêmico: (1) . <br /> <br />  -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Coordenador. -->
					
<!-- 				</dd> -->
				
<!-- 				<dt class="panel panel-default panel-heading"> -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse3"> -->
<!-- 		          	Avaliação da Resposta Clínica e Imunológica ao Tratamento com Benzonidazo L em Pacientes Chagásicos na Fase Crônica -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2008 - 2015</span> -->
<!-- 		        </dt> -->
<!-- 		        <dd id="collapse3" class="panel-collapse panel-body collapse"> -->
<!-- 		        	O projeto visa avaliar a resposta clínica e sorologica de pacientes chagásicos  -->
<!-- 		        	após anos de tratamento com do Benzonidazol. <br />  -->
<!-- 					Situação: Em andamento; Natureza: Pesquisa. <br />  -->
<!-- 					Alunos envolvidos: Graduação: (3) . <br /> <br />  -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Coordenador. -->
		        	
<!-- 		        </dd> -->
		        
<!-- 		        <dt class="panel panel-default panel-heading"> -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse4"> -->
<!-- 		          	Controle da Doença de Chagas no Estado do Ceará -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2005 - 2010</span> -->
<!-- 		        </dt> -->
<!-- 		        <dd id="collapse4" class="panel-collapse panel-body collapse"> -->
<!-- 		        	Este projeto tem como objetivo avaliar o impacto do programa de controle vetorial da doença de Chagas no Estado do Ceará.  -->
<!-- 					Situação: Em andamento; Natureza: Pesquisa. <br /> <br />  -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Coordenador / Milena Mascarenhas dos Santos Ximenes - Integrante.<br />  -->
<!-- 					Financiador(es): Universidade Federal do Ceará - Outra.<br />  -->
		        	
<!-- 		        </dd> -->
				
<!-- 				<dt class="panel panel-default panel-heading"> -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse5"> -->
<!-- 		          	Monitoramento de Pacientes Chagásicos Atendidos no Ambulatório do Hospital Universitário Walter Cantídio em Tratamento com Benzonidazol -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2004 - 2007</span> -->
<!-- 		        </dt> -->
<!-- 		        <dd id="collapse5" class="panel-collapse panel-body collapse"> -->
<!-- 		        	Este projeto visa acompanhar os pacientes chagásicos em tratamento com benzonidazol no sentido de identificar, classificar, avaliar e resolver os problemas relacionados com medicamentos durante o tratamento. Neste período os pacientes são acompanhados por exames clínicos e laboratóriais..  -->
<!-- 					Situação: Em andamento; Natureza: Pesquisa. <br /><br /> -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Integrante / Vânia Maria Oliveira de Pontes - Coordenador / Luciana Costa de Menezes - Integrante / Alcidésio Sales Sousa Júnior - Integrante.<br /> -->
<!-- 					Financiador(es): Universidade Federal do Ceará - Auxílio financeiro. -->
		        	
<!-- 		        </dd> -->
		        
<!-- 		        <dt class="panel panel-default panel-heading"> -->
<!-- 		          <a class="panel-title" data-toggle="collapse" data-parent="#pagina" href="#collapse6"> -->
<!-- 		          	Avaliação de Problemas Relacionados a Medicamentos e Qualidade de Vida em Pacientes Chagásicos Usuários de Benzonidazol -->
<!-- 		          </a> -->
<!-- 		          <br /> -->
<!-- 		          <span>2006 - Atual</span> -->
<!-- 		        </dt> -->
<!-- 		        <dd id="collapse6" class="panel-collapse panel-body collapse"> -->
<!-- 		        	O projeto visa avaliar a qualidade de vida e os problemas relacionados a medicamentos dos pacientes chagásicos em tratamento com Benzonidazol.  -->
<!-- 					Situação: Em andamento; Natureza: Desenvolvimento. <br /> -->
<!-- 					Alunos envolvidos: Graduação: (2) / Mestrado acadêmico: (1) . <br /><br /> -->
					
<!-- 					Integrantes: Maria de Fátima Oliveira - Coordenador. -->
		        	
<!-- 		        </dd> -->
<!-- 			</dl> -->
		</div> <!-- Fim da Div de Página -->
<?php include "/layout/footer.php"; ?>