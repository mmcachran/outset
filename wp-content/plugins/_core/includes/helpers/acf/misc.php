<?php

namespace _core\helpers\acf\misc;

use function _core\helpers\utils\has_key;
use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\merge;
use function Functional\map;

/**
 * Create Field Group
 *
 * A function to take advantage of custom defaults for a field group our registrations a bit more DRY.
 *
 * @param array $override
 * @return void
 * @since 1.0.0
 */
function create_field_group_arguments( $args = [] ) {
	if ( ! has_every_key( [ 'name', 'slug', 'fields' ], $args ) ) {
		return;
	}

	// https://www.advancedcustomfields.com/resources/register-fields-via-php/
	return merge(
		[
			'key'                   => "group_{$args['slug']}",
			// phpcs:disable WordPress.WP.I18n.NoEmptyStrings
			// translators: %s: Title of field group
			'title'                 => esc_html( sprintf( __( '%s', 'core' ), $args['name'] ) ),
			'fields'                => [],
			'location'              => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					],
				],
			],
			'menu_order'            => 0,
			'position'              => 'normal', // normal, side
			'style'                 => 'default',
			'label_placement'       => 'top', // top, left
			'instruction_placement' => 'label',
			'hide_on_screen'        => [], // permalink, the_content, excerpt, discussion, comments, revisions, slug, author, format, page_attributes, featured_image, categories, tags, send-trackbacks
			'active'                => true,
			'description'           => '',
		],
		$args
	);
}

function field_shorthand_translator( $prefix, $fields ) {
	return map(
		$fields,
		function( $field ) use ( $prefix, $fields ) {
			return merge(
				$field,
				slug_handler( $prefix, $field ),
				conditional_logic_handler( $prefix, $field ),
				sub_field_handler( $prefix, $field ),
				[]
			);
		}
	);
}

function sub_field_handler( $prefix, $field ) {
	if ( has_key( 'sub_fields', $field ) ) {
		return merge(
			$field,
			[
				'sub_fields' => field_shorthand_translator( "{$prefix}/{$field['slug']}", $field['sub_fields'] ),
			]
		);
	}
	return $field;
}

function slug_handler( $prefix, $field ) {
	if ( ! has_key( 'slug', $field ) ) {
		return $field;
	}

	return merge(
		$field,
		[
			'key'  => "{$prefix}/{$field['slug']}",
			'name' => $field['slug'],
		]
	);
}

function conditional_logic_handler( $prefix, $field ) {

	if ( ! has_key( 'conditional_logic', $field ) ) {
		return $field;
	}

	$adjusted_condition_group = [];

	foreach ( $field['conditional_logic'] as $condition_set ) {
		$new_set = [];

		foreach ( $condition_set as $condition ) {
			$adjusted_condition = [];

			if ( has_key( 'field', $condition ) ) {
				$adjusted_condition = array_merge(
					$condition,
					[
						'field' => "{$prefix}/{$condition['field']}",
					]
				);
			}

			$new_set[] = $adjusted_condition;
		}

		$adjusted_condition_group[] = $new_set;
	}

	$field['conditional_logic'] = $adjusted_condition_group;

	return $field;
}
