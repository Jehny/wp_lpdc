<div id="menu">
	<h1 class="logoTopo"><a href="<?php echo get_bloginfo('home') ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo_LPDC.png" alt="Laboratório em Doenças de Chagas" /></a></h1>
	<ul class="inline"> 
        <?php 
                $paginas = get_pages('sort_column=menu_order&sort_order=ASC'); 
                foreach ($paginas as $pagina):
                	if($pagina->menu_order != ''){

        ?> 
        				<li><a href="<?php echo get_permalink($pagina->ID) ?>"><?php echo $pagina->post_title ?></a></li> 


        <?php 		}
        		endforeach; ?> 
	</ul>
</div>