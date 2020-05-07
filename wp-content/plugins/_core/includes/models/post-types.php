<?php

namespace _core\models\post_types;

use function _core\helpers\utils\push;

function career( $post_types = [] ) {
	return push(
		$post_types,
		[
			'slug'      => 'career',
			'singular'  => 'Career',
			'plural'    => 'Careers',
			'menu_icon' => 'dashicons-layout',
		]
	);
}

function event( $post_types = [] ) {
	return push(
		$post_types,
		[
			'slug'     => 'event',
			'singular' => 'Event',
			'plural'   => 'Events',
		]
	);
}

function testimonial( $post_types = [] ) {
	return push(
		$post_types,
		[
			'slug'     => 'testimonial',
			'singular' => 'Testimonial',
			'plural'   => 'Testimonials',
		]
	);
}


function staff( $post_types = [] ) {
	return push(
		$post_types,
		[
			'slug'     => 'staff',
			'singular' => 'Staff',
			'plural'   => 'Staff',
		]
	);
}
