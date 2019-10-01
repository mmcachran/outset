<?php

namespace _core\filters\taxonomies;

use function _core\helpers\utils\push;

function event( $taxonomies ) {
	return push(
		$taxonomies,
		[
			'slug'     => 'event_type',
			'singular' => __( 'Event Type', '_core' ),
			'plural'   => __( 'Event Types', '_core' ),
			'types'    => [ 'event' ],
		]
	);
}

function location( $taxonomies ) {
	return push(
		$taxonomies,
		[
			'slug'     => 'location',
			'singular' => __( 'Location', '_core' ),
			'plural'   => __( 'Locations', '_core' ),
			'types'    => [ 'career' ],
		]
	);
}
