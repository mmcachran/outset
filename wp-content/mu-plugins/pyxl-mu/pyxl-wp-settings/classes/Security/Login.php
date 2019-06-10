<?php

namespace Pyxl\WPSettings\Security;

class Login
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
        add_filter('login_errors', [self::instance(), 'showLessLoginInfo']);
    }

    /**
     * Show less info to users on failed login for security.
     * (Will not let a valid username be known.)
     */
    public function showLessLoginInfo()
    {
        return _('<strong>Incorrect</strong>: Sorry, please try again or reset your password.');
    }
}