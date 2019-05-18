<?php

namespace Core\Models\PostTypes;

use Core\Utils\ACF;

class Page
{
    const SLUG = 'page';

    const REST_BASE = 'pages';

    const SINGULAR = 'Page';

    const PLURAL = 'Pages';

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'modify']);
    }

    public function modify()
    {
        remove_post_type_support(self::SLUG, 'custom-fields');
    }
}