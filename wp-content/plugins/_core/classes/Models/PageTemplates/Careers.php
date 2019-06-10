<?php

namespace Core\Models\PageTemplates;

class Careers extends RegisterPageTemplate
{
    const SLUG = 'careers';
    const SINGULAR = 'Career';
    const PLURAL = 'Careers';

    public static function init()
    {
        parent::register([
            'slug'     => self::SLUG,
            'singular' => self::SINGULAR,
            'plural'   => self::PLURAL,
        ]);
    }
}