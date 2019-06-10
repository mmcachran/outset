<?php

namespace Pyxl\WPSettings\TemplateFunctions;

class TheExcerpt
{

    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_action('init', [self::instance(), 'pTags']);
    }

    public function pTags()
    {
        // Remove p tags from excerpt
        remove_filter('the_excerpt', 'wpautop');
    }
}