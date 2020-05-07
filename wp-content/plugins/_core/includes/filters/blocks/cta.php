<?php

namespace _core\filters\blocks;

use function Functional\map;
use function _core\helpers\image\get_image_from_id_formatted;

function cta( $data ) {
	return map(
		$data,
		function( $value, $key ) use ( $data ) {

			if ( 'classes' === $key ) {
				return join(
					' ',
					[
						$value,
						is_int( $data['image'] ) ? 'light' : 'dark',
					]
				);
			}

			if ( 'image' === $key ) {
				return get_image_from_id_formatted( $value );
			}

			return $value;
		}
	);
}
