<?php

namespace _core\helpers\menu;

use Timber;

use function _core\helpers\utils\merge;
use function Functional\map;
use function Functional\select_keys;

function simplify_menu_items( $menu_items, $menu_item_fields ) {
	return map(
		$menu_items,
		function( $item ) use ($menu_item_fields) {
			$meta = get_menu_meta( $item, $menu_item_fields );

			return merge(
				select_keys( (array) $item, [ 'children', 'class', 'url', 'id', 'target' ] ),
				[
					'children' => simplify_menu_items( $item->children, $menu_item_fields ),
					'title'    => $item->title,
				],
				$meta
			);
		}
	);
}

function get( $menu_name, $menu_fields = [], $menu_item_fields = [] ) {
	$menu = new Timber\Menu( $menu_name );
	$meta  = get_menu_meta($menu, $menu_fields);

	return merge(
		select_keys( (array) $menu, [ 'items', 'name', 'slug', 'id' ] ),
		[
			'items' => simplify_menu_items( $menu->items, $menu_item_fields ),
		],
		$meta
	);
}

function get_menu_meta($menu, $fields) {
	return array_reduce(
		$fields,
		function ($_meta, $field) use ($menu) {
			$field_name = is_array($field)
				? $field[0]
				: $field;
			$field_key = is_array($field)
				? $field[1]
				: $field;
			$field_value = get_field($field_name, $menu);
			$_meta[$field_key] = $field_value;
			return $_meta;
		},
		[]
	);
}
