<?php

namespace _core\models\field_groups;

use function _core\helpers\acf\field_group\location_post_type;
use _core\models\pos;
use _core\helpers\fields;
use Timber\PostType;

function event() {
	$post_type = PostTypes\event();

	return [
		'slug'     => $post_type['slug'],
		'name'     => __( 'Additional Information', 'core' ),
		'fields'   => [
			fields\text(),
		],
		'position' => 'side',
		'location' => location_post_type( $post_type['slug'] ),
	];
}

function career() {
	 $post_type = PostTypes\career();
	return [
		'slug'     => $post_type['slug'],
		'name'     => __( 'Additional Information', 'core' ),
		'fields'   => [
			fields\text(),
			fields\content(),
			fields\image(),
		],
		'position' => 'side',
		'location' => location_post_type( $post_type['slug'] ),
	];
}

function testimonial() {
	$post_type = PostTypes\career();
	return [
		'slug'     => $post_type['slug'],
		'name'     => __( 'Additional Information', 'core' ),
		'fields'   => [
			fields\text(),
			fields\content(),
			fields\image(),
		],
		'position' => 'side',
		'location' => location_post_type( $post_type['slug'] ),
	];
}
