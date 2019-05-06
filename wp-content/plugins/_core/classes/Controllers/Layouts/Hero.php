<?php

namespace Core\Controllers\Layouts;

use Core\Utils\General as Util;

class Hero
{
    public static function init()
    {
        $class = new self;
        add_filter('Layouts/Hero', [$class, 'filter']);
    }

    public function filter($context)
    {
        return $context;
    }
}