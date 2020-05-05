<?php

namespace _core\filters\blocks;

use Timber;
use _core\helpers\image;

use function _core\helpers\utils\has_key;
use function Functional\map;
use function _core\helpers\image\get_image_from_id_formatted;

function hero( $data ) {
	return map(
		$data,
		function( $value, $key ) use ( $data ) {

			if ( 'image' === $key ) {
				return get_image_from_id_formatted( $value );
			}

			return $value;
		}
	);
}
