<?php

namespace _core\helpers\acf\misc;

use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function Functional\map;

function easy_field_transformations( $prefix, $fields ) {
	return map($fields, function($field) use ($prefix){
		return merge(
			$field,
			slug_handler($prefix, $field),
			conditional_logic_handler( $prefix, $field),
			[
				'sub_fields' => has_key('sub_fields', $field) ? easy_field_transformations( "{$prefix}/{$field['slug']}", $field['sub_fields'] ) : [],
			]
		);
	});
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
