<?php

namespace Pyxl\WPSettings\AdminBar;

use Pyxl\WPSettings\Utils\SVG;

class Additions
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
        add_action('admin_bar_menu', [self::instance(), 'add'], -1);
    }

    public function add($wp_admin_bar)
    {
        $wp_admin_bar->add_menu(
            apply_filters('pyxl_admin_bar_logo', [
                'id'    => 'logo',
                'title' => SVG::get('admin-bar-logo'),
                'href'  => esc_url(get_admin_url()),
                'meta'  => [
                    'title' => __('Simple Launch'),
                ],
            ])
        );
    }
}