<?php

namespace _core\helpers\query;

use Timber;
use _core\helpers\post;

use function _core\helpers\utils\merge;

/**
 * Query single post from by id
 *
 * @param boolean $post_id
 * @return array
 */
function post_by_id( $post_id ) {
	return post\simplify( new Timber\Post( $post_id ) );
}

/**
 * Query single post from context
 *
 * @return array
 */
function post() {
	return post\simplify( new Timber\Post( get_the_ID() ) );
}

/**
 * Query multiple posts by providing an array of id's with post type support
 *
 * @param array $post_ids
 * @return void
 */
function posts_by_ids( $post_ids = [], $post_type = 'post' ) {
	$query = new Timber\PostQuery(
		[
			'post__in'  => $post_ids,
			'post_type' => $post_type,
		]
	);
	return [
		'posts'      => post\simplify_multiple( $query->get_posts() ),
		'pagination' => (array) $query->pagination(),
	];
}

/**
 * Query based on view context
 *
 * @return array
 */
function posts() {
	$query = new Timber\PostQuery();
	return [
		'posts'      => post\simplify_multiple( $query->get_posts() ),
		'pagination' => (array) $query->pagination(),
	];
}

/**
 * Query all public post types
 *
 * @param array $args
 * @param string $output
 * @param [type] $operator
 * @return array
 */
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
