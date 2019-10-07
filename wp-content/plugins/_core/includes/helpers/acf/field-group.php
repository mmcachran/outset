<?php

namespace _core\helpers\acf\field_group;

use function _core\helpers\acf\misc\field_shorthand_translator;
use function _core\helpers\acf\misc\create_field_group_arguments;
use function _core\helpers\utils\has_every_key;
use function Functional\map;


/**
 * Create Field Group
 *
 * Our entry point for registering field groups
 *
 * @param [type] $args
 * @return void
 * @since 1.0.0
 */
function create( $args ) {
	if ( ! has_every_key( [ 'name', 'slug', 'fields' ], $args ) ) {
		return;
	}

	if ( ! function_exists( 'register_field_group' ) ) {
		return;
	}

	register_field_group(
		map(
			create_field_group_arguments( $args ),
			function( $item, $key ) use ( $args ) {
				if ( 'fields' === $key ) {
					return field_shorthand_translator( $args['slug'], $args['fields'] );
				}
				return $item;
			}
		)
	);
}
