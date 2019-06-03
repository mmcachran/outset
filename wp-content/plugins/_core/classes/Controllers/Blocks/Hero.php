<?php

namespace Core\Controllers\Blocks;

use Timber;

class Hero
{
    public static function init()
    {
        $class = new self;
        add_filter('Blocks/Hero', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        var_dump(get_intermediate_image_sizes());
        if (class_exists(Timber\Image::class)) {
            $data['image'] = new Timber\Image($data['image']);
        }

        return $data;
    }
}