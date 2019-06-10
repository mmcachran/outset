<?php

namespace Core\Models\PageTemplates;

class Testimonials extends RegisterPageTemplate
{
    const SLUG = 'testimonials';
    const SINGULAR = 'Testimonial';
    const PLURAL = 'Testimonials';

    public static function init()
    {
        parent::register([
            'slug'     => self::SLUG,
            'singular' => self::SINGULAR,
            'plural'   => self::PLURAL,
        ]);
    }
}