<?php

namespace _core\helpers\query;

use Timber;
use _core\helpers\post;

use function _core\helpers\utils\merge;

function post( $post_id = false ) {
	return post\simplify( new Timber\Post( $post_id ?: get_the_ID() ) );
}

function posts() {
	$query = new Timber\PostQuery();
	return [
		'posts'      => post\simplify_multiple( $query->get_posts() ),
		'pagination' => (array) $query->pagination(),
	];
}

function post_types( $args = [], $output = 'objects', $operator = null ) {
	return get_post_types(
		merge(
			[
				'public' => true,
			],
			$args
		),
		$output
	);
}
