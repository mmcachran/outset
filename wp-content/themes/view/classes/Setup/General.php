<?php

namespace Pyxl\View\Setup;

class General
{
    public static function init()
    {
        // General
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

        // Block Editor Settings
        add_theme_support('align-wide');
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support('disable-custom-font-sizes');
        add_theme_support('disable-custom-colors');

        $colors = [
            [
                'name'  => 'Magenta',
                'color' => '#a156b4',
            ],
            [
                'name'  => 'Dark Gray',
                'color' => '#444444',
            ],
        ];

        add_theme_support('editor-color-palette', array_map(function ($color) {
            return [
                'name'  => $color['name'],
                'slug'  => sanitize_title($color['name']),
                'color' => $color['color'],
            ];
        }, $colors));
    }
}