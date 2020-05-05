<?php

namespace _core\helpers\post;

use _core\helpers\image;
use _core\helpers\taxonomy;

use function _core\helpers\utils\has_key;
use function Functional\map;

/**
 * Simplify returned post from a single timber query
 *
 * @param array $post
 * @return array
 */
function simplify( $post = [] ) {

	if ( 'testimonial' === $post->post_type ) {
		return [
			'title'          => $post->title(),
			'content'        => $post->content(),
			'excerpt'        => (string) $post->preview()->length( 25 )->read_more( 'read more' ),
			'author'         => $post->author->display_name,
			'link'           => get_the_permalink( $post->id ),
			'post_type'      => $post->post_type,
			'location'       => $post->meta( 'location' ),
			'position'       => $post->meta( 'position' ),
			'name'           => $post->meta( 'name' ),
			'featured_image' => image\reformat_from_timber( $post->thumbnail() ),
		];
	}

	return [
		'title'          => $post->title(),
		'content'        => $post->content(),
		'excerpt'        => (string) $post->preview()->length( 25 )->read_more( 'read more' ),
		'author'         => $post->author->display_name,
		'date'           => [
			'posted'   => $post->date( 'M d, Y' ),
			'modified' => $post->modified_date( 'M d, Y' ),
		],
		'link'           => get_the_permalink( $post->id ),
		'post_type'      => $post->post_type,
		'tags'           => taxonomy\simplify( $post->terms( 'post_tag' ) ),
		'categories'     => taxonomy\simplify( $post->terms( 'category' ) ),
		'featured_image' => image\reformat_from_timber( $post->thumbnail() ),
	];
}

function simplify_multiple( $posts = [] ) {
	return map(
		$posts,
		function( $post ) {
			return simplify( $post );
		}
	);
}
