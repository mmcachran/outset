<?php

namespace _view\utils;

use const _view\PATH;
use const _view\URI;

function get_post_preview_image( $post_id ) {
	if ( get_field( 'listing_image' ) ) {
		return map_acf_image( get_field( 'listing_image' ) );
	} else {
		return map_wp_image( $post_id );
	}
}

function map_wp_image( $post_id ) {
	$image_id = get_post_thumbnail_id( $post_id );
	return [
		'src'    => wp_get_attachment_image_url( $image_id, 'your_image_size' ),
		'alt'    => get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: __( 'Pyxl Image', 'view' ),
		'srcset' => wp_get_attachment_image_srcset( $image_id ),
	];
}

function map_acf_image( $acf_image ) {
	return [
		'src'    => $acf_image['url'],
		'alt'    => $acf_image['alt'] ?: __( 'Pyxl Image', 'view' ),
		'srcset' => wp_get_attachment_image_srcset( $acf_image['ID'] ),
	];
}

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

/**
 *
 * Includes SVG ready for responsive display
 *
 * @param string $svg name of svg to render - If $create_path is false this must be a full URL
 * @param boolean $echo return or echo svg
 * @param boolean $create_path create path to our svg folder or use path provided
 * @return HTML svg tag wrapped in resposive html elements
 *
 **/

function include_svg( $svg, $echo = true, $create_path = true ) {
	$theme_directory = PATH;
	$id              = ! $create_path ? '' : $svg;
	if ( $create_path ) {
		$svg = $theme_directory . 'assets/svgs/' . $svg . '.svg';
		if ( ! file_exists( $svg ) ) {
			return;
		}
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName
		$loadType = 'load';
	} else {
		$curl = getstatus( $svg );
		if ( 400 === $curl['status'] ) {
			return;
		}
		$svg = $curl['return'];
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName
		$loadType = 'loadHTML';
	}
	$doc = new \DOMDocument();
	// phpcs:ignore WordPress.NamingConventions.ValidVariableName
	$doc->$loadType( $svg );
	$svg = $doc->getElementsByTagName( 'svg' );
	foreach ( $svg as $s ) {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName
		$svg_ratio = $s->getAttribute( 'viewBox' );
		$svg_ratio = explode( ' ', $svg_ratio );
		unset( $svg_ratio[0] );
		unset( $svg_ratio[1] );
	}
	$return = '<div class="svg" id="' . $id . '" aria-hidden="true"><canvas width="' . $svg_ratio[2] . '" height="' . $svg_ratio[3] . '"></canvas>' . $svg->item( 0 )->C14N() . '</div>';
	if ( $echo ) {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = [
			'svg'   => [
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			],
			'g'     => [ 'fill' => true ],
			'title' => [ 'title' => true ],
			'path'  => [
				'd'    => true,
				'fill' => true,
			],
		];

		$allowed_tags = array_merge( $kses_defaults, $svg_args );

		echo wp_kses( $return, $allowed_tags );
	} else {
		return $return;
	}
}
