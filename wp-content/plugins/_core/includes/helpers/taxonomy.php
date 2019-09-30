<?php

namespace _core\helpers\taxonomy;

use _core\helpers\image;
use function _core\helpers\utils\merge;
use function Functional\map;
use function Functional\select_keys;

function simplify($terms = []){
    if (empty($terms)){
        return [];
    };

    return [
        'taxonomy' => $terms[0]->taxonomy,
        'items' => map($terms, function($term){
            return merge(select_keys((array)$term, ['name', 'slug', 'taxonomy', 'id']), [
                'link' => $term->link,
            ]);
        })
    ];
}