<?php

namespace _core\helpers\template;

use Timber\Timber;
use WP_Error;
use const _core\PATH;

function render( $path, $context = [] ) {
	Timber::render( get_view_location( get_view_path( $path ) ), (array) $context );
}

function get_view_path( $path ) {
	return trailingslashit( $path ) . basename( $path ) . '.twig';
}

function get_view_location( $path ) {
	if ( file_exists( get_stylesheet_directory() . $path ) ) {
		return get_stylesheet_directory() . $path;
	}
	if ( file_exists( PATH . $path ) ) {
		return PATH . $path;
	}

	return PATH . get_view_path( 'views/misc/Missing' );
}

