<?php

namespace Core\Controllers\Globals;

use Core\Utils\General;

class Header
{
    public static function init()
    {
        $class = new self;
        add_filter('globals/header', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        return $data;
    }
}