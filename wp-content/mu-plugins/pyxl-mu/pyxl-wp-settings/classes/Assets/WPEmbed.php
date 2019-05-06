<?php

namespace Pyxl\WPSettings\Assets;

class WPEmbed
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
        add_action('wp_footer', [self::instance(), 'removeWPEmbed']);
    }

    public function removeWPEmbed()
    {
        if (is_user_logged_in()) {
            return;
        }
        wp_deregister_script('wp-embed');
    }
}