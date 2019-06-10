<?php

namespace Pyxl\View\StaticPages;

class StyleGuide extends RegisterPage
{
    public static function init()
    {
        parent::register([
            'page_title' => 'Style Guide',
            'slug'       => 'style-guide',
            'path'       => 'Misc/StyleGuide',
        ]);
    }
}