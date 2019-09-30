<?php

namespace _core\helpers\image;
use function _view\utils\merge;
use function Functional\map;

function create_sizes_urls( $src, $sizes ){
    return array_reverse(map($sizes,
        function($size) use ($src) {
            return merge($size, [
                'url' => dirname($src) . "/{$size['file']}",
            ]);
        }
    ));
}

function reformat_from_timber($timber_image){
	if (!$timber_image){
		return [];
	};

	return [
		'alt' => $timber_image->alt,
		'src' => $timber_image->src,
		'srcset' => $timber_image->srcset,
		'img_sizes' => $timber_image->img_sizes,
		'sizes' => create_sizes_urls($timber_image->src, $timber_image->sizes)
	];
}