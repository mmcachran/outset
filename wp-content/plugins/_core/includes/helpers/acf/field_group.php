<?php

namespace _core\helpers\acf\field_group;

use function _core\helpers\utils\merge;
use function _core\helpers\has_key;

function create( $args ) {
	$required = [
		'name',
		'slug',
		'fields',
	];

	foreach ( $required as $key ) {
		if ( has_key( $key, $args ) ) {
			continue;
		}
		return new WP_Error( 'broke', __( 'Arguments "' . $key . '" is required', 'core' ) );
	}

	//https://www.advancedcustomfields.com/resources/register-fields-via-php/
	register_field_group(
		merge(
			[
				'key'                   => "group_{$args['slug']}",
				'title'                 => "{$args['name']}",
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'description'           => '',
				'fields'                => [],
				'hide_on_screen'        => [
				// 'permalink',
				// 'the_content',
				// 'excerpt',
				// 'discussion',
				// 'comments',
				// 'revisions',
				// 'slug',
				// 'author',
				// 'format',
				// 'page_attributes',
				// 'featured_image',
				// 'categories',
				// 'tags',
				// 'send-trackbacks',
				],
				'location'              => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'post',
						],
					],
				],
			],
			$args
		)
	);
}

function location_post_type( $post_type = 'post' ) {
	return [
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => $post_type,
			],
		],
	];
}
