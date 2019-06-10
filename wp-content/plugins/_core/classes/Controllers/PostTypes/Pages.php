<?php

namespace Core\Controllers\PostTypes;

use Core\Utils\General;
use Core\Utils\WordPress;

class Pages
{
    public static function init()
    {
        $class = new self;
        add_filter('Singles/Pages', [$class, 'singles']);
    }

    public function singles($data)
    {
        return $data;
    }
}