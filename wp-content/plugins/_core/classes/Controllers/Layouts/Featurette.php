<?php

namespace Core\Controllers\Layouts;

class Featurette
{
    public static function init()
    {
        $class = new self;
        add_filter('layouts/modules/featurette', [$class, 'filter']);
    }

    public function filter($context)
    {
        return $context;
    }
}