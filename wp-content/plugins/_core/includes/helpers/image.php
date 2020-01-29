<?php

namespace _core\helpers\image;

use Timber;
use function _view\utils\merge;
use function Functional\map;

function create_sizes_urls( $src, $sizes ) {
	$urls = map(
		$sizes,
		function( $size ) use ( $src ) {
			return merge(
				$size,
				[
					'url' => dirname( $src ) . "/{$size['file']}",
				]
			);
		}
	);

	usort(
		$urls,
		function( $a, $b ) {
			return $a['width'] <=> $b['width'];
		}
	);

	return array_reverse( $urls );
}

function reformat_from_timber( $timber_image ) {
	if ( ! $timber_image ) {
		return [];
	};

	$img_src = wp_get_attachment_image_src( $timber_image->ID, 'full' );

	$sizes   = create_sizes_urls( $timber_image->src, $timber_image->sizes );
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

function image_from_post_id( $post ) {
	return reformat_from_timber( new Timber\Image( get_post_thumbnail_id( $post ) ) );
}
