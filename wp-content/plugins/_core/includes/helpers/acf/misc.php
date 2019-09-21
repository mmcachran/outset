<?php

namespace _core\helpers\acf\misc;

use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function Functional\each;

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


function easy_field_transformations( $prefix, $fields ) {
	$adjusted_fields = [];

	each(
		$fields,
		function ( $field ) use ( $prefix ) {

			$fields = slug_handler( $prefix, $field );
			$fields = conditional_logic_handler( $prefix, $field );

			if ( has_key( 'sub_fields', $field ) ) {
				$adjusted_field['sub_fields'] = easy_field_transformations( $prefix, $field['sub_fields'] );
			}
		}
	);

	return $adjusted_fields;
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
