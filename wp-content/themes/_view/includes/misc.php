<?php

namespace _view\utils;

use const _view\PATH;
use const _view\URI;

function get_file_as_string( $path ) {
	ob_start();
	include_once $path;
	return ob_get_clean();
}

function string_dashes_to_camelcase( $string, $capitalize_first_character = false ) {

	$str = str_replace( '-', '', ucwords( $string, '-' ) );

	if ( ! $capitalize_first_character ) {
		$str = lcfirst( $str );
	}

	return $str;
}

function register_style( $handle, $src = '', $deps = [], $ver = false, $media = 'all' ) {
	wp_register_style( $handle, env_check( $src ), $deps, mod_time( $ver ), $media );
}

function load_style( $string ) {
	wp_enqueue_style( $string );
}

function register_script( $handle, $src, $deps = [], $ver = false, $in_footer = true, $async = false, $defer = false ) {
	wp_register_script( $handle, env_check( $src ), $deps, mod_time( $src ), $in_footer );
	if ( $async ) {
		add_filter(
			'view/enqueues/async',
			function( $array ) use ( $handle ) {
				return merge( $array, [ $handle ] );
			}
		);
	}
	if ( $defer ) {
		add_filter(
			'view/enqueues/defer',
			function( $array ) use ( $handle ) {
				return merge( $array, [ $handle ] );
			}
		);
	}
}

function localize_script_data( $handle, $object_name, $l10n ) {
	wp_localize_script( $handle, $object_name, $l10n );
}

function load_script( $string ) {
	wp_enqueue_script( $string );
}

function mod_time( $file ) {
	if ( ! file_exists( PATH . $file ) ) {
		return null;
	}

	return filemtime( PATH . $file );
}

/**
 * Checks for a minified version of given asset and attempts a string to help load it
 */
function env_check( $path ) {
	// Create a string to match a possible production file e.g.( app.min.js ) which is likely uglified/minified.
	$file_path      = substr( $path, 0, strrpos( $path, '.' ) );
	$file_extension = substr( $path, strrpos( $path, '.' ) );

	// Test for production file e.g.( app.min.js)
	if ( file_exists( PATH . $file_path . '.min' . $file_extension ) ) {
		return URI . $file_path . '.min' . $file_extension;
	} elseif ( file_exists( PATH . $path ) ) {
		// If dev file exists e.g( app.js )
		return URI . $path;
	} else {
		// If neither exist, return null
		return null;
	}
}
