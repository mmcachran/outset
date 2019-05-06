<?php

namespace Pyxl\View\Setup;

class General
{
    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'general']);
        add_action('init', [$class, 'registerSidebars']);
    }

    /**
     * General.
     */
    public function general()
    {

        add_theme_support('align-wide');

        add_theme_support('title-tag');

        add_theme_support('automatic-feed-links');

        add_theme_support('post-thumbnails');

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );

        add_theme_support('align-wide');
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');

        add_theme_support('disable-custom-font-sizes');
        add_theme_support('disable-custom-colors');


    }


    /**
     * Register Sidebars.
     */
    public function registerSidebars()
    {

    }
}