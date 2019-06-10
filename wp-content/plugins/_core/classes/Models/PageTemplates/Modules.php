<?php

namespace Core\Models\PageTemplates;

class Modules extends RegisterPageTemplate
{
    const SLUG = 'modules';
    const SINGULAR = 'Module';
    const PLURAL = 'Modules';

    public static function init()
    {
        parent::register([
            'slug'     => self::SLUG,
            'singular' => self::SINGULAR,
            'plural'   => self::PLURAL,
        ]);
    }
}