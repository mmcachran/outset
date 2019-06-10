<?php

namespace Pyxl\WPSettings\Security;

class FileEditor
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
        add_action('admin_init', [self::instance(), 'removeFileEditor']);
    }

    public function removeFileEditor()
    {
        defined('DISALLOW_FILE_EDIT') || define('DISALLOW_FILE_EDIT', true);
    }
}