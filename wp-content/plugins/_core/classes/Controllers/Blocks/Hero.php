<?php

namespace Core\Controllers\Blocks;

class Hero
{
    public static function init()
    {
        $class = new self;
        add_filter('Blocks/Hero', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        return $data;
    }
}