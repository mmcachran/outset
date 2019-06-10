<?php

namespace Core\Models\PostTypes;

class Testimonials extends RegisterPostType
{
    const SLUG = 'testimonial';

    const REST_BASE = 'testimonials';

    const SINGULAR = 'Testimonial';

    const PLURAL = 'Testimonials';

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