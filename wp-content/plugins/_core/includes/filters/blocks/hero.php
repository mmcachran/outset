<?php

namespace _core\filters\blocks;

use Timber;
use _core\helpers\image;

use function _core\helpers\utils\has_key;
use function Functional\map;

function hero( $data ) {
	return map(
		$data,
		function( $value, $key ) use ( $data ) {
			if ( has_key( $key, [ 'image' ] ) ) {
				return image\reformat_from_timber( new Timber\Image( $value ) );
			}

			return $value;
		}
	);
}
