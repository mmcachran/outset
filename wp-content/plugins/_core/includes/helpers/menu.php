<?php

namespace _core\helpers\menu;

use Timber;

use function _core\helpers\utils\merge;
use function Functional\map;
use function Functional\select_keys;

function simplify_menu_items($menu_items){
    return map($menu_items, function($item){
        return merge(select_keys((array)$item, ['children', 'class', 'url', 'id']),[
            'children' => simplify_menu_items($item->children),
            'title' => $item->title,
        ]);
    });
}

function get($menu_name = ''){
    if (!$menu_name){
        return [];
    }
    $menu = new Timber\Menu($menu_name);

    return merge(select_keys((array)$menu, ['items', 'name', 'slug', 'id']),[
        'items' => simplify_menu_items($menu->items)
    ]);
}