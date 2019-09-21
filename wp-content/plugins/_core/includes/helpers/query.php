<?php

namespace _core\query;

use Timber\PostQuery;
use Timber\Post;

use function Functional\map;
use function _core\helpers\utils\merge;

function get_offices( $query_params = [] ) {
	$posts = new PostQuery(
		merge(
			[
				'post_type' => 'offices',
			],
			$query_params
		)
	);

	return map(
		$posts,
		function ( $post ) {
			return merge(
				[
					'title'   => $post->title(),
					'content' => $post->content(),
				],
				get_fields( $post->ID )
			);
		}
	);
}


function get_post() {
	$post_id = get_the_ID();
	$post    = new Post( $post_id );

	return merge(
		[
			'title'   => $post->title(),
			'content' => $post->content(),
		],
		get_fields( $post_id )
	);
}
