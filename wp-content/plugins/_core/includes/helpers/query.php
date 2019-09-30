<?php

namespace _core\helpers\query;

use Timber;
use _core\helpers\image;
use _core\helpers\post;

use function _core\helpers\utils\merge;
use function Functional\map;
use function Functional\select_keys;

function post($post_id = false) {
	return post\simplify(new Timber\Post( $post_id ?: get_the_ID() ));
}

function posts() {
	$query    = new Timber\PostQuery();
	return [
		'posts' => post\simplify_multiple($query->get_posts()),
		'pagination' => (array)$query->pagination()
	];
}