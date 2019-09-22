<?php

namespace _core\query;

use Timber\PostQuery;
use Timber\Post;

use function Functional\map;
use function _core\helpers\utils\merge;

function post($post_id) {
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
