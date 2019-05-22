<?php

namespace Core\Controllers\PostTypes;

use Core\Utils\General;
use Core\Models\OptionsPages\Globals;

class Events
{
    public static function init()
    {
        $class = new self;
        add_filter('Singles/Events', [$class, 'singles']);
        add_filter('Archives/PostTypes/Events', [$class, 'archives']);
    }

    public function archives($data)
    {

    }

    public function singles($data)
    {

    }
}