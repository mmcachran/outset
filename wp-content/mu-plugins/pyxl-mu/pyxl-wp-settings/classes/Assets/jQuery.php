<?php

namespace Pyxl\WPSettings\Assets;

class jQuery
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
        // Replace jQuery with CDN and load in Footer
        add_action('wp_enqueue_scripts', [self::instance(), 'jQuerySwap'], -1);
    }

    public function jQuerySwap()
    {
        /*
         * Swap for jQuery Google API
         * We shouldn't bundle jQuery in WordPress for a lot of reasons,
         * but we can at least swap it for a version that is probably cached
         */
        if (is_user_logged_in() && is_admin()) {
            return;
        }
        if (is_admin()) {
            return;
        }

        // jQuery Core
        wp_deregister_script('jquery-core');
        $jQuery_core = '//code.jquery.com/jquery-1.12.4.min.js';
        wp_register_script('jquery-core', $jQuery_core, false, '1.12.4', true);

        // jQuery Migrate
        wp_deregister_script('jquery-migrate');
        $jQuery_migrate = '//code.jquery.com/jquery-migrate-1.2.1.min.js';
        wp_register_script('jquery-migrate', $jQuery_migrate, true, '1.2.1', true);

        wp_enqueue_script('jquery-core');
        wp_enqueue_script('jquery-migrate');
    }
}