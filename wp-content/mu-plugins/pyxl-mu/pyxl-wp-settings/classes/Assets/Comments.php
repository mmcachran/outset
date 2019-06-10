<?php

namespace Pyxl\WPSettings\Assets;

class Comments
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
        add_action('widgets_init', [self::instance(), 'recentCommentsStyle']);
    }

    public function recentCommentsStyle()
    {
        global $wp_widget_factory;
        remove_action('wp_head', [
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style',
        ]);
    }
}