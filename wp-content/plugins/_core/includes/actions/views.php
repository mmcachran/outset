<?php

namespace _core\actions\views;

use function _core\helpers\template\render;

function head( $data ) {
	render( 'global/head', $data );
}

function header( $data ) {
	printf( '<body class="%s">', esc_html( join( get_body_class(), ' ' ) ) );
	require_once get_stylesheet_directory() . '/dist/svgs/sprite.svg';
	printf( '<div id="wrapper" class="%s">', esc_html( join( apply_filters( '_view/wrapper/classes', [ 'wrapper' ] ) ) ) );
	printf( '<main class="%s">', esc_html( join( apply_filters( '_view/main/classes', [ 'main' ] ) ) ) );
	render( 'global/header', $data );
}

function footer( $data ) {
	render( 'global/footer', $data );
	printf( '</main><!-- main -->' );
	printf( '</div><!-- #wrapper -->' );
	printf( '</body><!-- body -->' );
}

function archive( $data ) {
	render( 'archive/post_type/default', $data );
}

function singular( $data ) {
	render( 'single/default', $data );
}

function post( $data ) {
	render( 'single/post', $data );
}
