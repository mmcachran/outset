<?php

namespace Core\Models\PostTypes;

class Events extends RegisterPostType
{
    const SLUG = 'event';

    const REST_BASE = 'events';

    const SINGULAR = 'Event';

    const PLURAL = 'Events';

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