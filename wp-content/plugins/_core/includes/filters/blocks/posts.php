<?php

namespace _core\filters\blocks;

use Timber\Timber;
use function _core\helpers\post\simplify_multiple;
use function _view\utils\merge;
use function Functional\map;

function posts( $data ) {

	return merge(
		$data,
		map(
			$data,
			function( $value, $key ) use ( $data ) {
				// For either post type, use the ID's from ACF and return formatted Timber Post objects
				if ( in_array( $key, [ 'posts', 'events' ], true ) ) {
					return array_slice( handle_posts( $value, $key, $data['post_type'] ), 0, 3 );
				}
				return $value;
			}
		)
	);
}

function handle_posts( $value, $key, $post_type = 'post' ) {
	if ( in_array( $key, [ 'posts', 'events' ], true ) ) {
		// Combine both specific and latest posts
		return merge(
			// Get specific requested posts
			simplify_multiple(
				Timber::get_posts(
					[
						'post_type' => $post_type,
						'post__in'  => empty( $value ) ? [] : $value,
					]
				)
			),
			// Get latest posts
			simplify_multiple(
				Timber::get_posts(
					[
						'post_type'      => $post_type,
						'posts_per_page' => 3,
					]
				)
			)
		);
	};
	return $value;
}
