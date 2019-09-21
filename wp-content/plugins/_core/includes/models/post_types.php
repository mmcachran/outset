<?php

namespace _core\models\post_types;

use function _core\helpers\utils\merge;
use function Functional\each;

function career() {
	 return [
		 'slug'      => 'career',
		 'singular'  => 'Career',
		 'plural'    => 'Careers',
		 'menu_icon' => 'dashicons-layout',
	 ];
}

function event() {
	return [
		'slug'     => 'event',
		'singular' => 'Event',
		'plural'   => 'Events',
	];
}

function testimonial() {
	return [
		'slug'     => 'testimonial',
		'singular' => 'Testimonial',
		'plural'   => 'Testimonials',
	];
}
