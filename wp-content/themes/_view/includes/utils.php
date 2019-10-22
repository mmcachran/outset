<?php

namespace _view\utils;

use function Functional\each;

function push( $original_array, ...$additional_arrays ) {
	foreach ( $additional_arrays as $additional_array ) {
		$original_array[] = $additional_array;
	}

	return $original_array;
}


function merge( ...$params ) {
	return array_merge( ...$params );
}

function has_key( $key, $data ) {
	if ( is_array( $data ) ) {
		return array_key_exists( $key, $data );
	}
	if ( is_object( $data ) ) {
		return property_exists( $data, $key );
	}
}

function get_glob_brace_pattern( $paths = [] ) {
	$pattern = '{';

	foreach ( $paths as $path ) {
		$pattern .= $path . ',';
	}

	$pattern .= '}';

	return glob( $pattern, GLOB_NOSORT | GLOB_BRACE );
}

function safe_require( $path ) {
	if ( ! stream_resolve_include_path( $path ) ) {
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped, WordPress.PHP.DevelopmentFunctions.error_log_var_export
		wp_die( '<pre>' . var_export( $path, true ) . wp_kses_post( sprintf( '</pre>', 'Error: %s missing', $path ) ) );
	} else {
		require_once $path;
	}
}

function glob_autoloader( $paths = [] ) {
	each( get_glob_brace_pattern( $paths ), __NAMESPACE__ . '\safe_require' );
}
