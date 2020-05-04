<?php

namespace _core\helpers\image;

use Timber;

/**
 * Easy to use image query for most images
 *
 * @param [type] $id
 * @return array
 */
function get_image_from_id_formatted( $id ) {
	return reformat_from_timber( new Timber\Image( $id ) );
}

/**
 * Function to reformat a timber image into something we prefer to use
 *
 * @param int $timber_image
 * @return array
 */
function reformat_from_timber( $timber_image ) {
	if ( ! $timber_image ) {
		return [];
	};

	$img_src = wp_get_attachment_image_src( $timber_image->ID, 'full' );

	$sizes[] = [
		'file'      => basename( $timber_image->src ),
		'url'       => $timber_image->src,
		'height'    => ( is_array( $img_src ) ) ? $img_src[2] : '',
		'width'     => ( is_array( $img_src ) ) ? $img_src[1] : '',
		'mime-type' => $timber_image->post_mime_type,
	];

	return [
		'alt'       => $timber_image->alt,
		'src'       => $timber_image->src,
		'height'    => ( is_array( $img_src ) ) ? $img_src[2] : '',
		'width'     => ( is_array( $img_src ) ) ? $img_src[1] : '',
		'srcset'    => $timber_image->srcset,
		'img_sizes' => $timber_image->img_sizes,
		'sizes'     => $sizes,
	];
}

function default_images() {
	$theme_uri = get_stylesheet_uri();
	return [
		'thumbnail' => [
			'url' => esc_url( "{$theme_uri}/images/thumbnail.jpg" ),
			'alt' => __( 'Thumbnail Default Image', 'core' ),
		],
		'tiny'      => [
			'url' => esc_url( "{$theme_uri}/images/tiny.jpg" ),
			'alt' => __( 'Tiny Default Image', 'core' ),
		],
		'small'     => [
			'url' => esc_url( "{$theme_uri}/images/small.jpg" ),
			'alt' => __( 'Small default image', 'core' ),
		],
		'medium'    => [
			'url' => esc_url( "{$theme_uri}/images/medium.jpg" ),
			'alt' => __( 'Medium default image', 'core' ),
		],
		'large'     => [
			'url' => esc_url( "{$theme_uri}/images/large.jpg" ),
			'alt' => __( 'Large default image', 'core' ),
		],
		'full'      => [
			'url' => esc_url( "{$theme_uri}/images/full.jpg" ),
			'alt' => __( 'Full default image', 'core' ),
		],
	];
}
