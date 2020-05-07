<?php

namespace _core\helpers\menu;

use Timber;

use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function Functional\map;
use function Functional\select_keys;

function simplify_menu_items( $menu_items ) {
	if ( ! is_array( $menu_items ) ) {
		return $menu_items;
	}

	return map(
		$menu_items,
		function( $item ) {
			return merge(
				select_keys( (array) $item, [ 'children', 'class', 'url', 'id', 'target' ] ),
				[
					'children' => simplify_menu_items( $item->children ),
					'title'    => $item->title,
					'icon'     => has_key( 'icon', $item ) ? $item->icon : [],
				],
			);
		}
	);
}

function get( $menu_name ) {
	$menu = new Timber\Menu( $menu_name );

	return merge(
		select_keys( (array) $menu, [ 'name', 'slug', 'id' ] ),
		[
			'items' => simplify_menu_items( $menu->items ),
		]
	);
}
