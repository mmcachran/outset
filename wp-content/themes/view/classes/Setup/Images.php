<?php

namespace Pyxl\View\Setup;

use Pyxl\View\Utils\Helpers;

class Images
{
    // https://wpshout.com/wordpress-custom-image-sizes/
    const SIZES = [
        [
            'name'   => 'Thumbnail',
            'slug'   => 'thumbnail',
            'width'  => 120,
            'height' => 120,
            'crop'   => true,
        ],
        [
            'name'  => 'Small',
            'slug'  => 'small',
            'width' => 550,
            'height' => 550,
            'crop'   => false,
        ],
        [
            'name'  => 'Medium',
            'slug'  => 'medium',
            'width' => 720,
        ],
        [
            'name'  => 'Large',
            'slug'  => 'large',
            'width' => 1200,
        ],
        [
            'name'  => 'Full Size',
            'slug'  => 'full',
            'width' => 2048,
        ],
    ];

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'register_sizes']);
        add_filter('intermediate_image_sizes_advanced', [$class, 'deregister_sizes']);
        add_filter('image_size_names_choose', [$class, 'image_size_choices_registration'], 10, 1);
        add_action('admin_print_styles', [$class, 'hide_sizes_interface']);
    }

    public function register_sizes()
    {
        foreach (self::SIZES as $size) {
            add_image_size(
                $size['slug'],
                $size['width'],
                Helpers::has_key('height', $size) ? $size['height'] : null,
                Helpers::has_key('crop', $size) ? $size['crop'] : null
            );
        }
    }

    public function image_size_choices_registration($sizes)
    {
        foreach (self::SIZES as $size) {
            $sizes[$size['slug']] = __($size['name']);
        }

        return $sizes;
    }

    public function deregister_sizes($sizes)
    {
        $removals = [
            // 'thumbnail',
            // 'small',
            // 'medium',
            'medium_large',
            // 'large',
        ];

        foreach ($removals as $size) {
            unset($sizes[$size]);
        }
        return $sizes;
    }

    public function hide_sizes_interface()
    {
        $screen = get_current_screen();

        // Media Options Page Only
        if ('options-media' !== $screen->id) {
            return;
        }

        /**
         * Unfortunately, this may be the only way to remove this section.
         */
        ?>
        <style>
            #wpbody-content .title:first-of-type,
            #wpbody-content .title:first-of-type + p,
            #wpbody-content .form-table:first-of-type {
                display: none;
            }
        </style>
        <?php
    }
}