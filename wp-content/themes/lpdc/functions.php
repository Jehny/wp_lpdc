<?php
register_nav_menu( 'main-menu', __( 'Main Menu' ) );

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'banners_post_type' );

add_post_type_support('banners', 'thumbnail');

function banners_post_type() {
	register_post_type( 'banners',
			array(
					'labels' => array(
							'name' => __( 'Banners' ),
							'singular_name' => __( 'Banner' )
					),
					'public' => true,
					'has_archive' => true,
			)
	);
}
?>