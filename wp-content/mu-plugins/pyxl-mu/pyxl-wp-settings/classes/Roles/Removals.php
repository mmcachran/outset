<?php

namespace Pyxl\WPSettings\Roles;

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
        add_action('admin_init', [self::instance(), 'removals']);
    }

    public static function removals()
    {
        $default_roles = [
            'subscriber',
            'contributor',
            'editor',
            'author',
        ];

        foreach ($default_roles as $role) {
            if (get_role($role)) {
                remove_role($role);
            }
        }
    }
}