<?php

namespace Pyxl\WPSettings\Security;

class Assets
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

    public function removals()
    {
        add_filter('style_loader_src', [self::instance(), 'removeAssetVersion'], 9999, 2);
        add_filter('script_loader_src', [self::instance(), 'removeAssetVersion'], 9999, 2);
    }

    /**
     * Pick out the version number from scripts and styles
     */
    public function removeAssetVersion($src, $handle)
    {
        $handles_with_version = ['style']; // <-- Adjust to your needs!
        if (strpos($src, 'ver=') && !in_array($handle, $handles_with_version, true)) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
}