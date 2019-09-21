<?php

namespace _core\autoloader;

use const _core\PATH;
use function Functional\each;

function get_glob_brace_pattern( $paths = [] ) {
	$pattern = '{';

	foreach ( $paths as $path ) {
		$pattern .= PATH . $path . ',';
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

function simple_glob_require( $paths = [] ) {
	each( get_glob_brace_pattern( $paths ), __NAMESPACE__ . '\safe_require' );
}
