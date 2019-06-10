<?php

namespace Pyxl\WPSettings\Utils;

class Role
{
    public static function updateRoleCaps($role_slug, $capabilities)
    {
        $role = get_role($role_slug);

        foreach ($capabilities as $key => $value) {
            $role->add_cap($key);
        }
    }

    public static function createRole($slug, $display_name, $capabilities)
    {
        if (get_role($slug)) {
            return;
        }
        add_role($slug, $display_name, $capabilities);
    }

}