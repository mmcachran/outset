<?php

namespace Core\Controllers\Globals;

use Core\Utils\General;

class FourOhFour
{
    public static function init()
    {
        $class = new self;
        add_filter('404', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        $fields = get_field('four_oh_four', 'site');
        return General::merge($data, $fields);
    }
}