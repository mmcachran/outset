<?php

namespace _core\models\field_groups;

use _core\helpers\acf\location;
use _core\helpers\field;

use function _core\helpers\utils\push;

function testimonial( $field_groups ) {
	$post_type = get_post_type_object( 'testimonial' );
	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(
					[
						'label' => __( 'Location', 'core' ),
						'slug'  => 'location',
					]
				),
				field\text(
					[
						'label' => __( 'Position', 'core' ),
						'slug'  => 'position',
					]
				),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function social_menu_item( $field_groups ) {
	return push(
		$field_groups,
		[
			'slug'     => 'social_menu_item',
			'name'     => 'Social Menu',
			'fields'   => [
				field\text(
					[
						'label' => __( 'Icon', 'core' ),
						'slug'  => 'icon',
					]
				),
			],
			'position' => 'normal',
			'location' => location\social_menu(),
		]
	);
}


function event( $field_groups ) {
	$post_type = get_post_type_object( 'event' );

	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function career( $field_groups ) {
	$post_type = get_post_type_object( 'career' );
	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(
					[
						'label' => __( 'Location', 'core' ),
						'slug'  => 'location',
					]
				),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}
