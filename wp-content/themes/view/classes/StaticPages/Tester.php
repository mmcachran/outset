<?php

namespace Pyxl\View\StaticPages;

class Tester extends RegisterPage
{
    public static function init()
    {
        parent::register([
            'page_title' => 'Tester',
            'slug'       => 'tester',
            'path'       => 'Misc/Tester',
        ]);
        flush_rewrite_rules(true);
    }
}