<?php

namespace Pyxl\WPSettings\AdminNotices;

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
        add_action('admin_init', [self::instance(), 'run'], 99);
    }

    public function run()
    {
        // Duplicate Post Nonsense
        remove_action('admin_notices', 'duplicate_post_show_update_notice');
    }
}