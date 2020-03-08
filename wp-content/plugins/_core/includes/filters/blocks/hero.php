<?php

namespace _core\filters\blocks;

use Timber;
use _core\helpers\image;
use function Functional\map;

function hero( $data ) {
	return map(
		$data,
		function( $value, $key ) use ( $data ) {

			if ( in_array( $key, [ 'background_desktop', 'background_mobile' ], true ) ) {
				return ! empty( $value ) ? image\reformat_from_timber( new Timber\Image( $value ) ) : [];
			}

			return $value;
		}
	);
}
