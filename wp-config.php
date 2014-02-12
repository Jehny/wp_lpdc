<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'lpdc');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$N7ktYhq/@K(^=_&ND[c0Ysf^?L9T[}=*R;j;[H-@1V[x0JiK,E&mZEWL.L3yBY&');
define('SECURE_AUTH_KEY',  '6!_@9sE3{H DupA^eWSrD*Pa[Ttiwo3Ope3r?cU!7?j>4|-W %G30(lmro`3J,bZ');
define('LOGGED_IN_KEY',    '?@8+DIcg`7*NP1e?N#JFeyay5~b*Ob!j]*.zTY1Om508tS@Ka>@#[I]g}d{i)N]g');
define('NONCE_KEY',        's/&~rEUu78}M^`}eD=C1&.W]ZIoTe;XB|%VNq&v2~+<p^mIL537fCqz-gmm[Lm^$');
define('AUTH_SALT',        '-{j[;kxp,ry<5KT;`5W9/5&>(G-UR+N`.K}@~&TKY^D-DPj]/XL>c!n=G8%efd)=');
define('SECURE_AUTH_SALT', 'evxHVxZCO!gdS?>&c/X{bY7[FTB<p#6|/R,CREz&fPlvaQF&BlY.?fG+`-|tJsC0');
define('LOGGED_IN_SALT',   '`oA/l0T?XBeA21K&M{6VWKoYR|<ZPT92Y|!>&XQ-Xf_ZHuB,ZfU+Fp5Z_/*@n`OB');
define('NONCE_SALT',       '~ H$:%f$~6Su0lO#S}NZ|$m,|GjkN(f!8(C`alSL6{1[N/[|?%^+iWwEK}Y5{Sn]');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
