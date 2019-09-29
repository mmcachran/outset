<?php

namespace _core\helpers\image;
use function _view\utils\merge;
use function Functional\map;

function format_sizes_data( $timber_image ){
    return map($timber_image->sizes, function($size) use ($timber_image) {
        return merge($size, [
            'url' => dirname($timber_image->src) . "/{$size['file']}",
        ]);
    });
}