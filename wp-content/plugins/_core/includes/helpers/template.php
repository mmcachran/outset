<?php

namespace _core\helpers\template;

use function _view\utils\merge;
use Timber;

Timber\Timber::$locations = [
	get_stylesheet_directory() . '/dist',
	get_stylesheet_directory() . '/dist/views',
];

function render( $path, $context = [] ) {
	if ( ! file_exists( get_view_path( $path ) ) ) {
		// translators: %s: Title of field group
		wp_die( esc_html( sprintf( __( 'File %s not found', 'core' ), get_view_path( $path ) ) ) );
	}

	Timber\Timber::render(
		get_view_path( $path ),
		merge(
			[
				'base' => basename( $path ),
			],
			(array) $context
		)
	);
}

function render_svg( $path ) {
	if ( ! file_exists( get_svg_path( $path ) ) ) {
		// translators: %s: Title of field group
		wp_die( esc_html( sprintf( __( 'File %s not found', 'core' ), get_svg_path( $path ) ) ) );
	}
	Timber\Timber::render( get_svg_path( $path ), [] );
}

function get_view_path( $path ) {
	return sprintf( '%1$s/%2$s/%3$s/%4$s/%5$s.twig', get_stylesheet_directory(), 'dist', 'views', $path, basename( $path ) );
}

function get_svg_path( $path ) {
	return sprintf( '%1$s/%2$s/%3$s/%4$s.svg', get_stylesheet_directory(), 'dist', 'svgs', basename( $path ) );
}
