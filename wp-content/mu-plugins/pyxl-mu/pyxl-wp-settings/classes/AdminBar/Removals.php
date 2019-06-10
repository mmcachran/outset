<?php

namespace Pyxl\WPSettings\AdminBar;

class Removals
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
        add_action('admin_bar_menu', [self::instance(), 'remove'], 999);
    }

    public function remove($wp_admin_bar)
    {
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('customize');
        $wp_admin_bar->remove_menu('comments');
    }
}