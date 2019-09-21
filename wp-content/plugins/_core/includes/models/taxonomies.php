<?php

namespace _core\models\taxonomies;

function event() {
	return [
		'slug'     => 'event_type',
		'singular' => __( 'Event Type', '_core' ),
		'plural'   => __( 'Event Types', '_core' ),
		'types'    => [ 'event' ],
	];
}

function location() {
	return [
		[
			'slug'     => 'location',
			'singular' => __( 'Location', '_core' ),
			'plural'   => __( 'Locations', '_core' ),
			'types'    => [ 'career' ],
		],
	];
}
