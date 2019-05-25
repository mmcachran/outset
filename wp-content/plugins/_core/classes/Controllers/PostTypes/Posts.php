<?php

namespace Core\Controllers\PostTypes;

use Core\Utils\General;
use Core\Models\OptionsPages\Globals;

class Posts
{
    public static function init()
    {
        $class = new self;
        add_filter('Singles/Posts', [$class, 'singles']);
        add_filter('Archives/PostTypes/Posts', [$class, 'archives']);
    }

    public function archives($data)
    {
        return $data;
    }

    public function singles($data)
    {
        return $data;
    }
}