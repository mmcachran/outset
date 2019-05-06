<?php

namespace Pyxl\View\Utils;

use const Pyxl\View\DEBUG;

class Debug
{
    public static function init()
    {
        if (!DEBUG) {
            return;
        }
        $class = new self;
        add_action('view_main', [$class, 'show_queried'], 1);
    }

    public function show_queried()
    {
        var_dump(get_queried_object());
    }

    function log()
    {
        if (!WP_DEBUG_LOG) {
            return;
        }

        foreach (func_get_args() as $arg) {
            error_log("--------------------------------------------------------------------------------------------------");
            if (is_array($arg) || is_object($arg)) {
                error_log(print_r($arg, true));

            } else {
                error_log($arg);
            }
            error_log("--------------------------------------------------------------------------------------------------");
        }
    }
}