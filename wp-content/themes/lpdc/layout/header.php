<?php 

	global $pageDescription;
	global $pageKeywords;
	global $footerAdicional;
	global $message;
	
	$pageDescription = "Laboratório de Pesquisa em Doenças de Chagas";
	$pageKeywords = "LPDC, laborátorio, UFC, Pesquisa, Doenças de Chagas, Chagas";
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet" media="all">
	<title> LPDC - <?php echo get_the_title(); ?></title>
	<link href="<?php bloginfo('template_url'); ?>/css/ldp.css" rel="stylesheet" media="all">
	<link href="<?php bloginfo('template_url'); ?>/css/fontes.css" rel="stylesheet" media="all">
	<link href="<?php bloginfo('template_url'); ?>/css/icons.css" rel="stylesheet" media="all">
	<link href="<?php bloginfo('template_url'); ?>/css/print_ficha_1.css" rel="stylesheet" media="print">
	<link href="<?php bloginfo('template_url'); ?>/css/print_ficha_2.css" rel="stylesheet" media="print">
	<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.0.3.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/ldp.js"></script>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="<?php echo $pageKeywords; ?>">
	<meta name="author" content="Canto Certo">
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/logo.png" />
</head>
<body>
	<div id="conteudo">
		<header>
			<div class="beforeHeader">
				<div id="redeSociais" class="row-fluid">
					<ul class="inline">
						<li class="span6"></li>
						<li class="span6 searchLi">
							<img src="<?php bloginfo('template_url'); ?>/img/face.png" alt="Facebook" title="Facebook" class="social" />
							<img src="<?php bloginfo('template_url'); ?>/img/twitter.png" alt="Twitter" title="Twitter" class="social" />
							<img src="<?php bloginfo('template_url'); ?>/img/search.png" alt="Buscar" title="Buscar" class="searchImg" />
							<input type="text" placeholder="Pesquisar no Site">
						</li>
					</ul>
				</div>
			</div>
			<?php include "menu.php"; ?>
			
		</header>
