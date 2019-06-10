<?php

namespace Pyxl\WPSettings\Utils;

class PluginLists
{

    public static function active()
    {
        return get_option('active_plugins');
    }

    public static function installed()
    {
        return get_plugins();
    }
}