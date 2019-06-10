<?php

namespace Core\Models\PostTypes;

class Careers extends RegisterPostType
{
    const SLUG = 'career';

    const REST_BASE = 'careers';

    const SINGULAR = 'Career';

    const PLURAL = 'Careers';

    public static function init()
    {
        parent::register(
            self::class,
            [
                'menu_icon' => 'dashicons-media-document',
            ]
        );
    }
}