<?php

namespace _core\helpers\template;

use function _view\utils\merge;
use Timber;

Timber\Timber::$locations = [
	get_stylesheet_directory() . '/dist/',
	get_stylesheet_directory() . '/dist/views',
];

function render( $path, $context = [] ) {
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

function get_view_path( $path ) {
	return sprintf( '%1$s/%2$s/%3$s/%4$s/%5$s.twig', get_stylesheet_directory(), 'dist', 'views', $path, basename( $path ) );
}
