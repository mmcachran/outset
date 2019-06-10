<?php

namespace Core\Controllers\Globals;

use Core\Utils\General;

class Footer
{
    public static function init()
    {
        $class = new self;
        add_filter('Globals/Footer', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        return $data;
    }
}