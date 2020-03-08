<?php

namespace _core\helpers\template;

use Timber;
use _core\helpers\image;

use function _core\helpers\acf\misc\check_for_link;
use function _view\utils\merge;
use function Functional\map;


/**
 * Adding template paths to Timber
 *
 * This will look for twig files in the paths provided.
 */
Timber\Timber::$locations = [
	get_stylesheet_directory() . '/dist',
	get_stylesheet_directory() . '/dist/views',
];

/**
 * View render
 *
 * Will attempt to put together a full path based on shorthand looking in the theme views directory for a match.
 * Example - 'single/post' would end up trying to fine 'wp-content/themes/_view/single/post/post.twig'.
 *
 * @since 1.0.0
 *
 * @param [type] $path
 * @param array $context
 * @return void
 */
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

/**
 * SVG Render
 *
 * Will attempt to put together a full path based on shorthand looking in the theme dist svgs directory for a match.
 * Example - 'single/post' would end up trying to fine 'wp-content/themes/_view/single/post/post.twig'.
 *
 * @since 1.0.0
 *
 * @param [type] $path
 * @return void
 */
function render_svg( $path ) {
	if ( ! file_exists( get_svg_path( $path ) ) ) {
		// translators: %s: Title of field group
		wp_die( esc_html( sprintf( __( 'File %s not found', 'core' ), get_svg_path( $path ) ) ) );
	}
	Timber\Timber::render( get_svg_path( $path ), [] );
}

/**
 * Get view path
 *
 * Will take a shorthand string and create a matching path to the theme views directory
 *
 * @since 1.0.0
 *
 * @param [type] $path
 * @return string
 */
function get_view_path( $path ) {
	return sprintf( '%1$s/%2$s/%3$s/%4$s/%5$s.twig', get_stylesheet_directory(), 'dist', 'views', $path, basename( $path ) );
}

/**
 * Get svg path
 *
 * Will take a shorthand string and create a matching path to the theme svg directory
 *
 * @param [type] $path
 * @return string
 * @since 1.0.0
 */
function get_svg_path( $path ) {
	return sprintf( '%1$s/%2$s/%3$s/%4$s.svg', get_stylesheet_directory(), 'dist', 'svgs', basename( $path ) );
}

/**
 * Setup ACF fields
 *
 * Converts ACF id values to their corresponding post/image/link array.
 *
 * @param [type] $path
 * @return string
 * @since 1.0.0
 */
function setup_fields( $fields ) {
	return map(
		$fields,
		function( $field, $key ) {

			if ( in_array( $key, [ 'post', 'event', 'product', 'post_1', 'post_2', 'testimonial' ], true ) ) {
				return ! empty( $field ) ? simplify( Timber\Timber::get_post( $field ) ) : [];
			}

			if ( in_array( $key, [ 'background_video' ], true ) && $field ) {
				$pattern = "/src\s*=\s*(\"|')(([^\"';]*))(\"|')/";
				preg_match( $pattern, $field, $matches );

				return str_replace( $matches[2], "{$matches[2]}&autoplay=1&controls=0&mute=1", $field );
			}

			if ( is_array( $field ) ) {
				return setup_fields( $field );
			}

			if ( in_array( $key, [ 'image', 'icon', 'background_image', 'background_image_mobile', 'image_1', 'image_2', 'image_caption', 'background_desktop', 'background_mobile' ], true ) ) {
				return image\reformat_from_timber( new Timber\Image( $field ) );
			}

			if ( in_array( $key, [ 'link', 'link_primary', 'link_secondary' ], true ) ) {
				return check_for_link( $field );
			}

			return $field;
		}
	);
}
