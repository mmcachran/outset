<?php

namespace Pyxl\WPSettings\DashboardWidgets;

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
        add_action('wp_dashboard_setup', [self::instance(), 'removals']);
    }

    public function removals()
    {
        remove_action('welcome_panel', 'wp_welcome_panel');

        $meta_boxes = [
            'dashboard_primary'         => 'side',
            'dashboard_quick_press'     => 'side',
            'dashboard_recent_drafts'   => 'side',
            'dashboard_incoming_links'  => 'side',
            'dashboard_plugins'         => 'normal',
            'dashboard_secondary'       => 'normal',
            'dashboard_recent_comments' => 'normal',
            'dashboard_right_now'       => 'normal',
            'dashboard_activity'        => 'normal',
        ];

        foreach ($meta_boxes as $key => $value) {
            remove_meta_box($key, 'dashboard', $value);
        }
    }
}
