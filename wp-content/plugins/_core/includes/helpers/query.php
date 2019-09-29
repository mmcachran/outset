<?php

namespace _core\helpers\query;

use Timber;
use _core\helpers\image;

use function Functional\map;
use function Functional\select_keys;



function post($post_id) {
	if (!isset($post_id)){
		return [];
	}

	$post    = new Timber\Post( $post_id );
	$featured_image = $post->thumbnail();


	return [
		'title'   => $post->title(),
		'content' => $post->content(),
		'author' => $post->author->display_name,
		'date' => [
			'posted' => $post->date('M d, Y'),
			'modified' => $post->modified_date('M d, Y'),
		],
		'link' => get_the_permalink($post_id),
		'post_type' => $post->post_type,
		'tags' => map($post->terms('post_tag'), function($term){
			return select_keys((array)$term, ['name', 'slug', 'taxonomy', 'id']);
		}),
		'categories' => map($post->terms('category'), function($term){
			return select_keys((array)$term, ['name', 'slug', 'taxonomy', 'id']);
		}),
		'featured_image' => [
			'alt' => $featured_image->alt,
			'src' => $featured_image->src,
			'srcset' => $featured_image->srcset,
			'img_sizes' => $featured_image->img_sizes,
			'sizes' => image\format_sizes_data($featured_image)
		],
	];
}
