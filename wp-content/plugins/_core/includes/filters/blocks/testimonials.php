<?php

namespace _core\filters\blocks;

use function _core\helpers\query\posts_by_ids;
use function _view\utils\merge;
use function Functional\map;

function testimonials( $data ) {
	return merge(
		$data,
		map(
			$data,
			function( $value, $key ) {
				if ( 'testimonials' === $key ) {
					return posts_by_ids( $value, 'testimonial' );
				}
				return $value;
			}
		)
	);
}
